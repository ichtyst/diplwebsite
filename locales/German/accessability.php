<?php
/*
    Copyright (C) 2013 Oliver Auth

	This file is part of vDiplomacy.

    vDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    vDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('IN_CODE') or die('This script can not be run by itself.');

?>
	<li class="formlisttitle">Reihenfolge der Befehle:</li>
	<li class="formlistfield">
		Einheitentyp:<select name="userForm[unitOrder]">
			<option value='Mixed'<?php if($User->unitOrder=='Mixed') print "selected"; ?>>Gemischt</option>
			<option value='FA'   <?php if($User->unitOrder=='FA')    print "selected"; ?>>Flotten -> Armeen</option>
			<option value='AF'   <?php if($User->unitOrder=='AF')    print "selected"; ?>>Armeen -> Flotten</option>
		</select> - 
		Sortieren nach: <select name="userForm[sortOrder]">
			<option value='BuildOrder'<?php if($User->sortOrder=='BuildOrder') print "selected"; ?>>Alter</option>
			<option value='TerrName'  <?php if($User->sortOrder=='TerrName')   print "selected"; ?>>Gebietsname</option>
			<option value='NorthSouth'<?php if($User->sortOrder=='NorthSouth') print "selected"; ?>>Norden -> S&uuml;den</option>
			<option value='EastWest'  <?php if($User->sortOrder=='EastWest')   print "selected"; ?>>Osten -> Westen</option>
		</select>
	</li>
	<li class="formlistdesc">
		Reihenfolge der Einheiten und ihrer Befehle in der Befehls&uuml;bersicht.
	</li>
	
	<li class="formlisttitle">Zeige L&auml;ndername:</li>
	<li class="formlistfield">
		<strong>Im globalen Chat:</strong>
		<input type="radio" name="userForm[showCountryNames]" value="Yes" <?php if($User->showCountryNames=='Yes') print "checked"; ?>>Ja
		<input type="radio" name="userForm[showCountryNames]" value="No"  <?php if($User->showCountryNames=='No')  print "checked"; ?>>Nein
	</li>
	<li class="formlistfield">
		<strong>Auf der Karte:</strong>
		<input type="radio" name="userForm[showCountryNamesMap]" value="Yes" <?php if($User->showCountryNamesMap=='Yes') print "checked"; ?>>Ja
		<input type="radio" name="userForm[showCountryNamesMap]" value="No"  <?php if($User->showCountryNamesMap=='No')  print "checked"; ?>>Nein
	</li>
	<li class="formlistdesc">
		Verwende L&auml;ndernamen und schwarzen Text anstelle der farbigen Nachrichten im Chat.
		Schreibe die L&auml;ndernamen direkt auf die Karte.
	</li>

	<li class="formlisttitle">Farbenfehlsichtigkeitseinstellungen:</li>
	<li class="formlistfield">
		<select name="userForm[colorCorrect]">
			<option value='Off'        <?php if($User->colorCorrect=='Off')         print "selected"; ?>>aus</option>
			<option value='Protanope'  <?php if($User->colorCorrect=='Protanope')   print "selected"; ?>>Protanop</option>
			<option value='Deuteranope'<?php if($User->colorCorrect=='Deuteranope') print "selected"; ?>>Deuteranop</option>
			<option value='Tritanope'  <?php if($User->colorCorrect=='Tritanope')   print "selected"; ?>>Tritanop</option>
		</select>
	</li>
	<li class="formlistdesc">
		Verbessert die Farben auf der Karte f&uuml;r verschiedene F&auml;lle von Farbenblindheit. (Funktioniert leider nicht bei allen Varianten)
	</li>

<?php
/*
 * This is done in PHP because Eclipse complains about HTML syntax errors otherwise
 * because the starting <form><ul> is elsewhere
 */
print '</ul>

<div class="hr"></div>

<input type="submit" class="form-submit notice" value="Anwenden">
</form>';

?>