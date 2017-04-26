<?php  
  
    $appid = "wxfe10b513b25caf7a";  
    $callbackurl="http://www.tangweb.cn/wechat/gettest.php";
    $callbackurl=urlencode($callbackurl);
    echo $callbackurl;
   $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxfe10b513b25caf7a&redirect_uri=http%3A%2F%2Fwww.tangweb.cn%2Fwechat%2Fgettest.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
   header("Location:".$url);  
  
?>  