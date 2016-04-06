<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php find_selected_page(); //navigation?> 

<?php 
	$admin=find_admin_by_id($_GET["id"]); //find the page
	if(!$admin){ 
		redirect_to("manage_admins.php");
		}

	$id=$admin["id"];
	$query="DELETE FROM admins WHERE id= {$id} LIMIT 1";
	$result=mysqli_query($connection, $query); 

	if($result && mysqli_affected_rows($connection==1)){
		//success
			$_SESSION["message"]="admin deleted";
			redirect_to("manage_admins.php");
	}else{
		//failure
			$_SESSION["message"]="admin deletion failed";
			redirect_to("manage_admins.php");
	}
?>
