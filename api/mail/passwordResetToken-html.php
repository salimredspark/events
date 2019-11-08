<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
$resetLink = str_replace("api/web/","",$resetLink);

//$resetLink = Url::to(['site/reset-password', 'token' => $user->password_reset_token]);

$resetLink = (( isset($_SERVER['HTTPS'] ) )?'https':'http').'://hausbuddy.com/frontend/web/index.php?r=site/reset-password&token='.$user->password_reset_token;

$logo=  (( isset($_SERVER['HTTPS'] ) )?'https':'http').'://hausbuddy.com/email_images/logo/logo.png';
$loginlink=  Url::to(['site/login']);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="date=no" />
<meta name="format-detection" content="address=no" />
<meta name="format-detection" content="telephone=no" />
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"> 
<style type="text/css">
body {
    margin: 0px !important;
    padding: 0px !important;
    -webkit-text-size-adjust: 100% !important;
    -ms-text-size-adjust: 100% !important;
    -webkit-font-smoothing: antialiased !important;
}
html {
    width: 100%;
}
img {
    border: 0 !important;
    outline: none !important;
    display: block !important;
}
table {
    border-collapse: collapse;
    mso-table-lspace: 0px;
    mso-table-rspace: 0px;
}
td {
    border-collapse: collapse;
    mso-line-height-rule: exactly;
}
a, span {
    mso-line-height-rule: exactly;
}
a {
    text-decoration: none !important;
}
.ExternalClass * {
    line-height: 100%;
}
.video img {
    width: 100%;
    height: auto;
}
h1, h2, h3, h4, h5, h6 {
    line-height: 100% !important;
    -webkit-font-smoothing: antialiased;
}
yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
    color: black;
    text-decoration: none !important;
    border-bottom: none !important;
    background: none !important;
}
code {
    white-space: 300;
    word-break: break-all;
}
span a {
    text-decoration: none !important;
}
.yshortcuts a {
    border-bottom: none !important;
}
*[class="gmail-fix"] {
    display: none !important;
}
 @media only screen and (min-width:481px) and (max-width:599px) {
table[class=templetcontainer] {
    width: 100% !important;
}
table[class=spark_full_width_containt] {
    width: 100% !important;
}
td[class=spacer] {
    padding-left: 14px !important;
    padding-right: 14px !important;
}
td[class=remove] {
    display: none !important;
}
img[class=full_img] {
    width: 100% !important;
    height: auto !important;
}
td[class=height_f] {
    height: 20px !important;
}
td[class=video] img {
    width: 100% !important;
    height: auto !important;
}
td[class=text_center] {
    text-align: center !important;
}
.hide {
    display: none !important;
}
td[class="mob_hide"] {
    display: none !important;
    font-size: 0 !important;
    height: 0 !important;
    line-height: 0 !important;
    min-height: 0 !important;
    width: 0 !important;
}
td[class="templetcontainer2"] {
    float: left !important;
    width: 100% !important;
    display: block !important;
}
td[class=pad_bottom] {
    padding-bottom: 10px;
}
td[class=pad_top] {
    padding-top: 10px;
}
iframe {
    width: 100% !important;
    height: auto !important;
}
}
 @media only screen and (max-width:480px) {
table[class=templetcontainer] {
    width: 100% !important;
}
table[class=spark_full_width_containt] {
    width: 100% !important;
}
td[class="spacer"] {
    padding-left: 16px !important;
    padding-right: 16px !important;
}
td[class=remove] {
    display: none !important;
}
img[class=full_img] {
    width: 100% !important;
    height: auto !important;
}
td[class=height_f] {
    height: 20px !important;
}
td[class=video] img {
    width: 100% !important;
    height: auto !important;
}
td[class=text_center] {
    text-align: center !important;
}
.hide {
    display: none !important;
}
td[class=pad_bottom] {
    padding-bottom: 10px;
}
td[class=pad_top] {
    padding-top: 10px;
}
td[class="mob_hide"] {
    display: none !important;
    font-size: 0 !important;
    height: 0 !important;
    line-height: 0 !important;
    min-height: 0 !important;
    width: 0 !important;
}
td[class="templetcontainer2"] {
    float: left !important;
    width: 100% !important;
    display: block !important;
}
table[class="center_align"] {
    float: none !important;
    margin: 0 auto !important;
    display: block !important;
    width: 165px !important;
}
iframe {
    width: 100% !important;
    height: auto !important;
}
}



