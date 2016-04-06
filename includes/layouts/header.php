<?php 
if(!isset($layout_context))
	{$layout_context ="public"; }
?>
<!doctype html>
<html>
<head>
	<title>Widget Corps <?php if($layout_context=="admin") {echo "Admin";} ?></title>
</head>
<body>

</body>
</html><!doctype html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="stylesheets/public.css">
</head>
<body>
<div id="header">
	<h1>Widget Corp <?php if($layout_context=="admin") {echo "Admin";} ?></h1>
</div>