<?php
include('../includes/config.php');
if(isset($_POST['rowid'])){


	$id =$_POST['rowid'];
	$query="SELECT * FROM `tblparks` WHERE id =?";
	$statementA = $dbh->prepare($query);
	$statementA->execute([$id]);
	$count->rowCount($statementA);
	if($count>=1) {
		$row1 = $statementA->fetch(PDO::FETCH_OBJ)
		?>
		<h5><?php echo $row1['name'] ;?></h5>
		<p><?php echo $row1['descriptions'];?></p>
	<?php	
	}
}

?>
