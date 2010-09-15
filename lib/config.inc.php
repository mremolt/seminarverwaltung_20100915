<?php
require_once 'lib/funktionen.inc.php';
session_start();

$db = db_connect();
Seminar::connect($db);
Seminartermin::connect($db);