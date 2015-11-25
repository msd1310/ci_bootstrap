<html>
<head>
<title>Formitable Demo</title>
<style type="text/css"> @import url("../Formitable_style.css"); </style>
</head>

<body link="#777777" alink="#555555" vlink="#777777">

<center>

<div class="boxed">
<h3>Formitable Demo</h3>
The following form was automatically created from a MySQL database table using the
Formitable PHP class. This example demonstrates some of the core functionality.
More examples are available on the
<a href="https://sourceforge.net/projects/formitable/">Formitable homepage</a>.
See the <a href="../Documentation.html">Documentation</a> for more information.
<br><br>
Don't forget to try <a href="<?=$_SERVER['PHP_SELF'];?>?ID=1">retrieving a record</a>.
</div>

<div class="boxed">
<?php
/*** change the following variables ***/
$user = "username";
$pass = "password";
$DB = "database";

//include class, create new Formitable, set primary key field name
include("../Formitable.class.php");
$newForm = new Formitable( @mysql_connect("localhost",$user,$pass),$DB,"formitable_demo" );
$newForm->setPrimaryKey("ID");
$newForm->setEncryptionKey("g00D_3nCr4p7");

//hide primary key field, force a few field types
$newForm->hideField("ID");
$newForm->forceTypes(array("foods","day_of_week"),array("checkbox","radio"));

//get data pairs from another table
$newForm->normalizedField("toon","formitable_toons","ID","name","pkey ASC");

//set custom field labels
$newForm->labelFields( array("f_name","l_name","description","pets","foods","color","day_of_week","b_day","toon"),
						array("First Name","Last Name","About Yourself","Your Pets","Favorite Foods","Favorite Color","Favorite Day","Your Birthday","Favorite Cartoon") );

//set some default values
$newForm->setDefaultValue("pets","Dog");
$newForm->setDefaultValue("color","Blue");
$newForm->setDefaultValue("toon","3");
$newForm->setDefaultValue("foods","pizza,salad");
$newForm->setDefaultValue("day_of_week",date("l"));

//set up regular expressions for field validation
$newForm->registerValidation("required",".+","Input is required.");

//set up a field for validation using regex above
$newForm->validateField("f_name","required");

//set validation feedback mode
$newForm->feedback="both";

//retrieve a record for update if GET var set
if( isset($_GET['ID']) ) $newForm->getRecord($_GET['ID']);

//call submit method if form has been submitted
if( !isset($_POST['submit']) ||
	(isset($_POST['submit']) && $newForm->submitForm() == -1) ){ $newForm->printForm(); }

?>

</div>

</center>
</body></html>