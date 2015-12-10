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
 * @subpackage Static
 */

print libHTML::pageTitle('Kurzanleitung zu Diplomacy ','Eine kurze Einführung ins Diplomacy spielen für Einsteiger hier auf Diplomacy\'s Website.');

print '
<p>
Diplomacy ist ein Spiel, das leicht zu erlernen, aber unm&ouml;glich zu meistern ist. Die Regeln sind intuitiv, die meisten Leute lernen sie direkt beim Spielen. Dieses Kurzanleitung hilft, sie noch ein wenig schneller zu verstehen. 
</p>

<div class="hr"></div>';

?>
<p style="text-align:center"><a href="#Objective">Ziel des Spiels</a> - <a href="#Units">Einheiten</a> -
	<a href="#Moves">Befehle</a> - <a href="#Rules">Regeln</a> - <a href="#Play">Spielen</a></p>

<div class="hr"></div>

<a name="Objective"></a>
<h3>Ziel des Spiels</h3>
<p>
 Das Ziel bei Diplomacy ist es, 18 Versorgungszentren inne zu haben. F&uuml;r jedes Versorgunszentrum gewinnst du eine Einheit; du verlierst eine Einheit, wenn eines deiner Versorgungszentren von jemand anderem besetzt wird.
<br>
<br>
Die Versorgungszentren sind gesondert markierte Landabschnitte.</p>
<p style="text-align:center;">
	<img src="images/intro/supply.png" alt=" " title="Versorgungszentren sind markiert (gro&szlig;e Karte)" />
	<img src="images/intro/supply2.png" alt=" " title="Versorgungszentren sind markiert (kleine Karte)" />
</p>

<div class="hr"></div>

<a name="Units"></a>
<h3>Einheiten</h3>
<ul class="formlist">
	<li class="formlisttitle">Armee <img src="<?php print STATICSRV; ?>contrib/army.png"
		alt=" "  title="An army unit icon" /></li>
	<li class="formlistdesc">
		Diese Einheit kann nur &uuml;ber Land bewegt werden.
	</li>

	<li class="formlisttitle">Flotte <img src="<?php print STATICSRV; ?>contrib/fleet.png"
		alt=" " title="A fleet unit icon" /></li>
	<li class="formlistdesc">
		Diese Einheit lann nur auf See und in K&uuml;sten-Territorien bewegt werden. Sie kann zudem Armee &uuml;ber die See-Gebiete hinweg bef&ouml;rdern mittels des "convoy"-Befehls. 
	</li>
</ul>

<div class="hr"></div>
<a name="Moves"></a>
<h3>Befehle</h3>
<ul class="formlist">
	<li class="formlisttitle">Hold</li>
	<li class="formlistdesc">
		Die Einheit verteidigt das Territorium, falls es angegriffen wird. Sonst tut es nichts.
		<p style="text-align:center;">
			<img src="http://webdiplomacy.net/datc/maps/801-large.map-thumb" alt=" " title="An army holds in Naples" />
		</p>
	</li>


	<li class="formlisttitle">Move</li>
	<li class="formlistdesc">
		Die Einheit versucht in ein angrenzendes Territorium zu ziehen / es zu anzugreifen. 
		<p style="text-align:center;">
			<img src="http://webdiplomacy.net/datc/maps/802-large.map-thumb" alt=" " title="An army in Naples moves to Rome" />
		</p>
	</li>


	<li class="formlisttitle">Support hold, support move</li>
	<li class="formlistdesc">
		 Support ist das, worum es in Diplomacy eigentlich geht. Da alle Einheiten im Spiel die gleiche St&auml;rke haben muss man die Kraft mehrerer Einheiten vereinen um Territorien angreifen zu k&ouml;nnen.
		<br>
		<em>
		(Fahre mit der Maus &uuml;ber die komplexeren Schlachten f&uuml;r eine genauere Erkl&auml;uterung.) </em>
		<p style="text-align:center;">
			<img src="http://webdiplomacy.net/datc/maps/803-large.map-thumb" alt=" "
				title="Ein gelber Support move l&auml;sst die Armee in Venedig, die Armee in Rom besiegen." />
			<img src="http://webdiplomacy.net/datc/maps/804-large.map-thumb" alt=" "
				title="Ein gr&uuml;ner Support move der Flotte im Tyrrhenischen Meer l&auml;sst die Armee in Rom gegen den unterst&uuml;tzten Angriff der Armee in Venedig bestehen (unentschieden)." />
		</p>
	</li>


	<li class="formlisttitle">Convoy</li>
	<li class="formlistdesc">
		Man kann Flotten nutzen, um Armeen &uuml;ber See-Territorien zu geleiten (im Enlischen "convoy"). Mehrere Flotten hintereinander k&ouml;nnen in einem einzigen Zug eine Armee auch weitere Strecken &uuml;ber See bewegen.
		<p style="text-align:center;">
			<img src="http://webdiplomacy.net/datc/maps/805-large.map-thumb" alt=" "
				title="Eine Armee zieht von Venedig nach Tunis, convoyed von einer Flotte in der Adria und einer im Ionischen Meer." />
		</p>
	</li>
