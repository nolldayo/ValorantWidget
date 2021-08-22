<?php

class RA{

	public $username;
	public $password;
	public $region;
	public $season;
	public $at;
	public $et;
	public $uid;
	public $pid;
	public $gname;
	public $tag;

	public function __construct($username, $password, $region){
		$this->username = $username;
		$this->password = $password;
		$this->season = $region;

		//set base region
		if ($region == "na"){ $this->region = "https://pd.na.a.pvp.net/"; }
		if ($region == "eu"){ $this->region = "https://pd.eu.a.pvp.net/"; }
		if ($region == "ap"){ $this->region = "https://pd.ap.a.pvp.net/"; }
		if ($region == "kr"){ $this->region = "https://pd.ko.a.pvp.net/"; }
	}

	public function auth(){
		//1
		$data = json_encode(array(
			"client_id" => "play-valorant-web-prod",
			"nonce" => "1",
			"redirect_uri" => "https://playvalorant.com/opt_in",
			"response_type" => "token id_token"
		));
		$headers = array('Content-type: application/json');
		$r1 = $this->curl_req("https://auth.riotgames.com/api/v1/authorization", $headers, $data);

		//2
		$data = json_encode(array(
			"type" => "auth",
			"username" => $this->username,
			"password" => $this->password
		));
		$headers = array('Content-type: application/json');
		$r2 = $this->curl_req("https://auth.riotgames.com/api/v1/authorization", $headers, $data, "put");

		if (!isset($r2->error)){
			preg_match('/access_token=((?:[a-zA-Z]|\d|\.|-|_)*)&scope=/u', $r2->response->parameters->uri, $at);
			$this->at = $at[1];

			//3
			$headers = array(
				'Authorization: Bearer '. $this->at,
				'Content-Type: application/json'
			);

			$r3 = $this->curl_req("https://entitlements.auth.riotgames.com/api/token/v1", $headers, null, null, true);
			$this->et = $r3->entitlements_token;

			//4
			$headers = array(
				'Authorization: Bearer '. $this->at,
				'Content-Type: application/json'
			);

			$r4 = $this->curl_req("https://auth.riotgames.com/userinfo", $headers, null, null, true);
			$this->uid = $r4->sub;

			//5
			$headers = array(
				'Authorization: Bearer '. $this->at,
				'X-Riot-Entitlements-JWT: ' . $this->et
			);
			$data = json_encode(array($this->uid));
			$r5 = $this->curl_req($this->region . "name-service/v2/players", $headers, $data, "put", true);
			$this->pid = $r5[0]->Subject;
			$this->gname = $r5[0]->GameName;
			$this->tag = $r5[0]->TagLine;
		}else{
			return "login error";
		}
	}

	public function GetName(){
		return $this->gname . "#" . $this->tag;
	}

	public function GetRiot(){
		$file = file_get_contents("https://ynz.noob.jp/VW/api/riot.php");
		$file = json_decode($file);
		return array($file[0], $file[1]);
	}

	public function GetSeason(){
		$riot = $this->GetRiot();

		$headers = array(
			'Authorization: Bearer '. $this->at,
			'X-Riot-Entitlements-JWT: ' . $this->et,
			'X-Riot-ClientPlatform: ' . $riot[0],
			'X-Riot-ClientVersion: ' . $riot[1]
		);

		$ch = curl_init();
		$url = "https://shared." . $this->season . ".a.pvp.net/content-service/v2/content";                           
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		curl_close($ch);

		foreach (json_decode($response)->Seasons as $season) {
			if ($season->IsActive == true){
				$id = $season->ID;
				break;
			}
		}

		return $id;
	}

	public function GetCompetive(){
		$riot = $this->GetRiot();
		$season = $this->GetSeason();

		$headers = array(
			'Authorization: Bearer '. $this->at,
			'X-Riot-Entitlements-JWT: ' . $this->et,
			'X-Riot-ClientPlatform: ' . $riot[0],
			'X-Riot-ClientVersion: ' . $riot[1]
		);

		$ch = curl_init();
		$url = $this->region . "mmr/v1/players/" . $this->pid;                           
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		$response = curl_exec($ch);
		curl_close($ch);

		if (preg_match('/errorCode/', $response, $error)){
			return "error";
		}

		foreach (json_decode($response)->QueueSkills->competitive->SeasonalInfoBySeasonID as $seasons) {
			if ($seasons->SeasonID == $season){
				$tier = $seasons->CompetitiveTier;
				$rr = $seasons->RankedRating;
				break;
			}
		}
		
		return array($tier, $rr);
	}

	public function curl_req($url, $headers, $data = null, $type = false, $oh = false){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_VERBOSE, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		if ($oh == false){
			curl_setopt($ch, CURLOPT_COOKIEFILE, "./VW/cookie/ra");
			curl_setopt($ch, CURLOPT_COOKIEJAR, "./VW/cookie/ra");

			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			if ($type == false && $data){
				curl_setopt($ch, CURLOPT_COOKIESESSION, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}else{
				curl_setopt($ch, CURLOPT_COOKIESESSION, false);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
		}else{
			if ($type == false){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
			}else{
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			}
		}

		$result = curl_exec($ch);

		curl_close($ch);

		return json_decode($result);
	}

}
