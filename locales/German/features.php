<?php

defined('IN_CODE') or die('This script can not be run by itself.');

$faq = array();

$globalFaq = array(
"Varianten" => "Sub-section",
	/*"Why are here so many variants?" => 
		"With the new variant-framework of the webdip-code it's easy to make custom variants.
		The main webdiplomacy.net is very careful about adding new variants, so this is a place
		where developers can test their ideas. ",
	"Who did the variants" => 
		"You can check the variant-description of each variant using the \"Variants\"-tab.",
	"What is the best variant?" => 
		"Different variants are for different tastes. 
		You can check the variants-page for the overall rating of a variant or see what variant is played most at the moment.",*/
	"Warum können 2-Spieler-Varianten nur mit 1-D-Point-Einstätzen gespielt werden?" => 
		"Ein geringer Einsatz soll einen Missbrauch der 2-Spieler-Varianten, um schnell viele Punkte zu gewinnen, verhindern.",
	"Ich habe einen Fehler in einer Variante gefunden." => 
		"Bitte melde diesen im <a href=\"modforum.php\">Mod-Forum</a>.",
	"Ein paar Spieler haben einen Fehler ausgenutzt, nun es das Spiel verfälscht." => 
		"Ist das Spiel ledilglich eine Runde fortgeschritten, wird die letzte Runde erneut ausgewertet.
		Dabei wird der falsche Befehl auf Hold/Destroy gesetzt.
		Ist das Spiel bereits meherer Runden fortgeschritten, wird zwar der Fehler behoben, eine Korrektur des Spiels ist aber leider nicht mehr möglich.",

"Interface" => "Sub-section",
	"Pregame-Chat" => 
		"Bereits in der Pregame-Phase, in der noch Spieler dem Spiel beitreten müssen, ist bereits ein Chat-Fenster vorhanden.
		So können abweichende Regeln besprochen und die Wartezeit ein bischen verkürzt werden.",
	"Die Befehls-Pfeile können auf der Karte ausgeblendet werden" => 
		"Ist das Spiel aufgerufen, können die Befehls-Pfeile über diesen Button (<img src=\"images/historyicons/hidemoves.png\" alt=\" \">) ausgeblendet werden,
		odass eine leere Karte nur mit den Einheiten dargestellt wird.",
	"Benutzer blockieren" =>
		"Falls Du einem unangenehmen Mitspieler begegnest, besteht ab nun die Möglichkeit, diesen zu blockieren.
		Dazu muss sein Profil aufgerufen werden und der Smiley hinter seinem Namen angeklickt werden.
		Auf diese Weise kann eine Blockierung auch wieder aufgehoben werden.
		In den Einstellungen kannst du ebenfalls Blockierungen von den dort aufgelisteten blockierten Nutzern aufheben.",
	"Mod-Forum" =>
		"Anstelle einer E-Mail soll von nun an das <a href=\"modforum.php\">Mod-Forum</a> verwendet werden, um mit den Moderatoren in Kontakt zu treten.
		Das Mod-Forum kann über den \"Mod-Forum\"-Tab aufgerufen werden.
		Moderatoren erhalten eine Benachrichtigung über im Mod-Forum geäußerte Probleme und können diese so im entsprechenden Foren-Thread behandlen.
		Nur Du und die Moderatoren können dort von Dir erstellte Beiträge sehen.",
	"Country switch" =>
		"Wenn Du deine Spiele eine Zeit lang nicht selbst spielen kannst, solltest Du versuchen einen \"Sitter\” zu finden.
		Über die Einstellungen kannst Du diesem deine Spiele für einen bestimmten Zeitraum übertragen.",
	"Verbesserte Varianten-Übersicht" =>
		"Es können nun viele Informationen und Statistiken in der Varianten-Übersicht aufgerufen sowie die Quellcodes herunterfgeladen werden.",
	"Anonyme Beiträge im Forum" =>
		"Um zum Beispiel Spieler für anonyme Spiele zu suchen, ist es nun möglich, anonyme Beiträge im Forum zu erstellen.
		Dazu muss ein Link zum anonymen Spiel erstellt werden (\"gameID=XYZ\" oder ganze URL). Befindet sich dieser in der Betreffs-Zeile, sind alle Beiträge im
		entsprechenden Thema anonym. Ansonsten werden nur die Beiträge mit Link anonymisiert.
		Werden mehrere Spiele verlinkt, wird nur das erste berücksichtig.
		Moderatoren können nach wie vor sehen, wer anonyme Beiträge verfasst, um einen Missbrauch der Funktion zu verhindern.",
	"Andere Farben für Farbenblinde" =>
		"In den Einstellungen kann zwischen drei verschiedenen Typen von Farbenblindheit gewählt werden, um die Farben im Spiel entsprechend zu verbessern.",
	"Ländernamen immer im globalen Chat ausgeben" =>
		"In den Einstellungen kann eine Option zum Ausgeben der entsprechenden Ländernamen vor jeder Nachricht im globalen Chat aktiviert werden.",
	"Eingegebene Züge können durch visuelle Darstellung überprüft werden" => 
		"Ist das Spiel aufgerufen, kann über diesen Button (<img src=\"images/historyicons/Preview.png\" alt=\" \">) eine Vorschau-Karte anhand der eingegebenen Befehle generiert werden.
		Alle Deine gespeicherten Befehle werden ausgegeben. Daher müssen Änderungen erst abgespeichert werden und die Seite neu geladen werden, damit diese auf der Karte erscheinen.",
	"Interactive Map" =>
		"Neben der Vorschau der eingegeben Befehle ist es auch möglich, die Befehle direkt per Point&Click auf der Karte einzugeben. Wähle dazu in der Befehlsübersicht den \"InteractiveMap-OrderInterface-\"-Tab und gebe durch Klicken auf der Karte deine Befehle ein.
		Mehr zur Benutzung findest Du <a href=\"interactiveMap/html/help.html\">hier</a>. Nicht jede Variante wird unterstützt.",
		
"Reliability-Rating" => "Sub-section",
	"Was bedeutet die Zahl hinter meinem Namen?" =>
		"Das Reliability-Rating (\"Zuverlässigkeits-Wertung\") basiert auf eine einfachen Algorithmuss, der deine Zuverlässigkeit im Spiel bewertet.
		Mehr dazu erfährst Du <a href=\"reliability.php\">hier</a>.",
		
"Spieloptionen" => "Sub-section",
	"Länderzuweisung" =>
		"Bei der Erstellung eines neuen Spieles besteht die Möglichkeit, neben der zufälligen Verteilung der Länder diese auch selbst zu wählen.
		Dabei werden die zur Wahl stehenden Länder lediglich durch den Beitrittszeitpunkt bestimmt. Wer als letztes Beitritt können also nur noch das
		übriggebliebene Land wählen",
	"Lege alternative Zielbedingungen fest (andere Ziel-VZs, beschränkte Rundenzahl)" =>
		"Bei der Erstellung eines neuen Spieles kann ein Limit der Rundenzahl und/oder eine alternative Anzahl an Ziel-VZs festgelegt werden. 
		Berücksichtige bitte die weiteren Informationen in dem entsprechenden Abschnitt bei der Erstellung eines Spiels.
		Der Sieger ist bei einem Rundenlimit derjenige, der nach den gespielten Runden die meisten VZs besitzt.
		Haben zwei oder mehr Spieler dieselbe Anzahl an VZs bei Ende des Spiels, zählt die vorherige Runde, usw..
		Haben zwei Spieler während des gesamten Spiels die gleiche Anzahl an VZs gehabt, wird der Sieger unter ihnen zufällig ermittelt.",
	"Spezielle NMR-CD-Verlängerung" =>
		"Diese Funktion ermöglichts es, ein Land sofort in Civil Disorder (CD) zu schicken, sobald keine Befehle vom entsprechenden Spieler eingegangen sind (NMR).
		Außerdem wird die aktuelle Phase verlängert, sodass Ersatz für den inaktiven Spieler gesucht werden kann.
		Eine Verlängerung finde nach jeder Auswertung statt (Diplomatie, Rückzug, Bauphase).
		Achtung: Diese Funktion kann auch zu ständig verlängerten Spielen führen, falls bei bestimmten Einstellungen kein Ersatz gefunden wird.",
	"Unbewerte Spiele (\"Ohne Pott und Wertung\")" =>
		"Bei der Erstellung eines neuen Spieles kann in den Optionen auch \"Ohne Pott und Wertung\" anstelle eines Einsatzes gewählt werden.
		Dies ermöglicht Spiele ohne Einsatz, die auch nicht in den Statistiken auf der Profilseite eines Spielers auftauchen.<br>
		Diese Spiele werden ebenfalls nicht bei der Berechnung der V-Points berücksichtigt.",

"Neue Wahlmöglichkeiten" => "Sub-section",
	"Aufgeben" =>
		"Wenn alle bis auf einen Spieler \"Aufgeben\" gewählt haben, endet das Spiel und der Spieler, der <i>nicht</i> für \"Aufgeben\" gestimmt hat, gewinnt automatisch alle Punkte.
		Für alle anderen Spieler wird das Spiel als Niederlage (ohne VZs) gewertet.
		Der hauptsächliche Zweck dieser Funktion ist, dass in 2-Spieler-Varianten, bei denen der Sieger bereits feststeht, nicht mehr einige dann überflüssige Züge gemacht werden müssen, bis 
		auch die Ziel-VZs erreicht werden.",
	"Verlängern" =>
		"Wenn 2/3 aller aktiven Spieler \"Verlängern\" gewählt haben, wird die aktuelle Phase um 4 Tage verlängert.
		Eine Phase kann mehrmals verlängert, um das Datum der Auswertung weiter zu verschieben.",

);
foreach($globalFaq as $Q=>$A)
	$faq[$Q]=$A;

$i=1;

print libHTML::pageTitle('Features','Neue Features von vDiplomacy.com (nicht in Original-Software enthalten (webdiplomacy.net)).');

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
			<div class="faq_answer" style="margin-top:5px; display:none; margin-bottom:15px;"><ul><li>'.$a.'</li></ul></div>
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

function FAQInit() {
	ancor = self.document.location.hash.substring(1).match(/\d+/g);
	section  = ancor[0];
	question = ancor[1];
	if ( question != undefined)
	{
		$$('#faq_answer_'+section+'_'+question+' .faq_answer').map(function (e) {e.show();});
		$$('#faq_answer_'+section+'_'+question+' .faq_question').map(function (e) {e.setStyle({fontWeight:'bold'});});
	}
}

</script>
<?php libHTML::$footerScript[] = 'FAQInit();'; ?>

