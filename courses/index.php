<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>JHU Course Evaluations</title>

<!-- Bootstrap -->
<link href="Content\Bootstrap\bootstrap.min.css" rel="stylesheet">
<link href="Content\Bootstrap\select2.min.css" rel="stylesheet">
<link href="Content\Bootstrap\bootstrap-multiselect.css" rel="stylesheet">
<style type="text/css">
body,td,th {
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
	color: #000000;
}
body {
	background-color: #FDFEFE;
	background-image: url();
	background-repeat: no-repeat;
	background-position: center 0%;
}
</style>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#">JHU Course Evaluations</a></div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<center>
	<img src="Content/Images/Gilman.jpg" alt="" width="1200" height="509" class="img-responsive"/>
</center>

<div class="container">
  <hr>
<form action = '' method = 'post'>
<div class="row" >
    <div class="text-justify col-sm-4 col-lg-3 col-md-4 col-xs-12" style="text-align: center;">
    <select name="year[]" id="year_select" name="year" multiple="true">
      <option select disabled label="Year(s)">year</option>
  	  <option value="2015">2015</option>
      <option value="2014">2014</option>
      <option value="2013">2013</option>
      <option value="2012">2012</option>
      <option value="2011">2011</option>
    </select>
    <select name="semester[]" id="semester_select" name="year" multiple="true">
      <option select disabled label="Semester">semester</option>
      <option value="Fall">Fall</option>
      <option value="Spring">Spring</option>
    </select>
    </div>
    <div class="col-sm-4 text-justify col-lg-6 col-md-4 col-xs-12" style="display:inline-block; text-align: center; ">
         <?php echo $contentDepartment; ?>
		 <?php echo $contentCourse; ?>
         <?php echo $contentProfessor; ?>
        <input type="submit" id="search" value="Search..." class="btn" />
    </div>
  <div class="col-sm-4 text-justify col-lg-3 col-lg-offset-0 col-xs-12" style="text-align: center;">
    <span>Rating:</span><br/>
    <input name="minrating" id="minimum_rating" type="number" placeholder="Minimum (0-5):" step="any" min="0" max="5"><br>
    <input name="maxrating" id="maximum_rating" type="number" placeholder="Maximum (0-5):" step="any" min="0" max="5"> 
  </div>
  <br>
</div>
</form>
<div id="content_area">
<?php echo $courseTables; ?>
</div>
<hr>
<div class="row">
    <div class="text-center col-md-6 col-md-offset-3 col-lg-offset-3">
      <h4>Vamsi C· Venus S</h4>
      <p>Databases Final Project&middot; Fall 2015</p>
    </div>
  </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="Scripts/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="Scripts/bootstrap.min.js"></script>
<script src="Scripts/bootstrap-multiselect.js"></script>
<script src="Scripts/select2.full.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#department_select').select2({
			placeholder: "Department"
		});
		$('#course_select').select2({
			placeholder: "Course"
		});
		$('#professor_select').select2({
			placeholder: "Professor"
		});
		$('#search').click(function () {
			var year = $('#year_select').val();
			var semester = $('#semester_select').val();
			var department = $('#department_select').val();
			var course = $('#course_select').val();
			var professor = $('#professor_select').val();
			var minimumRating = $('#minimum_rating').val();
			var maximumRating = $('#maximum_rating').val();
			console.log(year + ", " + semester + ", " + department + ", " + course + ", " + course + ", " + professor + ", " + minimumRating + ", " + maximumRating + "."); 
		});
	});
</script>
</div>
</body>
</html>