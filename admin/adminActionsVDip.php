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
				'params' => array('gameID'=>'GameID', 'userID'=>'UserID to be replaced','replaceID'=>'UserID replacing')
			),
			'disableVotes' => array(
				'name' => 'Disable some or all vote buttons',
				'description' => 'Disable or enable some or all vote-buttons.<br />
				If you want enable all vote buttons again use "none"',
				'params' => array('votes'=>'Comma separated list of votes you want disabled'),
			),			
			'ChangeDirectorLicense' => array(
				'name' => 'Change director license',
				'description' => 'Manually grand or remove the license to create moderated games.',
				'params' => array('userID'=>'User ID','newLicense'=>'change license to (Yes, No or NULL)'),
			),
		);
		
		adminActions::$actions = array_merge(adminActions::$actions, $vDipActions);
	}

	public function changeReliability(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		$CDtakeover = (int)$params['CDtakeover'];

		list($CDtakeoverOld) = $DB->sql_row("SELECT CDtakeover FROM wD_Users WHERE id=".$userID);

		$DB->sql_put("UPDATE wD_Users SET CDtakeover = ".$CDtakeover." WHERE id=".$userID);

		return 'This users CDtakeovers got changed from <b>'.$CDtakeoverOld.'</b> to <b>'.$CDtakeover.'</b>.';
	}
	
	public function changeReliabilityConfirm(array $params)
	{
		global $DB;
		
		$userID = (int)$params['userID'];
		$CDtakeover = (int)$params['CDtakeover'];
		
		list($CDtakeoverOld) = $DB->sql_row("SELECT CDtakeover FROM wD_Users WHERE id=".$userID);

		return 'This users CDtakeovers will be changed from <b>'.$CDtakeoverOld.'</b> to <b>'.$CDtakeover.'</b>.';
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
	
	public function disableVotes(array $params)
	{
		global $DB;

		$gameID = intval($this->fixedGameID);

		$Variant=libVariant::loadFromGameID($gameID);
		$Game = $Variant->Game($gameID);
		$votes=strtoupper($params['votes']);

		if (strpos($votes,'NONE')!== false)
			$changeVotes='';
		else
		{
			$changeVotesArr=array();
			if (strpos($votes,'DRAW')!== false)
				$changeVotesArr[]="Draw";
			if (strpos($votes,'PAUSE')!== false)
				$changeVotesArr[]="Pause";
			if (strpos($votes,'CANCEL')!== false)
				$changeVotesArr[]="Cancel";
			if (strpos($votes,'EXTEND')!== false)
				$changeVotesArr[]="Extend";
			if (strpos($votes,'CONCEDE')!== false)
				$changeVotesArr[]="Concede";

			$changeVotes= implode ( ',' , $changeVotesArr );
			foreach ($changeVotesArr as $removeVote)
			{
				foreach ($Game->Members->ByID as $Member)
				{
					if(in_array($removeVote, $Member->votes))
					{
						unset($Member->votes[array_search($removeVote, $Member->votes)]);
						$DB->sql_put("UPDATE wD_Members SET votes='".implode(',',$Member->votes)."' WHERE id=".$Member->id);
					}
				}
			}
		}
		
		$DB->sql_put(
			"UPDATE wD_Games
			SET blockVotes = '".$changeVotes."'
			WHERE id = ".$Game->id
		);

		if ($changeVotes == '')
			$changeVotes = 'None';
		
		return l_t('Disabled votes successfully set to %s.',$changeVotes);
	}	
	
	public function ChangeDirectorLicense(array $params)
	{

		$userID = (int)$params['userID'];
		$params['newLicense'] = strtoupper(substr($params['newLicense'],0,1));
		switch($params['newLicense']) {
			case 'Y':
				$newLicense = 'Yes';
				break;
			case 'N':
				$newLicense = 'No';
				break;
			default:
				$newLicense = 'NULL';
		}
	
		$DB->sql_put("UPDATE wD_Users SET directorLicense = '".$newLicense."' WHERE id=".$userID);

		return l_t('This users director license was set to %s.',$newLicense);
	}
}
?>