</ul>

<div class="hr"></div>
<a name="Rules"></a>
<h3>Regeln</h3>
<ul class="formlist">
<li class="formlistdesc">
	 In Dipomacy sind alle Armeen und Flotten gleich stark, eine verteidigende (
	<strong>hold</strong>
	) Einheit besiegt immer eine bewegende (
	<strong>moving</strong>
	) mit gleicher Unterst&uuml;tzung (
	<strong>support</strong>
	). 
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/806-large.map-thumb" alt=" "
			title="Eine Armee in Neapel soll nach Rom ziehen, wird aber nicht unterst&uuml;tzt und kann so die Einheit in Rom nicht vertreiben." />
		<img src="http://webdiplomacy.net/datc/maps/807-large.map-thumb" alt=" "
			title="Die Flotte und die Armee sind gleich stark, daher kann keiner nach Apulien ziehen." />
	</p>
</li>


<li class="formlistdesc">
	 Die einzige M&ouml;glichkeit, einen Angriff zu gewinnen ist, eine angreifende (
	<strong>moving</strong>
	) Einheit mit einer anderen zu unterst&uuml;tzen indem man letzter einen gelben
	<strong>support move</strong>
	befielt. 
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/803-large.map-thumb" alt=" "
				title="Ein gelber Support move l&auml;sst die Armee in Venedig, die haltende Armee in Rom besiegen." />
	</p>
</li>


<li class="formlistdesc">
	Verteidigende (
	<strong>holding</strong>
	) Einheiten k&ouml;nnen mit einem gr&uuml;nen
	<strong>support hold</strong>
	-Befehl unterst&uuml;tzt werden. 
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/804-large.map-thumb" alt=" "
				title="Ein gr&uuml;ner Support hold der Flotte im Tyrrhenischen Meer l&Auml;sst die Armee in Rom gegen den unterst&uuml;tzten Angriff der Armee in Venedig bestehen (unentschieden)." />
	</p>
</li>

<li class="formlistdesc">
	  Ist die Anzahl der
	<strong>support moves</strong>
	-Befehle gr&ouml;&szlig;er als die Anzahl der
	<strong>support holds</strong>
	-Befehle gl&uuml;ckt der move-Befehl, andernfalls scheitert er. 
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/808-large.map-thumb" alt=" "
				title="Die Flotte, die aus Triest nach Venedig angreift, hat zwei Support moves, die haltende Flotte in Venedig aber nur einen support hold. Also gewinnt die angreifende Flotte." />
		<img src="http://webdiplomacy.net/datc/maps/809-large.map-thumb" alt=" "
				title="Sowohl der Angriff aus Triest, als auch die Abwehr in Venedig werden zweimal unterst&uuml;tzt. Es steht unentschieden, also kann der Verteidiger bleiben." />
	</p>
</li>

<li class="formlistdesc">
	 Wichtig: wird eine Einheit angegriffen verteidigt sie sich automatisch, f&uuml;hrt also den
	<strong>hold</strong>
	-Befehl aus und kann keine weitere Einheit mehr unterst&uuml;tzen. 
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/808-large.map-thumb" alt=" "
				title="Keine unterst&uuml;tzenden Einheiten werden angegriffen, alle Z&auml;hlen: Triest 2 - Venedig 1; Triest darf ziehen" />
		<img src="http://webdiplomacy.net/datc/maps/810-large.map-thumb" alt=" "
				title="Eine Armee aus M&uuml;nchen greift Tirol an und verhindert so, dass die dortige Einheit unterst&uuml;tzen kann: Triest 1 - Venedig 1; Triest muss bleiben" />
		<img src="http://webdiplomacy.net/datc/maps/811-large.map-thumb" alt=" "
				title="Eine Flotte im Tyrrhenischen Meer greift Rom an und verhindert, dass es Venedig unterst&uuml;tzt: Triest 1 - Venedig 0; Triest darf ziehen" />
	</p>
</li>

</ul>
<div class="hr"></div>
<ul class="formlist">
<li class="formlistdesc">
	<a name="Play"></a>
	 Mit diesen Regeln wei&szlig;t du alles, was du wissen musst, um auf Diplomacy's Website eine Partie Diplomacy zu spielen. Nachdem du dich
	<a class="light" href="register.php">registriert</a>
	hast kannst du ein
	<a class="light" href="gamecreate.php">Spiel erstellen</a>
	und an
	<a class="light" href="gamelistings.php">offenen Spielen</a>
	teilnehmen.
	<p style="text-align:center;">
		<img src="http://webdiplomacy.net/datc/maps/812-large.map-thumb" alt=" "
				title="Weil Preussen die Flotte in der Ostsee unterst&uuml;tzt, wird sie nicht von der Flotte aus Livland vertieben. Sie kann die Armee aus Berlin erfolgreich nach Schweden geleiten."  />
	</p>
	</li>
</ul>