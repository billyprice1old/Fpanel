<?php
/**
 * common.php stores our application's commonly used functions
 * 
 * @package nmAdmin
 * @author Rattana Neak (rattana.neak@gmail.com)
 * @version 1.001 2016/06/05
 * 
 * 
 *  
 * 
 */

function safeEmail($to, $subject, $message, $replyTo = '',$contentType='text')
{
    $fromAddress = "Admin New World School <noreply@" . $_SERVER["SERVER_NAME"] . ">";

    if(strtolower($contentType)=='html')
    {//change to html format
        $contentType = 'Content-type: text/html; charset=iso-8859-1';
    }else{//default is text
        $contentType = 'Content-type: text/plain; charset=iso-8859-1';
    }
    
    $headers[] = "MIME-Version: 1.0";//optional but more correct
    //$headers[] = "Content-type: text/plain; charset=iso-8859-1";
    $headers[] = $contentType;
    //$headers[] = "From: Sender Name <sender@domain.com>";
    $headers[] = 'From: ' . $fromAddress;
    //$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
    
    if($replyTo !=''){//only add replyTo if passed
        //$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
        $headers[] = 'Reply-To: ' . $replyTo;   
    }
    
    $headers[] = "Subject: {$subject}";
    $headers[] = "X-Mailer: PHP/". phpversion();
    
    //collapse all header data into a string with operating system safe
    //carriage returns - PHP_EOL
    $headers = implode(PHP_EOL,$headers);

    //use mail() command internally and pass back the feedback
    return mail($to, $subject, $message, $headers);

}//end safeEmail()

function startSession()
{
	//if(!isset($_SESSION)){@session_start();}
	if(isset($_SESSION))
	{
		return true;
	}else{
		@session_start();
	}
	if(isset($_SESSION)){return true;}else{return false;}
} #End startSession()

#onlyEmail is function to validate the email
function onlyEmail($myString)
{
  if(preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9_\-\.]+\.[a-zA-Z0-9_\-]+$/",$myString))
  {return true;}else{return false;}
}#end onlyEmail()
#onlyEmail is function to validate for Alpha and Number only
function onlyAlphaNum($myString)
{
  if(preg_match("/[^a-zA-Z0-9]/",$myString))
  {return false;}else{return true;} //opposite logic from email?
}#end onlyAlphaNum()

function onlyNum($myString)
{
  if(preg_match("/[^0-9]/",$myString))
  {return false;}else{return true;} //opposite logic from email?
}#end onlyNum()

#pass_encrypt to encrypt the pasword or a string
# $string is variable that we want to encrypt
# $key is interget give what ever number to encrypt the string
function pass_encrypt($string,$key)
{
    
    $iv = mcrypt_create_iv(
    mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
    MCRYPT_DEV_URANDOM
);

$encrypted = base64_encode(
    $iv .
    mcrypt_encrypt(
        MCRYPT_RIJNDAEL_128,
        hash('sha256', $key, true),
        $string,
        MCRYPT_MODE_CBC,
        $iv
    )
);
return $encrypted;
}
# pass_decrypt to decrypt the pasword.
# $encrypted is HASH code or MD5 code that we want to decrypt
# $key is interget give what ever number to decrypt the string
function pass_decrypt($encrypted,$key)
{

    $data = base64_decode($encrypted);
$iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

$decrypted = rtrim(
    mcrypt_decrypt(
        MCRYPT_RIJNDAEL_128,
        hash('sha256', $key, true),
        substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
        MCRYPT_MODE_CBC,
        $iv
    ),
    "\0"
);
return $decrypted;
}
#msgbox is a function to call the alert box in javascript
#$message is a message to show to user.
#$url is a link where we want to go after the message has beed close. if $url = null so the link won't redirect to anywhere
#$target : _self = to redict with the same table and window. _blank = to redict in new tab.
#set $yesno = 'yesno' if you want to use the confirm alert box.
function msgbox($message,$url,$target,$yesno)
{
    echo '<script>';
    if ($yesno == "yesno")
    {
        echo'
        if (confirm("'.$message.'")) {
            // Save it!
            window.open("'.$url.'","'.$target.'");
        } else {
            // Do nothing!
        }
        ';
    }else{
    echo '
	alert ("'.$message.'")';
        if($url != ""){
            echo ' 
	        window.open("'.$url.'","'.$target.'");';
        }
    }
	echo'
	</script>
	';
}
#format_date is use for formate date from database
#$str_date is a date string without formate or a string look like a date
#format is the format you want to use in php.
function format_date($str_date,$format)
{
    $date_create = date_create($str_date);
    return date_format($date_create,$format);
}

#dumDie is a function you may need to use to find the error 
#this function is create from var_dump
function dumpDie($var){
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die;
}
