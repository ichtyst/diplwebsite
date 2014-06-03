<?php
/*
	Copyright (C) 2013 kaner406 & Oliver Auth

	This file is part of the WWIV_V6 variant for webDiplomacy

	The WWIV_V6 variant for webDiplomacy is free software: you can
	redistribute it and/or modify it under the terms of the GNU Affero General
	Public License as published by the Free Software Foundation, either version
	3 of the License, or (at your option) any later version.

	The WWIV_V6 variant for webDiplomacy is distributed in the hope
	that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
	warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
	See the GNU General Public License for more details.

	You should have received a copy of the GNU Affero General Public License
	along with webDiplomacy. If not, see <http://www.gnu.org/licenses/>.
*/

class WWIV_V6Variant_userOrderDiplomacy extends userOrderDiplomacy
{
	protected function checkConvoyPath($startCoastTerrID, $endCoastTerrID, $mustContainTerrID=false, $mustNotContainTerrID=false)
	{
		return true;
	}

	protected function supportMoveFromTerrCheck()
	{
		return true;
	}

	protected function typeCheck()
	{
		if ($this->Unit->type == 'Fleet' and in_array($this->Unit->Territory->id, $GLOBALS['Variants'][VARIANTID]->convoyCoasts))
			return true;
		return parent::typeCheck();
	}
}
