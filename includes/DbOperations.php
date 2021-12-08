<?php
	class DbOperations{
		private $con;
		
		function __construct(){
		
			require_once dirname(__FILE__).'/DbConnect.php';
			
			$db = new DbConnect();
			
			$this->con = $db->connect();
			
		}

		public function createUser($username, $pass, $email){
			if($this->isUserExist($username, $email)){
				return 0;
			}else{
				$password = md5($pass);
				$stmt = $this->con->prepare("INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES (NULL, ?, ?, ?);");
				$stmt->bind_param("sss",$username,$password,$email);
			
				if($stmt->execute()){
					return 1;
				}else{
					return 2;
				}
			}
		}
		
		public function userLogin($username, $pass){
			$password = md5($pass);
			$stmt = $this->con->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
			$stmt->bind_param("ss",$username,$password);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
		}
		
		public function getUserByUsername($username){
			$stmt = $this->con->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bind_param("s", $username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
		}
		
		private function isUserExist($username, $email){
			$stmt = $this->con->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
			$stmt->bind_param("ss", $username, $email);
			$stmt->execute();
			$stmt->store_result();
			return $stmt->num_rows > 0;
		}
		
		public function addWeight($weight, $date, $time, $food, $other_info, $username, $userid){
			$stmt = $this->con->prepare("INSERT INTO `data_weight` (`id`, `weight`, `date`, `time`, `food`, `other_info`, `user_name`, `user_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");
			$stmt->bind_param("sssssss",$weight, $date, $time, $food, $other_info, $username, $userid);
			
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
		}
		
		public function addTemperature($temperature, $date, $time, $food, $other_info, $username, $userid){
			$stmt = $this->con->prepare("INSERT INTO `data_temperature` (`id`, `temperature`, `date`, `time`, `food`, `other_info`, `user_name`, `user_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");
			$stmt->bind_param("sssssss",$temperature, $date, $time, $food, $other_info, $username, $userid);
			
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
		}
		
		public function addPressure($pressure_diastole, $pressure_systole, $pulse, $date, $time, $food, $other_info, $username, $userid){
			$stmt = $this->con->prepare("INSERT INTO `data_pressure` (`id`, `pressure_diastole`, `pressure_systole`, `pulse`, `date`, `time`, `food`, `other_info`, `user_name`, `user_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$stmt->bind_param("sssssssss",$pressure_diastole, $pressure_systole, $pulse, $date, $time, $food, $other_info, $username, $userid);
			
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
		}
		
		public function addGlucose($glucose, $date, $time, $food, $other_info, $username, $userid){
			$stmt = $this->con->prepare("INSERT INTO `data_glucose` (`id`, `glucose`, `date`, `time`, `food`, `other_info`, `user_name`, `user_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?);");
			$stmt->bind_param("sssssss",$glucose, $date, $time, $food, $other_info, $username, $userid);
			
			if($stmt->execute()){
				return 1;
			}else{
				return 2;
			}
		}
	}