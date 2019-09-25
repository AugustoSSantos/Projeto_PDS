<?php
// diretório base da aplicação
//define('BASE_PATH', dirname(__FILE__));
 
// credenciais de acesso ao banco
define('DB_HOST', 'localhost');
define('DB_USER', 'postgres');
define('DB_PASS', '1234');
define('DB_DBNAME', 'hortifruti');
 
// configurações do PHP
ini_set('display_errors', true);
error_reporting(E_ALL);
date_default_timezone_set('America/Sao_Paulo');