<!doctype>
<html>
<head>
<title> facebook </title>
</head>
<body>

<form action="index.php" method="post">
<input type="text" name="keyword">
<input type="submit" value="search">
</form>

<?php

include 'libs/facebook.php';

$facebook = new Facebook(array(
	'appId' => '581731525184771',
	'secret' => '945548c0c80e9aa72ae3b8da7a0bd080',
	'cookie' => true
));

$session = $facebook->getSession();
$me = null;
$term = $_POST['keyword'];

if ($session){
	try{
		$me = $facebook->api('/me');
		
		$mySrch = $facebook->api('/search?q=$term&type=place');
		print_r($mySrch);
	}
	catch (FacebookApiException $e)
	{
		echo $e->getMessage();
	}
}

if($me)
{
	$logoutUrl = $facebook->getLogoutUrl();
	echo "<a href='$logoutUrl'>Logout</a>";
}
else
{
	$loginUrl = $facebook->getLoginUrl(array(
	 'scope' => 'email,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown'
	));
	echo "<a href='$loginUrl'>Login</a>";
}

?> 

</body>
</html>