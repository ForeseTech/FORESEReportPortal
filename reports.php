<?php

	require("src/sql-connections.php");
	require("src/calculations.php");

	$regnumber=$_POST['regnumber'];
	$student = get_student_information($regnumber);

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
					<th>Score (Out of 50)</th>
				</tr>

				<tr>
					<td><b>Your Score</b></td>
					<td><b><?php echo $tech; ?></b></td>
				</tr>
			</table>

			<br>
	
			<p>58 students have attempted the test in the department.<br>Arjun has scored more than <strong><?php echo $percentile; ?>%</strong> of students in their department.<br><br>The candidate was tested on questions from the quantitative, verbal and technical categories. Technical questions counted for 50% of the questions asked to the candidate.</p>

			<br><br><br>

			<strong>NOTE:</strong><br>

			<ul style="text-align: left;">
				<li>These results <strong><em>must</em></strong> be shown to your interviewer on the day of the Mock Placements.</li>
				<li>We recommend you take a <strong>screenshot</strong> of this page and store it in your phone.</li>
				<li>Without this report, you will <strong><em>not</em></strong> be allowed to attend your interview.</li>
				<li>For more queries, visit <a href="http://www.forese.in/students"> the official FORESE website.</a></li>
			</ul>

		</div>
		
	</body>

</html>
