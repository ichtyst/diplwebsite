<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class GobbleEarthVariant_OrderInterface extends OrderInterface {

	protected function jsLoadBoard() {
		global $Variant;
		parent::jsLoadBoard();
		if( $this->phase=='Builds' )
		{
			libHTML::$footerIncludes[] = '../variants/'.$Variant->name.'/resources/buildanywhere.js';
			foreach(libHTML::$footerScript as $index=>$script)
				libHTML::$footerScript[$index]=str_replace('loadBoard();','loadBoard();SupplyCentersCorrect();', $script);
		}
	}
}
