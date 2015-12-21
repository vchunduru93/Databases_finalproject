<?php 
require ("CourseModel.php");

class CourseController {
	
	function CreateDepartmentList() {
        $courseModel = new CourseModel();
        $result = "<select name='department[]' id='department_select' multiple='multiple' style='width: 100%;'>"
						.$this->CreateOptionValues($courseModel->getDepartments()).
                	"</select>";
        return $result;
    }
	
	function CreateCourseList() {
        $courseModel = new CourseModel();
        $result = "<select name='course[]' id='course_select' multiple='multiple' style='width: 100%;'>"
					.$this->CreateOptionValues($courseModel->getCourses()).
                "</select>";
        return $result;
    }
	
	function CreateProfessorList() {
        $courseModel = new CourseModel();
        $result = "<select name='professor[]' id='professor_select' multiple='multiple' style='width: 100%;'>" 
					.$this->CreateOptionValues($courseModel->getProfessors()).
                "</select>";
        return $result;
    }
	
	function CreateOptionValues(array $valueArray) {
        $result = "";

        foreach ($valueArray as $value) {
            $result = $result . "<option value='$value'>$value</option>";
        }

        return $result;
    }
	
	function CreateCourse($year, $semester, $department, $courseName, $professor, $minrating, $maxrating)
    {
        $courseModel = new CourseModel();
        $courseArray = $courseModel->getCourse($year, $semester, $department, $courseName, $professor, $minrating, $maxrating);
        $result = "<table class = 'courseTable table'><tr>
                            <th width = '75px' >Year: </th>
                            <th>Semester: </th>
                            <th>Department: </th>
                            <th>Course Name: </th>
                            <th>Professor: </th>
                            <th>Rating: </th>
                        </tr>";
        foreach ($courseArray as $key => $course) 
        {
            $result = $result .
                    "
                        
                        <tr>
                            <td>$course->year</td>
                            <td>$course->semester</td>
                            <td>$course->department</td>
                            <td>$course->courseName</td>
                            <td>$course->professor</td>
                            <td>$course->rating</td>
                        </tr>
						<tr><td></td>
							<th>Summary: </th>
                            <td colspan='3'>$course->summary</td>
						</tr>";
        }
		$result .= "</table>";
        return $result;
        
    }
}
?>
