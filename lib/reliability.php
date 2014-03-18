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

class libReliability
{
	/**
	 * Get a user's or members noNMRrating rating.	 
	 * This is ( missedMoves / phasesPlayed )
	 * @return noNMRrating
	 */
	static function noNMRrating($User)
	{
		if ($User->phasesPlayed == 0) return 100;
		return round (100 * ( 1 - $User->missedMoves / $User->phasesPlayed ) , 2);
	}
	
	/**
	 * Get a user's or members noCDrating rating.	 
	 * This is ( gamesLeft / gamesPlayed )
	 * @return noNMRrating
	 */
	static function noCDrating($User)
	{
		if ($User->gamesPlayed == 0) return 100;
		return round (100 * ( 1 - $User->gamesLeft / $User->gamesPlayed ) , 2);
	}

	/**
	 * Get a user's or members noCDrating rating.	 
	 * This is ( gamesLeft / gamesPlayed )
	 * @return noNMRrating
	 */
	static function integrityRating($User)
	{
		if ($User->gamesPlayed == 0) return 0;
		return $User->CDtakeover - (($User->missedMoves * 0.2) + ($User->gamesLeft * 0.6));
	}

	/**
	 * Get a user's or members reliability rating.	 
	 * This is ( (noCD + noNMR) /2 ) ^3
	 * @return reliability
	 */
	static public function getReliability($User)
	{
		$cleanRR = ((self::noNMRrating($User) + self::noCDrating($User)) / 2);
		$adjustedRR = 100 * pow (($cleanRR / 100), 3);
		return round ($adjustedRR , 2);
	}
	
	/**
	 * Display the Grade to the given reliability
	 */
	static public function Grade($reliability)
	{
		return "R".floor($reliability);
	}
	
	/**
	 * Get a user's Grade... 
	 * @return grade as string...
	 */
	static public function getGrade($User)
	{
		if ($User->phasesPlayed > 99 && $User->gamesPlayed > 2)
			return self::Grade(self::getReliability($User));
		else
			return 'Rookie';
	}

	static public function gameLimits($User)
	{
		$gLp = $gLi = 999;
		
		if ($User->phasesPlayed < 100) {$gLp = 7;}
		if ($User->phasesPlayed < 50)  {$gLp = 4;}
		if ($User->phasesPlayed < 20)  {$gLp = 2;}
		
		$integrity = self::integrityRating($User);
		if ($integrity <= -1) { $gLi =  6; }
		if ($integrity <= -2) { $gLi =  5; }
		if ($integrity <= -3) { $gLi =  3; }
		if ($integrity <= -4) { $gLi =  1; }
		
		return min($gLp,$gLi);		
	}
	
	
	/**
	 * Return how many games a user can join.
	 * @return $maxgames as integer or 9999 as no restrictions...
	 */
	static public function maxGames($User)
	{
		global $DB;

		$gL = self::gameLimits($User);
		if ($gL > 100) return 100;
			
		$mG = 100;
		list($totalGames) = $DB->sql_row("SELECT COUNT(*) FROM wD_Members m, wD_Games g WHERE m.userID=".$User->id." and m.status!='Defeated' and m.gameID=g.id and g.phase!='Finished' and m.bet!=1");
		$mG = $gL - $totalGames;
		if ($mG < 0) { $mG = 0; }
		return $mG;
	}
	
	/**
	 * 
	 * 
	 */
	static public function printCDNotice($User)
	{
		if ( self::maxGames($User) < 50 )
			print '<p class="notice">Game-Restrictions in effect.</p>
				<p class="notice">You can join or create '.self::maxGames($User).' additional games.<br>
				Read more about this <a href="reliability.php">here</a>.<br><br></p>';
	}
	
	/**
	 * Check if the users reliability is high enough to join/create more games
	 * @return true or error message	 
	 */
	static public function isReliable($User)
	{
		global $DB;
		
		// A player can't join new games, as long as he has active CountrySwiches.
		list($openSwitches)=$DB->sql_row('SELECT COUNT(*) FROM wD_CountrySwitch WHERE (status = "Send" OR status = "Active") AND fromID='.$User->id);
		if ($openSwitches > 0)
			return "<p><b>NOTICE:</b></p><p>You can't join or create new games, as you have active CountrySwitches at the moment.</p>";

		$maxGames = self::maxGames($User);
		
		if ($maxGames == 0)
		{
			if ( self::gameLimits($User) == 2 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>20 phases</strong>, before you can join more than 2 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
			if ( self::gameLimits($User) == 4 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>50 phases</strong>, before you can join more than 4 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
			if ( self::gameLimits($User) == 7 ) 
				return "<p>You're taking on too many games at once for a new member.<br>
					Please relax and enjoy the games that you are currently in before joining/creating a new one.<br>
					You need to play at least <strong>100 phases</strong>, before you can join more than 7 games.<br>
					2-player variants are not affected by this restriction.</p>
					<p>Read more about this <a href='reliability.php'>here</a>.</p>";
					
			return "<p>NOTICE: You cannot join or create a new game, because you seem to be having trouble keeping up with the orders in the ones you already have.</p>
				<p>Read more about this <a href='reliability.php'>here</a>.</p>";
		}
	}
	
	/**
	 * Update a members reliability-stats
	 */
	static function updateReliability($Member, $type, $calc)
	{
		global $DB;
		
		if ( (count($Member->Game->Variant->countries) > 2) && ($Member->Game->phaseMinutes > 30) )
			$DB->sql_put("UPDATE wD_Users SET ".$type." = ".$type." ".$calc." WHERE id=".$Member->userID);		
	}

	/**
	 * Adjust the missed turns of each member and update the phase counter
	 * for games with more then 2 players and not live games...
	 * "Left" users are included (for civil disorder to total phases ratio calculating)
	 */
	static function updateNMRreliabilities($Members)
	{
		foreach($Members->ByStatus['Playing'] as $Member)
		{
			self::updateReliability($Member, 'phasesPlayed', '+ 1');
			if ($Member->orderStatus == '')
				self::updateReliability($Member, 'missedMoves', '+ 1');
		}
		
		foreach($Members->ByStatus['Left'] as $Member)
		{
			self::updateReliability($Member, 'phasesPlayed', '+ 1');
			self::updateReliability($Member, 'missedMoves' , '+ 1');
		}
	}
	
	static function updateCDReliabilities($Members)
	{
		foreach($Members->ByID as $Member)
			self::updateReliability($Member, 'gamesPlayed', '+ 1');
	}
	
}

?>
