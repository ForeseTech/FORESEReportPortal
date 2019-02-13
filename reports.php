<?php

	require 'sql_connections.php';

	$regnumber=$_POST['regnumber'];
	$name = "";
	$dept = "";
	$one= "";
	$two = "";
	$three = "";
	$four = "";
	$five = "";
	$tech = "";
	$percentile = "";

	try{

		$conn = getConn();
		
		//Our sql query which gets both the non-technical and technical questions.
		$sql_query = "SELECT IF(COUNT(*)=1, 'YES', 'NO') AS IF_EXISTS FROM USERS WHERE REGNUMBER='$regnumber';";

		$statement = $conn->query($sql_query);
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);	

		//We generate each question along with the four options.
		foreach($results as $row){
	
			if($row['IF_EXISTS']!="YES"){
				echo "<script>alert('Your registration number does not exist in the database. Please note that you must have written the test and, if you are Option B, you must register with the Placement Cell first.');</script>";	
				echo "<Script>window.location.href='index.html';</script>";
			}

		}

	} catch (PDOException $e){
		echo $e."<br>";
	}

	try{

		$conn = getConn();
		
		//Our sql query which gets both the non-technical and technical questions.
		$sql_query = " SELECT USERS.NAME AS NAME, USERS.DEPARTMENT AS DEPARTMENT, RESULTS.SECTION_ONE AS ONE, RESULTS.SECTION_TWO AS TWO, RESULTS.SECTION_THREE AS THREE, RESULTS.SECTION_FOUR AS FOUR, RESULTS.SECTION_FIVE AS FIVE, RESULTS.SECTION_TECH AS TECHNICAL, RESULTS.TOTAL AS TOTAL, (SELECT COUNT(USERS.REGNUMBER) FROM USERS, RESULTS WHERE USERS.REGNUMBER=RESULTS.REGNUMBER AND USERS.DEPARTMENT=(SELECT DEPARTMENT FROM USERS WHERE REGNUMBER='$regnumber') AND RESULTS.TOTAL < (SELECT TOTAL FROM RESULTS WHERE REGNUMBER='$regnumber'))/(SELECT COUNT(REGNUMBER) FROM USERS WHERE DEPARTMENT=(SELECT DEPARTMENT FROM USERS WHERE REGNUMBER='$regnumber'))*100 AS PERCENTILE FROM USERS, RESULTS WHERE RESULTS.REGNUMBER=USERS.REGNUMBER AND USERS.REGNUMBER='$regnumber'; ";

		$statement = $conn->query($sql_query);
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);	

		//We generate each question along with the four options.
		foreach($results as $row){

			$name = $row['NAME'];
			$dept = $row['DEPARTMENT'];
			$one = $row['ONE'];
			$two = $row['TWO'];
			$three = $row['THREE'];
			$four = $row['FOUR'];
			$five = $row['FIVE'];
			$tech = $row['TECHNICAL'];
			$percentile = $row['PERCENTILE'];

		}

	} catch (PDOException $e){
		echo $e."<br>";
	}

?>
<html>

	<head>
		<title>Your Result | FORESE</title>
		<link href="static/css/reports.css" rel="stylesheet">
		<link rel="icon" href="../students/img/favicon.png">
	</head>

	<body>

		<div class="report-card">

			<strong>Name:</strong> <?php echo $name; ?><br>
			<strong>Department:</strong> <?php echo $dept; ?><br>
			<strong>Registration Number:</strong> <?php echo $regnumber; ?><br>
			<br><br>

			<strong><u>Mock Aptitude Test Results</u></strong><br>
			<br>

			<table>
				<tr>
					<th>Section</th>
					<th>Score (Out of 5)</th>
				</tr>

				<tr>
					<td><b>Word Comparison</b></td>
					<td><b><?php echo $one; ?></b></td>
				</tr>

				<tr>
					<td><b>Sentence Completion</b></td>
					<td><b><?php echo $two; ?></b></td>
				</tr>

				<tr>
					<td><b>Vocabulary</b></td>
					<td><b><?php echo $three; ?></b></td>
				</tr>

				<tr>
					<td><b>Quantity Comparison</b></td>
					<td><b><?php echo $four; ?></b></td>
				</tr>

				<tr>
					<td><b>Quantitative</b></td>
					<td><b><?php echo $five; ?></b></td>
				</tr>

				<tr>
					<td><b>Technical (out of 25)</b></td>
					<td><b><?php echo $tech; ?></b></td>
				</tr>
			</table>

			<br>
	
			<p>He/She has scored more than <strong><?php echo $percentile; ?>%</strong> of students in their department.</p>

			<br>

			<strong>NOTE:</strong><br>

			<ul style="text-align: left;">
				<li>These results <strong><em>must</em></strong> be shown to your interviewer on the day of the Mock Placements.</li><br>
				<li>We recommend you take a <strong>screenshot</strong> of this page and store it in your phone.</li><br>
				<li>Without this report, you will <strong><em>not</em></strong> be allowed to attend your interview.</li><br>
				<li>For more queries, visit <a href="http://www.forese.in/students"> the official FORESE website.</a></li>
			</ul>

		</div>
		
	</body>

</html>
