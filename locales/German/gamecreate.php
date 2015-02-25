<?php
/*
    Copyright (C) 2004-2010 Kestas J. Kuliukas

	This file is part of webDiplomacy.

    webDiplomacy is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    webDiplomacy is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with webDiplomacy.  If not, see <http://www.gnu.org/licenses/>.
 */

defined('IN_CODE') or die('This script can not be run by itself.');
/**
 * @package Base
 * @subpackage Forms
 */
?>
<div class="content-bare content-board-header content-title-header">
<div class="pageTitle barAlt1">
	Neues Spiel erstellen
</div>
<div class="pageDescription barAlt2">
Beginne ein neues Spiel; du entscheidest, wie es heißt, wie lange die Phasen dauern, und was es wert ist.
</div>
</div>
<div class="content content-follow-on">

<form method="post">
<ul class="formlist">

	<li class="formlisttitle">
		Name:
	</li>
	<li class="formlistfield">
		<input type="text" name="newGame[name]" value="" size="30" onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13">
	</li>
	<li class="formlistdesc">
		Der Name des Spiels
	</li>
	
	<li class="formlisttitle">
		Phasen-Länge: (5 Minuten - 10 Tage)
	</li>
	<li class="formlistfield">
		<select id="phaseMinutes" name="newGame[phaseMinutes]" onChange="
			document.getElementById('wait').selectedIndex = this.selectedIndex; 
			if (this.selectedIndex < 5) {
				$('fixStart').value= 'Yes';
				$('fixStart').disabled= true;
			} else { 
				$('fixStart').value= 'No';
				$('fixStart').disabled= false;
			}
			if (this.selectedIndex == 28) $('phaseHoursText').show(); else $('phaseHoursText').hide();">
		<?php
			$phaseList = array(5, 10, 15, 20, 30,
				60, 120, 240, 360, 480, 600, 720, 840, 960, 1080, 1200, 1320,
				1440, 2160, 2880, 4320, 5760, 7200, 8640, 10080, 14400, 1440+60, 2880+60*2);

			foreach ($phaseList as $i) {
				$opt = libTime::timeLengthText($i*60);

				print '<option value="'.$i.'"'.($i==1440 ? ' selected' : '').'>'.$opt.'</option>';
			}
		?>
		<option value="0">Individuell</option>
		</select>
		<span id="phaseHoursText" style="display:none">
			 - Phasen-Länge: <input type="text" id="phaseHours" name="newGame[phaseHours]" value="24" size="4" style="text-align:right;"
			 onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			 onChange="
			  this.value = parseInt(this.value);
			  if (this.value == 'NaN' ) this.value = 24;
			  if (this.value < 1 ) this.value = 1;
			  document.getElementById('phaseMinutes').selectedIndex = 28;
			  document.getElementById('phaseMinutes').options[28].value = this.value * 60;
			  document.getElementById('wait').selectedIndex = 17;" > Stunden.
		</span>

	</li>
	<li class="formlistdesc">
		Die Zeit, die die Spieler pro Phase maximal für Diskussionen und das Abgeben von Zügen haben.<br />
		Längere Spiel-Phasen bedeuten mehr Zeit für sorgfälltige Überlegungen und Absprachen - aber brauchen schlichtweg mehr Zeit.
		Kürzere Phasen bringen ein schnelleres Spiel mit sich. Die Spieler, die an einem schnellen Spiel teilnehmen, müssen aber auch die Zeit mitbringen, sich in kurzen Abständen am Spiel zu beteiligen.<br /><br />

		<strong>Standard:</strong> 24 Stunden/1 Tag
	</li>

	<li class="formlisttitle">
		Einsatz: (2<?php print libHTML::points(); ?> -
			<?php print $User->points.libHTML::points(); ?>)
	</li>
	<li class="formlistfield">
	<div id="betinput">
		<input id="bet" type="text" name="newGame[bet]" size="7" value="<?php print $formPoints ?>" 
			onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			onChange="
				this.value = parseInt(this.value);
				if (this.value == 'NaN' ) this.value = <?php print $defaultPoints; ?>;
				if (this.value < 2) this.value = 2;
				if (this.value > <?php print $User->points; ?>) this.value = <?php print $User->points; ?>;"
			/> / 
			<input type="button" value="Ohne Pott und Wertung."
				onclick="$('bet').value = '0';
						$('betinput').hide(); $('potType').hide(); $('bet_unrated').show();">
	</div>
	<div id="bet_unrated" style="<?php print libHTML::$hideStyle; ?>" >Dies ist ein Spiel ohne Pott und Wertung.</div>
	</li>
	<li class="formlistdesc">
		Der Einsatz, der von jedem Spieler gesetzt werden muss, um einem Spiel beizutreten.
		Die Summe der Einsätze aller Spieler (auch deiner!) bilden den "Pott", um den in dieser Partie gespielt wird. (<a href="points.php" class="light">mehr Infos</a>).<br />
		<?php
			if (isset(Config::$limitBet))
			{
				print 'Für Spiele mit Varianten, die nur eine geringe Spieleranzahl vorraussetzen, ist der Einsatz begrenzt.</br>';
				$first=true;
				foreach (Config::$limitBet as $limit=>$bet)
				{
					if ($first)
					{
						print '('.$limit.'-Spieler-Varianten dürfen mit einem Maximaleinsatz von '.$bet.libHTML::points().' gespielt werden,';
						$first = false;
					}
					else
						print $limit.'-Spieler: '.$bet.libHTML::points().', ';
				}
				print 'Varianten mit einer größeren Spieleranzahl haben kein solches Limit.)';
				print '<br />';
			}
		?>
		<br />

		<strong>Standard:</strong> <?php print $defaultPoints.libHTML::points(); ?>
	</li>
	
