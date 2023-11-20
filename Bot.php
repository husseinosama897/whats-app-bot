<?php

$token = 'EAAEw6gUSqUEBOZBEBnTs9uTuBGH3lazminKDvHCq8MWXJITIZCBsZCFEZAxbroVJ5XshpQxKG9OQGZC8ZB4RZB8bzrBgI6PAYYDJYExwLtQiCoyylNemqDv4OBYtf54mzZAHL0pT85bbLgZB8DZBe7NTZBb40L7HPBqkyukVSBUr401JrxY03ZABu2H3y4QPTEPqeWKZAR8SJtSLWxGcBn1zzipiI';
$api_version = 'v18.0';
$payload = file_get_contents('php://input');

$t  = 5555;



$challenge = $request->hub_challenge;
$verify_token = $request['hub_verify_token'];


if ($verify_token == $t) {
    echo $challenge;
    \Log::info('true');
    }else{
        \Log::info('false');
    }
    


if(empty($payload)){
	$payload = '{"object":"whatsapp_business_account","entry":[{"id":"147981711723923","changes":[{"value":{"messaging_product":"whatsapp","metadata":{"display_phone_number":"923098993732","phone_number_id":"108047392287351"},"contacts":[{"profile":{"name":"Aqib Awan"},"wa_id":"923162292811"}],"messages":[{"from":"201148026949","id":"wamid.HBgMOTIzMTYyMjkyODExFQIAEhggNTZENjQwM0ZBMDg0RTQ3MEJEMTM3RUFDMzlENzk4ODAA","timestamp":"1683385994","text":{"body":"how much"},"type":"text"}]},"field":"messages"}]}]}';
}


$decode = json_decode($payload,true);
//echo '<pre>';
//print_r($decode);
//echo '</pre>';

//die;
$ownerno = $decode['entry'][0]['changes']['0']['value']['metadata']['display_phone_number'];
$username = $decode['entry'][0]['changes']['0']['value']['contacts'][0]['profile']['name'];
$userno = $decode['entry'][0]['changes']['0']['value']['messages'][0]['from'];
$usermessage = $decode['entry'][0]['changes']['0']['value']['messages'][0]['text']['body'];
$phone_id = $decode['entry'][0]['id'];


  $response =   'بعشره جنيه يا فندم';



try {


    


	/// sending message back to user ///
// Set your access token and API version


// Set the endpoint URL and request payload
$endpoint = "https://graph.facebook.com/{$api_version}/{$phone_id}/messages";
$data = array(
    'messaging_product' => 'whatsapp',
    'to' => $userno,
    'text' => array(
        'body' => $response
    )
);

// Set the cURL options and execute the request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $endpoint);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer {$token}",
    "Content-Type: application/json"
));
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Output the response
echo $response;
	
	
	
}

catch (customException $e) {
  //display custom message
  echo $e->errorMessage();
}



    

