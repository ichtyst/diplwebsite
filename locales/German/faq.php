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


$faq = array();

if( isset(Config::$faq) && is_array(Config::$faq) && count(Config::$faq) )
{
	$faq["Server-specific"]="Sub-section";
	foreach(Config::$faq as $Q=>$A)
		$faq[$Q]=$A;
}

$globalFaq = array(
"Ich bin neu hier" => "Sub-section",
"Worum geht es bei Diplomacy eigentlich?" => "Diplomacy ist ein Brettspiel von Allan B. Calhamer, welches den ersten Weltkrieg in Europa simuliert.
	Wichtiger als strategisches Geschick sind bei diesem Spiel vor allem das F&uuml;hren diplomatischer Verhandlungen und das geschickte Aushandeln von B&uuml;ndnissen zwischen den verschiedenen Spielern. Da es nur einen Sieger bei diesem Spiel gibt, ist man fr&uuml;her oder sp&auml;ter gezwungen, die B&uuml;ndnisse wieder zu brechen.
	Diplomacy's Website bietet die M&ouml;glichkeit, dieses Kultspiel vollkommen kostenlos, online mit seinen Freunden oder neuen Mitspielern zu spielern.",
"Wie spielt man Diplomacy?" => "Das Spielprinzip ist eigentlich selbsterkl&oauml;rend, jedenfalls nach einem Blick auf die kurze
	<a href='intro.php' class='light'>Einleitung</a>. Grunds&auml;tzlich kann es aber nicht schaden, sich auch einmal die offiziellen
	<a href='http://diplomacy.s-website.de/redirect.php?g=1' target='_blank'>Diplomacy-Regeln</a> durchzulesen.
	Und nicht zuletzt steht auch unser kleines <a href='forum.php' class='light'>Forum</a>dazu bereit, auch deine letzten Fragen noch geduldig zu beantworten!.",
"Wie gebe ich meine Z&uuml;ge ein?" => "Die Zugeingabe, das Erteilen der Befehle, ist sehr einfach und im Grunde selbsterkl&auml;rend. Wenn dein Spiel gestartet wurde, erh&auml;ltst du im Fenster deines Spiels ein Drop-down-Men&uuml; f&uuml;r jede deiner Einheiten. Hier w&auml;hlst du den entsprechenden Befehl, z.B &quot;move&quot; aus und danach das Zielterritorium, in die die Einheit diesen Befehl aus&uuml;ben soll. Genauso verf&auuml;hrt so mit Hold, Support oder Convoy- Befehlen. Danach kannst Du Deine Befehle speichern oder erteilen.<br />Die erteilten Befehle kann man solange widerrufen und &auml;ndern, bis alle Mitspieler ihre Befehle erteilt haben oder die aktuelle Spielphase abgelaufen ist; also bis das Spiel ausgewertet wird.",
"Muss ich meine Z&uuml;ge an einen Spielleiter schicken?" => "Nein. Die Befehlseinfabe erfolgt wie oben beschrieben und die Auswertung erfolgt automatisch. Verschiedenfarbige Pfeile in der Karte geben an, was welche Einheit durchf&uuml;hren wollte, und ob sie erfolgreich war. Au&szlig;erdem wird die Zughistory (Befehlsaufzeichnung) um den laufenden Zug erweitert. Diese und die Entwicklung des Spiels auf der Karte je Zug kannst du dir auch in allen <a href=\"/gamelisting.php\" targe=\"_self\">laufenden oder abgeschlossenen Spielen</a> ansehen.",
"Wie k&ouml;nnen Spieler miteinander kommunizieren?" => "Je nach Einstellung des Spiels finden sich im Spiel verschiedene Chatfenster, &uuml;ber die die Spieler miteinander chatten k&ouml;nnen. Sind alle Nachrichten erlaubt kann man private Nachrichten an jeden Mitspieler und globale Nachrichten an alle Spieler des aufgerufenen Spiels senden. Diese M&ouml;glichkeiten kann man getrennt von einander f&uuml;r jedes Spiel abschalten. <br /> Dar&uuml;ber hinaus k&ouml;nnen alle Spieler nat&uuml;rlich auch andere Kommunikationswege wie Email oder Telefon nutzen. Allerdings sollte der Fainess-halber allen Mitspielern Bescheid gegeben werden, wenn sich zwei oder mehr Spieler auch RL kennen, bzw. &quot;verk&uuml;rzte&quot; Kommunikationswege zur Vefr&uuml;gung haben.",
"Muss ich eine bestimmte Software zum Spielen downloaden?" => "Nein. Du brauchst lediglich Deinen Browser. Das Spiel, deine Zugabgabe, die Kommunikation usw. l&auml;uft direkt &uuml;ber Diplomacy's Website.",
#"What's the software license?" => "The <a href='AGPL.txt' class='light'>GNU Affero General License</a>
#	(<a href='http://www.opensource.org/licenses/agpl-v3.html' class='light'>Open Source Initiative</a> approved),
#	which basically says you can download and change the code as you like, and put it up on your
#	own website, but you can't claim you wrote it, and you have to give any changes
#	you make back to the community.<br /><br />
#	See <a href='credits.php' class='light'>the credits</a> for information about the
#	small elements which are under different licenses.",

#"Is this software related to phpDiplomacy?" => "This software used to be called phpDiplomacy until version 0.9.
#	Sorry for the confusion, we hate name changes too, but for our user-base the old 'php' prefix wasn't
#	the immidiately recognizable label that was intended.",


"Die Spiel-Ansicht" => "Sub-section",
"Was bedeutet der gr&uuml;ne Kreis neben den Namen mancher Leute?" => "Der gr&uuml;ne Kreis erscheint, wenn sich der Spieler auf der Dipomacy's Website angemeldet hat.
	Spieler mit einem gr&uuml;nen Kreis am Benutzernamen sind oder waren in den letztn zehn bis 15 Minuten am Server angemeldet.",
"Was bedeuten diese Symbole? (<img src='images/icons/online.png' />, <img src='images/icons/mail.png' />, etc)" => "Wenn du ein Symbol/Bild/Button siehst, und sich dir dessen Bedeutung nicht direkt erschlie&szlig;t, fahre mit Maus dar&uuml;ber und dir wird neben dem Mauszeiger eine kleine Erkl&auml;rung angezeigt. Falls das nicht passiert, frage gerne im <a href='forum.php' class='light'>Forum</a> nach oder kontaktiere die Administratoren.",
"Warum wechseln meine Befehle die Farbe?" => "Rote Befehle sind nicht gespeichert. Wenn viele deiner Befehle rot angezeigt werden, solltest du auf &quot;speichern&quot; klicken, oder die bereits eingegebenen Befehle gehen verloren wenn du das Browserfenster schlie&szlig;t oder einem Mitspieler eine Nachricht schreibst. Gr&uuml;ne Befehle sind gespeichert und flie&szlig;en nach Ablauf der Spielphase in die Auswertung mit ein.",
"Was bedeuten &quot;speichern&quot; und &quot;erteilen&quot;" => "&quot;Speichern&quot; speichert deine Befehle. Deine roten, ungespeicherten Befehle werden gr&uuml;n, wenn du sie speicherst. &quot;Erteilen&quot; bedeutet, dass du alle deine Befehle vollst&auml;ndig eingegeben hast und bereit f&uuml;r die Auswertung, bzw. n&auml;chste Spielphase bist.  &quot;Erteilen&quot; alle Spieler ihre Befehle, wird die Spielphase direkt ausgewertet.",
"Wie kann man in Foren-Beitr&auml;gen oder Nachrichten Verweise einf&uuml;gen?" => "Um Verweise auf Spiele, Benutzer oder Foren-&quot;Threads&quot; in Nachrichten und Foren-Beitr&auml;gen einzubinden kann man folgenden Code benutzen, der automatisch in einen klickbaren Verweis (Link) abge&auml;ndert wird:
	<strong>'gameID=<em>[number]</em>'</strong> / <strong>'threadID=<em>[number]</em>'</strong> / <strong>'userID=<em>[number]</em>'</strong> erzeugt einen Link zu dem entsprechenden Spiel, Foren-Eintrag oder Nutzer-Profil. Bei <ul><li><strong>'<em>[number]</em> points'</strong>/<strong>'<em>[number]</em> D'</strong> wird au&szlig;erdem <strong>'points'</strong> / <strong>'D'</strong> durch den Punkte-Icon ersetzt (".libHTML::points().").</li>",
"Warum erscheinen manche Dinge auf der Seite erst nachdem sie bereits fertig geladen ist?" => "Nach dem laden der Seite wird JavaScript ausge&uuml;hrt, der einige Dinge in der Spiel-Anzeige ver&auml;ndert. So werden beispielsweise alle Zeite in GMT/UTC auf dem Server gespeichert und f&uuml;r jeden Spieler per JavaScript in die entsprechende Zeitzone umgerechnet.",


"Spielregeln" => "Sub-section",
"Ich m&ouml;chte die grundlegenden Regeln lernen" => "Sieh dir dazu unsere kurze <a href='intro.php' class='light'>Einf&uuml;hrung</a> in Diplomacy an.",
"Ich m&ouml;chte tiefer in die Diplomacy-Regeln eintauchen" => "Schau dir dazu am Besten die offiziellen Spielregen. Hier sind sie als <a href='/redirect.php?g=1' target='_blank'>pdf-Dokument</a> hinterlegt.",
"Welche genauen Regeln liegen der Auswertung der Befehle auf Dipomacy's Website zugrunde?" => "webDiplomacy, die Software die hier &quot;unter der Haube&quot; l&auml;uft&quot; nutzt die &quot;Diplomacy Adjudicator Test Cases&quot;, kurz DATC, um die Befehle auszuwerten und gegeneinander abzuw&auml;gen. Damit besteht auch f&uuml;r die sehr seltenen F&auml;lle eine nachvollziebare Auswertungs-Grundlage, wo das Regelwerk mehrdeutig ausgelegt werden k&ouml;nnte. N&auml;here Information zu den DATC finden sich <a href='/redirect.php?g=2' target='_blank' class='light'>hier</a>.",
"Wenn jemand eine Einheit zerst&ouml;ren muss, aber keine Befehle eingibt, welche Einheit wird dann zerst&ouml;rt?" => "Hier wird verfahren, wie in den DATC vorgeschrieben: Die Einheit, die am weitesten von den heimischen Versorgungslagern entfernt ist, wird zerst&ouml;rt. Die zugrunde liegende Entfernung ist die geringst-m&ouml;gliche Anzahl von Z&uuml;gen, die ben&ouml;tigt wird, um von den Position der Einheit zum n&auml;chsten, heimischen Versorgungslager zu gelangen. Bei der Berechnung wird davon ausgegangen, dass Armeen sich auch &uuml;ber Wasser bewegen, Flotten allerdings nur &uuml;ber Wasser und K&uuml;sten bewegen k&ouml;nnen. Sind zwei Einheiten gleichweit von einem heimischen Versorgungszentrum enfernt, wird in alphabetischer Reihenfolge der Territorien-Namen, in denen die Einheiten stehen entschieden.",
"Wird ein Konvoi unterbrochen, wenn er angegriffen wird?" => "Nein; um einen Konvoi zu unterbrechen (dabei schl&auml;gt er vollst&auml;ndig fehl) muss mindestens eine Flotte von ihrer Position vertrieben werden und es darf kein anderer Konvoi-Weg an dessen Stelle treten k&ouml,nnen.",
"Was passiert, wenn ich zwei Einheiten Befehle zum bauen/zerst&ouml;ren innerhalb des selben Territoriums erteile?" => "Der erste Befehl wird akzeptiert, der zweite nicht.",
"Was passiert, wenn sich zwei Einheiten Befehle zum R&uuml;ckzug in das selbe Territorium erhalten?" => "Sie werden beide zerst&ouml;rt",
"Kann ich meine eigenen Einheiten vertreiben?" => "Nein; man kann seine eigenen Einheiten nicht vertreiben, oder das Vertreiben der eigenen Einheit durch einen Mitspieler &quot;supporten&quot;.",
"Beim Diplomacy-Brettspiel wird zum &quot;Abh&ouml;hren&quot; ermutigt; hier auch?" => "Hier, auf Diplomacy's Website befinden sich die Spieler nicht im selben Raum. Die technischen Voraussetzungen sind hier im Netz also v&ouml;llig andere. Es ist gesetzlich verboten, Handlungen zu unternehmen, um sich unerlaubten Zugang zu jeglicher Form von Web-Accounts zu verschaffen. Der Versuch, die Nachrichten anderer Spieler auf Diplomacy's Website mitzulesen, w&auml;re also ein Straftat bestand und w&uuml;rde zur Anzeige gebracht werden. Passw&ouml;rter auszusp&auml;hen oder Sicherheitsl&ouml;cher zu finden kann nicht mit dem Versuch, diplomatische Verhandlungen abh&ouml;ren zu wollen, entschuldigt werden.",


"Punkte" => "Sub-section",
"Was passiert, wenn ich keine Punkte mehr habe?" => "das kann nicht passieren: die Gesamtzahl deiner Punkte setzt aus der denen zusammen, die du als Einsatz in deinen Spiele hast und denen, die du in deinem Account hast.
	Diese Gesamtzahl kann niemals unter 100 fallen. Tut sie das, 
	bekommst du die Eins&auml;tze aus deinen Spielen zur&uuml;ck.<br /><br />
	Oder anders ausgedr&uuml;ckt: ein Spieler, der an keinen Spielen teilnimmt hat <u>immer</u> mindestens 100 Punkte.
	Du kannst also nicht alle deine Punkte verzocken!",
"Wie werden die Punkte bei einem Unentschieden aufgeteilt?" => "Bei einem Unentschieden werden die Punkte unter allen bis zu diesem Punkt &uuml;berlebenden Spilern aufgeteilt.
	Das passiert unabh&auml;ngug von der Anzahl an Versorgungszentren, die die einzelnen Spieler haben.<br/>
	Lie&szlig; <a href='points.php' class='light'>den Punkte-Plan</a> um mehr &uuml;ber die Punkte hier herauszufinden.",
"Ich habe eine gute Idee, wie man das Punkte-System verbessern k&ouml;nnte" => "Es werden immer wieder einige gute Ideen zum Thema Punkte diskutiert.
	Aber genau wie das Punkte-System, das momentan hier zum Einsatz kommt haben auch alle neuen Ideen ihre Vor- und Nachteile.<br /><br />
	Nat&uuml;rlich zeigt auch unser System nicht wirklich an, wie gut ein Spieler tats&auml;chlich ist. Aber das wird auch kein anderes Punkte-System perfekt schaffen.
	Deswegen werden wir weiterhin so weitermachen, wie bisher und das Punktesystem nicht umstellen.<br /><br />
	Eine Diskussion, die feststellen sollte, welche neue Punkte-Vergabe zu benutzen w&auml;re w&uuml;rde sowieso nie einen absoluten Konsens zwischen allen Usern auf dieser Seite finden.",
"Kann man ein Spiel f&uuml;r unentschieden erkl&auml;ren und die Punkte geziehlt / nach eigenen Vorgaben aussch&uuml;tten?" => "Ein Unentschieden f&uuml;hrt immer zu einer Aufteilung zwischen allen &uuml;berlebenden Spielern.
	Eine andere Aufteilung der Punkte ist nicht m&ouml;glich - egal wie unterschiedlich &quote;gut&quote; die einzelnen Spieler waren.",

"Fehler" => "Sub-section",
"Mein Spiel ist &quot;crashed&quot;!" => "Es kann passieren, dass ein Software- oder Serverfehler auftritt, w&auml;hrend ein Spiel ausgewertet wird. Falls das passieren sollte, werden alle &Auml;nderungen/Eingaben r&uuml;ckg&auml;nging gemacht und das Spiel als gecrasht markiert. <br />Die Administration wird automatisch &uuml;ber gecrashte Spiele informiert und versucht, das Problem zu heben. Danach wird kann das Spiel von einem Administrator wieder frei gegeben werden und l&auml;uft weiter. Sollte sich kein Admin umgehend um das gecrashte Spiel k&uuml;mmern, schreibe am Besten ins <a href=\"modforum.php\">Mod-Forum</a>!",
/*"The phase ends 'Now'?" => "Non-live (>15 minutes per phase) games are processed every 5 minutes; if a game's time run out it'll say the phase ends 'Now' until
	the game proccessor runs. If the server is especially busy the game may be put-off for a short while, but it should
	move onto the next phase within 0-5 minutes.<br />
	Live games should continue immidiately.",*/
"Diese Befehle habe ich nie eingeben!" => "Immer mal wieder h&ouml;rt man diesen Vorwurf. Wir haben das oft &uuml;berpr&uuml;ft, aber bisher stellte es sich immer heraus, dass der Fehler vor dem Bildschirm lag. Vergewissere dich vor dem Befehle-Erteilen immer zweimal, ob das, was im Formular steht auch wirklich das ist, was du befehlen m&ouml;chtest. Manchmal verwechselt man Territorien wie Budapest und Bulgarien... Sowas ist jedem schon mal irgendwann passiert.",
"Meine Befehle wurde falsch ausgewertet." => "Bevor du uns wegen eines Software-Fehlers anschreibst &uuml;berpr&uuml;fe erst, ob du deine Befehle korrekt erteilt hast (benutze auch die Befehls-Historie, erreichbar in jedem Spiel ganz unten). Und dann lie&szlig; dir die Regeln (s.o.) noch einmal durch um dich zu vergewissern, dass der Fehler nicht vielleicht doch bei dir lag. Zu 99% liegt einfach ein Missverst&auml;ndnis vor.",
"Einige Teile des Spiels sehen in einem alternativen Browser merkw&uuml;rdig aus" => "Diplomacy's Website orientiert sich an g&auml;ngigen Web-Standards. Aber nat&uuml;rlich kann es mal vorkommen, dass ein Browser etwas aus der Reihe tanzt. Sollte dir eine unsch&ouml;ne Unstimmigkeit auffallen, unterrichte die Admins davon und f&uuml;ge am besten einen Screenshot mit an.",

"Allgemein" => "Sub-section",
"Ist Diplomacy's Website wirklich kostenlos?" => "<b>Ja</b>. Diplomacy's Website ist gestartet, als Plattform, um mit ein paar Freunden Diplomacy spielen zu k&ouml;nnen, ohne an Terminfindungsschwierigkeiten zu scheitern. Dass dieser &quot;Service&quot; auch von Fremden entdeckt und gerne genutzt wurde hat die Plattform nat&uuml;rlich f&uuml;r alle interessanter gemacht: mehr Spieler -> mehr Abwechslung -> mehr Spiele.<br /><br /><b>Nein</b>, denn nat&uuml;rlich kosten Server und Bandbreite etwas. Es wird dennoch in keiner Weise irgendeine Geb&uuml;hr erhoben. Wir hoffen, dass die entstehenden Kosten durch Spenden und Werbeklicks wieder reinkommen. Unten mehr dazu.",
"Wie kann man Diplomacy's Website unterst&uuml;tzen" => "Unterst&uuml;tzen kann man dieses Projekt auf verschiedene Weise. An erster und wichtigster Stelle steht die Devise: Spiele fair! Wenn alle Spieler untereinander gut auskommen, ist das der gr&ouml;&szlig;te Gewinn, den du beitragen kannst!<br />Und dann:&quot;Spread the Word!&quot; Je mehr Menschen von Diplomacy's Website erfahren und hier anfangen zu spielen, desto gr&ouml;&szlig;er die Abwechslung und das Angebot an Spielen. Sag deinen Freunden, Bekannten und Verwandten bescheid, dass man hier kostenlos Diplomacy spielen kann!!!",
"Wie kann ich Diplomacy's Website finanziell unterst&uuml;tzen?" => "Die einfachste Art, Diplomacy's Website finanziell zu unterst&uuml;tzen ist, f&uuml;r alle deine Amazon-Eink&auml;ufe diesen Referal-Link zu verwenden: <a href=\"http://amzn.to/wXEIWG\" title=\"Amazon Referal-Link\">http://amzn.to/wXEIWG</a>. Dadurch bekommen wir einen kleinen Prozentbetrag des Einkaufwertes von Amazon als Werbekosten-R&uuml;ckerstattung ausgezahlt.<br /><br />
	Unten auf Diplomacy's Website findet du ein paar Links (vorausgesetzt, du verwendest keinen Werbeblocker!). Vielleicht findest du dort ab und zu etwas interessantes zum anklicken. Wenn du dort regelm&auml;&szlig;ig einem Link folgst, werden die Kosten, die auf dem Server durch deine Spiele entstehen, von Werbetreibenden &uuml;bernommen.<br /><br />
	Wenn du etwas Geld &uuml;brig hast und es an Diplomacy's Website spenden m&ouml;chtest, kannst du das gerne &uuml;ber Paypal machen:
	<div style='text-align:center'><form action='https://www.paypal.com/cgi-bin/webscr' method='post'><input type='hidden' name='cmd' value='_s-xclick'><input type='hidden' name='hosted_button_id' value='4HPLWGNY47LDJ'><input type='image' src='https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donateCC_LG.gif' border='0' name='submit' alt='Jetzt einfach, schnell und sicher online bezahlen â€“ mit PayPal.'><img alt='' border='0' src='https://www.paypalobjects.com/de_DE/i/scr/pixel.gif' width='1' height='1'></form></div>",
"Wie kann ich meinen Account auf Diplomacy's Website l&ouml;schen?" => "Du kannst deinen Account auf Diplomacy's Website stilllegen und die mit dem Account verbundenen Daten l&ouml;schen. Das Stilllegen ist unwiderruflich! Mehr Informationen und die M&ouml;glichkeit zum Stilllegen findest du <a href=\"http://diplomacy.s-website.de/delaccount.php\">hier</a>",
/*

"Feature Requests" => "Sub-section",
"Better forum" => "A better forum would be good, but getting it to fit in and appear as part of webDiplomacy, rather than just
	a separate site, is difficult.",
"A point and click interactive map" => "This is being worked on, but progress is slow. If you know JavaScript and SVG/Canvas why not
	carry on the work on the <a href='http://forum.webdiplomacy.net/' class='light'>development forum</a>?",
"Translations" => "Eventually translations will be supported, but it is a long process and not a top priority.",
"Can I suggest a feature?" => "Feature suggestions are best made in the <a class='light' href='http://forum.webdiplomacy.net/'>developer forums</a>,
	elsewhere they're likely to be missed. Remember that unless you can back-up your suggestion with code even good ideas may not get far.",

"Helping out" => "Sub-section",
"Can I help develop the software?" => "You sure can: if you're an HTML/CSS/JavaScript/PHP 5/MySQL/SVG/Canvas developer,
	graphics/icon artist, or want to learn, check out the <a class='light' href='http://webdiplomacy.net/developers.php'>dev info</a>,
	and if you get lost you can get help/discuss ideas in the <a class='light' href='http://forum.webdiplomacy.net/'>developer forums</a>.",
"Can I donate?" => "If you enjoy the site and want to help out, but can't code, you can donate to the project via
PayPal, and this is student-ware so all donations are appreciated. :-)</p>
<div style='text-align:center'>
<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
<input type='hidden' name='cmd' value='_s-xclick'>
<input type='image' src='https://www.paypal.com/en_US/i/btn/x-click-but21.gif' border='0' name='submit' alt='Make payments with PayPal - it's fast, free and secure!'>
<img alt='' border='0' src='https://www.paypal.com/en_AU/i/scr/pixel.gif' width='1' height='1'>
<input type='hidden' name='encrypted' value='-----BEGIN PKCS7-----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-----END PKCS7-----
'>
</form></div><p class=\"answer\">A big thanks to all the past donors who helped make all '07-'08 server fees community paid!",
"How else can I help?" => "Tell your friends about webDiplomacy, put links on your website, help new players out in the forums,
	and give helpful feedback to developers. Thanks!",
"What's the Plura icon at the bottom?" => "To pay for this hosting (which is already pretty cheap for what it is
	thanks to Dreamhost) we use Plura Processing; instead of ads thrust in your face Plura is a Java applet which silently
	does number-crunching for Plura without bothering you, and they pay a fraction of a cent per unit of computer work the
	applet does.<br />
	This all adds up and lets webdiplomacy.net be self-sufficient without having to scroll past ads every time you view a page.<br /><br />

	Ideally it should use 70% of a computer's idle-time (so it shouldn't affect your browsing experience), and isn't detectable or
	intrusive at all, but in reality people with slower computers may notice a slow-down. Because of this people can opt themselves
	out of helping the site with Plura, because there's no point if it makes the site unusable.<br />
	You can opt-out via the link below, but remember that when your computer is running the (mostly unnoticeable) applet it's helping
	to keep this place online. Thanks :-)<br />
	<a href='usercp.php?optout=on' class='light'>Opt-out</a> (And you can <a href='usercp.php?optout=off' class='light'>
	opt back in</a> if you change your mind.)",
"I don't see any Plura icon at the bottom, but it sounds like a good idea" => "You probably either don't have
	<a href='http://java.com/' class='light'>Java installed</a>, or you're using a browser with an ad-blocker
	that uses a public filter list (anything with 'affiliate' in the URL is blocked by some lists).",


"Map" => "Sub-section",
"Why are some orders missing from the map?" => "Not all orders are drawn on the small map. Below the small map there is a set of icons;
	the one in the middle (<img src='images/historyicons/external.png' alt='example' />) opens up the large map, which contains all orders.<br/>
	Also at the bottom of the board page is a link to open up a textual list of all the orders entered in the game, if you can't see
	something in the large map.",
"I can't tell the difference between Germany and Austria" => "Color-blind people may have trouble distinguishing Germany and Austria's
	colors. We hope to fix this problem in the future.",

"Multi-accounters" => "Sub-section",
"What is a multi-accounter" => "Someone who has more than one account (this is banned).",
"Is that like a meta-gamer?" => "A meta-gamer is someone in more than one game who lets one of his games influence how he plays in
	another one. The classic example is threatening a stronger player in a weak game with a country in a different game where the tables
	are turned.<br/>
	Meta-gaming is usually frowned on, but is acceptable in some cases and not seen as being as bad as multi-accounting.",
"What action is taken against multi-accounters" => "Data is logged which makes it possible to spot multi-accounters. Eventually they're
	spotted and banned, and their points are removed. Because of this the players with the most points are the least likely to be
	multi-accounters, but in reality multi-accounter problems are very rare (accusations of multi-accounting are far more common).",
"I think someone is a multi-accounter" => "Double-check and try and get lots of good reasons for your suspicion, then talk to the
	'multi-accounter'. If you're still sure then e-mail your evidence to <a href='mailto:webdipmod@gmail.com' class='light'>webdipmod@gmail.com</a>.<br /><br />
	Lots more people are accused of being multi-accounters than actually are multi-accounters. It's actually very rare, so please make
	sure you have good reasons for accusing someone of multi-accounting before you do.", // TODO: webdipmod@gmail.com can't be officially released
"I play on the same computer as someone else, I dont want to get banned" => "The data used to tell whether someone is a multi-accounter
	is a lot more thorough than just IPs. More evidence than just having the same IP is needed for a ban.<br/>
	However if you know the other player well you may want to avoid playing in games with them, or you'll have an unfair advantage. You
	should at least let the other players in the game know that you know the other player in real life.",
"Can I pretend to be a multi as a diplomacy tactic?"=>"Nope; this is just about the only extra restriction we add to in-game
	messages, because multi-account accusations take lots of moderator time to look up and check. With so many more accusations
	than multi-accounters the number of false accusations should be limited."
*/);

