<?php

/********************/
/* CALCULATIONS.PHP */
/********************/

function get_student_details($reg_no) {

	$student = array();

	try {
		$connection = getConnection();
		$sqlstmt = "SELECT* FROM SCORES WHERE REG_NO = $reg_no;";
		$results = execute_query($connection, $sqlstmt);
		$connection = NULL;

		$student["name"] = $results[0]["NAME"];
		$student["dept"] = $results[0]["DEPT"];
		$student["score"] = $results[0]["TOTAL_SCORE"];
	
	} catch (PDOException $exception) {
		return NULL;
	}

	return $student;

}

function get_student_information($reg_no) {

	if(!student_exists($reg_no)) {
		return NULL;
	}

	$student = get_student_details($reg_no);

	try {
		$connection = getConnection();
		$sqlstmt = "SELECT (SELECT (COUNT(*)-1) FROM SCORES WHERE TOTAL_SCORE <= ".$student["score"]." AND DEPT = '".$student["dept"]."') / (SELECT COUNT(*) FROM SCORES WHERE DEPT = '".$student["dept"]."') * 100 AS PERCENTILE";
		$results = execute_query($connection, $sqlstmt);
		$connection = NULL;

		$student["percentile"] = $results[0]["PERCENTILE"];
	
	} catch (PDOException $exception) {
		return NULL;
	}

	return $student;

}

print_r(get_student_information("170601021"));

function student_exists($reg_no) {

	try {
		$connection = getConnection();
		$sqlstmt = "SELECT COUNT(*) AS NUM FROM SCORES WHERE REG_NO = $reg_no;";
		$results = execute_query($connection, $sqlstmt);
		$connection = NULL;

		if($results[0]["NUM"] == 0) {
			return false;
		}
		else {
			return true;
		}

	} catch (PDOException $exception) {
		return NULL;
	}

}

?>
