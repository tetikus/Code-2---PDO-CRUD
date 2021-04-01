<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crudsql";

//set data source name (to describe data source /db)
$dsn = 'mysql:host=localhost; dbname=crudsql';

//create a PDO instance
$connect = new PDO('mysql:host=localhost; dbname=crudsql', 'root', '');
