<?php

defined('IN_CODE') or die('This script can not be run by itself.');

/**
 * @package Base
 * @subpackage Static
 */
?>

<?php global $User; if ($User->type['Moderator']) { ?>
<p class="intro">
Your ability to join or create a new game is limited, because you seem to be having 
trouble keeping up with the orders in the ones you already have.
</p>

<p class="intro">
On this site we ask that all players respect their fellow players. Part of this respect includes
entering orders every turn in your games. Diplomacy is a game of communication, trust (and mistrust),
and because games usually take a long time to finish it's very important that you play the best you can
and don't ruin the game halfway. 
</p>

<p class="intro">
While playing a losing position might not be as fun as a winning one, it is still your responsibility to
other members to continue to play. Even if you cannot win a game there are still plenty of ways to make the
game fun. For example: you may choose to hurt the country that sealed your defeat, help someone secure a solo
so that you can get a survive instead of a defeat, or use the rest of the game to practice manipulating other
players on the board.
</p>

<p class="intro">
If you fail to submit orders for your country in consecutive turns (usually 2) the country is sent into "Civil disorder"
and another player can take over your position to ensure that the game's integrity is not overly impacted.
</p>

<p class="intro">
If you have missed turns in your games or your countries went in CD then you will be limited in the number of games 
you can play. This is to ensure that players do not take on more games then they can keep up with, and to ensure that players who
do not respect their fellow members cannot ruin multiple games. 
</p>

<?php 
$unballancedCDs = $User->gamesLeft - $User->CDtakeover;
$unballancedNMR = $User->missedMoves - ($User->CDtakeover * 2);
if ( $unballancedCDs < 0 )
{
	$unballancedNMR = $User->missedMoves + ($unballancedCDs * 2);
	$unballancedCDs = 0;
}
?>

<p class="intro">
With <b><?php print $unballancedCDs;?></b> unbalanced CDs and <b><?php print $unballancedNMR;?></b> unbalanced NMRs you can play a maximum of
<b><?php print libReliability::gameLimits($User);?></b> games at once. 2-player games are not affected by this restrictions.
If you want to to increase the number of games you can join you may take over 
<a href='gamelistings.php?page-games=1&gamelistType=Joinable'>open spots in ongoing games</a> or reclaim your CDed countries if 
they have not been taken.</p>

<?php return; }?>

<p class="intro">

Because Diplomacy is a game of communication, trust (and distrust), 
and because games usually take a long time to finish it's very important for 
players that you play the best you can and don't screw the game halfway.</p>

<p class="intro">

The reliable rating is an easy calculation that represents how reliable 
you enter your commands and how reliable you play your games till the end.
</p>

<div class="hr" ></div>

<p class="intro">
Your rating is dependent on 2 important factors. How many phases you missed 
to enter orders in comparison to your total phases played, and how many games 
you left before the end.<br>
<b>Example</b>: If a user misses 5% of their games, rating would be 90, 15% would be 70, etc.
</p>

<p class="intro">
From this rating we subtract 10% for each game you left before the end.
The penalty for the "Left" games seems a bit harsh, but many games get totally 
screwed if a player does not play the game till the end. Most of the time some 
countries gain really big unearned advantages.
<br>But you can even out your lost reliability by taking <b>an open spot from a game</b> another player left.
</p>

<p class="intro">
<style>
div.fraction-inline { display: inline-block; position: relative; vertical-align: middle; }
.fraction-inline > span { display: block; padding: 0; }
.fraction-inline span.divider{ position: absolute; top: 0em; display: none;	letter-spacing: -0.1em;	 }
.fraction-inline span.denominator{ border-top: thin solid black; text-align:center;}
</style>
The exact calculation is: 
<div class="intro">
	100 &minus; (100 *
	<div class="fraction-inline">
		<span class="numerator">2 * NoMoveReceived</span>
		<span class="divider">________________</span>
		<span class="denominator">TotalPhases</span>
	</div>
	) &minus; 10 * (CDs - CD-takeovers)
</div><br>
<span class="intro">

<?php
	require_once(l_r('lib/reliability.php'));		 

	if ( isset($_REQUEST['userID']) && intval($_REQUEST['userID'])>0 )
		$UserProfile = new User((int)$_REQUEST['userID']);
	else
		$UserProfile = $User;

	$mm = $UserProfile->missedMoves;
	$pp = $UserProfile->phasesPlayed;
	$cd = $UserProfile->gamesLeft;
	$cdb=$UserProfile->CDtakeover;
	
	if (libReliability::getReliability($UserProfile) < 0)
	{
		print 'For the first 20 phases all players are called "Rookies" and have no reliability-rating.';
	}
	else
	{
		print 'The calculation for '.($UserProfile == $User ? 'your' : $UserProfile->username.'s').' rating is:
					100 &minus; (100 *
					<div class="fraction-inline">
						<span class="numerator">2 * <b>'.$mm.'</b></span>
						<span class="divider">________________</span>
						<span class="denominator"><b>'.$pp.'</b></span>
					</div>
					) &minus; 10 * (<b>'.$cd.'</b> - <b>'.$cdb.'</b>)
					= 100 &minus; '.($pp == 0 ? '0' : round(200 * $mm / $pp)).
					' &minus; '.(10 * $cd).' = <b>'.libReliability::getReliability($UserProfile).'</b>';
	}
?>
</span>
</p>

<p class="intro">
<b>Live</b> games do <u>not</u> affect your rating.
</p>

<p class="intro">
When someone creates a game they can select a minimum rating for the people able to enter their games, 
and if you rating is too low you might not be able to join all the games as you like.<br>
Also for each 10% of reliability you can join 1 game. If your reliability is <b>91% or better</b> you can join as many games as you want.</p>

<?php
	if (abs(libReliability::getReliability($UserProfile)) < 100)
	{
		print '<p class="intro">
			How to improve '.($UserProfile == $User ? 'your' : $UserProfile->username.'s').' rating:<ul>';
		
		if ($cd > 0)
		{
			print '<li class="intro"> Take some "open" spots from ongoing games. They are in the "Joinable" Section of the games-tab. Every country "saved from CD" will improve the reliability by 10%. After <b>'.$cd.'</b> game'.(($cd > 1) ? 's' : '').' '.($UserProfile == $User ? 'your' : $UserProfile->username.'s').' reliability will be <b>'.round($pp == 0 ? '0' : (100 - 200 * $mm / $pp)).'</b>.</li>';
		}
		
		print '<li class="intro">Play some more phases without missing to enter orders.';
		
		if ((200 * $mm / $pp) > 10)
		{
			print 'With <b>'.$mm.'</b> missed moves and <b>'.$pp.'</b> phases played '.($UserProfile == $User ? 'you' : $UserProfile->username).' need to play <b>'.round((100 - floor((200 * $mm / $pp) / 10 ) *10) * $pp / 200).'</b> more phases to gain a <b>'.(100 - floor((200 * $mm / $pp) / 10 ) * 10).'+</b> rating.</li>';
		}
				
		print '</ul></p>';
	}
?>

<p class="intro">
On the games-pages your rating is displayed as a grade after your name.
The current grades are:<br>
98+, 90+, 80+, 60+, 40+, 10+, 0 and Rookie
</p>

<div class="hr" ></div>
<p class="intro">
<b>Why should I continue a game if my country can't win?</b><br>
If you can't win a game or are on a losing position you might choose to hurt the country that sealed 
your failure as much as possible by making your defeat as hard as possible. Talk to stronger players 
on the board, they might help you, just because you have a common enemy.
</p>
