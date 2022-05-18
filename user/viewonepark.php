<?php
include('../includes/config.php');
if(isset($_POST['rowid'])){


	$id =$_POST['rowid'];
	$query="SELECT * FROM `tblparks` WHERE id =?";
	$statementA = $dbh->prepare($query);
	$statementA->execute([$id]);
	$count =$statementA->rowCount();
	if($count>=1) {
		$row1 = $statementA->fetch(PDO::FETCH_OBJ)
		?>
		<h5 class="text-info"><?php echo $row1->name ;?></h5>
		<p><?php echo 'More :'. $row1->descriptions;?></p>
		<p><?php echo 'Location: ' .$row1->location;?></p>
	<?php	
	}
}

?>
