<?php
$altText = explode("_", $_GET['view'], 2);
$imageSize = getimagesize('uploads/' . $_GET['view']);
$query = mysqli_query($conn, "SELECT * FROM uploads WHERE file = '". $_GET['view'] ."'");
$result = mysqli_fetch_assoc($query);

if($imageSize[0] > 940)
{
	echo '<div style="text-align: center;"><img width="940" alt="'. $altText[1] .'" src="uploads/'. $_GET['view'] .'" /></div>' . "\n";
}
else
{
	echo '<div style="text-align: center;"><img alt="'. $altText[1] .'" src="uploads/'. $_GET['view'] .'" /></div>' . "\n";
}

if($result['warned'] == 1)
{
	if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
	{
		echo '<a href="?p=review&review='. $result['uID'] .'&ax=clear" style="display:inline-block; height:32px;"><img border="0" src="img/allow.png" alt="CLEAR WARNINGS" />(Clear warnings)</a><a href="?p=review&review='. $result['uID'] .'&ax=delete&n='. $result['file'] .'" style="display:inline-block; float:right; height:32px;">(Delete image)<img border="0" src="img/deny.png" alt="DELETE IMAGE" /></a>';
	}
	else
	{
		echo '<div id="imageWarned">This file has been reported, either as illegal or inappropriate.</div>' . "\n";
	}
}
else
{
	echo '<div id="imageWarn"><a href="?p=warn&warn='. $_GET['view'] .'">Is this image illegal or inappropriate? Report it!</a></div>' . "\n";
}
?>