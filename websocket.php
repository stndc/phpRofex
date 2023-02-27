<?php

/* namespace Api;

require __DIR__ . '/vendor/autoload.php';

use Api\ApiRofex;

// object with API key
$rofex = new ApiRofex('infoinnobite7580','oarndD7$');

$add_token = $rofex->get_token('https://api.remarkets.primary.com.ar/auth/getToken');

$data = json_encode($add_token);

$explode = explode(":", $data);
$token = substr($explode[9], 0, -17);

var_dump($token);
$symbol = 'SOJ.ROS/MAY23'; */

$url = 'wss.remarkets.primary.com.ar';

error_reporting(E_ALL);

echo "<h2>TCP/IP Connection</h2>\n";

/* Obtener el puerto para el servicio WWW. */
$service_port = getservbyname('www', 'tcp');

/* Obtener la dirección IP para el host objetivo. */
$address = gethostbyname('api.remarkets.primary.com.ar');

/* Crear un socket TCP/IP. */
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
} else {
    echo "OK.\n";
}

echo "Intentando conectar a '$address' en el puerto '$service_port'...";
$result = socket_connect($socket, $address, $service_port);
if ($result === false) {
    echo "socket_connect() falló.\nRazón: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
} else {
    echo "OK.\n";
}

$headers = "x-auth-token:xNbg0CkZ4eUJklpKDsrLYn49vhnNWnQvg+UYjLclyUk=";
$in = "GET /websocket/path HTTP/1.1\r\n" .
       "Host: api.remarkets.primary.com.ar\r\n" .
       "Upgrade: websocket\r\n" .
       "Connection: Upgrade\r\n" .
       "Sec-WebSocket-Key: key\r\n" .
       "Sec-WebSocket-Version: 13\r\n" .
       $headers .
       "\r\n";

$in .= '{"type":"smd","level":1, "entries":["BI", "OF"],"products":[{"symbol":"SOJ.ROS/MAY23","marketId":"ROFX"}]}';

echo "Enviando petición WSS HEAD ...";

$e = socket_write($socket, $in, strlen($in));
echo "<br>";
echo $e;
echo "<br>";
if ($e === false) {echo "error al escribir el socket";} else {
    echo "OK.\n";
}
echo "Leyendo respuesta:\n\n";
while ($out = socket_read($socket, 204800)) {
    echo $out;
}
echo "Cerrando socket...";
socket_close($socket);
echo "OK.\n\n";

?>