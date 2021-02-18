<?php
include("../../oreo/oreo.core.php");
if($islogin2==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
//验证Token
$module = $_POST['module'];
$timestamp = $_POST['timestamp'];
$token = md5($module.'#$@%!^*'.$timestamp);
if($token != $_POST['token']){
exit('{"code":7,"msg":"我们将记录您的非法操作并作出相应的处罚！"}');
}//验证token结束
$row=$DB->query("SELECT * FROM oreo_shop_details WHERE out_trade_no='{$_POST['id']}' AND status='1' AND shop_type='0' AND seller='$pid'  limit 1")->fetch();
if(!$row)exit('{"code":-1,"msg":"不满足退款条件"}');
$shop_user=$DB->query("SELECT * FROM oreo_shop_real WHERE user='{$row['user']}' limit 1")->fetch();
if(!$shop_user){
$DB->exec("INSERT INTO `oreo_shop_apply` (`user`, `odd_numbers`, `real_name`, `alipay_id`,  `money`, `addtime`, `transfer_status`, `transfer_result`, `transfer_date`) VALUES ('{$pid}', '{$_POST['id']}', '', '', '{$row['money']}', '{$date}', '', '', '')");
exit('{"code":6,"msg":"您的账户尚未实名认证，暂时不能自动退款到账户，目前为您创建退款订单，请耐心等待管理员处理"}');
}else{
$DB->exec("INSERT INTO `oreo_shop_apply` (`user`, `odd_numbers`, `real_name`, `alipay_id`,  `money`, `addtime`, `transfer_status`, `transfer_result`, `transfer_date`) VALUES ('{$pid}', '{$_POST['id']}', '{$shop_user['real_name']}', '{$shop_user['alipay_id']}', '{$row['money']}', '{$date}', '', '', '')");
}
header('Content-type:text/html; Charset=utf-8');

$rs=$DB->query("select * from oreo_shop_site");
while($rowcon=$rs->fetch()){ 
	$shop_conf[$rowcon['o']]=$rowcon['r'];
}
$appid = $shop_conf['alipay_appid'];  //https://open.alipay.com 账户中心->密钥管理->开放平台密钥，填写添加了电脑网站支付的应用的APPID
$outTradeNo = uniqid();     //商户转账唯一订单号
$payAmount = $row['money'];           //转账金额，单位：元 （金额必须大于等于0.1元)
if($row['name']=="oreo实名认证"){
$remark = "Oreo综合服务站-认证退款";    //转帐备注
}else{
$remark = $shop_conf['payer_show_name'];    //转帐备注
}
$signType = 'RSA2';       //签名算法类型，支持RSA2和RSA，推荐使用RSA2
//商户私钥，填写对应签名算法类型的私钥，如何生成密钥参考：https://docs.open.alipay.com/291/105971和https://docs.open.alipay.com/200/105310
$saPrivateKey=$shop_conf['alipay_privatekey'];
$account = $shop_user['alipay_id'];      //收款方账户（支付宝登录号，支持邮箱和手机号格式。）
$realName = $shop_user['real_name'];     //收款方真实姓名
$aliPay = new AlipayService($appid,$saPrivateKey);
$result = $aliPay->doPay($payAmount,$outTradeNo,$account,$realName,$remark);
$result = $result['alipay_fund_trans_toaccount_transfer_response'];
if($result['code'] && $result['code']=='10000'){
$data['code']=0;
$data['ret']=2;
$data['msg']='success';  
$data['result']='支付宝转账单据号：'.$result['order_id'].  ' 支付时间：'.$result['pay_date']; 
$DB->exec("update `oreo_shop_apply` set `transfer_status`='1',`transfer_result`='".$result['order_id']."',`transfer_date`='".$result['pay_date']."' where `odd_numbers`='{$_POST['id']}'");  
$DB->exec("update `oreo_shop_user` set frozen_balance=frozen_balance-{$row['money']}  where `user`='{$pid}'");
$DB->exec("update `oreo_shop_details` set `shop_type`='4'  where  out_trade_no='{$_POST['id']}'  AND  `seller`='$pid'");
if($row['name']=="oreo实名认证"){
$DB->exec("update `oreo_shop_real` set `activation`='2'  where `user`='{$pid}' ");
$DB->exec("update `oreo_shop_user` set `activation`='2'  where `user`='{$pid}' ");
//发送申请成功的手机短信
	$user_info=$DB->query("select * from oreo_shop_user where user='{$pid}' limit 1")->fetch();
	$sms_type='2';
	$user_name=$user;
	$phone=$user_info['phone'];
	$real_type='：实名认证已通过';
	$result = tensms_msg($sms_type,$phone, $user_name,$real_type);
}
//发送退款成功的手机短信
$user_info=$DB->query("select * from oreo_shop_user where `user`='{$pid}' limit 1")->fetch();
$sms_type='4';//短信类型
$user_name=$user_info['user'];//用户账号
$phone=$user_info['phone'];//手机号码
$order_num='尾号'.substr($_POST['id'],-4);$_POST['id'];//订单号
$apply_type='：支付宝';
$result = tensms_msg($sms_type,$phone, $user_name,$real_type,$order_num,$apply_type);
exit('{"code":0,"ret":2}');
}elseif($result['code']=='40004') {
$data['code']=0;
$data['ret']=3;
$data['msg']='fail';
$data['result']=$result['sub_msg'];
$DB->exec("update `oreo_shop_apply` set `transfer_status`='2',`transfer_result`='".$data['result']."' where `odd_numbers`='{$_POST['id']}'");
$DB->exec("update `oreo_shop_details` set `shop_type`='5'  where   out_trade_no='{$_POST['id']}' AND `seller`='$pid' ");
//发送退款异常的手机短信
$user_info=$DB->query("select * from oreo_shop_user where `user`='{$pid}' limit 1")->fetch();
$sms_type='3';//短信类型
$user_name=$user_info['user'];//用户账号
$phone=$user_info['phone'];//手机号码
$order_num='尾号'.substr($_POST['id'],-4);$_POST['id'];//订单号
$apply_type='：账号与姓名不匹配';
$result = tensms_msg($sms_type,$phone, $user_name,$real_type,$order_num,$apply_type);
exit('{"code":5,"msg":"'.$result['sub_msg'].'"}');
}
else{
    echo $result['msg'].' : '.$result['sub_msg'];
}
class AlipayService
{
    protected $appId;
    //私钥值
    protected $rsaPrivateKey;
    public function __construct($appid, $saPrivateKey)
    {
        $this->appId = $appid;
        $this->charset = 'utf8';
        $this->rsaPrivateKey=$saPrivateKey;
    }
    /**
     * 转帐
     * @param float $totalFee 转账金额，单位：元。
     * @param string $outTradeNo 商户转账唯一订单号
     * @param string $remark 转帐备注
     * @return array
     */
    public function doPay($totalFee, $outTradeNo, $account,$realName,$remark='')
    {
        //请求参数
        $requestConfigs = array(
            'out_biz_no'=>$outTradeNo,
            'payee_type'=>'ALIPAY_LOGONID',
            'payee_account'=>$account,
            'payee_real_name'=>$realName,  //收款方真实姓名
            'amount'=>$totalFee, //转账金额，单位：元。
            'remark'=>$remark,  //转账备注（选填）
        );
        $commonConfigs = array(
            //公共参数
            'app_id' => $this->appId,
            'method' => 'alipay.fund.trans.toaccount.transfer',             //接口名称
            'format' => 'JSON',
            'charset'=>$this->charset,
            'sign_type'=>'RSA2',
            'timestamp'=>date('Y-m-d H:i:s'),
            'version'=>'1.0',
            'biz_content'=>json_encode($requestConfigs),
        );
        $commonConfigs["sign"] = $this->generateSign($commonConfigs, $commonConfigs['sign_type']);
        $result = $this->curlPost('https://openapi.alipay.com/gateway.do',$commonConfigs);
        $resultArr = json_decode($result,true);
        if(empty($resultArr)){
            $result = iconv('GBK','UTF-8//IGNORE',$result);
            return json_decode($result,true);
        }
        return $resultArr;
    }
    public function generateSign($params, $signType = "RSA") {
        return $this->sign($this->getSignContent($params), $signType);
    }
    protected function sign($data, $signType = "RSA") {
        $priKey=$this->rsaPrivateKey;
        $res = "-----BEGIN RSA PRIVATE KEY-----\n" .
            wordwrap($priKey, 64, "\n", true) .
            "\n-----END RSA PRIVATE KEY-----";
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        if ("RSA2" == $signType) {
            openssl_sign($data, $sign, $res, version_compare(PHP_VERSION,'5.4.0', '<') ? SHA256 : OPENSSL_ALGO_SHA256); //OPENSSL_ALGO_SHA256是php5.4.8以上版本才支持
        } else {
            openssl_sign($data, $sign, $res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    /**
     * 校验$value是否非空
     *  if not set ,return true;
     *    if is null , return true;
     **/
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, $this->charset);
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = $this->charset;
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
                //$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
            }
        }
        return $data;
    }
    public function curlPost($url = '', $postData = '', $options = array())
    {
        if (is_array($postData)) {
            $postData = http_build_query($postData);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置cURL允许执行的最长秒数
        if (!empty($options)) {
            curl_setopt_array($ch, $options);
        }
        //https请求 不验证证书和host
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}