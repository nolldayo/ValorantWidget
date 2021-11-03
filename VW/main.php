<?php
require_once("./VW/auth.php");
require_once("./VW/functions.php");

//first step
$secure = secure_check();
if ($secure == "false"){
	echo "You are using unknown output.html.\n";
	echo "There is security problem, so You need to check it.\n";
	echo "If you don't understand this message,\n";
	echo "Contact developer Twitter @YNZjp.\n";
	exit();
}

$setting = GetSetting();
if ($setting == "make"){
	echo "You need to setup *setting.txt* first!\n";
	exit();
}elseif ($setting == "server"){
	echo "Wrong server setting.\n";
}

//login check
$ra = new RA($setting[0], $setting[1], $setting[2]);
$auth = $ra->auth();
if ($auth == "login error"){
	echo "The login attempt failed.\n";
	echo "Either the user ID or password is invalid.\n";
	exit();
}

$WL = $ra->CalculateWL();
WL_first($WL[0], $WL[1]);

echo "+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-\n";
echo "Hello this is Valorant Widget!\n";
echo "GLHF in your VALORANT games :)\n";
echo "\n";
echo "\n";
echo "Twitter @YNZjp\n";
echo "Github https://github.com/nolldayo/ValorantWidget\n";
echo "+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-+-\n\n\n";
echo "Now Watching your current rank...\n\n\n";

//main
$ra = new RA($setting[0], $setting[1], $setting[2]);
$auth = $ra->auth();

while (true){

	if ($auth == "login error"){
		$auth_check = $ra->auth();
		if ($auth_check == "login error"){
			echo "The login attempt failed.\n";
			echo "Either the user ID or password is invalid.\n";
			exit;
		}else{ $auth = $auth_check; }
	}else{
		$cinfo = $ra->GetCompetive();
		if ($cinfo == "error"){
			echo "Need to update!\n";
			echo "Please reply me Twitter @YNZjp\n";
			exit();
		}

		record($cinfo[0], $cinfo[1]);

		$WL = $ra->CalculateWL();
		WL($WL[0], $WL[1]);
	}

	sleep(30); //30s per check
}
