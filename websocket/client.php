<?php

/*

v1.0.b

*/

namespace Api;

require __DIR__ . '/../vendor/autoload.php';

use Api\ApiRofex;

$rofex = new ApiRofex('X-Username','X-password');
$marketdata = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/marketdata/get?marketId=ROFX&symbol=SOJ.ROS/MAR23&entries=CL');
$data = json_decode($marketdata);

$host = "127.0.0.1";
$port = 80812;

$socket = socket_create(AF_INET, SOCK_STREAM, 0) or die('Not Created');
socket_connect($socket, $host, $port);

$msg = $data->marketData->CL->price;

socket_write($socket, $msg, strlen($msg));


?>