<?php
$first='';
if( count(Config::$variants)==1 )
{
	foreach(Config::$variants as $variantID=>$variantName) ;

	$defaultVariantName=$variantName;

	print '<input type="hidden" name="newGame[variantID]" value="'.$variantID.'" />';
}
else
{
?>
	<li class="formlisttitle">Variant map/rules:</li>
	<li class="formlistfield">
	
	<script type="text/javascript">
	function setExtOptions(i){
		document.getElementById('countryID').options.length=0;
		switch(i)
		{
			<?php
			$checkboxes=array();
			foreach(Config::$variants as $variantID=>$variantName)
			{
				if (isset(Config::$blockedVariants) && in_array($variantID,Config::$blockedVariants))
					continue;
					
				$Variant = libVariant::loadFromVariantName($variantName);
				$checkboxes[$variantName] = '<option value="'.$variantID.'"'.(($first=='')?' selected':'').'>'.$Variant->fullName.'</option>';
				if($first=='') {
					$first='"'.$variantID.'"';
					$defaultName=$variantName;
				}
				print "case \"".$variantID."\":\n";
				print 'document.getElementById(\'desc\').innerHTML = "<a class=\'light\' href=\'variants.php?variantID='.$variantID.'\'>'.$Variant->fullName.'</a><hr style=\'color: #aaa\'>'.$Variant->description.'";'."\n";		
				print "document.getElementById('countryID').options[0]=new Option ('Zufall','0');";
				for ($i=1; $i<=count($Variant->countries); $i++)
					print "document.getElementById('countryID').options[".$i."]=new Option ('".$Variant->countries[($i -1)]."', '".$i."');";
				print "break;\n";		
			}	
			ksort($checkboxes);	
			?>	
		}
	}
	</script>
	
	<table><tr>
		<td	align="left" width="0%">
			<select name="newGame[variantID]" onChange="setExtOptions(this.value)">
			<?php print implode($checkboxes); ?>
			</select> </td>
		<td align="left" width="100%">
			<div id="desc" style="border-left: 1px solid #aaa; padding: 5px;"></div></td>
	</tr></table>
	</li>
	<li class="formlistdesc">
		Wähle aus dieser Liste verfügbarer Spiel-Varianten/-Regeln, welche Art von Diplomacy-Partie du starten
		möchtest.<br /><br />

		Klicke auf einen Varianten-Namen, um mehr Details über die Variante zu erfahren.<br /><br />

		<strong>Standard:</strong> <?php print $Variant->fullName; ?>
	</li>
<?php
}
?>
	<li class="formlisttitle">Länderzuweisung:</li>
	<li class="formlistfield">
		<select id="countryID" name="newGame[countryID]">
		</select>
	</li>

	<li class="formlistdesc">
		Zufällige Verteilung der Länder oder Möglichkeit, dass jeder Spieler sein Land selbst auswählt (Spielersteller erhält ausgewähltes Land).<br /><br />
		
		<strong>Standard:</strong> Zufall
	</li>
	
	<script type="text/javascript">
	setExtOptions(<?php print $first;?>);
	</script>
	
	<div id="potType">
		<li class="formlisttitle">Pott-Typ:</li>
		<li class="formlistfield">
			<input type="radio" name="newGame[potType]" value="Points-per-supply-center" checked > Points-per-supply-center<br />
			<input type="radio" name="newGame[potType]" value="Winner-takes-all"> Winner-takes-all
		</li>
		<li class="formlistdesc">
			Soll der Gewinn unter den am Ende des Spiels übrigen Spielern aufgeteilt werden (Points-per-supply-center)
			oder bekommt der Gewinner den gesammten Pott (Winner-takes-all)? (<a href="points.php#ppscwta" class="light">Mehr Infos zu Pott-Typen</a>).<br /><br />

			<strong>Standard:</strong> Points-per-supply-center
		</li>
	</div>

	<li class="formlisttitle">
		Anonyme Spieler:
	</li>
	<li class="formlistfield">
		<input type="radio" name="newGame[anon]" value="No" checked>Nein
		<input type="radio" name="newGame[anon]" value="Yes">Ja
	</li>
	<li class="formlistdesc">
		Wenn auf "Ja" gesetzt werden im Spiel keine Namen und Benutzer-Infos angezeigt. Die Spieler bleiben bis zum Ende der Partie anonym.<br /><br />

		<strong>Standard:</strong> Nein, die Spieler sind nicht anonym.
	</li>
	
	<li class="formlisttitle">
		Spielnachrichten deaktivieren:
	</li>
	<li class="formlistfield">
		<input type="radio" name="newGame[pressType]" value="Regular" checked>Alle erlauben
		<input type="radio" name="newGame[pressType]" value="PublicPressOnly">Nur globale Nachrichten, keine privaten
		<input type="radio" name="newGame[pressType]" value="NoPress">Keine Nachrichten
	</li>
	<li class="formlistdesc">
		Deaktiviert einige Arten von Nachrichten, die Spieler sich im Spiel schicken können. Je nach Auswahl werden alle, nur globale oder gar keine Nachrichten erlaubt.

		<br /><br /><strong>Standard:</strong> Alle erlauben
	</li>
	
	<li class="formlisttitle">
		Keine Spielauswertung an:
	</li>
	<li class="formlistfield">
		<input type="checkbox" name="newGame[noProcess][]" value="1">Mo
		<input type="checkbox" name="newGame[noProcess][]" value="2">Di
		<input type="checkbox" name="newGame[noProcess][]" value="3">Mi
		<input type="checkbox" name="newGame[noProcess][]" value="4">Do
		<input type="checkbox" name="newGame[noProcess][]" value="5">Fr
		<input type="checkbox" name="newGame[noProcess][]" value="6">Sa
		<input type="checkbox" name="newGame[noProcess][]" value="0">So
	</li>
	<li class="formlistdesc">
		Wenn das Spiel an bestimmten Tagen nicht ausgewertet werden soll, können hier entsprechende Tage ausgewählt werden. <br />
		Sollte die aktuelle Phasenfrist auf einen gewählten Tag fallen, wird die Phase automatisch um 24 Stunden verlängert. Es besteht weiterhin die Möglichkeit, vorzeiting in die nächste Phase voranzuschreiten, indem alle Spieler ihre Befehle mit "Fertig" markieren. <br />
		Tage werden in CET-Zeit (Central European Time) angegeben.
		
		<br /><br /><strong>Standard:</strong> Keine Auswahl. Auswertung an allen Tagen der Woche.
	</li>
	
