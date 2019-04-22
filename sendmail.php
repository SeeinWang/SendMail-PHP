<?php
$visitor_email = $_POST['email'];
$name=$_POST['name'];
$sex=$_POST['sex'];
$birthday=$_POST['birthday'];
$birthcity=$_POST['birthcity'];
$nationality=$_POST['nationality'];
$zipcode=$_POST['zipcode'];
$tel=$_POST['tel'];
$wxnumber=$_POST['wxnumber'];
$city=$_POST['city'];
$price = $_POST['price'];
$title = $_POST['title'];


echo $title;
//Validate first
if(empty($visitor_email)) 
{
    echo "Email has to be filled!；必须填写邮件地址 ";
    exit;
}

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}


$email_from = "info@guangson.ca";//<== update the email address;
$email_subject = "=?UTF-8?B?".base64_encode("订单确认")."?=";
$email_body = "<p>亲爱的".$name."感谢您使用我的服务</p>
               <p>您购买的".$title."价格是".$price."</p>
               <table>
        <tr>
        <th>项目</th>
        <th>内容</th>
        </tr>
        <tr>
        <td>姓名</td>
        <td>".$name."</td>
        </tr>
        <tr>
        <td>生日</td>
        <td>".$birthday."</td>
        </tr>
        <tr>
        <td>出生地</td>
        <td>".$birthcity."</td>
        </tr>
        <tr>
        <td>国籍</td>
        <td>".$nationality."</td>
        </tr>
        <tr>
        <td>邮编</td>
        <td>".$zipcode."</td>
        </tr>
        <tr>
        <td>电话</td>
        <td>".$tel."</td>
        </tr>
        <tr>
        <td>微信</td>
        <td>".$wxnumber."</td>
        </tr>
        

        </table>
               <p>我们的联系方式是 604-408-7777 有任何问题请与我们联系</p>";
    
$to = $visitor_email;//<== update the email address

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: info@guangson.ca \r\n";
$headers .= "Reply-To: info@guangson.ca \r\n";
$headers .= "X-Mailer: PHP/".phpversion();


//Send the email!
mail($to, $email_subject, $email_body, $headers);

//done. redirect to thank-you page.
//echo "$name  $visitor_email $message \n $email_body ";

//回到原来页面
//header('Location: http://guangson.ca/sendemail.html');


//Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
  
?>
