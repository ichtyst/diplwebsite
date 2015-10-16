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

?>
<h2>Kein Multiaccounting</h2>
<p>
	Du darfst nur <b>einen Account</b> besitzen. Weitere Accounts sind unter <b>keinen Umständen</b> erlaubt und werden gelöscht.
	Es kann ebenfalls passieren, dass dann auch dein erster Account gelöscht wird.
	<ul>
		<li>Wenn du dein Passwort vergessen hast, lass dir <a href="logon.php?forgotPassword=1">hier</a> ein neues Passwort generieren.</li>
		<li>Wenn du deinen Benutzernamen vergessen hast, klicke <a href="logon.php?resendUsername=1">hier</a>.</li>
		<li>Wenn du sowohl Benutzername als auch Passwort vergessen hast, klicke zunächst <a href="logon.php?resendUsername=1">hier</a> und lass dir dann <a href="logon.php?forgotPassword=1">hier</a> ein neues Passwort generieren.</li>
		<li>Wenn du dich immernoch nicht anmelden kannst, kontaktiere mit dieser E-Mail-Adresse die Moderatoren: <a href="mailto:<?php print (isset(Config::$modEMail) ? Config::$modEMail : Config::$adminEMail)?>"><?php print (isset(Config::$modEMail) ? Config::$modEMail : Config::$adminEMail)?></a></li>
	</ul>
</p>
<h2>Kein Metagaming</h2>
<p>
	Du darfst keine Bündnisse wegen <em>Gründen außerhalb des Spiel</em> schließen. Solche Gründe wären zum Beipspiel, dass ihr Freunde oder Verwandte seid oder im Gegenzug in einem anderen Spiel helft. Diese Verhalten wird Metagaming genannt und ist gegen die Regeln da es einen unfairenen Vorteil für die Beteiligten hervorruft. Wenn du Bedenken hast, dass du einen Freund nicht im Spiel verraten kannst, dann ist das natürlich ok. Ihr dürft dann allerdings nicht dem gleichen Spiel beitreten.
</p>

<h2>Registrierung und Anti-Bot-Check</h2>

<form method="post" action="register.php">

	<ul class="formlist">

		<li class="formlisttitle">Regel-Check</li>
		<li class="formlistfield"><input type="text" name="rulesValidate" size="50" value="<?php
		        if ( isset($_REQUEST['rulesValidate'] ) )
					print $_REQUEST['rulesValidate'];
		        ?>"></li>
		<li class="formlistdesc">
			Bitte gebe die beiden Dinge an, die auf keinen Fall auf dieser Website erlaubt sind (siehe oben). Damit zeigst du, dass du diese Regeln gelesen und verstanden hast.
		</li>
		
		<li class="formlisttitle">Anti-Bot-Check</li>
		<li class="formlistfield">
		        <img alt="EasyCaptcha image" src="<?php print STATICSRV; ?>contrib/easycaptcha.php" /><br />
		        <input type="text" name="imageText" />
		</li>
		<li class="formlistdesc">
			Durch die Eingabe der Zeichen hier oben hilfst du uns, das System z.B. vor Spam-Bots sauber zu halten.
		</li>

		<li class="formlisttitle">Email-Adresse</li>
		<li class="formlistfield"><input type="text" name="emailValidate" size="50" value="<?php
		        if ( isset($_REQUEST['emailValidate'] ) )
					print $_REQUEST['emailValidate'];
		        ?>"></li>
		<li class="formlistdesc">
			Indem wir sicher stellen, dass jeder Spieler eine gültige Email-Adresse hat verringern wir die Gefahr, dass sich ein Spieler mit mehreren Accounts am System anmeldet und Spiele unfair manipulieren kann. Deine Email-Adresse wird von uns <strong>nicht</strong> zugemüllt oder an Dritte weitergeben!
		</li>
</ul>

<iframe id="tosbox" src="/tos.php?tosbox=true" border="0" height="100px" width="600px">Bitte lese die <a href="/tos.php">Nutzungsbedingungen</a> sorgfälltig durch</iframe>
<div class="hr"></div>

<p class="notice">
	<input type="submit" class="form-submit" value="Ich akzeptiere die Nutzungsbedingungen und registriere mich nur mit einem Account">
</p>
</form>