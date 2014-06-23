<?php

defined('IN_CODE') or die('This script can not be run by itself.');

class GobbleEarthVariant_processOrderBuilds extends processOrderBuilds {

	public function archiveMoves()
	{
		global $DB, $Game;
		
		parent::archiveMoves();
		
		// Add Wait-orders in the database too...
		$DB->sql_put(
			"INSERT INTO wD_MovesArchive (
				gameID, turn, type, terrID, /* Index */
				countryID, toTerrID, fromTerrID, viaConvoy, /* Order */
				unitType, /* Unit */
				success, dislodged /* Move */
			)
			SELECT
				o.gameID, ".$Game->turn.", o.type, NULL,
				o.countryID, NULL, NULL, 'No',
				NULL,
				'Yes', 'Yes'
			FROM wD_Orders o
			INNER JOIN wD_Moves m ON ( m.orderID = o.id AND m.gameID=".$GLOBALS['GAMEID']." )
			WHERE o.gameID = ".$Game->id." AND o.type = 'Wait'");
			
			$DB->sql_put(
				"INSERT INTO wD_MovesArchive (
					gameID, turn, type, terrID, /* Index */
					countryID, toTerrID, fromTerrID, viaConvoy, /* Order */
					unitType, /* Unit */
					success, dislodged /* Move */
				)
				SELECT
					o.gameID, ".$Game->turn.", o.type, o.toTerrID,
					o.countryID, NULL, NULL, 'No',
					NULL,
					m.success, 'No'
				FROM wD_Orders o
				/* Moves needed to get success/dislodged results data */
				INNER JOIN wD_Moves m ON ( m.orderID = o.id AND m.gameID=".$GLOBALS['GAMEID']." )
				WHERE o.gameID = ".$Game->id." AND NOT o.type = 'Wait' AND success = 'No'");

	}
	
	public function create()
	{
		global $DB, $Game;

		$newOrders = array();
		foreach($Game->Members->ByID as $Member )
		{
			$difference = 0;
			if ( $Member->unitNo > $Member->supplyCenterNo )
			{
				$difference = $Member->unitNo - $Member->supplyCenterNo;
				$type = 'Destroy';
			}
			elseif ( $Member->unitNo < $Member->supplyCenterNo )
			{
				$difference = $Member->supplyCenterNo - $Member->unitNo;
				$type = 'Build Army';
			}

			for( $i=0; $i < $difference; ++$i )
			{
				$newOrders[] = "(".$Game->id.", ".$Member->countryID.", '".$type."')";
			}
		}

		if ( count($newOrders) )
		{
			$DB->sql_put("INSERT INTO wD_Orders
							(gameID, countryID, type)
							VALUES ".implode(', ', $newOrders));
		}
		
		$colonialInfo = "These are the possible colonial builds for each country:";
		foreach($Game->Variant->homeSCs as $countryName => $HomeSCs)
		{
			$countryID = $Game->Variant->countryID($countryName);
			list($sB)=$DB->sql_row("SELECT COUNT(*) FROM wD_MovesArchive WHERE gameID=".$Game->id." AND countryID=".$countryID." AND turn=".($Game->turn - 2)." AND type='Wait'");
			if ($sB > 0)
			{
				$colonialInfo .= "\n".$countryName.": ".$sB." colonial-build";
				if ($sB > 1)
					$colonialInfo .= "s";
				$colonialInfo .= ".";
			}
		}
		if ($colonialInfo != "These are the possible colonial builds for each country:" )
		{
			require_once "lib/gamemessage.php";
			libGameMessage::send(0, 'GameMaster', $colonialInfo);
		}
		
	}

}
