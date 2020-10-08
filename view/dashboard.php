<?php 
	session_start();
	
	if(!isset($_SESSION['u_id'],$_SESSION['r_id']))
	{
		header('location:index.php?lmsg=true');
		exit;
	}		
	
	require_once('../controller/user/userController.php');
	require_once('header.php'); 
	
?>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <h1>Welcome to Dashboard</h1>
      <hr>
      <h3>You are login as <strong><?php echo getUserAccessRoleByID($_SESSION['r_id']); ?></strong></h3>
	  
		<ul>
			<li><strong>John Doe</strong> has <strong>Administrator</strong> rights so all the left bar items are visible to him</li>
			<li><strong>Sahan</strong> has <strong>Contract</strong> rights and he doesn't have access to Settings</li>
			<li><strong>Shanuka</strong> has <strong>Accountant</strong> rights and she can't have access to Appearance, Components and Settings</li>
			<li><strong>Udara</strong> has <strong>Stock Keeper</strong> rights and he has only access Relevant</li>
			<li><strong>Supun</strong> has <strong>Dashboard Faility</strong> rights and he has only access Relevant</li>
		</ul>	


      
      <h2>
	  Special Notices:
	  </h2>
	  

      <div style="height: 600px;"></div>
    </div>
<?php 
require_once('left_sidebar.php'); 	
require_once('footer.php'); ?>	