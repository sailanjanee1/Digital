<html>
	<head>
		<title>Digital 8848</title>
	</head>
	<body>
		<p>
			<a href="<?php echo site_url('news'); ?>">Home</a> | 
			<a href="<?php echo site_url('news/create'); ?>">Add News</a> | 
			
			<?php if ($this->session->userdata('is_logged_in')) { 
					echo '<b>Logged in as:</b> ' . $this->session->userdata('email');
					echo ' | ' . "<a href=" . site_url('logout') . ">Logout</a>";
				} else {
			?>    
				<a href="<?php echo site_url('register'); ?>">Register</a> | 
				<a href="<?php echo site_url('login'); ?>">Login</a>
			<?php } ?>    
		</p>
