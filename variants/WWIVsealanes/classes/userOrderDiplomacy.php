<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class ConvoyFix_userOrderDiplomacy extends userOrderDiplomacy
{
	protected function checkConvoyPath($startCoastTerrID, $endCoastTerrID, $mustContainTerrID=false, $mustNotContainTerrID=false)
	{
		return true;
	}

	protected function supportMoveFromTerrCheck()
	{
		return true;
	}

}

class WWIVsealanesVariant_userOrderDiplomacy extends ConvoyFix_userOrderDiplomacy {}