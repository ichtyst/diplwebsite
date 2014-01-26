<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class GobbleEarthVariant_drawMap extends drawMap
{
	protected $countryColors = array(
		0  => array(226, 198, 158), // Neutral
		1  => array(255, 102, 102), // Austria
		2  => array(242, 176, 225), // England
		3  => array(108, 208, 208), // France
  		4  => array(127, 127, 127), // Germany
  		5  => array( 94, 232,  94), // Italy
  		6  => array(235, 235, 235), // Russia
		7  => array(218, 218,  68), // Turkey
  		8  => array(194, 102, 194), // China
  		9  => array(185, 185, 104), // Japan
  		10 => array( 83, 157,  83), // Brazil
  		11 => array(179, 102, 102), // Argentina
  		12 => array(255, 194, 102), // Colombia
  		13 => array(137, 118, 100), // Mexico
  		14 => array(102, 102, 255), // USA
	);

	// Always only load the largemap (as there is no smallmap)
	// Map is too big, so up the memory-limit
	public function __construct($smallmap)
	{
		parent::__construct(false);
		ini_set('memory_limit',"32M");
	}

	protected function resources() {
		return array(
			'map'=>'variants/GobbleEarth/resources/map.png',
			'army'=>'contrib/smallarmy.png',
			'fleet'=>'contrib/smallfleet.png',
			'names'=>'variants/GobbleEarth/resources/mapNames.png',
			'standoff'=>'images/icons/cross.png'
		);
	}
	
	// Wait build orders are saved as Disloged to avoid bigger problems with map.php
	public function drawDislodgedUnit($terrID)
	{
		if ($terrID != 0) parent::drawDislodgedUnit($terrID);
	}
	
	// Always use the small orderarrows...
	protected function loadOrderArrows()
	{
		$this->smallmap=true;
		parent::loadOrderArrows();
		$this->smallmap=false;
	}	
	
	// Always use the small standoff-Icons
	public function drawStandoff($terrName)
	{
		$this->smallmap=true;
		parent::drawStandoff($terrName);
		$this->smallmap=false;
	}

	// Do draw a cross for failed build-orders.
	public function addUnit($drawToTerrID, $unitType)
	{
		if ($unitType == "") 
			$this->drawStandoff($drawToTerrID);
		else
			parent::addUnit($drawToTerrID, $unitType);
	}
}

?>