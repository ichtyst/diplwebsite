<?php

require_once('interactiveMap.php');

$IAmap = getIAmapObject();

$IAmap->drawMap();

$IAmap->serveMap();
?>