$i=1;


foreach($globalFaq as $Q=>$A)
	$faq[$Q]=$A;

$i=1;

print libHTML::pageTitle('Frequently Asked Questions','Hier haben wir Antworten zu h&auml;ufig gestellten Fragen zusammengestellt. Klicke auf eine Frage, um ihre Antwort angezeigt zu bekommen.');


$sections = array();
$section=0;
foreach( $faq as $q => $a )
	if ( $a == "Sub-section" )
		$sections[] = '<a href="#faq_'.$section++.'" class="light">'.$q.'</a>';
print '<div style="text-align:center; font-weight:bold"><strong>Sections:</strong> '.implode(' - ', $sections).'</div>
	<div class="hr"></div>';

$section=0;
foreach( $faq as $q => $a )
{
	if ( $a == "Sub-section" )
	{
		if( $section ) print '</ul></div>';

		print '<div><p><a name="faq_'.$section.'"></a><strong>'.$q.'</strong></p><ul>';

		$question=1;
		$section++;
	}
	else
	{
		print '<li><div id="faq_answer_'.$section.'_'.$question.'">
			<a class="faq_question" name="faq_'.$section.'_'.$question.'"
			onclick="FAQShow('.$section.', '.$question.'); return false;" href="#">'.$q.'</a>
			<div class="faq_answer" style="margin-top:5px; margin-bottom:15px;"><ul><li>'.$a.'</li></ul></div>
			</div></li>';
		$question++;
	}
}
print '</ul></div>
</div>';

?>
<script type="text/javascript">
function FAQHide() {
	$$('.faq_question').map( function (e) {e.setStyle({fontWeight:'normal'});} );
	$$('.faq_answer').map( function (e) {e.hide();} );
}
function FAQShow(section, question) {
	FAQHide();
	$$('#faq_answer_'+section+'_'+question+' .faq_answer').map(function (e) {e.show();});
	$$('#faq_answer_'+section+'_'+question+' .faq_question').map(function (e) {e.setStyle({fontWeight:'bold'});});
}
</script>
<?php libHTML::$footerScript[] = 'FAQHide();'; ?>
