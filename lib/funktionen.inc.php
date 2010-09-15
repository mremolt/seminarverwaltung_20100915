<?php

function db_connect() {
    $optionen = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $db = new PDO('mysql:host=localhost;dbname=seminarverwaltung', 'root', '', $optionen);
    $db->query('SET NAMES utf8');
    return $db;
}

function __autoload($class_name) {
    require 'models/' . strtolower($class_name) . '.php';
}

function redirect_to($url) {
    header('Location: ' . $url);
}

function flash() {
    $nachricht = $_SESSION['nachricht'];
    unset($_SESSION['nachricht']);
    return $nachricht;
}