<?php


require_once('header.php');

libHTML::starthtml();

// haben wir einen User, der ganz sicher ist, dass er seinen Account löschen will?
if($User->type['User'] and isset($_REQUEST['delaccount']) and $_REQUEST['delaccount'] == "yes" and isset($_REQUEST['really']) and $_REQUEST['really'] == "on" )
{
	print libHTML::pageTitle('Account stillgelegt','Dein Account wird nun von einem Administrator stillgelegt.');

	$timestamp = time() + 1209600;
	$loeschdatum = date("d.m.Y",$timestamp);
	$rand = rand(1000,9999);

	require_once('objects/mailer.php');
	$Mailer = new Mailer();
	//Mail an den User mit Hinweis auf die 14-Tage-Frist
	$Mailer->Send(array($User->email=>$User->username), 'Diplomacys Website - Account stillgelegt',"Hallo ".$User->username.",<br><br>du hast deinen Account auf Diplomacy\'s Website erfolgreich stillgelegt.<br>Hören wir in den nächsten 14 Tagen nichts mehr von dir, werden deine Nutzerdaten unwiderruflich von unserem System gelöscht. Gegen diese Löschung kannst du innerhalb von 14 Tagen nach Zustellung dieser E-Mail (also bis zum ".$loeschdatum.") mit einer Nachricht an info@diplomacy.s-website.de Widerspruch einlegen.Wir wünschen dir alles Gute,");
	//Mail an den Administrator mit der Bitte um Löschung des Accounts
	$Mailer->Send(array("info@diplomacy.s-website.de"=>"Diplomacys Website"), 'Bitte Account stilllegen!',"Der User ".$User->username." möchte seinen Account stilllegen.<br><br>Bitte führe in 14 Tagen, also am ".$loeschdatum." folgenden Löschbefehl aus:<br >UPDATE `diplomacysql1`.`wD_Users` SET `email` = 'geloescht".rand(1000,9999)."@diplomacy.s-website.de', `username` = '".rand(1000,999999)."' WHERE `wD_Users`.`id` = ".$User->id.";<br>");

	$DB->sql_put("UPDATE wD_Users SET `password` = UNHEX( '".rand(1000,9999)."' ) WHERE id = ".$User->id);

	print ' <p>Dein Account auf Diplomacy\'s Website wird in 14 Tagen entgültig aus unserem System gelöscht.</p>
		<p>Logge dich nun zum letzten Mal aus.</p><p>Wir wünschen dir alles Gute!</p>
		<form action="./logon.php" method="get">
		<p class="notice"><input type="hidden" name="logoff" value="on">
		<input type="submit" class="form-submit" value="Letzter Logout"></p>
		</form></div>';

	libHTML::footer();
}


// wenn der Besucher nicht eingeloggt ist, bekommt er das Login-Formular angezeigt.
if( ! $User->type['User'] ) {
	print libHTML::pageTitle('Anmelden','Gib hier deinen Benutzernamen und dein Passwort ein, um dich auf Diplomacys Website einzuloggen.');
	print '
		<form action="./index.php" method="post">

		<ul class="formlist">

		<li class="formlisttitle">Benutername</li>
		<li class="formlistfield"><input type="text" tabindex="1" maxlength=30 size=15 name="loginuser"></li>
		<li class="formlistdesc">Dein Benutzername auf Diplomacys Website. Solltest du noch keinen haben
			<a href="register.php" class="light">registriere dich</a> bitte zuerst.</li>

		<li class="formlisttitle">Passwort</li>
		<li class="formlistfield"><input type="password" tabindex="2" maxlength=30 size=15 name="loginpass"></li>
		<li class="formlistdesc">Dein Passwort auf Diplomacys Website.</li>

		<li class="formlisttitle">Eingeloggt bleiben</li>
		<li class="formlistfield"><input type="checkbox" /></li>
		<li class="formlistdesc">Möchtest du ständig eingeloggt bleiben?
			Falls du einen öffentlichen Computer nutzt raten wir dir von der Möglichkeit, nicht ständig deine Benutzerdaten eingeben zu müssen, ab!</li>

		<li><input type="submit" class="form-submit" value="Login"></li>
		</ul>
		</form>
		<p><a href="logon.php?forgotPassword=1" class="light">Passwort vergessen?</a></p>';
} else {
// Hier will jemand seinen Account löschen - geben wir ihm die Möglichkeit dazu
	print libHTML::pageTitle('Account stilllegen','Hier kannst du deinen Account stilllegen.');

	// Sicherstellen, dass sich der User auch sicher ist (Button ist nur mit Checkbox=On klickbar
	print '<script language="JavaScript">
<!--
function check(checkbox, stilllegen) {
if(checkbox.checked==true){
stilllegen.disabled = false;
}
else {
stilllegen.disabled = true;
}
}
//-->
</script>';

	print '<p>Durch das Stilllegen deines Accounts ist ein weiteres Einloggen nicht mehr möglich. Du wirst nicht mehr an Spielen teilnehmen können, keine Nachrichten an Mitspieler schicken und nichts mehr ins Forum posten können. Zudem wird deine E-Mail-Adresse wird aus unserem System gelöscht.</p>'
	     .'<p>Allerdings werden <u>weder deine Foren-Beiträge noch deine Spielnachrichten</u> gelöscht. Wenn du eine Nachricht oder einen Beitrag von dir gelöscht haben möchtest, setze dich bitte mit einem Administrator (info@diplomacy.s-website.de) in Verbindung! Das Löschen von einzelnen Nachrichten ist ist u.U. durch einen Administrator möglich.</p>'
	     .'<p>Das Stilllegen deines Accounts ist <u>ein unwiderruflicher Akt</u> - wir können deinen Account <u>nicht</u> reaktivieren!<br />Bitte überlege genau, ob du deinen Account stilllegen möchtest!</p>';

	print '<form action="./delaccount.php" method="post" name="form">
		<p class="notice"><input type="hidden" name="delaccount" value="yes">
		<input type="checkbox" name="really" value="on" onClick="check(this, document.form.stilllegen)" /> Ich habe die Hinweise auf dieser Seite aufmerksam gelesen und möchte meinen Account stilllegen. <br /><br />
		<input type="submit" name="stilllegen" class="form-submit" value="Account stilllegen" disabled /></p>
		</form>';
}

print '</div>';
libHTML::footer();
?>
