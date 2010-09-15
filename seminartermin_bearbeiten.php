<?php
require_once 'lib/config.inc.php';

$seminare = Seminar::selectAll();
$termin = Seminartermin::select($_REQUEST['id']);

if ($_POST) {
    $termin->setBeginn($_POST['beginn']);
    $termin->setEnde($_POST['ende']);
    $termin->setRaum($_POST['raum']);
    $termin->setSeminar_id($_POST['seminar_id']);

    if ( $termin->isValid() ) {
        $termin->save();

        $_SESSION['nachricht'] = 'Der Termin wurde erfolgreich geändert!';
        redirect_to('index.php');
        exit();
    } else {
        $errors = $termin->getErrors();
    }
}

require_once 'views/seminartermin_bearbeiten.tpl.php';