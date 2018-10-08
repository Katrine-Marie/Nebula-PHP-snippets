<?php 
    ini_set('display_errors', 1);
	  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);

		session_start();

    require_once('class/Curl.php');

		$pagesFolderPath = "pages/";
		$frontpage = "home.php";
    
    $page = $_GET['page'];
    
		include_once('includes/header.php');

    if(isset($_GET['page'])){
      if(file_exists($pagesFolderPath . $page . '.php')){
        include($pagesFolderPath . $page . '.php');
      }
      else{
        include($pagesFolderPath . '404.php');
      }
    }else {
      include($pagesFolderPath . $frontpage);
    }

		include_once('includes/footer.php');