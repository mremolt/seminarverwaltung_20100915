<?php
require_once 'lib/config.inc.php';

$termine = Seminartermin::selectAll();

require_once 'views/index.tpl.php';