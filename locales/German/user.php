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
	<li class="formlisttitle">Email-Adresse</li>
	<li class="formlistfield"><input type="text" name="userForm[email]" size="50" value="<?php
		if ( isset($_REQUEST['userForm']['email'] ) )
		{
			print $_REQUEST['userForm']['email'];
		}
		elseif( isset($User->email) )
		{
			print $User->email;
		}
		?>" <?php if ( isset($_REQUEST['emailToken']) ) print 'readonly '; ?> /></li>
	<li class="formlistdesc">Deine Email-Adresse, sie wird <strong>nicht</strong> zugemüllt oder an dritte weitergegeben.</li>

	<li class="formlisttitle">Email-Adresse verbergen:</li>
	<li class="formlistfield">
		<input type="radio" name="userForm[hideEmail]" value="Yes" <?php if($User->hideEmail=='Yes') print "checked"; ?>>Ja
		<input type="radio" name="userForm[hideEmail]" value="No" <?php if($User->hideEmail=='No') print "checked"; ?>>Nein
	</li>
	<li class="formlistdesc">
		Darf deine eMail-Adresse anderen Benutzern angezeigt werden? 
		Wenn du hier ja auswählst, wird deine eMail-Adresse als Grafik in deinem Profil angezeigt,
		um zu verhindern, dass SpamBots
		sie einsammeln können.
	</li>

	<li class="formlisttitle">Passwort:</li>
	<li class="formlistfield">
		<input type="password" name="userForm[password]" maxlength=30>
	</li>
	<li class="formlistdesc">
		Dein Diplomacy Passwort.
	</li>

	<li class="formlisttitle">Passwor wiederholen:</li>
	<li class="formlistfield">
		<input type="password" name="userForm[passwordcheck]" maxlength=30>
	</li>
	<li class="formlistdesc">
		Gib dein Passwort noch einmal ein, um Tippfehler auszuschließen.
	</li>

	<input type="hidden" name="locale" value="English" />

	<li class="formlisttitle">Homepage:</li>
	<li class="formlistfield">
		<input type="text" size=50 name="userForm[homepage]" value="<?php print $User->homepage; ?>" maxlength=150>
	</li>
	<li class="formlistdesc">
		<?php if ( !$User->type['User'] ) print '<strong>(Optional)</strong>: '; ?>
		Dein Blog, deine persönlische Website o.ä.
	</li>

	<li class="formlisttitle">Kommentar:</li>
	<li class="formlistfield">
		<TEXTAREA NAME="userForm[comment]" ROWS="3" COLS="50"><?php
			print str_replace('<br />', "\n", $User->comment);
		?></textarea>
	</li>
	<li class="formlistdesc">
		<?php if ( !$User->type['User'] ) print '<strong>(Optional)</strong>: '; ?>
		Ein Kommentar den du in deinem Profil veröffentlichen möchtest, oder dein Skype-Name o.ä.
	</li>
	
<?php

