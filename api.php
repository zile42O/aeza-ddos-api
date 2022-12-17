<?php
session_start();
header("Content-type: application/json");

if (!isset($_GET['token'])) {
	$message = array("status" => 'error', "response" => 'Token is required please generate it via ./aeza_token.sh');
	die(json_encode($message, JSON_PRETTY_PRINT));
}

if (!isset($_GET['service'])) {
	$message = array("status" => 'error', "response" => 'Service is required');
	die(json_encode($message, JSON_PRETTY_PRINT));
}

$context = stream_context_create([
	"http" => [
		"header" => "Authorization: Bearer ".$_GET['token']
	]
]);

$format_url = "https://core.aeza.net/api/services/".$_GET['service']."/ddosattacks?sort=id";
$json = file_get_contents($format_url, false, $context );
$data = json_decode($json, true);
//die(json_encode($data, JSON_PRETTY_PRINT)); //debug all
$array_out = array();
array_push($array_out, array("service" => $_GET['service'], "last_id" => $data['data']['items'][0]['id'], "type" => $data['data']['items'][0]['type'], "protocol" => $data['data']['items'][0]['protocol'], "start_time" => date("g:i a", $data['data']['items'][0]['startAt']), "end_time" => date("g:i a", $data['data']['items'][0]['endAt']), "attack_power" => formatBytes($data['data']['items'][0]['bpsTotal']) ));
function formatBytes($size, $precision = 2)
{
	$base = log($size, 1024);
	$suffixes = array('', 'KBs', 'MBs', 'GBs', 'TBs'); 
	return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}
die(json_encode($array_out, JSON_PRETTY_PRINT));
?>