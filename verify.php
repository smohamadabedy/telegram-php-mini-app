<?php

/** Initialization **/
$input      = json_decode(file_get_contents('php://input'), true);
$bot_token  = "xxxxxxx:XXXXXXXXXXXXXXXXXXXXXXXXXXX";
$err        = "";


/**  Validate User Request **/
$data_check_arr = explode('&', rawurldecode($input['data']));
$needle = 'hash=';
$check_hash = FALSE;
foreach( $data_check_arr AS &$val ){
    if( substr( $val, 0, strlen($needle) ) === $needle ){
        $check_hash = substr_replace( $val, '', 0, strlen($needle) );
        $val = NULL;
    }
}
// if( $check_hash === FALSE ) return FALSE;
$data_check_arr = array_filter($data_check_arr);
sort($data_check_arr);
$data_check_string = implode("\n", $data_check_arr);
$secret_key = hash_hmac( 'sha256', $bot_token, "WebAppData", TRUE );
$hash = bin2hex( hash_hmac( 'sha256', $data_check_string, $secret_key, TRUE ) );
$input_fid = $data_check_arr[4];
$jsonString = preg_replace('/^user=/', '', $input_fid);
$userData = json_decode($jsonString, true);
if( strcmp($hash, $check_hash) === 0 ){
    $validation = 'success';
}else{
    $validation = 'failed';
}


// A simple operation
try{
    if( $validation = 'success'){
        $message = 1;
    }else{
        $message = 0;
    }
}catch(Exception  $e){
    $err = '|   ' . json_encode($e) . '   |';
}

$response = [
    'message'    => $message,
    'status'     => $validation,
    'id'         => $userData["id"],
    'data'       => $userData,
    'err'        => $err,
];


header('Content-Type: application/json');
echo json_encode($response);
?>
