<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php find_selected_page(); //navigation?> 

<?php 
	$current_page=find_page_by_id($_GET["page"], false); //find the page
	if(!$current_subject){ // making sure its there in db
		//pagepage id was missing or invalid or
		// page couldn't be found in db
		redirect_to("manage_content.php");
		}

	$id=$current_page["id"];
	$query="DELETE FROM pages WHERE id= {$id} LIMIT 1";
	$result=mysqli_query($connection, $query); 

	if($result && mysqli_affected_rows($connection==1){
		//success
			$_SESSION["message"]="Page deleted";
			redirect_to("manage_content.php");
	}else{
		//failure
			$_SESSION["message"]="Page deletion failed";
			redirect_to("manage_content.php?page={$id}");
	}
?>
