<?php
require ("CourseEntity.php");

class CourseModel {
	
	function getDepartments() {
		require 'Credentials.php';
		$con = new mysqli($server, $user, $pass, $dbname) or die("Can't connect");
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} 
		$result = $con->query("SELECT dname FROM Department ORDER BY dname") or die(mysql_error());
		$dnames = array();
		while($row = $result->fetch_assoc()) {
			array_push($dnames, $row["dname"]);
		}
		$con->close();
		return $dnames;
	}
	
	function getCourses() {
		require 'Credentials.php';
		$con = new mysqli($server, $user, $pass, $dbname) or die("Can't connect");
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} 
		$result = $con->query("SELECT DISTINCT cname FROM Course ORDER BY cname") or die("query failed");
		$courses = array();
		
		while($row = $result->fetch_assoc()) {
			array_push($courses, $row["cname"]);
		}
		$con->close();
		return $courses;
	}
	
	function getProfessors() {
		require 'Credentials.php';
		$con = new mysqli($server, $user, $pass, $dbname) or die("Can't connect");
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} 
		$result = $con->query("SELECT DISTINCT CONCAT(fname, ' ', lname) AS profName FROM Professor ORDER BY lname") or die(mysql_error());
		$professors = array();
		
		while($row = $result->fetch_assoc()) {
			array_push($professors, $row["profName"]);
		}
		$con->close();
		return $professors;
	}
	
	function getCourse($year, $semester, $department, $courseName, $professor, $minrating, $maxrating) {
		require 'Credentials.php';
		$con = new mysqli($server, $user, $pass, $dbname) or die("Can't connect");
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		$whereclause = "";
		$joinclause = "";
		if(!empty($year) || !empty($semester) || !empty($department) || !empty($courseName) || !empty($professor) || !empty($minrating) || !empty($maxrating)) {
			$whereclause .= "";
			$flag = False;
			if(!empty($year)) {
				$whereclause .= " WHERE year IN (";
				foreach($year as $y) {
					$whereclause .= "'$y',";
				}
				$whereclause = rtrim($whereclause, ",");
				$whereclause .= ")";
				$flag = True;	
			}
			if(!empty($semester)) {
				if($flag) {
					$whereclause .= " AND";
				} else {
					$whereclause .= " WHERE ";
					$flag = True;
				}
				$whereclause .= " semester IN (";
				foreach($semester as $s) {
					$whereclause .= "'$s[0]',";
				}
				$whereclause = rtrim($whereclause, ",");
				$whereclause .= ")";
			}
			if(!empty($department)) {
				$joinclause .= " JOIN Department d ON d.dname IN (";
				foreach($department as $d) {
					$joinclause .= "'$d',";
				}
				$joinclause = rtrim($joinclause, ",");
				$joinclause .= ") AND cc.dno = d.dno ";
			} else {
				$joinclause .= " JOIN Department d ON cc.dno = d.dno ";
			}
			if(!empty($courseName)) {
				$joinclause .= " JOIN Course c ON c.cname IN (";
				foreach($courseName as $c) {
					$joinclause .= "'$c'";
				}
				$joinclause = rtrim($joinclause, ",");
				$joinclause .= ") AND cc.cno = c.cno ";
			} else {
				$joinclause .= " JOIN Course c ON cc.cno = c.cno ";
			}
			if(!empty($professor)) {
				$joinclause .= " JOIN Professor p ON (p.fname + ' ' + p.lname) IN (";
				foreach($professor as $p) {
					$joinclause .= "'$p'";
				}
				$joinclause = rtrim($joinclause, ",");
				$joinclause .= ") AND cc.pid = p.pid ";
			} else {
				$joinclause .= " JOIN Professor p ON cc.pid = p.pid ";
			}
			if(!empty($minrating)) {
				if($flag) {
					$whereclause .= " AND";
				} else {
					$whereclause .= " WHERE ";
					$flag = True;
				}
				$whereclause .= " rating >= '$minrating'";	
			}
			if(!empty($maxrating)) {
				if($flag) {
					$whereclause .= " AND";
				} else {
					$whereclause .= " WHERE ";
				}
				$whereclause .= " rating <= '$maxrating'";	
			}
		}
		$query = "SELECT * FROM Course_instance cc";
		$query .= $joinclause;
		$query .= $whereclause;
		$result = $con->query($query) or die("course query failed");
		$courses = array();
		while($row = $result->fetch_assoc()) {
			$year = $row["year"];
			$semester = $row["semester"];
			$department = $row["dname"];
			$courseName = $row["cname"];
			$professor = $row["fname"] . " " . $row["lname"];
			$rating = $row["rating"];
			$summary = $row["summary"];	
			
			$course = new CourseEntity($year, $semester, $department, $courseName, $professor, $rating, $summary);
			array_push($courses, $course);	
		}
		$con->close();
		return $courses;
	}
	function getAverageCourse($year, $semester, $department, $courseId, $courseName, $professor, $minrating, $maxrating) {
		require 'Credentials.php';
		$con = new mysqli($server, $user, $pass, $dbname) or die("Can't connect");
		if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		}
		
		$whereclause = "";
		if(!empty($year) || !empty($semester) || !empty($department) || !empty($courseName) || !empty($professor) || !empty($minrating) || !empty($maxrating)) {
			$whereclause .= "WHERE";
			$flag = False;
			if(!empty($year)) {
				$whereclause .= " year = '$year'";
				$flag = True;	
			}
			if(!empty($semester)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$flag = true;	
				$whereclause .= " semester = '$semester'";
			}
			if(!empty($department)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$flag = true;
				$whereclause .= " dname = '$department'";	
			}
			if(!empty($courseName)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$flag = true;
				$whereclause .= " cname = '$courseName'";	
			}
			if(!empty($professor)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$flag = true;
				$whereclause .= " professor = '$professor'";	
			}
			if(!empty($minrating)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$flag = true;
				$whereclause .= " rating >= '$minrating'";	
			}
			if(!empty($maxrating)) {
				if($flag) {
					$whereclause .= " AND";
				}
				$whereclause .= " rating <= '$maxrating'";	
			}
		}
		$query = "SELECT * FROM Course_complete";
		$query .= $whereclause;
		$result = $con->query($query) or die(mysql_error());
		$courses = array();
		
		while($row = $result->fetch_assoc()) {
			$year = $row[1];
			$semester = $row[2];
			$department = $row[3];
			$courseId = $row[4];
			$courseName = $row[5];
			$professor = $row[6];
			$rating = $row[7];
			$summary = $row[8];	
			
			$course = new CourseEntity($year, $semester, $department, $courseId, $courseName, $professor, $rating, $summary);
			array_push($courses, $course);	
		}
		$con->close();
		return $courses;
	}
}
?>
