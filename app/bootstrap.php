<?php 
	session_start();
	ob_start();
	setlocale(LC_TIME, 'fr_FR.utf8','fra'); 

	ini_set('error_reporting', E_ALL);
	ini_set( 'display_errors', 1 );
	
  
	


	require 'config/config.php';
	
	require 'librairies/Core.php';
	require 'librairies/Database.php';
	require 'librairies/Controller.php';

	require 'helpers/functions.php';
	

	require 'models/Account_model.php';
	require 'models/Video_model.php';
	require 'models/VideoPreview_model.php';
	require 'models/EntityProvider_model.php';

	require 'classes/User.php';
	require 'classes/VideoProvider.php';
	require 'classes/Video.php';
	require 'classes/Season.php';
	require 'classes/Entity.php';
	require 'classes/EntityProvider.php';
	require 'classes/VideoPreview.php';
	require 'classes/Account.php';

	

 ?>