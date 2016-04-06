<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/functions.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php find_selected_page(); //navigation?> 
<?php 
//can't add a new page unless we have a subject as a parent
	if(!$current_subject){
		//subject id was missing or invalid or
		//subject couldn't be found in db
		redirect_to("manage_content.php");
	}
?>

<?php 
if(isset($_POST['submit'])){
	//process the form

	//validations
	$required_fields=array("menu_name", "position", "visible","content");
	validate_presences($required_fields);

	$fields_with_max_lengths=array("menu_name" =>30);
	validate_max_lengths($fields_with_max_lengths);

	if(empty($errors)){
		//perform create

		//make sure you add the subject_id!
		$subject_id=$current_subject["id"];
		$menu_name=mysql_prep($_POST["menu_name"]);
		$position= (int) $_POST["position"];
		$visible= (int) $_POST["visible"];
		//be sure to escape the content
		$content=mysql_prep($_POST["content"]);

		$query="INSERT INTO pages(";
		$query.="subject_id, menu_name, position, visible, content";
		$query.= ") VALUES (";
	    $query.=" {$subject_id} '{$menu_name}',{$position}, {$visible} '{$content}')";
		$query.= ")";
		$result=mysqli_query($connection, $query); //runs the query

		if($result){
		//success
		$_SESSION["message"]="Page created";
		redirect_to("manage_content.php?subject=".urlencode($current_subject["id"]));
	}else{
		//failure
		$_SESSION["message"]="Page creation failed";
		redirect_to("new_subject.php");
	}
	
	}else{
		//this is probably a GET request
	redirect_to("new_subject.php");
	}
	

	}
?>
<?php $layout_context ="admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<?php echo navigation($current_subject, $current_page); ?>
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>

		<h2>Create Page</h2>
		<form action="new_page.php?subject=<?php echo urlencode($current_subject["id"]); ?>" method="post">
			<p>Menu Name:
			<input type="text" name="menu_name" value="" />
			</p>
			<select name="position">
			<?php 
			$page_set = find_pages_for_subject($current_subject["id"], false);  //sql qry to count subj from db
			$page_count=mysqli_num_rows($page_set);
				for($count=1; $count <= ($page_count +1); $count++){
					echo "<option value=\"{$count}\">{$count}</option>";
				}
			?> 		
			</select>
			<p>Visible:
			<input type="radio" name="visible" value="0"/> No
			&nbsp;
			<input type="radio" name="visible" value="1"/> Yes
			</p>
			<p>Content: <br />
				<textarea name="content" rows="20" cols="80"></textarea>
			</p>
			<input type="submit" name="submit" value="Create page" />
		</form>
		<br />
		<a href="manage_content.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Cancel</a>
		</div>
		</div>
	<?php include("../includes/layouts/footer.php"); ?>     