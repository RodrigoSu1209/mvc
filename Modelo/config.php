<?php
$appUrl = getenv('APP_URL');
if ($appUrl === false || $appUrl === '') {
	$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
	$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
	$basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '/'));
	$basePath = ($basePath === '/' || $basePath === '.') ? '' : rtrim($basePath, '/');
	$appUrl = $scheme . $host . $basePath . '/';
}

define("urlsite", rtrim($appUrl, '/') . '/');
define("DB_HOST", getenv('DB_HOST') ?: 'localhost');
define("DB_NAME", getenv('DB_NAME') ?: 'dbstore');
define("DB_USER", getenv('DB_USER') ?: 'root');
$dbPassword = getenv('DB_PASSWORD');
define("DB_PASSWORD", $dbPassword === false ? '' : $dbPassword);






