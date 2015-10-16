<?php

defined('IN_CODE') or die('This script can not be run by itself.');

include_once ("variants/TenSixtySix/classes/drawMap.php");

class TenSixtySix_V3Variant_drawMap extends TenSixtySixVariant_drawMap
{
	protected $sea_terrs = array(
		'Central North Sea' , 'Firth of Clyde' , 'North Atlantic Ocean' , 'Mid Atlantic Ocean' , 'Irish Sea',
		'Bristol Channel', 'North English Channel', 'Southwest North Sea', 'Strait of Dover',
		'Thames Estuary' , 'South English Channel', 'Northwest North Sea', 'Skagerrak',
		'Norwegian Sea'  , 'Northeast North Sea'  , 'Southeast North Sea', 'Baltic Sea',
		'Channel Islands', 'Shetland and Orkneys' , 'Heligoland Bight');

	protected function resources() {
		if( $this->smallmap )
		{
			return array(
				'map' =>l_s('variants/TenSixtySix_V3/resources/smallmap.png'),
				'army' =>l_s('contrib/smallarmy.png'),
				'fleet' =>l_s('contrib/smallfleet.png'),
				'names' =>l_s('variants/TenSixtySix_V3/resources/smallmapNames.png'),
				'standoff'=>l_s('images/icons/cross.png')
			);
		}
		else
		{
			return array(
				'map' =>l_s('variants/TenSixtySix_V3/resources/map.png'),
				'army' =>l_s('contrib/army.png'),
				'fleet' =>l_s('contrib/fleet.png'),
				'names' =>l_s('variants/TenSixtySix_V3/resources/mapNames.png'),
				'standoff'=>l_s('images/icons/cross.png')
			);
		}
	}
	
	//l_t()-Funktion ergänzt
	public function __construct($smallmap,$all_fog=true)
	{
		global $Game;

		parent::__construct($smallmap);
		
		// Add the fog and sea colors to the country-palette
		$this->fog_index = count($this->countryColors);
		$this->sea_index = count($this->countryColors)+1;		
		$this->countryColors[$this->fog_index] = array(222, 200, 177); // Fog
		$this->countryColors[$this->sea_index] = array(176, 209, 201); // Sea

		$this->cheat = $all_fog;
	
		if (isset ($Game))
		{
			if ($Game->phase == 'Finished' || $Game->phase == 'Pre-Game')
				$this->cheat = false;
		}
		else
		{
			$this->cheat = false;
		}

		// Make the seas all blue (maybe the Fog hides this later again)
		foreach ($this->sea_terrs as $seas)
			$this->colorTerritory(array_search(l_t($seas),$this->territoryNames), $this->sea_index);
	}
	
	//Coast durch küste ersetzt
	public function colorTerritory($terrID, $countryID)
	{
		$this->unit_c[$terrID]=$countryID;
		foreach (preg_grep( "/^".$this->territoryNames[$terrID].".*küste\)$/", $this->territoryNames) as  $id=>$name)
			$this->unit_c[$id]=$countryID;
		parent::colorTerritory($terrID, $countryID);
	}

}

?>
