<?php
header("Content-Type: application/json");

require_once('interactiveMap.php');

$IAmap = getIAmapObject();

$IAmap->createMapData();

$IAmap->serveMapData();

?>