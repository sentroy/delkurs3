<?php
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
	echo '<form action="index.php" id="indexForm" enctype="multipart/form-data" method="post">
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
				<p><label for="name">Upload a file!</label><br /></p>
				<input id="file" size="32" type="file" name="file" value="..." onChange="formFileValue()" required />
				<p><input name="p_p" id="ppfalse" checked type="radio" value="0" /><label for="ppfalse">Public</label>
				<input name="p_p" id="pptrue" type="radio" value="1" /><label for="pptrue">Private</label></p>
				<p><input type="submit" id="startUpload" name="submit" value="Start upload" /></p>
		</form>
			<script>
				var x = document.getElementById("file");
				var y = document.getElementById("tempTestInput");
				function formFiled()
				{
					x.click();
				}
				
				function formFileValue()
				{
					y.value = x.value;
				}
			</script>' . "\n";
}
else
{
	$uploadFolder = "uploads/";
	$file = explode("/",$_FILES['file']['type']);
	
	if(isset($_FILES['file']))
	{
		if(!$_POST['p_p'])
		{
			$target_path = $uploadFolder . (round(time()/2) + mt_rand(111111,222222222)) . '_' . str_replace(" ", "", basename($_FILES['file']['name']));
		}
		else
		{
			$target_path = $uploadFolder . substr(md5(uniqid(mt_rand(), true)), 0, 9) . '_' . str_replace(" ", "", basename($_FILES['file']['name']));
		}

		if(preg_match('/image\//i', $_FILES['file']['type']))
		{
			if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path))
			{
				if(mysqli_query($conn, "INSERT INTO uploads (file, p_p, warned) VALUES ('". basename($target_path) ."', '". $_POST['p_p'] ."', 0)"))
				{
					echo '<input type="text" onfocus="document.getElementById(\"uploadedFileField\").select()" size="64" id="uploadedFileField" value="http://' . $_SERVER["SERVER_NAME"] . '/' . basename($target_path) . '" />' . "\n<br />\n";
				}
				else
				{
					echo mysqli_error($conn) . "\n";
				}
				
				$temp = explode("/", $target_path);
				echo 'The file <a href="?p=view&view="' . $temp[1] . '" />"' . basename($_FILES['file']['name']). '"</a> has been uploaded.' . "\n";
			}
			else
			{
				echo 'There was an error uploading the file, please try again!' . "\n";
			}
		}
		else
		{
			echo 'This is not an image, please make sure it has the correct extension.';
		}
		unset($_FILES['file']);
	}
}
?>