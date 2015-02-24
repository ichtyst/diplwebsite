<?php
defined('IN_CODE') or die('This script can not be run by itself.');

class AfricaVariant_adjudicatorPreGame extends adjudicatorPreGame {

	protected $countryUnits = array(
		'Demokratische Republik Kongo'			=> array('Kinshasa'=>'Fleet'  , 'Lubumbashi'=>'Army'  , '&Eacute;quateur'=>'Army'),
		'Agypten'							=> array('Kairo'=>'Fleet'     , 'Alexandria'=>'Army'  , 'Luxor'=>'Army'),
		'Athiopien'						=> array('Amhara'=>'Army'     , 'Addis Abeba'=>'Army' , 'Dire Dawa'=>'Army'),
		'Madagaskar'							=> array('Komoren'=>'Fleet'   , 'Mauritius'=>'Fleet'  , 'Antananarivo'=>'Fleet'),
		'Mali'									=> array('Kayes'=>'Army'      , 'Sikasso'=>'Army'     , 'Bamako'=>'Army'),
		'Marokko'								=> array('Casablanca'=>'Fleet', 'Marrakesch'=>'Army'  , 'Ost-Marokko'=>'Army'),
		'Nigeria'								=> array('Lagos'=>'Fleet'     , 'Abuja'=>'Army'       , 'Kano'=>'Army'),
		'Sud Afrika'						=> array('Kapstadt'=>'Fleet'  , 'Johannesburg'=>'Army', 'Durban'=>'Army'),
		'Neutral units'							=> array('Tripolis'=>'Army'   , 'Mogadischu'=>'Fleet' , 'Simbabwe'=>'Army', 'Gao'=>'Army', 'Timbuktu'=>'Army', 'Kivu'=>'Army', 'Tunesien'=>'Army'),
	);

}