</ul>

<div class="hr"></div>

<div id="AdvancedSettingsButton">
<ul class="formlist">
	<li class="formlisttitle">
		<a href="#" onclick="$('AdvancedSettings').show(); $('AdvancedSettingsButton').hide(); return false;">
		Erweiterte Einstellungen öffnen
		</a>
	</li>
	<li class="formlistdesc">
		Die erweiterten Einstellungen erlauben weitere Anpassungen für gestandene Spieler,
		 wie z.B. verschiedene Karten-Typen, alternative Regeln oder besondere Zeit-Optionen.<br /><br />

		Die Standard-Einstellungen sind genau richtig für <strong>neue Spieler</strong>.
	</li>
</ul>
</div>

<div id="AdvancedSettings" style="<?php print libHTML::$hideStyle; ?>">

<h3>Erweiterte Einstellungen</h3>

<ul class="formlist">

	<li class="formlisttitle">
		Länge der Beitrittsphase: (5 Minuten - 10 Tage)
	</li>
	<li class="formlistfield">
		<select id="wait" name="newGame[joinPeriod]">
		<?php
			foreach ($phaseList as $i) {
				$opt = libTime::timeLengthText($i*60);

				print '<option value="'.$i.'"'.($i==1440 ? ' selected' : '').'>'.$opt.'</option>';
			}
		?>
		</select>
		- 
		<select id="fixStart" name="newGame[fixStart]">
			<option value="No" selected>Das Spiel wird gestartet, sobald genug Spieler beigetreten sind.</option>';
			<option value="Yes">Das Spiel startet erst, wenn das Start-Datum und die Start-Zeit erreicht ist.</option>';
		</select>
	</li>
	<li class="formlistdesc">
		Die länge der Phase, die Benutzer haben, um diesem Spiel beizutreten (=Vorspiel-Phase). Diese Option besteht, um beispielsweise auch in Fünf-Minuten-Spielen den Benutzern mehr Zeit zum Beitreten einzuräumen. 

		<br /><br /><strong>Standard:</strong> Gleiche Länge wie die übrigen Spielphasen
	</li>
	
	<li class="formlisttitle">
		Reliability-Rating Vorraussetzungen:
	</li>
	<script type="text/javascript">
		function changeReliabilitySelect(i){
			if (i > 0) {
				document.getElementById('minPhases').options[0].value = '20';
				document.getElementById('minPhases').options[0].text  = '20+';
				document.getElementById('ReliabilityInput').value = i;
			} else if ( i == '') {
				document.getElementById('minPhases').options[0].value = '20';
				document.getElementById('minPhases').options[0].text  = '20+';
				$('ReliabilityText').show();
				$('ReliabilitySelect').hide();			
			}
			else {
				document.getElementById('minPhases').options[0].value = '0';
				document.getElementById('minPhases').options[0].text  = 'keine';
				document.getElementById('ReliabilityInput').value = i;
			}
		}
	</script>
	<li class="formlistfield">
		Minimum Reliability-Rating: R
