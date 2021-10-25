<?php

require_once '../includes/DbOperations.php';

$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){
	
	if(isset($_POST['temperature']) and isset($_POST['date']) and isset($_POST['time']) and isset($_POST['food']) and isset($_POST['other_info']) and isset($_POST['username']) and isset($_POST['userid'])){
		
		$db = new DbOperations();
		
		$result = $db->addTemperature($_POST['temperature'],$_POST['date'],$_POST['time'],$_POST['food'],$_POST['other_info'],$_POST['username'],$_POST['userid']);
		if($result == 1){
			$response['error'] = false;
			$response['message'] = "Measurement added successfully";
		}elseif($result == 2){
			$response['error'] = true;
			$response['message'] = "Some error occurred, please try again";
		}
		
	}else{
		$response['error'] = true;
		$response['message'] = "Required fields are missing";
	}
	
}else{
	$response['error'] = true;
	$response['message'] = "Invalid Request";
}

echo json_encode($response);