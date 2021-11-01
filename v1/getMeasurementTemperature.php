<?php
	$con = mysqli_connect('localhost','root','','health_care');
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['user_name']) and isset($_POST['user_id'])){
			
			$user_name = mysqli_real_escape_string($con, $_POST['user_name']);
			$user_id = mysqli_real_escape_string($con, $_POST['user_id']);
			
			$sql = "SELECT temperature, date, time, food, other_info FROM data_temperature WHERE user_name = $user_name AND user_id = $user_id";
			
			$result = mysqli_query($con, $sql);
	
			$temperature = mysqli_fetch_all($result, MYSQLI_ASSOC);
	
			mysqli_free_result($result);
	
			mysqli_close($con);
	
			$response = $temperature;
			
		}else{
		$response['error'] = true;
		$response['message'] = "Required fields are missing";
		}
	}
	echo json_encode($response);
?>