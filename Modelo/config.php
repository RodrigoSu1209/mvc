<?php
// APP_URL fija la direccion publica; si esta vacia, se calcula a partir de la solicitud actual.
$appUrl = getenv('APP_URL');
if ($appUrl === false || $appUrl === '') {
	// Detecta protocolo, host y subcarpeta para que los enlaces funcionen en XAMPP y Docker.
	$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
	$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
	$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
	$basePath = ($basePath === '/' || $basePath === '.') ? '' : rtrim($basePath, '/');
	$appUrl = $scheme . $host . $basePath . '/';
}

// Normaliza la URL para que los enlaces generados terminen con una barra.
define("urlsite", rtrim($appUrl, '/') . '/');

// DB_* permite configurar el mismo codigo para Docker o XAMPP sin editar PHP.
// Los valores alternativos son los valores locales habituales de XAMPP.
define("DB_HOST", getenv('DB_HOST') ?: 'localhost');
define("DB_NAME", getenv('DB_NAME') ?: 'dbstore');
define("DB_USER", getenv('DB_USER') ?: 'root');
$dbPassword = getenv('DB_PASSWORD');
// Permite una contrasena vacia en XAMPP cuando la variable no esta definida.
define("DB_PASSWORD", $dbPassword === false ? '' : $dbPassword);






