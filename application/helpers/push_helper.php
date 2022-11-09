<?php

function msgPush($message,$id){

	$apiKey = "AIzaSyCWARg_y9AKdjAmeyXuIHJiGk9PDNqaoe0";        /*API  KEY  */
	// Replace with real client registration IDs 
	
	$registrationIDs = $id;

	$url = 'https://fcm.googleapis.com/fcm/send';
	
	$fields = array('registration_ids'  => $registrationIDs,
					'notification'=> array(	"title"=>"Nelos",
											"body" => $message,
											"sound"=>"default",
											"click_action"=>"FCM_PLUGIN_ACTIVITY",
											"icon"=>"fcm_push_icon"
									 ));
	$headers = array('Authorization: key=' . $apiKey,'Content-Type: application/json');
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;

}

function msgPushMovimento($message,$id,$key=null){

	$apiKey = "AIzaSyCWARg_y9AKdjAmeyXuIHJiGk9PDNqaoe0";        /*API  KEY  */
	// Replace with real client registration IDs 
	
	$registrationIDs = $id;

	$url = 'https://fcm.googleapis.com/fcm/send';
	
	$fields = array('registration_ids'  => $registrationIDs,
					'collapse_key'=>$key,
					'notification'=> array(	"title"=>"Nelos- Entrada e Saída",
											"body" => $message,
											"sound"=>"default",
											"icon"=>"fcm_push_icon"
									 ));
	$headers = array('Authorization: key=' . $apiKey,'Content-Type: application/json');
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POST, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );
	$result = curl_exec($ch);


	print_r($result);
	curl_close($ch);

	return $result;

}

