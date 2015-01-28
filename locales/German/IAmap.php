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
	<li class="formlisttitle">Hervorgehobene Gebiete:</li>
	<li class="formlistfield">
		<input type="radio" name="userForm[terrGrey]" value="all" <?php if($User->terrGrey=='all') print "checked"; ?>>Immer
		<input type="radio" name="userForm[terrGrey]" value="selected"  <?php if($User->terrGrey=='selected')  print "checked"; ?>>Nur f&uuml;r ausgew&auml;hlte Einheiten
		<input type="radio" name="userForm[terrGrey]" value="off"  <?php if($User->terrGrey=='off')  print "checked"; ?>>Nie
		</li>
	<li class="formlistdesc">
		"Immer": Egene Einheiten werden bei der Auswahl einer Einheit und m&ouml;gliche Zielgebiete bei der Befehlsvergabe hervorgehoben.<br>
		"Nur f&uuml;r ausgew&auml;hlte Einheiten": Die eigenen Einheiten werden nicht hervorgehoben. Ist keine Einheit ausgew&auml;hlt, erscheint die normale Karte sieht.
	</li>
	
	<li class="formlisttitle">Intensit&auml;t der ausgegrauten Gebiete:</li>
	<li class="formlistfield">
		<input type="text" name="userForm[greyOut]" size=3 maxlength=2 value="<?php print $User->greyOut ?>">%
	</li>
	<li class="formlistdesc">
		Die Intensit&auml;t beim Ausgrauen zur Hervorhebung der eigenen Einheiten in %. Gebe eine Zahl zwischen 10% (hell) und 90% (dunkel) ein.
	</li>
	
	<li class="formlisttitle">Scrollbars auf Karte:</li>
	<li class="formlistfield">
		<input type="radio" name="userForm[scrollbars]" value="Yes" <?php if($User->scrollbars=='Yes') print "checked"; ?>>Ja
		<input type="radio" name="userForm[scrollbars]" value="No"  <?php if($User->scrollbars=='No')  print "checked"; ?>>Nein
	</li>
	<li class="formlistdesc">
		F&uuml;gt wahlweise Scrollbars hinzu, wenn die Interactive Map aktiviert ist, sodass gro&szlig;e Karten auf dem ganzen Bildschirm oder nur in einem schmalen Ausschnitt dargestellt werden.
	</li>

	<li class="formlisttitle">Aktivierung:</li>
	<li class="formlistfield">
		<input type="radio" name="userForm[pointNClick]" value="Yes" <?php if($User->pointNClick=='Yes') print "checked"; ?>>Benutze nach M&ouml;glichkeit das Interactive Map Interface
		<input type="radio" name="userForm[pointNClick]" value="No"  <?php if($User->pointNClick=='No')  print "checked"; ?>>Nein, danke.
	</li>
	<li class="formlistdesc">
		Aktivierung der Interactive Map.
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