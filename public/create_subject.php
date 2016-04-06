<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>

<?php 
if (isset($_POST['submit'])) {
	//process the form
	//often these are from values in $_POST
	$menu_name= mysql_prep($_POST["menu_name"]);
	$position= (int) $_POST["position"];
	$visible= (int) $_POST["visible"];

	//validations
	$required_fields=array("menu_name", "position", "visible");
	validate_presences($required_fields);

	$fields_with_max_lengths=array("menu_name" => 30);
	validate_max_lengths($fields_with_max_lengths);

	if(!empty($errors)){
		$_SESSION["errors"]= $errors;
		redirect_to("new_subject.php");
	}

	//2. perform database query
	$query="INSERT INTO subjects(";
	$query.=" menu_name, position, visible";
	$query.= ") VALUES (";
    $query.=" '{$menu_name}',{$position}, {$visible})";
	$query.= ")";
	$result=mysqli_query($connection, $query); //runs the query

	//test if there was query error
	if(!$result){
		//success
		$_SESSION["message"]="subject created";
		redirect_to("manage_content.php");
	}else{
		//failure
		$_SESSION["message"]="subject creation failed";
		redirect_to("new_subject.php");
	}
	
	}else{
		//this is probably a GET request
	redirect_to("new_subject.php");
	}
	?>

<?php include("../includes/layouts/footer.php");?>