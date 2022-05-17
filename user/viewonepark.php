<?php
include('../includes/config.php');
if(isset($_POST['rowid'])){


	$id = trim($_POST['rowid']);
	$query=mysqli_query($con,"SELECT * FROM `tblparks` WHERE id = '$id'");
	if(mysqli_num_rows($query)>=1) {
		$row1=mysqli_fetch_array($query)
		?>
		<h5><?php echo $row1['name'] ;?></h5>
		<p><?php echo $row1['descriptions'];?></p>
	<?php	
	}
}

?>
