<?php
$query = mysqli_query($conn, "SELECT uID, file,warned FROM uploads WHERE p_p = '0'");
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
?>