<?php

function numtorank($num){ //get rankinfo from my api server.
	$file = file_get_contents("https://ynz.noob.jp/VW/api/rank.php");
	$file = json_decode($file);
	return preg_replace('/(?:\n|\r|\r\n)/', '', $file[$num] );
}

function secure_check(){//check all url in output.html for your account's secure
	$file = file_get_contents("./#template/output.html");
	if(preg_match_all('(https?://[-_.!~*\'()a-zA-Z0-9;/?:@&=+$,%#]+)', $file, $result) !== false){
	    foreach ($result[0] as $value){
    		$url[] = $value;
	    }
	}
	$imp = implode("<>", $url);
	$check = file_get_contents("https://ynz.noob.jp/VW/api/secure.php?body=" . $imp);
	return $check;
}

function GetSetting(){
	if (file_exists("./setting.txt")){
		$file = file_get_contents("./setting.txt");
		if (preg_match('/username=(.*)/', $file, $username) && preg_match('/password=(.*)/', $file, $password) && preg_match('/server=(.*)/', $file, $region)){
			preg_match('/password=(.*)/', $file, $password);
			$password = preg_replace('/(?:\n|\r|\r\n)/', '', $password[1] );
			preg_match('/username=(.*)/', $file, $username);
			$username = preg_replace('/(?:\n|\r|\r\n)/', '', $username[1] );
			preg_match('/server=(.*)/', $file, $region);
			$region = preg_replace('/(?:\n|\r|\r\n)/', '', $region[1] );
			if ($region == "na" || $region == "eu" || $region == "ap" || $region == "kr"){
			}else{
				return "server";
			}
		}else{
			return "yet";
		}
		return array($username, $password, $region);
	}else{
		$file_handle = fopen( "./setting.txt", "w");
		fwrite( $file_handle, "username=\npassword=\nserver=");
		fclose($file_handle);
		return "make";
	}
}

function record($tier, $rr){
	$file_handle = fopen( "./VW/tmp/tier.txt", "w");
	fwrite( $file_handle, $tier);
	fclose($file_handle);
	$file_handle = fopen( "./VW/tmp/rr.txt", "w");
	fwrite( $file_handle, $rr . " RR");
	fclose($file_handle);
	$file_handle = fopen( "./VW/tmp/tier_text.txt", "w");
	fwrite( $file_handle, numtorank($tier));
	fclose($file_handle);
}