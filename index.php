<?php 
//default starting location of the program
//redirect to the login view page

//start the session
session_start();

// import database settings
require_once('config/config.php');
//import core classes
require_once('config/core.php');
// import login controller
require_once('controller/login/loginController.php');
// import login page
require_once('view/login/login_view.php');

// end of index page
?>	
