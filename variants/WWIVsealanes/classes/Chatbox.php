<?php
defined('IN_CODE') or die('This script can not be run by itself.');

class CountryName_Chatbox extends Chatbox
{
	public function renderMessages($msgCountryID, $messages) {
		global $Member, $User;
		
		if (isset($User->showCountryNames) && $User->showCountryNames == 'Yes')
			return parent::renderMessages($msgCountryID, $messages);

		for($i=0; $i<count($messages); $i++)
			if( $messages[$i]['fromCountryID']!=0 && $messages[$i]['turn'] > 0 )
				if (!isset($Member) || $Member->countryID != $messages[$i]['fromCountryID'])
					$messages[$i]['message'] = '[<strong>'.$this->countryName($messages[$i]['fromCountryID']).'</strong>]<span style="color: black;">:'.$messages[$i]['message'];
				else
					$messages[$i]['message'] = '[<strong>You</strong>]<span style="color: black;">:'.$messages[$i]['message'];				

		return parent::renderMessages($msgCountryID, $messages);

	}
}

class NewMessageLimit_Chatbox extends CountryName_Chatbox
{
	function getMessages ( $msgCountryID, $limit=20 )
	{
		global $Game;
		$limit = $limit * 4;
		return parent::getMessages( $msgCountryID, $limit );
	}
}

class WWIVsealanesVariant_Chatbox extends NewMessageLimit_Chatbox {}
