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

print libHTML::pageTitle('Diplomacy\'s Website Hilfe','Links zu Seiten mit mehr Informationen über Diplomacy\'s Website.');
?>
<ul class="formlist">

<li><a href="intro.php">Kurzanleitung "Diplomacy"</a></li>
<li class="formlistdesc">Eine kurze Einleitung um Diplomacy's Website mit zu spielen.
Erfahre die rudimentären Regeln über Truppen-Typen und Zugmöglichkeiten bei Diplomacy..</li>

<li><a href="faq.php">FAQ</a></li>
<li class="formlistdesc">Die FAQ auf Diplomacy's Website.</li>

<li><a href="features.php">Features von vDiplomacy</a></li>
<li class="formlistdesc">Neue Features von vDiplomacy.com (nicht in Original-Software enthalten (webdiplomacy.net)).</li>

<li><a href="rules.php">Regelwerk</a></li>
<li class="formlistdesc">Die verbindlichen Regeln für alle Spieler auf Diplomacy's Website.</li>

<li><a href="hof.php">Hall of fame (V-Points)</a></li>
<li class="formlistdesc">Die hundert erfolgreichsten Spieler auf Diplomacy's Website. Bewertet mit V-Points (Elo-ähnlicher Algorithmus).</li>

<li><a href="halloffame.php">Hall of fame (D-Points)</a></li>
<li class="formlistdesc">Die hundert erfolgreichsten Spieler auf Diplomacy's Website. Bewertet mit D-Points (klassische Punktewertung basierend auf Einsätzen und Spieltyp (WTA, PPSC))</li>

<li><a href="points.php">Diplomacy Punkte</a></li>
<li class="formlistdesc">Das Punkte-System auf Diplomacy's Website. (D-Points)</li>

<li><a href="profile.php">Finde einen Benutzer</a></li>
<li class="formlistdesc">Suche einen Benutzer auf diesem Server anhand der ID, des Benutzernamens oder der Email-Adresse.</li>

<li><a href="variants.php">Varianten-Information</a></li>
<li class="formlistdesc">Eine Liste von Varianten, die auf diesem Server spielbar sind, mit weiteren Informationen und speziellen Regeln.</li>
<?php /*
<li><a href="credits.php">Credits</a></li>
<li class="formlistdesc">The credits.</li> 

<li><a href="datc.php">DATC Adjudicator Tests</a></li>
<li class="formlistdesc">For experts; the adjudicator tests which show that webDiplomacy is true to the proper rules</li>*/ ?>

<li><a href="tos.php">Nutzungsbedingungen</a></li>
<li class="formlistdesc">Die Bedingungen, zu denen der Service auf 
	Diplomacy's Website genutzt werden darf.</li>
<?php /*
<li><a href="http://webdiplomacy.net/developers.php">Developer info</a></li>
<li class="formlistdesc">If you want to fix/improve/install webDiplomacy all the info you need to make it happen is here.</li> */ ?>

<li><a href="AGPL.txt">GNU Affero General License</a></li>
<li class="formlistdesc">The OSI approved license which applies to the vast majority of webDiplomacy.</li>
</ul>

<p>Du konntest nicht die Hilfe finden, nach der du suchst? Dann nutze <a href="forum.php" class="light">das Forum</a>, oder wende dich bei sehr speziellen Fragen an einen Administrator:
info@diplomacy.s-website.de</p>
