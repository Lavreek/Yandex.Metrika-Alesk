<?php

namespace YandexMetrikaAlesk;

define('ROOT_PATH', __DIR__);

require_once ROOT_PATH . "/vendor/autoload.php";

use Symfony\Component\Dotenv\Dotenv;
use YandexMetrikaAlesk\src\Aleskbase;
use YandexMetrikaAlesk\src\Aleskrow;
use YandexMetrikaAlesk\src\Rootbase;

$dotenv = new Dotenv();
$dotenv->load(__DIR__ . '/.env');

$root = new Rootbase($_ENV['HOST'], $_ENV['USER'], $_ENV['PASSWORD'], $_ENV['DATABASE']);
$alesk = new Aleskbase($_ENV['ALESK_HOST'], $_ENV['ALESK_USER'], $_ENV['ALESK_PASSWORD'], $_ENV['ALESK_DATABASE']);

foreach ($alesk->getRows(limit: 1) as $aleskResponse) {
    $root->checkAleskRow(new Aleskrow($aleskResponse));
}


