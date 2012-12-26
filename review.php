<?php
if(isset($_SESSION['loggedIn']) && isset($_SESSION['user']))
{
	if($_GET['ax'] == 'clear')
	{
		if(mysqli_query($conn, "DELETE FROM warnings WHERE wID = '". $_GET['review'] ."'"))
		{
			mysqli_query($conn, "UPDATE uploads SET warned = '0' WHERE uid = '". $_GET['review'] ."'");
			header('Location: index.php?p=administration');
		}
		else
		{
			echo '<p>Unable to clear warnings!</p>';
		}
	}
	elseif($_GET['ax'] == 'delete')
	{
		if(mysqli_query($conn, "DELETE FROM warnings WHERE wID = '". $_GET['review'] ."'"))
		{
			if(mysqli_query($conn, "DELETE FROM uploads WHERE uID = '". $_GET['review'] ."'"))
			{
				$f = $_GET['n'];
				$d = 'uploads/';
				$fil = $d.$f;
				
				if($dh = opendir($d))
				{
					while(($f = readdir($dh))!== false)
					{
						if(file_exists($fil) && !is_dir($fil)) unlink($fil);
					}
					closedir($dh);
				}
			}
			else
			{
				echo '<p>Unable to clear upload!</p>';
			}
		}
		else
		{
			echo '<p>Unable to clear warnings!</p>';
		}
	}
	else
	{
		header('Location: index.php');
	}
}
?>