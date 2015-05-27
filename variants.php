<?php
/*
Copyright (C) 2004-2011 Oliver Auth

This file is part of vDiplomacy.

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
* @subpackage Static
*/

require_once('header.php');

libHTML::starthtml();

if(!(isset($_REQUEST['variantID'])))
{
	print '<script type="text/javascript" src="contrib/tablekit/tablekit.js"></script>';
	print libHTML::pageTitle(l_t('webDiplomacy variants'),l_t('A list of the variants available on this server, with credits and information on variant-specific rules.'));
	$variantsOn=array();
	$variantsOff=array();

	foreach(glob('variants/*', GLOB_ONLYDIR) as $variantDir)
	{
		if( file_exists($variantDir.'/variant.php') )
		{
			$variantDir=substr($variantDir,9);
			if( in_array($variantDir, Config::$variants) )
				$variantsOn[] = $variantDir;
			else
				$variantsOff[] = $variantDir;
		}
	}
	
	if( count($variantsOff) )
		print '<a name="top"></a><h4>'.l_t('Active variants:').'</h4>';
	
	print '<style type="text/css">
			.sortcol { cursor: pointer;
				padding-right: 20px;
				background-repeat: no-repeat;
				background-position: right center; }
			.sortasc {
				background-color: #DDFFAC;
				background-image: url(contrib/tablekit/up.gif); }
			.sortdesc {
				background-color: #B9DDFF;
				background-image: url(contrib/tablekit/down.gif); }
			.nosort { cursor: default;} 
		</style>';
		
	print '<TABLE class="sortable">
				<THEAD>
					<TH style="border: 1px solid #000" class="sortfirstasc">'.l_t('Name').'</TH>
					<TH style="border: 1px solid #000">'.l_t('Players').'</TH>
					<TH style="border: 1px solid #000">'.l_t('IAMap').'</TH>
					<TH style="border: 1px solid #000">'.l_t('Games finished').'</TH>
					<TH style="border: 1px solid #000">'.l_t('avg. Turns').'</TH>
					<TH style="border: 1px solid #000">'.l_t('Rating').'*</TH>
					<TH style="border: 1px solid #000">'.l_t('Hot').'**</TH>
				</THEAD>
				<TFOOT>
					<tr style="border: 1px solid #666"><td colspan=6>'.l_t('<b>**Rating</b> = ("players" x "games played") - <b>**Hot</b> = Number of active games').'</td></tr>
				</TFOOT>';
			
	foreach( $variantsOn as $variantName )
	{
		$Variant = libVariant::loadFromVariantName($variantName);
		
		if (isset(Config::$hiddenVariants) && in_array($Variant->id,Config::$hiddenVariants) && $User->type['Guest'])
			continue;
			
		list($players)=$DB->sql_row(
			'SELECT COUNT(*) FROM wD_Members m
				INNER JOIN wD_Games g ON (g.id = m.gameID) 
			WHERE g.variantID='.$Variant->id.' AND g.phase = "Finished"');
		list($turns,$games) = $DB->sql_row('SELECT SUM(turn), COUNT(*) FROM wD_Games WHERE variantID='.$Variant->id.' AND phase = "Finished"');
		list($hot) = $DB->sql_row('SELECT COUNT(*) FROM wD_Games WHERE variantID='.$Variant->id.' AND phase != "Finished" AND phase != "Pre-game"');
		print '<TR><TD style="border: 1px solid #666">'.$Variant->link().'</TD>';
		print '<TD style="border: 1px solid #666">'.($games==0?count($Variant->countries):round($players/$games,2)) .' '.l_t('players').'</TD>';
		print '<TD style="border: 1px solid #666" align="center">'.((file_exists('variants/'.$Variant->name.'/interactiveMap')) ? '<img src="images/icons/tick.png"' : '-').'</TD>';
		print '<TD style="border: 1px solid #666">'.l_t('%s game'.($games!=1?'s':''), $games).'</TD>';
		print '<TD style="border: 1px solid #666">'.l_t('%s turns',$games==0?'0.00':number_format($turns/$games,2)).'</TD>';
		print '<TD style="border: 1px solid #666">'.$players.'</TD>';
		print '<TD style="border: 1px solid #666">'.$hot.'</TD></TR>';
	}
	print '</TABLE>';

/* Do not show the deactivated variants, it causes all sort of problems with unfinnished maps on the lab and
 * it's not really that interesting.
 
	if( count($variantsOff) )
	{
		print '<h4>Disabled variants</h4>';
		print '<p>Variants which are present but not activated.</p>';
		print '<ul>';
		foreach( $variantsOff as $variantName )
		{
			$Variant = libVariant::loadFromVariantName($variantName);
			if (isset(Config::$hiddenVariants) && in_array($Variant->id,Config::$hiddenVariants) && $User->type['Guest'])
				continue;
				
			print '<li>' . $Variant->name . '</a> (' . count($Variant->countries) . ' Players)</li>';
		}
		print '</ul>';
	}
*/

	print '<div class="hr"></div>';
}
else
{
	$id=intval($_REQUEST['variantID']);
	
	if (!(isset(Config::$variants[$id])) || (isset(Config::$hiddenVariants) && in_array($id,Config::$hiddenVariants) && $User->type['Guest']) )
		foreach (array_reverse(Config::$variants,true) as $id => $name);
		
	$Variant = libVariant::loadFromVariantID($id);
	print libHTML::pageTitle(l_t( $Variant->fullName ) .' '.l_t('(%s Players)',count($Variant->countries)),l_t($Variant->description));
	print '<div style="text-align:center"><span id="Image_'. $Variant->name . '"> <a href="';
		if (file_exists(libVariant::cacheDir($Variant->name).'/sampleMapLarge.png'))
			print libVariant::cacheDir($Variant->name).'/sampleMapLarge.png';
		else
			print 'map.php?variantID=' . $Variant->id. '&largemap';	
	print '" target="_blank"> <img src="';
	if (file_exists(libVariant::cacheDir($Variant->name).'/sampleMap.png'))
		print libVariant::cacheDir($Variant->name).'/sampleMap.png';
	else
		print 'map.php?variantID=' . $Variant->id;
	print '" alt="Open large map" title="'.l_t('The map for the %s Variant',$Variant->name).'" /></a></span> </div><br />';

	print '<table>
		<td style="text-align:left">'.l_t('Search for games:'). 		
			'<form style="display: inline" action="gamelistings.php" method="POST">
				<input type="hidden" name="gamelistType" value="New" />
				<input type="hidden" name="searchOff" value="true" />
				<input type="hidden" name="search[chooseVariant]" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('New').'" /></form>							
			<form style="display: inline" action="gamelistings.php" method="POST">
				<input type="hidden" name="gamelistType" value="Open" />
				<input type="hidden" name="searchOff" value="true" />
				<input type="hidden" name="search[chooseVariant]" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('Open').'"/></form>				
			<form style="display: inline" action="gamelistings.php" method="POST">
				<input type="hidden" name="gamelistType" value="Active" />
				<input type="hidden" name="searchOff" value="true" />
				<input type="hidden" name="search[chooseVariant]" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('Active').'" /></form>
			<form style="display: inline" action="gamelistings.php" method="POST">
				<input type="hidden" name="gamelistType" value="Finished" />
				<input type="hidden" name="searchOff" value="true" />
				<input type="hidden" name="search[chooseVariant]" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('Finished').'" /></form>
		</td> <td style="text-align:right">
			<form style="display: inline" action="stats.php" method="GET">
				<input type="hidden" name="variantID" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('View statistics').'" /></form>			
			<form style="display: inline" action="edit.php" method="GET">
				<input type="hidden" name="variantID" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('Map info').'" /></form>			
			<form style="display: inline" action="files.php" method="GET">
				<input type="hidden" name="variantID" value="'.$Variant->id.'" />
				<input type="submit" value="'.l_t('View/Download code').'" /></form>
		</td>
	</table>';
			
	print '<br><div><strong>'.l_t('Variant Parameters').'';
	if ((isset($Variant->version)) || (isset($Variant->CodeVersion)))
	{
		print ' (';
		if (isset($Variant->version))
			print l_t('Version: %s',$Variant->version).(isset($Variant->codeVersion)?' / ':'');
		if (isset($Variant->codeVersion))
			print l_t('Code: %s',$Variant->codeVersion);
		print ')';
	}
	print ':</strong>';
	
	print '<ul>';
	if (isset($Variant->homepage))
      print '<li><a href="'. $Variant->homepage .'">'.l_t('Variant homepage').'</a></li>';
	if (isset($Variant->author))
      print '<li> '.l_t('Created by: %s',$Variant->author).'</li>';
	if (isset($Variant->adapter))
      print '<li> '.l_t('Adapted for webDiplomacy by: %s',$Variant->adapter).'</li>';

	list($turns,$games) = $DB->sql_row('SELECT SUM(turn), COUNT(*) FROM wD_Games WHERE variantID='.$Variant->id.' AND phase = "Finished"');
	print '<li> '.l_t('Games finished: %s game'.($games!=1?'s':''),$games).'</li>';
	print '<li> '.l_t('avg. Duration: %s turns',$games==0?'0.00':number_format($turns/$games,2)).'</li>';

	print '<li> '.l_t('SCs required for solo win: %s (of %s)',$Variant->supplyCenterTarget,$Variant->supplyCenterCount).'</li>';

	$count=array('Sea'=>0,'Land'=>0,'Coast'=>0,'All'=>0);
	$tabl = $DB->sql_tabl(
		'SELECT TYPE,count(TYPE) FROM wD_Territories t
			WHERE EXISTS (SELECT * FROM wD_Borders b WHERE b.fromTerrID = t.id && b.mapID = t.mapID) 
			&& t.mapID ='.$Variant->mapID.' && t.name NOT LIKE "% Coast)%" 
		GROUP BY TYPE');
	while(list($type,$counter) = $DB->tabl_row($tabl))
	{
		$count[$type]=$counter;
		$count['All']+=$counter;
	}	
	print '<li> '.l_t('Territories: %s (Land=%s; Coast=%s; Sea=%s)',$count['All'],$count['Land'],$count['Coast'],$count['Sea']).'</li>';

	if (!file_exists(l_s('variants/'. $Variant->name .'/rules.html')))
		print '<li>'.l_t('Standard Diplomacy Rules Apply').'</li>';
	print '</ul>';

	if (file_exists(l_s('variants/'. $Variant->name .'/rules.html'))) 
	{
		print '<p><strong>'.l_t('Special rules/information:').'</strong></p>';
		print '<div>'.file_get_contents(l_s('variants/'. $Variant->name .'/rules.html')).'</div>';
	}
	elseif (file_exists(l_s('variants/'. $Variant->name .'/rules.php'))) 
	{
		print '<p><strong>'.l_t('Special rules/information:').'</strong></p><div>';
		include_once(l_s('variants/'. $Variant->name .'/rules.php'));
		print '</div>';
	}
	print '</div>';
}

print '</div>';
libHTML::footer();

?>
