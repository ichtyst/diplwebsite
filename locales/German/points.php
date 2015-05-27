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
?>

<div align="center"><img src="images/points/stack.png" alt=" "
	title="A stack of webDiplomacy points. Points are a lot like casino chips in poker; tokens to bet with" /></div>

<p class="intro">
Diplomacy ist ein Spiel, welches zwar leicht zu erlernen, aber schwer zu meistern ist. Da
die webDiplomacy-Software (die auf dieser Website verwendet wird) sehr benutzerfreundlich ist,
gibt es hier viele Anfänger, aber auch einige fortgeschrittene Spieler.</p>

<p class="intro">
Punkte sind dazu da, dass Profis mit anderen Profis und Anfänger mit Anfängern spielen können, sodass
jeder ein zum jeweiligen Fortschritt passendes Spiel finden kann.
</p>

<div class="hr" ></div>

<div align="center"><img src="images/points/bet.png" alt=" "
	title="All players who want to join the game bet the same amount of points when the game begins" /></div>
<p class="intro">
Wenn man ein Spiel erstellt, kann man festlegen, wie viele Punkte "gesetzt" werden sollen.<br /><br />

Nur Spieler, die den angegebenen Einsatz an Punkten leisten, können dem Spiel beitreten.<br />
Ein Profi hat mehr Punkte und kann dementsprechend Spiele mit hohem Einsatz erstellen, denen nur andere Profis beitreten können.</p>

<div align="center"><img src="images/points/play.png" alt=" "
	title="The game begins; all players are now fighting for the 'pot' of points which they have all bet" /></div>

<p class="intro">
Sobald alle nötigen Spieler beigetreten sind, gibt es einen großen "Pott" an Punkten. Bei der klassischen 7-Spieler-Version ist 
dieser zum Beispiel sieben mal so groß wie der Einsatz eines jeden Spielers.<br /><br />

Ist das Spiel vorbei, wird der Pott wieder an die Spieler ausgezahlt, allerdings abhängig davon, wie gut ihr Spielergebnis ist.
</p>

<div align="center"><img src="images/points/win.png" alt=" "
	title="The game is over; the amount of points each player wins depends on their success in the game" /></div>

<p class="intro">
Die Anzahl an Punkten, die man erhält, hängt von der Anzahl der Versorgungszentren (VZ) ab, die man am Ende besitzt.
Wenn man alle 18 VZs für einen Sieg besitzt, bekommt man die meisten Punkte, aber solange man wenigstens mehr VZs als am Start besitzt,
bekommt man immerhin etwas an Punkten. Wurde man besiegt oder hat das Spiel verlassen, sind alle Punkte verloren.
</p>

<div class="hr" ></div>

<a name="ppscwta"></a>
<h4>Points-per-supply-center vs Winner-takes-all</h4>
<div align="center">
	<img src="images/points/wta.png" alt=" "
		title="The winner takes all the points: Winner-takes-all" />
</div>
<p class="intro">
Für erfahrenere Spieler gibt es den "Winner-take-all"-Modus (WTA), der anstelle des Standardmodus "Points-per-supply-center" (PPSC) gewählt werden
kann. In "Winner-takes-all"-Spielen bekommt der Sieger alle Punkte aus dem Pott und alle anderen Spieler gehen leer aus.<br /><br />

Zwar bleibt das Ziel des Spieles in beiden Modi das Selbe (die Ziel-VZ-Anzahl zu erreichen und zu gewinnen), aber
die unterschiedlichen Modi können zu unterschiedlichen Spielweisen führen, wenn man nicht mehr gewinnen kann. So muss man
in einem WTA-Spiel alles daran setzen, einen Spieler am Sieg zu hindern und ein Unentschieden zu erreichen, um überhaupt noch
Punkte zu bekommen. Im PPSC-Modus kann man stattdessen einfach versuchen, noch so viele VZs wie möglich zu bekommen, um so
womöglich sogar mehr Punkte zu erhalten, als wenn man alles mögliche gegen einen Sieg unternimmt.<br />

Deshalb gelten WTA-Spiele als Spiele, die mehr Diplomatie für eine gute Bewertung erforden. Alle Mitspieler müssen
überwunden werden oder alle bis auf einen müssen rechtzeitig zu einer Allianz gegen den stärksten Spieler vereinigt werden.<br />

Der WTA-Modus ist insbesondere für Spieler, die den WTA-Modus passender für das Originalspiel halten; es gibt keine Ehrung des zweiten
Platz, alle Spieler bis auf den Sieger sind gleichwertige Verlierer.<br /><br />

Allerdings sollte nicht vergessen werden, dass die Wahrscheinlichkeit in WTA-Spielen geringer ist, überhaupt Punkte zurückzuerhalten;
selbst wenn das Spiel einigermaßen gut läuft, könnte man leer ausgehen - im Gegensatz zu PPSC-Spielen!
</p>

<h4>Unentschieden</h4>
<div align="center">
	<img src="images/points/draw.png" alt=" "
		title="When all surviving players vote for a draw an equal share of the points are given to each surviving player" />
</div>
<p class="intro">
Manchmal geht es im Spiel nicht mehr weiter; zwei oder mehr Spieler haben ihre Einheiten so plaziert, dass Positionen nur noch
gehalten werden können und eine Veränderung der Grenzen nicht mehr möglich ist. In diesem Fall handelt es sich um ein Unentschieden.
Alle verbliebenen Spieler bekommen einen gleichen Anteil am Pott, unabhöngig von der Anzahl der VZs.<br /><br />

Es kann jederzeit für ein Unentschieden gestimmt werden; sobald alle noch verbliebenen Spieler für Unentschieden stimmen, endet das Spiel
und die Punkte aus dem Pott werden zu gleichen Anteilen an die überlebenden Spieler verteilt. (Bei einem Unentschieden erhält also ein Spieler
mit 15 VZs die gleichen Punkte wie ein Spieler mit nur einem VZ!)
</p>

<a name="minpoints"></a>
<h4>Punkteminimum</h4>
<p class="intro">
Neue Spieler erhalten zu Beginn 100 Punkte. Wenn sie ein Spiel verlieren und dadurch insgesamt weniger als 100 Punkte haben
(inkl. Einsatz in aktiven Spielen), bekommen sie entsprechende Punkte zurück, sodass sie wieder mit 100 Punkten starten können.
</p>

<h4>Disziplin!</h4>
<p class="intro">
Sobald Spieler Punkte gewinnen, können sie Spiele mit mehr Punkten beitreten und so an der Leiter zum Profilevel aufsteigen.
Aber gerade in Spielen mit hohem Einsatz kann man auch viele Punkte schnell wieder verlieren, also passe auf, dass Du nicht
alle Punkte auf einmal setzt!<br />
Sobald Du eine gewisse Menge an Punkten angesammelt hast, versuche dich auf maximal die Hälfte deiner Einsätze zu beschränken,
besonders gegen Profis, oder die spielst bald wieder mit den Anfängern!
</p>