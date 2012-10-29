<style>
.log-container{
	height: 600px;
	width: 98%;
	overflow:auto;
}
</style>


<form action="" method="post">
	<label for="file_destination"> Site Name: </label>
    <input type="text" name="file_destination" />
    <input type="submit" name="submit" value="Create" />
</form>
<?php
echo '<div class="log-container">';	
	if (isset($_POST['file_destination'])) {
			
	function recurse_copy($src,$dst) {
		
		/*copy files to the created file folder*/
		
		$dir = opendir($src);
		
		//check if folder is already existing
		if(!is_dir($dst)) 
		{ 
			@mkdir($dst,0755);
			echo "<br/><br/><h2><b>".$dst."&nbsp;created! <hr/></b></h2>";
		}else{
			echo "<h2><b>".$dst."&nbsp; is already existing, please choose other sitename</b></h2>";
			die();	
		}
		
		
		while(false !== ( $file = readdir($dir)) ) { 
			
			set_time_limit(0);
			if (( $file != '.' ) && ( $file != '..' )) { 
				if ( is_dir($src . '/' . $file) ) { 
					recurse_copy($src . '/' . $file,$dst . '/' . $file); 
					echo $src."/".$file."------>".$dst."/".$file."<br/>";
				} 
				else { 
					copy($src . '/' . $file,$dst . '/' . $file); 
					echo $src."/".$file."------>".$dst."/".$file."<br/>";
				} 
			} 
		} 
		closedir($dir); 
	}
	$basepath = $_SERVER['DOCUMENT_ROOT'];
	$source_url = $basepath."/hobokentest/";
	$desturl = $basepath."/".$_POST['file_destination'];
	$src = $source_url; /*source*/
	$dst = $desturl; /*destination*/
	recurse_copy($src,$dst);
}
echo '</div>';
?>