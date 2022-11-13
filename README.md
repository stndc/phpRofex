# Documentación phpRofex <img src='https://raw.githubusercontent.com/matbarofex/rRofex/master/man/figures/logo.png' align="right" width="139px"/>

phpRofex es un paquete de PHP que permite interacciones con las API Rest de Matba Rofex.

La biblioteca está diseñada para evitar a los desarrolladores las horas de investigación y codificación necesarias para conectarse con las API de ROFEX, de modo que puedan concentrarse en la parte importante de su software.

Puede leer la documentación oficial de la API para familiarizarse con las respuestas y la funcionalidad de la API en https://apihub.primary.com.ar/

## Instalación

Instalar con [Composer](https://getcomposer.org/).

```
composer require stndc/phprofex
```

## Credenciales API

Para usar la biblioteca, debe tener las credenciales de autenticación correctas para el entorno.

Para obtener nuevas credenciales vaya al sitio web de [Remarket](https://remarkets.primary.ventures) y cree una cuenta de forma gratuita.

Póngase en contacto con el equipo de MPI (Market and Platform Integration), mpi@primary.com.ar

## Modo de uso

```
namespace Api;

require __DIR__ . '/vendor/autoload.php';

use Api\ApiRofex;
```

## Metodos

El objeto `ApiRofex` debe devolver dos parametros; usuario y contraseña.

```
$rofex = new ApiRofex('X-Username','X-password');
```

Obtenido el objeto, la función `get_marketdata($url)` devulvá un diccionario `JSON`.

## Ejemplo

```
<?php

namespace Api;

require __DIR__ . '/vendor/autoload.php';

use Api\ApiRofex;

$rofex = new ApiRofex('infoinnobite7580','oarndD7$');

$instruments = $rofex->get_marketdata('https://api.remarkets.primary.com.ar/rest/instruments/all');

var_dump($instruments);

?>
```