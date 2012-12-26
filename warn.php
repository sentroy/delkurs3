<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo '<form action="" method="post">
				<p><label for="file">Report image</label></p>
				<p><input name="file" readonly size="64" type="text" value="'. $_GET['warn'] .'" /></p>
				<p><input maxlength="255" name="warning" onkeyup="countLength()" size="64" id="w" type="text" /></p>
				<p><span id="y">0</span> of 255</p>
				<p><input type="submit" name="submit" value="Send report" /></p>	
			</form>
			<script>
				var x;
				function countLength()
				{
					x = document.getElementById("w").value;
					document.getElementById("y").innerHTML = x.length;
				}
			</script>' . "\n";
}
else
{
	$query = mysqli_query($conn, "SELECT uID FROM uploads WHERE file = '". $_POST['file'] ."'");
	$result = mysqli_fetch_assoc($query);
	if(mysqli_query($conn, "INSERT INTO warnings (wID, warning) VALUES ('". $result['uID'] ."', '". $_POST['warning'] ."')"))
	{
		mysqli_query($conn, "UPDATE uploads SET warned = '1' WHERE uID = '". $result['uID'] ."'") or die(mysqli_error());
		echo 'The report has been sent!' . "\n";
	}
	else
	{
		echo mysqli_error($conn) . "\n";
	}
}
?>