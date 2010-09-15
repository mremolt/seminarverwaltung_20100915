<?php
require_once 'lib/config.inc.php';

$termin = Seminartermin::select($_GET['id']);
$termin->delete();

$_SESSION['nachricht'] = 'Der Termin wurde efolgreich gelöscht!';

redirect_to('index.php');