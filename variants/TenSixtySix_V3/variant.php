<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class TenSixtySix_V3Variant extends TenSixtySixVariant {
	public $id         = 94;
	public $mapID      = 94;
	public $name       = 'TenSixtySix_V3';
	public $fullName   = '1066 (V3.0)';
	public $version    = '3';
	public $codeVersion= '1.1';

	public function __construct() {
		parent::__construct();
		
		// Setup
		$this->variantClasses['adjudicatorPreGame'] = 'TenSixtySix_V3';
		$this->variantClasses['drawMap']            = 'TenSixtySix_V3';
	}
	
}

?>
