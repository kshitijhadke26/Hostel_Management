<?php 
session_start();

if(!isset($_SESSION['examineeSession']['examineenakalogin']) == true) header("location:index.php");


 ?>
<?php include("conn.php"); ?>
<!-- MAO NI ANG HEADER -->
<?php include("includes/header.php"); ?>      

<!-- UI THEME DIRI -->
<?php include("includes/ui-theme.php"); ?>

<div class="app-main">
<!-- sidebar diri  -->
<?php include("includes/sidebar.php"); ?>



<!-- Condition If unza nga page gi click -->
<?php 
   @$page = $_GET['page'];


   if($page != '')
   {
     if($page == "exam")
     {
       include("pages/exam.php");
     }
     else if($page == "result")
     {
       include("pages/result.php");
     }
     else if($page == "myscores")
     {
       include("pages/myscores.php");
     }
     
   }
   // Else ang home nga page mo display
   else
   {
     include("pages/home.php"); 
   }


 ?> 
<html>
  <body>
  <div style="background: rgb(191,189,231);
background: linear-gradient(90deg, rgba(191,189,231,1) 0%, rgba(192,192,244,1) 37%, rgba(151,213,226,1) 100%);">
  <pre>
    
  <h1><b>  Dashboard<b></h1>
    <center>
    <h3 class="page-title-subheading">Welcome to Online Exam Management System.</h3>
    <br>
    <img src="img.jpeg" alt="exam img" style="width:500px;height:200px;">
  </pre>
  </div>
  </body>
</html>

<!-- MAO NI IYA FOOTER -->
<?php include("includes/footer.php"); ?>

<?php include("includes/modals.php"); ?>


