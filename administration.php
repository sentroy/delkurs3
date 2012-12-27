<?php
if(!empty($_SESSION['loggedIn']) && !empty($_SESSION['user']))
{
	$query = mysqli_query($conn, "SELECT uID, file,warned FROM uploads WHERE warned = '1'");
	$alt = 0;
	while ($result = mysqli_fetch_assoc($query))
	{
		if($alt%2==0)
		{
			echo '<span class="browseLinks"><a href="?p=view&view='. $result['file'] .'">'. $result['file'] .'</a></span>';
		}
		else
		{
			echo '<span class="browseLinksAlt"><a href="?p=view&view='. $result['file'] .'">'. $result['file'] .'</a></span>';
		}
		$alt++;
	}
}
elseif(!empty($_POST['lUser']) && !empty($_POST['lPass']))
{
	$username = mysqli_real_escape_string($conn, $_POST['lUser']);
    $password = hash('sha256', mysqli_real_escape_string($conn, $_POST['lPass']));
    
	$checkLogin = mysqli_query($conn, "SELECT * FROM admin WHERE user = '".$username."' LIMIT 1");
	$check = mysqli_fetch_array($checkLogin);
	$salt = substr($check['hash'], 0, 64);
	$tryPass = $salt . hash('sha256', $salt . $password);
		
	echo "<p>" . $check['hash'] . "<br />" . $tryPass . "</p>\n";
	
    if($check['hash'] == $tryPass)
    {        
        $_SESSION['user'] = $username;
        $_SESSION['loggedIn'] = 1;

		header('Location:index.php?p=administration');
    }
    else
    {
        echo "<p>Sorry, your account could not be found. Please <a href=\"index.php\">click here to try again</a>.</p>";
    }
}
else
{
	echo '<form action="#" method="post" name="loginForm" id="loginForm">
				<label for="username">Username:</label><input type="text" name="lUser" id="lUsername" /> \'admin\'<br />
				<label for="password">Password:</label><input type="password" name="lPass" id="lPassword" /> \'root\'<br />
				<input type="submit" name="login" id="login" value="Login" />
			</form>' . "\n";
}
?>