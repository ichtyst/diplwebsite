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

require_once('lib/countryswitch.php');

$User->clearNotification('CountrySwitch');

if ( isset($_REQUEST['CancelSwitch']) )
	libSwitch::CancelSwitch((int)$_REQUEST['CancelSwitch']);

if ( isset($_REQUEST['RejectSwitch']) )
	libSwitch::RejectSwitch((int)$_REQUEST['RejectSwitch']);

if ( isset($_REQUEST['ClaimBackSwitch']) )
	libSwitch::ClaimBackSwitch((int)$_REQUEST['ClaimBackSwitch']);

if ( isset($_REQUEST['ReturnSwitch']) )
	libSwitch::ReturnSwitch((int)$_REQUEST['ReturnSwitch']);

if ( isset($_REQUEST['AcceptSwitch']) )
	libSwitch::AcceptSwitch((int)$_REQUEST['AcceptSwitch']);

if ( isset($_REQUEST['newSwitch']) )
	$error = libSwitch::NewSwitch($_REQUEST['newSwitch']);
?>

	<a name="Switch"></a>
	<form method="post"><ul class="formlist">
	<li class="formlisttitle">Vergebene L&auml;nder:</li>
	<li class="formlistfield"><?php print libSwitch::allSwitchesHTML($User->id);?></li>
	<li class="formlistdesc">Alle aktiven T&auml;usche.</li>

	<?php if (isset($error) && ($error != '')) {?>
		<li class="formlisttitle">ERROR:</li>
		<li class="formlistfield"><?php print $error;?></li>
		<br>
	<?php }?>
	<li class="formlisttitle">Erstelle neuen L&auml;ndertausch:</li>
	<li class="formlistfield">
	<TABLE> <THEAD><TH>Spielname / ID</TH><TH>Gesendet an UserID</TH><TH> </TH></THEAD><TR>
	<TD><select name="newSwitch[gameID]">
		<?php
		$sql='SELECT m.gameID, g.name FROM wD_Members m
				INNER JOIN wD_Games g ON (g.id = m.gameID)
				WHERE g.id NOT IN (SELECT gameID FROM wD_CountrySwitch WHERE ((fromID='.$User->id.' OR toID='.$User->id.') AND status IN ("Send","Active"))) AND 
				g.phase!="Pre-game" AND m.status="Playing" AND m.userID='.$User->id;
		$tabl = $DB->sql_tabl($sql);
		while(list($gameID, $gameName) = $DB->tabl_row($tabl))
			print '<option value="'.$gameID.'">'.$gameName.'</option>';
		?>
	</select></TD>
	<TD><input type="text" name="newSwitch[toID]" size="5"><br></TD>
	<TD><input type="submit" class="form-submit notice" value="Anwenden"></TD></TR></TABLE>
	<li class="formlistdesc">W&auml;hle das Spiel aus, das an einen anderen Benuter gesendet werden soll. Das Spiel kann jederzeit zur&uuml;ckgefordert werden.</li>
	
	<li class="formlisttitle">So funktioniert's:</li>
	<li class="formlistfield">Das Country-Switch-Tool erm&ouml;glicht es dir, bestimmte Spiele an andere Spieler zu senden. Der ausgew&auml;hlte Spieler bekommt dann eine Nachricht und kann die &Uuml;bernahme des Spiels akzeptieren. Beide beteiligten Spieler k&ouml;nnen jederzeit das Spiel an den eigentlichen Spieler zur&uuml;ck senden. Endet das Spiel, wird es automatisch zur&uuml;ckgeschickt.</li>
	<li class="formlistfield">Da das Tool zum Finden von tempor&auml;ren Ersatzspielern entwickelt wurde, ist es dir nicht m&ouml;glich, w&auml;hrend der Benutzung des Tools neuen Spielen beizutreten.</li>
</ul>