/* Hide spacer image in applications that support media queries */
@media only screen and (max-width: 600px) {
*[class="gmail-fix"] {
    display: none !important;
}
}
</style>
</head>
<body marginwidth="0" marginheight="0" offset="0" topmargin="0" leftmargin="0" bgcolor="#d7dde5">
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#d7dde5">
  <tr class="gmail-fix">
    <td><table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
        <tr>
          <td cellpadding="0" cellspacing="0" border="0" height="1"; style="line-height: 1px; min-width: 600px; mso-line-height-rule: exactly;"><img src="images/spacer.gif" width="600" height="1" style="display: block; max-height: 1px; min-height: 1px; min-width: 600px; width: 600px; "/></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
  </tr>
  <tr>
    <td class="spacer" align="center"><table class="templetcontainer" style="table-layout:fixed; background-color:#e7e7e7;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#e7e7e7">
        <tr>
          <td align="center"><table class="templetcontainer" style="table-layout:fixed; background-color:#ffffff;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#ffffff">
              <tr>
                <td class="height_f" height="30">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table class="templetcontainer" align="center" cellspacing="0" cellpadding="0" width="600" border="0">
                    <tr>
                      <td class="remove" width="20">&nbsp;</td>
                      <td align="center"><a href="#" target="_blank"><img src="http://hausbuddy.com/email_images/logo/logo.png" alt="Haus Buddy" style="display:block; max-width:260px;" width="260" height="49" border="0"></a></td>
                      <td class="remove" width="20">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td class="height_f" height="30">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="spacer" align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="templetcontainer" bgcolor="#ffffff" style="table-layout:fixed; background-color:#ffffff;" >
        <tr>
          <td width="20" class="remove">&nbsp;</td>
          <td width="" class="spacer"><table width="560" border="0" cellspacing="0" cellpadding="0" align="center" class="templetcontainer">
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              
              <tr>
                <td align="left" style="font-size:14px; line-height:24px; font-family:   "Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">You told us you forgot your password, If you really did, click here to choose a new one.</td>
              </tr>
              <tr>
                <td height="5" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="font-size:14px; line-height:24px; font-family:"Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">If you didn't mean to reset your password, Then you can just ignore this email. Your password will not change.</td>
              </tr>
              <tr>
              <td align="center" style="padding-top:40px;"><a href="<?= $resetLink ?>" target="_blank" style="width: 220px;border-radius: 5px; background: #37b34a; color: #ffffff; text-decoration: none; display: block; text-align: center; line-height:30px; font-size: 18px; font-weight:700; ">Reset Password</a></td>
              </tr>
              
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="font-size:14px; line-height:24px; font-family: "Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">Thank you, <br> Team HausBuddy.</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
            </table></td>
          <td width="20" class="remove">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" class="spacer"><table class="templetcontainer" style="table-layout:fixed; background-color:#ffffff;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#ffffff">
        <tr>
          <td class="remove" width="20">&nbsp;</td>
          <td class="spacer" align="center" valign="top"><table class="templetcontainer" align="center" cellspacing="0" cellpadding="0" width="560" border="0">
              <tr>
                <td height="10">&nbsp;</td>
              </tr>
              
              <tr>
                <td height="20"></td>
              </tr>
            </table></td>
          <td class="remove" width="20">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
  </tr>
</table>
</body>
</html>