<?php
/*		
		<span id="ReliabilitySelect" style="display:inline">
			<select onChange="changeReliabilitySelect(this.value)">
			<option value=0 selected>none</option>
			<?php
				foreach (libReliability::$grades as $limit=>$grade)
					print '<option value='.$limit.'>'.$grade.'</option>';
			?>
			print '<option value=''>custom</option>';
			</select>
		</span>
		<span id="ReliabilityText" style="display:none">
*/
?>		
		<span id="ReliabilityText" >
			<input id="ReliabilityInput" type="text" name="newGame[minRating]" size="2" value="0"
				style="text-align:right;"
				onChange="
					this.value = parseInt(this.value);
					if (this.value == 'NaN' ) this.value = 0;
					if (this.value < 0 ) this.value = 0;
					if (this.value > 100 ) this.value = 100;
					changeReliabilitySelect(this.value)" 
				onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13;">
			oder besser.
		</span>
		<br>
		Keine NMRs: <input id="minNoNMR" type="text" name="newGame[minNoNMR]" size="2" value="0"
			style="text-align:right;"
			onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			onChange="
				this.value = parseInt(this.value);
				if (this.value == 'NaN' ) this.value = 0;
				if (this.value < 0 ) this.value = 0;
				if (this.value > 100 ) this.value = 100;
				"/>% oder besser. - 
		Keine CDs: <input type="text" id="minNoCD" name="newGame[minNoCD]" size="2" value="0"
			style="text-align:right;"
			onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			onChange="
				this.value = parseInt(this.value);
				if (this.value == 'NaN' ) this.value = 0;
				if (this.value < 0 ) this.value = 0;
				if (this.value > 100 ) this.value = 100;
				"/>% oder besser.<br>
		Minimum gespielte Phasen: <select id="minPhases" name="newGame[minPhases]">
			<option value=0 selected>keines</option>
			<option value=50>50+</option>
			<option value=100>100+</option>
			<option value=300>300+</option>
			<option value=600>600+</option>
			</select>
	</li>
	<li class="formlistdesc">
		Hier können bestimmte Vorraussetzungen ausgewählt werden, die Spieler erfüllen müssen, um dem Spiel beitreten zu können.		
		<ul>
			<li><b>Minimum Reliability-Rating:</b> Die Zuverlässigkeit (Reliability-Rating), die ein Spieler mindestens erfüllen soll.</li>
			<li><b>Minimum gespielte Phasen:</b> Die Anzahl an Phasen, die ein Spieler mindestens gespielt haben soll.</li>
		</ul>
		Diese Einstellungen können dazu führen, dass nicht genug Spieler beitreten können. Die Einschränkungen sollten also mit Bedacht gewählt werden.<br /><br />
		
		<strong>Standard:</strong> Keine Vorraussetzungen:
	</li>

	<li class="formlisttitle">
		NMR - Umgang:
	</li>
	<li class="formlistfield">
		<?php 
			$specialCDturnsTxt = ( Config::$specialCDturnsDefault == 0 ? 'aus' : (Config::$specialCDturnsDefault > 99 ? '&infin;' : Config::$specialCDturnsDefault) );
			$specialCDcountTxt = ( Config::$specialCDcountDefault == 0 ? 'aus' : (Config::$specialCDcountDefault > 99 ? '&infin;' : Config::$specialCDcountDefault) );
		?>
		
		<input type="hidden" id="specialCDturn"  name="newGame[specialCDturn]"  value="<?php print $specialCDturnsTxt;?>">
		<input type="hidden" id="specialCDcount" name="newGame[specialCDcount]" value="<?php print $specialCDcountTxt;?>">
		
		<select id="NMRpolicy" name="newGame[NMRpolicy]" 
			onChange="
				if (this.value == 'c/c') {
					$('NMRpolicyCustom').show();
					$('NMRpolicyText').hide();
				} else {
					opt = this.value.split('/');
					document.getElementById('specialCDturn').value  = opt[0];
					document.getElementById('specialCDcount').value = opt[1];
					if (opt[0] == 0) opt[0] = 'aus'; if (opt[0] > 90) opt[0] = '&infin;'; 
					if (opt[1] == 0) opt[1] = 'aus'; if (opt[1] > 90) opt[1] = '&infin;'; 
					document.getElementById('specialCDturnCustom').value  = opt[0];
					document.getElementById('specialCDcountCustom').value = opt[1];
					document.getElementById('NMRpolicyText').innerHTML = ' - Runden: <b>' + opt[0] + '</b> - Verlängerung: <b>' + opt[1] + '</b>';
					$('NMRpolicyCustom').hide();
					$('NMRpolicyText').show();
				}
			">
			<option value="0/0">Aus</option>
			<option value="<?php print $specialCDturnsTxt;?>/<?php print $specialCDcountTxt;?>" selected>Standard</option>
			<option value="5/2">Verpflichtend</option>
			<option value="99/99">Ernst</option>
			<option value="c/c">Individuell</option>
		</select>
		
		
		<span id="NMRpolicyCustom" style="display:none">
			 - Runden: </b><input 
							type="text" 
							id="specialCDturnCustom" 
							size="2" 
							value='<?php print $specialCDturnsTxt; ?>'
							onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
							onChange="document.getElementById('NMRpolicy').selectedIndex = 4;
								if (this.value == 'aus') this.value = 0;
								this.value = parseInt(this.value);
								document.getElementById('specialCDturn').value  = this.value;
								if (this.value > 90) this.value = '&infin;';
								if (this.value == 0) this.value = 'aus';"
							>
			 - Verlängerung: </b><input
							type="text"
							id="specialCDcountCustom"
							value = '<?php print $specialCDcountTxt; ?>'
							onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
							onChange="document.getElementById('NMRpolicy').selectedIndex = 4;
								if (this.value == 'aus') this.value = 0;
								this.value = parseInt(this.value);
								document.getElementById('specialCDcount').value = this.value;
								if (this.value > 90) this.value = '&infin;';
								if (this.value == 0) this.value = 'aus';"
							size="2"
							> 
		</span>
		<span id="NMRpolicyText">
			 - Runden: <b><?php print $specialCDturnsTxt;?></b> - Verlängerung: <b><?php print $specialCDcountTxt;?></b>
		</span>
	</li>
	<li class="formlistdesc">
		Diese Einstellung ermöglicht es, Spieler auf Civil Disorder (CD) zu setzen, wenn keine Befehle (NMR) von ihnen abgeschickt wurden.
		<ul>
		<li><strong>Runden:</strong> Die Anzahl an Runden, innerhalb der Spieler sofort auf CD gesetzt werden. Eine Runde kann bis zu 3 Phasen haben.
			Beispiel: Eine 2 bewirkt, dass Spieler innerhalb des ersten Spieljahres (Frühling, Herbst, inkl. Rückzugs- und Bauphase) sofort auf CD gesetzt werden, wenn eine NMR vorliegt.</li>
		<li><strong>Verlängerung:</strong> Die zusätzliche Zeit zum Werben und Finden eines Ersatzspielers (die aktuelle Phase wird x-mal verlängert).
			Eine 0 wird zwar einen Spieler auf CD gesetzt wird, das Spiel aber trotzdem wie üblich fortgesetzt wird. Spieler mit einem oder keinem VZ haben keinen Einfluss auf diese Einstellungen und werden ignoriert.</li>
		</ul>
		Jeder Wert über 90 wird auf $infin; gesetzt, ein Wert von 0 deaktiviert diese Einstellung.
		<br /><br /><strong>Standard:</strong> <?php print $specialCDturnsTxt;?> / <?php print $specialCDcountTxt;?>
	</li>

	<li class="formlisttitle">
		Alternative Siegesbedingungn:
	</li>
	<li class="formlistfield"> 
		<b>Ziel-VZs: </b><input type="text" name="newGame[targetSCs]" size="4" value="0"
			onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			onChange="
				this.value = parseInt(this.value);
				if (this.value == 'NaN' ) this.value = 0;"
		/> (0 = Standard)<br>
		<b>Max. Runden: </b><input type="text" name="newGame[maxTurns]" size="4" value="0"
			onkeypress="if (event.keyCode==13) this.blur(); return event.keyCode!=13"
			onChange="
				this.value = parseInt(this.value);
				if (this.value == 'NaN' ) this.value = 0;
				if (this.value < 4 && this.value != 0) this.value = 4;
				if (this.value > 200) this.value = 200;"
		/> (4 < maxTurns < 200)
	</li>
	<li class="formlistdesc">
		Diese Einstellung ermöglicht es, Spiele nach einer bestimmten Anzahl an Runden und/oder bei Erreichen einer von den Standardregeln abweichenden VZ-Anzal zu beenden.
		Es ist hierbei sinnvoll, die in der Variantenbeschreibung angegebene durchschnittlich Rundenzahl dieser Variante zu berücksichtigen.<br />
		
		Bei einer Rundenbegrenzung wird der Sieger nach der Diplomatie-Phase ermittelt.
		Bei zwei oder mehr Spielern mit derselben Anzahl an VZs zählt die Anzahl in der vorherigen Runde.
		Hatten mehrere Spieler zu jeder Zeit gleich viele VZs, werden ein zufälliger Sieger aus diesen gewählt.
		<br />Ein Wert von "0" (Standard) beendet das Spiel wie üblich, wenn ein Spieler die benötigten Ziel-VZs erreicht hat.
		<br /><br /><strong>Standard:</strong> 0 (keine Rundenbegrenzung / Standardanzahl an VZs für Sieg nötig)
	</li>

	<?php
		if ($User->id == 5)
			print '
				<li class="formlisttitle">
					Chess Timer:
				</li>
				<li class="formlistfield">
					<b>Hours: </b><input type="text" name="newGame[chessTime]" value="0" size="8">
				</li>
				<li class="formlistdesc">
					If you want a chesstimer you can enter the time each player has on it\'s clock here.
				</li>
			';
		else
			print '
				<input type="hidden" name="newGame[chessTime]" value="0"
			';
	?>
	
	<li class="formlisttitle">
		Moderiertes Spiel:
	</li>
	<li class="formlistfield">
		<input type="radio" name="newGame[moderated]" 
			onclick="$('GDoptions').hide();	$('PWReq').hide(); $('PWOpt').show();"
			value="No" checked>Nein
		<input type="radio" name="newGame[moderated]" value="Yes" 
			onclick="$('GDoptions').show(); $('PWReq').show(); $('PWOpt').hide();"
			<?php if (!$User->DirectorLicense()) print "disabled"; ?> >Ja
	</li>
	<li class="formlistdesc">
		Ist "Ja" ausgewählt, erhälts Du besondere Moderatoren-Rechte, um dieses Spiel zu verwalten.<br />
		Um ein Spiel zu moderieren, müssen mindestens <b>25</b> Nicht-Live-Spiele mit mehr als zwei Spielern von Dir beendet worden sein und Du musst ein Reliability-Rating von <b>R97</b> oder besser vorweisen können.
		<br /><br />
		<strong>Standard:</strong> Nein, das Spiel wird nicht moderiert.
	</li>

	<span id="GDoptions" style="<?php print libHTML::$hideStyle; ?>">
	
		<li class="formlisttitle">
			Spielbeschreibung (notwendig für moderierte Spiele):
		</li>
		<li class="formlistfield">
			<TEXTAREA name="newGame[description]" ROWS="4"></TEXTAREA>
		<li class="formlistdesc">
			Bitte gebe hier eine kurze Beischreibung Deines Spiels und spezieller Regeln ein.
		</li>
	
	</span>