if( $User->type['User'] ) {
	// If the user is registered show the list of muted users/countries:

// Patch to block Users	
	$BlockedUsers = array();
	foreach($User->getBlockUsers() as $blockUserID) {
		$BlockedUsers[] = new User($blockUserID);
	}
	if( count($BlockedUsers) > 0 ) {
		print '<li class="formlisttitle">Blockierte Spieler:</li>';
		print '<li class="formlistdesc">Spieler, die blockiert sind, können deinen Spielen nicht beitreten. Ebenso kannst du ihren Spielen nicht beitreten.</li>';
		print '<li class="formlistfield"><ul>';
		foreach ($BlockedUsers as $BlockedUser) {
			print '<li>'.$BlockedUser->profile_link().' '.libHTML::blocked("profile.php?userID=".$BlockedUser->id.'&toggleBlock=on&rand='.rand(0,99999).'#block').'</li>';
		}
		print '</ul></li>';
	}
	
// End Patch	
	$MutedUsers = array();
	foreach($User->getMuteUsers() as $muteUserID) {
		$MutedUsers[] = new User($muteUserID);
	}
	if( count($MutedUsers) > 0 ) {
		print '<li class="formlisttitle">Stummgeschaltete Benutzer:</li>';
		print '<li class="formlistdesc">Diese Nutzer hast du stummgeschaltet; sie können dir keine Nachrichten schreiben.</li>';
		print '<li class="formlistfield"><ul>';
		foreach ($MutedUsers as $MutedUser) {
			print '<li>'.$MutedUser->username.' '.libHTML::muted("profile.php?userID=".$MutedUser->id.'&toggleMute=on&rand='.rand(0,99999).'#mute').'</li>';
		}
		print '</ul></li>';
	}

	$MutedGames = array();
	foreach($User->getMuteCountries() as $muteGamePair) {
		list($gameID, $muteCountryID) = $muteGamePair;
		if( !isset($MutedGames[$gameID])) $MutedGames[$gameID] = array();
		$MutedGames[$gameID][] = $muteCountryID;
	}
	if( count($MutedGames) > 0 ) {
		print '<li class="formlisttitle">Stummgeschaltete Länder:</li>';
		print '<li class="formlistdesc">Diese Länder hast du stummgeschaltet; sie können dir keine Nachrichten schreiben.</li>';
		print '<li class="formlistfield"><ul>';
		$LoadedVariants = array();
		foreach ($MutedGames as $gameID=>$mutedCountries) {
			list($variantID) = $DB->sql_row("SELECT variantID FROM wD_Games WHERE id=".$gameID);
			if( !isset($LoadedVariants[$variantID]))
				$LoadedVariants[$variantID] = libVariant::loadFromVariantID($variantID);
			$Game = $LoadedVariants[$variantID]->Game($gameID);
			print '<li>'.$Game->name.'<ul>';
			foreach($mutedCountries as $mutedCountryID) {
				print '<li>'.$Game->Members->ByCountryID[$mutedCountryID]->country.' '.
				libHTML::muted("board.php?gameID=".$Game->id."&msgCountryID=".$mutedCountryID."&toggleMute=".$mutedCountryID."&rand=".rand(0,99999).'#chatboxanchor').'</li>';
			}
			print '</ul></li>';
		}
		print '</ul></li>';
	}
	
	$tablMutedThreads = $DB->sql_tabl(
		"SELECT mt.muteThreadID, f.subject, f.replies, fu.username ".
		"FROM wD_MuteThread mt ".
		"INNER JOIN wD_ForumMessages f ON f.id = mt.muteThreadID ".
		"INNER JOIN wD_Users fu ON fu.id = f.fromUserID ".
		"WHERE mt.userID = ".$User->id);
	$mutedThreads = array();
	while( $mutedThread = $DB->tabl_hash($tablMutedThreads))
		$mutedThreads[] = $mutedThread;
	unset($tablMutedThreads);
	
	if( count($mutedThreads) > 0 ) {
		print '<li class="formlisttitle"><a name="threadmutes"></a>Stummgeschaltete Foren-Diskussionen:</li>';
		print '<li class="formlistdesc">Diese Foren-Diskussionen werden dir nicht angezeigt.</li>';
		
		$unmuteThreadID=0;
		if( isset($_GET['unmuteThreadID']) ) {
			
			$unmuteThreadID = (int)$_GET['unmuteThreadID'];
			$User->toggleThreadMute($unmuteThreadID);
			
			print '<li class="formlistfield"><strong>Diskussion <a class="light" href="forum.php?threadID='.$unmuteThreadID.'#'.$unmuteThreadID.
				'">#'.$unmuteThreadID.'</a> wieder anzeigen.</strong></li>';
		}
		
		print '<li class="formlistfield"><ul>';
		
		foreach ($mutedThreads as $mutedThread) {
			if( $unmuteThreadID == $mutedThread['muteThreadID']) continue;
			print '<li>'.
				'<a class="light" href="forum.php?threadID='.$mutedThread['muteThreadID'].'#'.$mutedThread['muteThreadID'].'">'.
				$mutedThread['subject'].'</a> '.
				libHTML::muted('usercp.php?unmuteThreadID='.$mutedThread['muteThreadID'].'#threadmutes').'<br />'.
				$mutedThread['username'].' ('.$mutedThread['replies'].' replies)<br />'.
				'</li>';
		}
		print '</ul></li>';
	}
}

/*
 * This is done in PHP because Eclipse complains about HTML syntax errors otherwise
 * because the starting <form><ul> is elsewhere
 */
print '</ul>

<div class="hr"></div>

<input type="submit" class="form-submit notice" value="Update">
</form>';


?>
