# Documentación phpRofex 

phpRofex es un paquete de PHP que permite interacciones con las API Rest de Matba Rofex.

La librería está diseñada para evitar a los desarrolladores las horas de investigación y codificación necesarias para conectarse con las API de ROFEX, de modo que puedan concentrarse en la parte importante de su software.

Puede leer la documentación oficial de la API para familiarizarse con las respuestas y la funcionalidad de la API en https://apihub.primary.com.ar/

## Instalación

Instalar con [Composer](https://getcomposer.org/).

```
composer require stndc/phprofex
```

## Credenciales API

Para usar la librería, debe tener las credenciales de autenticación correctas para el entorno.

Para obtener nuevas credenciales vaya al sitio web de [Remarket](https://remarkets.primary.ventures) y cree una cuenta de forma gratuita.

Póngase en contacto con el equipo de MPI (Market and Platform Integration), mpi@primary.com.ar

## Método

El método retorna un diccionario `JSON`.

- get_marketdata($url): obtiene Segementos, Instrumentos, Órdenes y Market Data.

## Modo de uso

La inicialización se debe realizar en dos pasos. En el primer paso se autentifica con servidor de Matba Rofex por medio usuario y contraseña y el segundo paso es pasar los datos que necesita obtener al método `get_marketdata($url)` en su parámetro `$url`.

Si la autenticación falla, la propiedad status del callback será “ERROR”.

```
<?php

namespace Api;

require __DIR__ . '/vendor/autoload.php';

use Api\ApiRofex;

$rofex = new ApiRofex('X-Username','X-password');
```

## Ejemplo

```
<?php

namespace Api;

require __DIR__ . '/vendor/autoload.php';

use Api\ApiRofex;

$rofex = new ApiRofex('XXXXXXXXXXX','XXXXXXXXXXX');

$instruments = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/instruments/all');

var_dump($instruments);

```

## Importante:

Es necesario que lea la documentación para obtener los datos que necesite y ajustarlos al parámetro `$url` dentro del método `get_marketdata`.

Lista de Segmentos disponibles

```
$segment = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/segment/all');

var_dump($segment);
```

Lista de Instrumentos disponibles

```
$instruments = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/instruments/all');

var_dump($instruments);
```

Lista detallada de Instrumentos disponibles

```
$instrument_details = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/instruments/details');

var_dump($instrument_details);
```

Consultar último estado por Client Order ID

```
$order_id = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/order/id');

var_dump($order_id);
```

Consultar todos los estados por Client Order ID

```
$order_status = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/order/allById');

var_dump($order_status);
```