<?php
header('Location: views/manager/index.php');
$dotenv = new Dotenv\Dotenv(__DIR__ . '/.env');
$dotenv->load();
var_dump(getenv('DB_HOST'));
exit();