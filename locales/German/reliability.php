<?php

defined('IN_CODE') or die('This script can not be run by itself.');

/**
 * @package Base
 * @subpackage Static
 */

global $User;

$unballancedCDs = $User->gamesLeft - $User->CDtakeover;
$unballancedNMR = $User->missedMoves - ($User->CDtakeover * 2);
if ( $unballancedCDs < 0 )
{
	$unballancedNMR = $User->missedMoves + ($unballancedCDs * 2);
	$unballancedCDs = 0;
}

if ($User->phasesPlayed < 100 && libReliability::integrityRating($User) > -1) {
?>
	<p class="intro">
	Neue Mitglieder dieser Seite werden mit einer kleinen Einschränkung bzgl. der maximal möglichen Spiele versehen, denen sie beitreten können.
	Du musst mindestens <strong>20 Phasen</strong> spielen, bevor du mehr als zwei Spielen beitreten kannst, <strong>50 Phasen</strong>, um mehr
	als 4 Spielen beitreten zu können, und mindestens <strong>100 Phasen</strong>, um mehr als 7 Spiele auf einmal Spielen zu können. 2-Spieler-Varianten
	sind von dieser Regelung nicht betroffen.
	</p>
	
	<p class="intro">
	Die Anzahl der gespielten Phasen sowie weitere nützliche Informationen können dem Reliability-Abschnitt <a href="profile.php?userID=<?php print $User->id; ?>">deiner Profil-Seite</a>
	entnommen werden.</p>

	<p class="intro">
	Die Einschränkungen existieren, um sicherzustellen, dass neue Mitglieder nicht mehr Spielen beitreten, als
	sie auf einmal spielen können. Diplomacy-Spiele können sehr viel Zeit in Anspruch nehemen, probiere also 
	erst einmal einige Spiele nacheinander aus, bevor du mehrere auf einmal startest.
	</p>

	<p class="intro">
	BITTE BEACHTEN: Wenn du (in der Regel) zweimal in Folge keine Befehle in einem Spiel abgibst, gibst du diese Position
	auf und dein Land wird in "Civil disorder" (CD) gesetzt. Solange dies der Fall ist, kann jeder Spieler dieser Website
	deine Position übernehmen, damit das Spiel nicht zu lange unter einem inaktiven Spieler leiden muss.
	</p>

	<p class="intro">
	Wenn du Runden verpasst oder sogar deine Länder in CD schickst, treten obige Einschränkungen ebenfalls für dich in Kraft.
	Dies geschieht unabhängig von den bisher gespielten Phasen und soll sicherstellen, dass kein Spieler mehr Spiele spielt,
	als er in der Lage ist, und dass Spieler, die nicht ihre Mitspieler respektieren, nicht mehrere Spiele ruinieren können.
	</p>
<?php
} else {
	if (libReliability::integrityRating($User) <= -1)
		print '<p class="intro">
			Deine Rechte, Spielen beizutreten oder neue zu erstellen, wurden eingeschränkt, da 
			du Probleme mit der rechtzeitigen Eingabe von Befehlen in deinen bisherigen Spielen
			zu haben scheinst.
			</p>';
?>
	<p class="intro">
	Auf dieser Website werden alle Spieler gebeten, ihre Mitspieler zu respektieren. Dazu gehört es auch,
	rechtzeitig Befehle in den Spielen einzugeben. Diplomacy ist ein Spiel über Kommunikation, Vertrauen (und Misstrauen)
	und dauert in der Regel sehr lang. Aus diesen Gründen ist es sehr wichtig, dass du deine Spiele 
	bis zum Ende und, so gut du kannst, spielst, damit diese nicht für andere Spieler ruiniert werden.
	</p>

	<p class="intro">
	Natürlich macht es nicht so viel Spaß, eine vermeintlich verlorene Position weiterzuspielen. Es zählt aber
	trotzdem zu deiner Verantwortung gegenüber den anderen Spieler weiterzuspielen. Im Übrigen gibt außerdem immer
	noch Wege, auch noch an verlorenen Spielen Spaß zu haben. Beispiel: Du kannst versuchen, dem Land, was deine 
	Niederlage besiegelt hatte, zu schaden, indem du einem anderen Land zum Sieg verhilfst, oder du kannst versuchen,
	deine Manipulationsfähigkeiten zu trainieren, indem du versuchst, eine möglichst starke Position bis zum Ende des Spiels
	zu erhalten oder sogar noch einen Draw (Unentschieden) mit größeren Mächten herauszuholen.
	</p>

	<p class="intro">
	Wenn du (in der Regel) zweimal in Folge keine Befehle in einem Spiel abgibst, gibst du diese Position
	auf und dein Land wird in "Civil disorder" (CD) gesetzt. Solange dies der Fall ist, kann jeder Spieler dieser Website
	deine Position übernehmen, damit das Spiel nicht zu lange unter einem inaktiven Spieler leiden muss.
	</p>

	<p class="intro">
	Wenn du Runden verpasst oder sogar deine Länder in CD schickst, wirst du in der Anzahl deiner aktiven Spiele eingeschränkt.
	Dies soll sicherstellen, dass kein Spieler mehr Spiele spielt,
	als er in der Lage ist, und dass Spieler, die nicht ihre Mitspieler respektieren, nicht mehrere Spiele ruinieren können.
	</p>

	<?php
	if (libReliability::integrityRating($User) <= -1)
	{
			print '<p class="intro">Um zu berechnen, wie vielen Spielen du beitreten kannst, werden deine CD-Übernehmen gezählt und von diesen
				die verpassten Züge * 0.2 und die CDs * 0,6 abgezogen.</p>
			
			<p class="intro">Mit deinen aktuellen Daten ergibt sich also:
			<ul><li>CD-Übernahmen = '.$User->CDtakeover.'</li>
			<li>NMRs = '.$User->missedMoves.'</li>
			<li>CDs = '.$User->gamesLeft.'</li></ul></p>
			<p class="intro">
			Deine finale Bewertung ist: <b>'.$User->CDtakeover.'</b> - (<b>'.$User->missedMoves.'</b> * 0.2 + <b>'.$User->gamesLeft.'</b> * 0.6) = <b>'.($User->CDtakeover - ( $User->missedMoves * 0.2 + $User->gamesLeft * 0.6)).
			'</b><br>
			<p class="intro">Basierend auf diesem Wert treten folgende Einschränkungen in Kraft:
			<ul><li>größer als -1 => keine Einschränkungen</li>
			<li>zwischen -1 und -2 => max 6 Spiele</li>
			<li>zwischen -2 und -3 => max 5 Spiele</li>
			<li>zwischen -3 und -4 => max 3 Spiele</li>
			<li>und kleiner als -4 => max 1 Spiel </li>
			</ul></p>
			
			<p class="intro">Um deinen Wert zu verbessern, kannst du 
			<a href="gamelistings.php?page-games=1&gamelistType=Joinable">offene Plätze in laufenden Spielen</a>
			übernehmen oder mit deinen aufgebenen Position weiterspielen, solange diese nicht von einem Mitspieler
			übernommen wurden. Jede übernommen Position erhöht deinen Bewertung um <b>1</b>.</p>';
			
	}
}
?>