<!-- 
 
		You can force extends, pauses and have many other options running the game.<br />
		If you select Yes, you are not automatically playing in this game, you are the moderator.
		You need to join this game once it's created if you want to play a country.<br />
		If you want to enable the players to choose their countries select any country in the "Country assignment" list. You will still need to join this game once it's created.
-->
	

	<li class="formlisttitle">
		<img src="images/icons/lock.png" alt="Private" /> Passwort-Schutz (<span id="PWOpt">optional</span><span id="PWReq" style="<?php print libHTML::$hideStyle;?>">notwendig für moderierte Spiele</span>):
	</li>
	<li class="formlistfield">
		<ul>
			<li>Passwort: <input type="password" name="newGame[password]" value="" size="30" /></li>
			<li>Noch einmal: <input type="password" name="newGame[passwordcheck]" value="" size="30" /></li>
		</ul>
	</li>
	<li class="formlistdesc">
		<strong>Ein Passwort ist optional.</strong> Wird hier ein Passwort gesetzt können nur Benutzer, denen du das Passwort mitteilst, an diesem Spiel teilnehmen.<br /><br />

		<strong>Standard:</strong> Kein Passwort
	</li>

<!-- 
	<li class="formlisttitle">
		No moves received options:
	</li>
	<li class="formlistfield">
		<input type="radio" name="newGame[missingPlayerPolicy]" value="Normal" checked > Normal<br />
		<input type="radio" name="newGame[missingPlayerPolicy]" value="Wait"> Wait for all players
	</li>
	<li class="formlistdesc">
		What should happen if the end of the turn comes and a player has not submitted any orders?<br /><br />
		
		If set to <strong>Normal</strong> the game will proceed, and after 
		a couple of turns they will go into civil disorder and their country can be taken over by another player.<br /><br />
		
		If set to <strong>Wait for all players</strong> the game will not continue until all players have submitted their orders.<br />
		This avoids any issues caused by 
		someone not submitting their orders on time, but it means that if someone becomes unavailable the game will not continue until they either
		return, or a moderator manually sets them to civil disorder.<br /><br />

		<strong>Default:</strong> Normal
	</li>
	 -->
</ul>

</div>

<div class="hr"></div>

<p class="notice">
	<input type="submit" onClick="$('fixStart').disabled = false;" class="form-submit" value="Create">
</p>
</form>
