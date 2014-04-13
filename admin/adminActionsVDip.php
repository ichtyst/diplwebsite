<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class adminActionsVDip extends adminActions
{
	public function __construct()
	{
		parent::__construct();

		$vDipActions = array(
			'changeReliability' => array(
				'name' => 'Change reliability',
				'description' => 'Enter the new phases played and missed and the new CD-count',
				'params' => array('userID'=>'User ID', 'CDtakeover'=>'CD takeovers')
			),
			'changeTargetSCs' => array(
				'name' => 'Change target SCs.',
				'description' => 'Enter the new CD count needed for the win.',
				'params' => array('gameID'=>'Game ID', 'targetSCs'=>'New target SCs')
			),
			'changeMaxTurns' => array(
				'name' => 'Set a new EoG turn',
				'description' => 'Enter the new turn that ends the game.',
				'params' => array('gameID'=>'Game ID', 'maxTurns'=>'New Max Turns')
			),
			'changeGameReq' => array(
				'name' => 'Change the game requirements.',
				'description' => 'Enter the min. Rating / min. phases played and the max. games left needed to join this game.',
				'params' => array('gameID'=>'Game ID', 'minRating'=>'Min. Rating','minPhases'=>'Min. Phases played')
			),
			'extendPhase' => array(
				'name' => 'Extend the curent phase',
				'description' => 'How many days should the curent phase extend?',
				'params' => array('gameID'=>'Game ID', 'extend'=>'Days to extend')
			),
			'toggleAdminLock' => array(
				'name' => 'Lock/unlock a game.',
				'description' => 'Lock (or unlock) a game to prevent users to enter orders.',
				'params' => array('gameID'=>'GameID')
			),
			'replaceCoutries' => array(
				'name' => 'Replace country-player.',
				'description' => 'Replace one player in a given game with another one.',
				'params' => array('gameID'=>'GameID','userID'=>'userID','replaceID'=>'replace User ID')
			),
		);
		
		adminActions::$actions = array_merge(adminActions::$actions, $vDipActions);
	}

	public function changeReliability(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];

		list($CDtakeoverOld) = $DB->sql_row("SELECT CDtakeover FROM wD_Users WHERE id=".$userID);

		$CDtakeover= ($params['CDtakeover']=='' ? $CDtakeoverOld : (int)$params['CDtakeover']);
		
		$DB->sql_put("UPDATE wD_Users SET 
			CDtakeover = ".$CDtakeover." 
			WHERE id=".$userID);

		return 'This users reliability was changed to:'.
			($params['CDtakeover'] == '' ? '' : '<br>Left Balanced: '.$leftBalancedOld.' => '.$CDtakeover);
	}
	
	public function changeReliabilityConfirm(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		
		list($CDtakeoverOld) 
			= $DB->sql_row("SELECT CDtakeover FROM wD_Users WHERE id=".$userID);

		$CDtakeover= ($params['CDtakeover']=='' ? $leftBalancedOld : (int)$params['CDtakeover']);

		return 'This users reliability will be changed:'.
			($params['CDtakeover'] == '' ? '' : '<br>CD takeover: '.$CDtakeoverOld.' => '.$CDtakeover);
	}
	
	public function changeTargetSCs(array $params)
	{
		global $DB;

		$gameID   = (int)$params['gameID'];
		$targetSCs= (int)$params['targetSCs'];
		
		$DB->sql_put("UPDATE wD_Games SET targetSCs = ".$targetSCs." WHERE id=".$gameID);

		return 'The target SCs for the game was changed to: '.$targetSCs;
	}
	public function changeMaxTurns(array $params)
	{
		global $DB;

		$gameID   = (int)$params['gameID'];
		$maxTurns= (int)$params['maxTurns'];
		
		$DB->sql_put("UPDATE wD_Games SET maxTurns = ".$maxTurns." WHERE id=".$gameID);

		return 'The max. turns for the game was changed to: '.$targetSCs;
	}
	public function extendPhase(array $params)
	{
		global $DB;

		$gameID = (int)$params['gameID'];
		$extend = (int)$params['extend'];
		
		$DB->sql_put("UPDATE wD_Games
			SET processTime = processTime + ". $extend * 86400 ."
			WHERE id = ".$gameID);
			
		return 'The target curend phase for the game was extended by '.$extend.' day(s).';
	}
	
	public function changeGameReq(array $params)
	{
		global $DB;

		$gameID    = (int)$params['gameID'];
		$minRating = (int)$params['minRating'];
		$minPhases = (int)$params['minPhases'];
		
		$DB->sql_put("UPDATE wD_Games SET minRating = ".$minRating.", minPhases = ".$minPhases." WHERE id=".$gameID);

		return 'This games reliability requirements was changed to: minRating = '.$minRating.', minPhases = '.$minPhases;
	}
	
	public function toggleAdminLock(array $params)
	{
		global $DB;
		$gameID = (int)$params['gameID'];
		list($status)=$DB->sql_row("SELECT adminLock FROM wD_Games WHERE id = ".$gameID);
		$DB->sql_put("UPDATE wD_Games SET adminLock = '".($status == 'Yes' ? 'No' : 'Yes')."' WHERE id = ".$gameID);		
		
		return 'This game is now '.( $status == 'No' ? 'locked' : 'unlocked').'.';
	}

	public function replaceCoutries(array $params)
	{
		global $DB;
		
		$gameID    = (int)$params['gameID'];
		$userID    = (int)$params['userID'];
		$replaceID = (int)$params['replaceID'];

		list($gameName)    = $DB->sql_row("SELECT name FROM wD_Games WHERE id=".$gameID);
		list($userName)    = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$userID);
		list($replaceName) = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$replaceID);
		
		list($bet) = $DB->sql_row("SELECT bet FROM wD_Members WHERE userID=".$userID." AND gameID=".$gameID);
		list($replacePoints) = $DB->sql_row("SELECT points FROM wD_Users WHERE id=".$replaceID);
		list($userPoints) = $DB->sql_row("SELECT points FROM wD_Users WHERE id=".$userID);

		$newPoints = $replacePoints - $bet;
		if ($newPoints < 0) $newPoints = 0;
		
		$DB->sql_put("UPDATE wD_Users SET points = ".$newPoints." WHERE id=".$replaceID);
		$DB->sql_put("UPDATE wD_Users SET points = ".($userPoints + $bet)." WHERE id=".$userID);
		$DB->sql_put("UPDATE wD_Members SET userID = ".$replaceID." WHERE userID=".$userID." AND gameID=".$gameID);

		return 'In game '.$gameName.' (id='.$gameID.') the user '.$userName.' was removed and replaced by '.$replaceName.'.';
	}
	
	public function replaceCoutriesConfirm(array $params)
	{
		global $DB;
		
		$gameID    = (int)$params['gameID'];
		$userID    = (int)$params['userID'];
		$replaceID = (int)$params['replaceID'];
		
		list($gameName)    = $DB->sql_row("SELECT name FROM wD_Games WHERE id=".$gameID);
		list($userName)    = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$userID);
		list($replaceName) = $DB->sql_row("SELECT username FROM wD_Users WHERE id=".$replaceID);
		
		return 'In game '.$gameName.' (id='.$gameID.') the user '.$userName.' will be removed and replaced by '.$replaceName.'.';
	}
	

}
?>
