<?php
	require 'PHP/CourseController.php';
	$courseController = new CourseController();
	$courseTables = "";
	if(!empty($_POST)) {
		$year = isset($_POST['year']) ? $_POST['year'] : NULL;
		$semester = isset($_POST['semester']) ? $_POST['semester'] : NULL;
		$department = isset($_POST['department']) ? $_POST['department'] : NULL;
		$course = isset($_POST['course']) ? $_POST['course'] : NULL;
		$professor = isset($_POST['professor']) ? $_POST['professor'] : NULL;
		$minrating = isset($_POST['minrating']) ? $_POST['minrating'] : NULL;
		$maxrating = isset($_POST['maxrating']) ? $_POST['maxrating'] : NULL;
		$courseTables = $courseController->CreateCourse($year, $semester, $department, $course, $professor, $minrating, $maxrating);
	}
	$title = 'Course overview';
	$contentCourse = $courseController->CreateCourseList();
	$contentDepartment = $courseController->CreateDepartmentList();
	$contentProfessor = $courseController->CreateProfessorList();
	include 'index.php';
?>
