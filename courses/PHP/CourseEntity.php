<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Course Entity</title>
</head>

<body>
<?php
class CourseEntity {
	public $year;
	public $semester;
	public $department;
	public $courseName;
	public $professor;
	public $rating;
	public $summary;	
	
	function CourseEntity($year, $semester, $department, $courseName, $professor, $rating, $summary) {
		$this->year = $year;
		$this->semester = $semester;
		$this->department = $department;
		$this->courseName = $courseName;
		$this->professor = $professor;
		$this->rating = $rating;
		$this->summary = $summary;
	}
}

?>
</body>
</html>