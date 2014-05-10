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

/**
 * @package Base
 * @subpackage Forms
 */

require_once('header.php');
require_once('lib/reliability.php');

if ( $Misc->Panic )
{
	libHTML::notice(l_t('Game creation disabled'),
		l_t("Game creation has been temporarily disabled while we take care of an ".
		"unexpected problem. Please try again later, sorry for the inconvenience."));
}

if( !$User->type['User'] )
{
	libHTML::notice(l_t('Not logged on'),l_t("Only a logged on user can create games, guests can't. ".
		"Please <a href='logon.php' class='light'>log on</a> to create your own games."));
}

libHTML::starthtml();

//print '<div class="content">';

if( isset($_REQUEST['newGame']) and is_array($_REQUEST['newGame']) )
{

	try
	{
		$form = $_REQUEST['newGame']; // This makes $form look harmless when it is unsanitized; the parameters must all be sanitized

		$input = array();
		$required = array('variantID', 'name', 'password', 'passwordcheck', 'bet', 'potType', 'phaseMinutes', 'joinPeriod', 'anon', 'pressType', 'missingPlayerPolicy'
						,'countryID'
						,'minRating' 
						,'minPhases'
						,'maxTurns'
						,'specialCDturn'
						,'specialCDcount'
						,'chessTime'
 						,'minNoCD'
 						,'minNoNMR'
						,'targetSCs'
						,'moderated'
						,'description'
						,'noProcess'
					);

		if ( !isset($form['noProcess']) )
			$form['noProcess'] = array();
		
		if ( !isset($form['missingPlayerPolicy']) )
			$form['missingPlayerPolicy'] = 'Normal';
		
		foreach($required as $requiredName)
		{
			if ( isset($form[$requiredName]) )
			{
				$input[$requiredName] = $form[$requiredName];
			}
			else
			{
				throw new Exception(l_t('The variable "%s" is needed to create a game, but was not entered.',$requiredName));
			}
		}
		unset($required, $form);

		$input['variantID']=(int)$input['variantID'];
		if( !isset(Config::$variants[$input['variantID']]) )
			throw new Exception(l_t("Variant ID given (%s) doesn't represent a real variant.",$input['variantID']));

		// If the name isn't unique or is too long the database will stop it
		$input['name'] = $DB->escape($input['name']);
		if ( !$input['name'] )
			throw new Exception(l_t("No name entered."));

		// This is hashed, so doesn't need validation
		if ( $input['password'] != $input['passwordcheck'] )
		{
			throw new Exception(l_t("The two passwords entered don't match."));
		}

		$input['bet'] = (int) $input['bet'];
		if ( $input['bet'] > $User->points )
		{
			throw new Exception(l_t("%s is an invalid bet size.",(string)$input['bet']));
		}

		if ( $input['potType'] != 'Winner-takes-all' and $input['potType'] != 'Points-per-supply-center' )
		{
			throw new Exception(l_t('Invalid potType input given.'));
		}

		$input['phaseMinutes'] = (int)$input['phaseMinutes'];
		if ( $input['phaseMinutes'] < 5 or $input['phaseMinutes'] > 1440*10 )
		{
			throw new Exception(l_t("The phase value is too large or small; it must be between 5 minutes and 10 days."));
		}

		$input['joinPeriod'] = (int)$input['joinPeriod'];
		if ( $input['joinPeriod'] < 5 or $input['joinPeriod'] > 1440*10 )
		{
			throw new Exception(l_t("Joining period value out of range."));
		}
		
		$input['anon'] = ( (strtolower($input['anon']) == 'yes') ? 'Yes' : 'No' );
		
		switch($input['pressType']) {
			case 'PublicPressOnly':
				$input['pressType'] = 'PublicPressOnly';
				break;
			case 'NoPress':
				$input['pressType'] = 'NoPress';
				break;
			case 'Regular': // Regular is the default
			default:
				$input['pressType'] = 'Regular';
		}
		
		switch($input['missingPlayerPolicy']) {
			case 'Wait':
				$input['missingPlayerPolicy'] = 'Wait';
				break;
			default:
				$input['missingPlayerPolicy'] = 'Normal';
		}
	
		$input['minPhases'] = (int)$input['minPhases'];
		if ( $input['minPhases'] > $User->phasesPlayed )
		{
			throw new Exception("You didn't play enough phases (".$User->phasesPlayed.") for your own requirement (".$input['minPhases'].")");
		}
		
		require_once(l_r('lib/reliability.php'));		 
		$input['minRating'] = (int)$input['minRating'];		
		if ( $input['minRating'] > libReliability::getReliability($User) )
		{
			throw new Exception("Your reliability-rating is to low (".abs(libReliability::getReliability($User)).") for your own requirement (".$input['minRating'].").");
		}
		
		$input['minNoCD'] = (int)$input['minNoCD'];		
		if ( $input['minNoCD'] > libReliability::noCDrating($User) )
		{
			throw new Exception("Your reliability-rating is to low (".abs(libReliability::noCDrating($User)).") for your own requirement (".$input['minNoCD'].").");
		}
		$input['minNoNMR'] = (int)$input['minNoNMR'];		
		if ( $input['minNoNMR'] > libReliability::noNMRrating($User) )
		{
			throw new Exception("Your reliability-rating is to low (".abs(libReliability::noNMRrating($User)).") for your own requirement (".$input['minNoNMR'].").");
		}
		
		$input['maxTurns'] = (int)$input['maxTurns'];		
		if ( $input['maxTurns'] < 4 )
			$input['maxTurns'] = 0;
		if ( $input['maxTurns'] > 200 )
			$input['maxTurns'] = 200;

		$input['targetSCs'] = (int)$input['targetSCs'];		
		$input['countryID'] = (int)$input['countryID'];
		
		$input['specialCDturn'] = (int)$input['specialCDturn'];
		if ( $input['specialCDturn'] <  0 ) $input['specialCDturn'] = 0;
		if ( $input['specialCDturn'] > 99 ) $input['specialCDturn'] = 99;
		
		$input['specialCDcount'] = (int)$input['specialCDcount'];
		if ( $input['specialCDcount'] <  0 ) $input['specialCDcount'] = 0;
		if ( $input['specialCDcount'] > 99 ) $input['specialCDcount'] = 99;
		
		$input['chessTime'] = (int)$input['chessTime'];
		if ( $input['chessTime'] < 0 or $input['chessTime'] > 1440*100 )
		{
			throw new Exception("The chessTime value is too large or small; it must be between 0 minutes and 100 days.");
		}
		
		$input['chooseYourCountry'] = ( ($input['countryID'] > 0) ? 'Yes' : 'No' );
		
		$input['moderator'] = ( (strtolower($input['moderated']) == 'yes') ? $User->id : '0' );
		if ( $input['moderator'] != 0 && !$User->DirectorLicense())
		{
			throw new Exception("You do not meet the criteria to moderate a game. Please ask the mods for assistance.");
		}	
		
		if ( $input['password'] == '' && $input['moderator'] != 0)
		{
			throw new Exception("Moderated games need a password.");
		}	
		
		$input['description'] = $DB->msg_escape($input['description']);
		if ( $input['description'] == '' && $input['moderator'] != 0)
		{
			throw new Exception("Moderated games need a game description.");
		}	
		$patterns = array('/gameID[:= _]?([0-9]+)/i','/userID[:= _]?([0-9]+)/i','/threadID[:= _]?([0-9]+)/i','/((?:[^a-z0-9])|(?:^))([0-9]+) ?(?:(?:D)|(?:points))((?:[^a-z])|(?:$))/i');
		$replacements = array('<a href="board.php?gameID=\1" class="light">gameID=\1</a>','<a href="profile.php?userID=\1" class="light">userID=\1</a>','<a href="forum.php?threadID=\1#\1" class="light">threadID=\1</a>',	'\1\2'.libHTML::points().'\3');
		$input['description'] = preg_replace($patterns, $replacements, $input['description']);

		$input['noProcess'] = implode(',',$input['noProcess']);
		if ( $input['noProcess'] == '1,2,3,4,5,6,0' )
		{
			throw new Exception("Games need at least one weekday for processing allowed.");
		}	
		
		// Create Game record & object
		require_once(l_r('gamemaster/game.php'));
		$Game = processGame::create(
			$input['variantID'], 
			$input['name'], 
			$input['password'], 
			$input['bet'], 
			$input['potType'], 
			$input['phaseMinutes'], 
			$input['joinPeriod'], 
			$input['anon'], 
			$input['pressType'], 
			$input['missingPlayerPolicy'],
			$input['maxTurns'],
			$input['targetSCs'],
			$input['minRating'],
			$input['minPhases'],
			$input['specialCDturn'],
			$input['specialCDcount'],
			$input['chessTime'],
			$input['minNoCD'],
			$input['minNoNMR']
			,$input['moderator']
			,$input['chooseYourCountry']
			,$input['description']
			,$input['noProcess']
		);

		/**
		 * Check for reliability, bevore a user can create a new game...
		 */
		require_once(l_r('lib/reliability.php'));		 
		if( (count($Game->Variant->countries)>2) && ($message = libReliability::isReliable($User)) )
		{
			processGame::eraseGame($Game->id);
			libHTML::notice('Reliable rating not high enough', $message);
		}
		// END RELIABILITY-PATCH
		
		// Create first Member record & object
		if ($input['moderator'] == 0)
			processMember::create($User->id, $Game->minimumBet, $input['countryID']);
	
		// Post a small note at the beginning of each ChooseYourCountry game to tell everyone discussion has to wait till everybody joined.
		if ($input['countryID'] != 0 && $input['pressType'] != 'NoPress')
		{
			include_once ('lib/gamemessage.php');
			libGameMessage::send(0, 'GameMaster', 'Please remember that negotiations before the game begins are not allowed.' , $Game->id);			
		}
		
		$Game->Members->joinedRedirect();
	}
	catch(Exception $e)
	{
		print '<div class="content">';
		print '<p class="notice">'.$e->getMessage().'</p>';
		print '</div>';

	}
}

if ( $User->points >= 3 )
{
	$roundedDefault = round(($User->points/7)/10)*10;
	if ($roundedDefault > 3 )
		$defaultPoints = $roundedDefault;
	else
		$defaultPoints = 3;

}
else
{
	print l_t("You can't create a new game; you have fewer than 5%s, you only have %s%s. ".
		"You will always have at least 100 points, including the points that you have bet into active games, so if you want ".
		"to start a new game just wait until your other games have finished (<a href='points.php#minpoints' class='light'>read more</a>).",libHTML::points(),$User->points,libHTML::points());

	print '</div>';
	libHTML::footer();
}

if( isset($input) && isset($input['points']) )
	$formPoints = $input['points'];
else
	$formPoints = $defaultPoints;


require_once('lib/reliability.php');
libReliability::printCDNotice($User);

require_once(l_r('locales/English/gamecreate.php'));

print '</div>';
libHTML::footer();

?>
