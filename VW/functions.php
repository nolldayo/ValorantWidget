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
		$file_handle = fopen( "./setting.txt", "w+");
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

function WL_first($Mid, $points){
	$file_handle = fopen( "./VW/tmp/CalculateWL.txt", "w+");
	fwrite( $file_handle, $Mid . "<>first\n");
	fclose($file_handle);
	$file_handle = fopen( "./VW/tmp/WLout.txt", "w+");
	fwrite( $file_handle, "0W0L");
	fclose($file_handle);
}

function WL($Mid, $points){
	$file = file_get_contents("./VW/tmp/CalculateWL.txt");
	$file_exp = explode("\n", $file);
	foreach ($file_exp as $line) {
		$Mid_check = explode("<>", $line);
		$Mids[] = $Mid_check[0];
	}
	if (!in_array($Mid, $Mids)){
		$file_handle = fopen( "./VW/tmp/CalculateWL.txt", "a");
		fwrite($file_handle, $Mid . "<>" . $points . "\n");
		fclose($file_handle);
	}

	$file = file_get_contents("./VW/tmp/CalculateWL.txt");
	$file_exp = explode("\n", $file);
	$win = array();
	$lose = array();
	foreach ($file_exp as $line) {
		$check = explode("<>", $line);
		if ($check[0] != ""){
			if ($check[1] != "first"){
				if ($check[1] >= 0){
					$win[] = $check[0];
				}else if ($check[1] < 0){
					$lose[] = $check[0];
				}
			}
		}
	}
	$file_handle = fopen( "./VW/tmp/WLout.txt", "w");
	fwrite($file_handle, count($win) . "W" . count($lose) . "L");
	fclose($file_handle);
}