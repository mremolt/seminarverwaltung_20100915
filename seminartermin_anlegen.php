<?php
require_once 'lib/config.inc.php';

if ($_POST) {
    $termin = new Seminartermin($_POST);

    if ($termin->isValid()) {
        $termin->save();

        $_SESSION['nachricht'] = 'Der Termin wurde erfolgreich angelegt!';
        redirect_to('index.php');
        exit();
    } else {
        $errors = $termin->getErrors();
    }
}

$seminare = Seminar::selectAll();

require_once 'views/seminartermin_anlegen.tpl.php';