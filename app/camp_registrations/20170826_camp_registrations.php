<?php
  $db_include = $_SERVER['DOCUMENT_ROOT']."/database.php";
  include($db_include);
  include('camp_registration_functions.php');

  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	$stmt = $pdo->prepare("SELECT * FROM camp_registrations WHERE camp_name = 'August 26th Midwest Force Select'");

	// $result = $stmt->execute();
	$stmt->execute();

	if(!$stmt){
		echo "Execute query error, because: ". print_r($this->pdo->errorInfo(),true);
	} else {
		$file = __DIR__ . '/templates/camp_registrations_row.php';
		$output = '<table>';
		$output.= '<tr>';
		$output.= '<th>id</th>';
		$output.= '<th>camp_name</th>';
		$output.= '<th>participant_name</th>';
		$output.= '<th>parent_name</th>';
		$output.= '<th>email_address</th>';
		$output.= '<th>mailing_address</th>';
		$output.= '<th>mailing_city</th>';
		$output.= '<th>mailing_state</th>';
		$output.= '<th>mailing_zip_code</th>';
		$output.= '<th>t_shirt_size</th>';
		$output.= '<th>age</th>';
		$output.= '<th>graduation_year</th>';
		$output.= '<th>session</th>';
		$output.= '</tr>';

		while ($row = $stmt->fetch())
		{
			$output.= template( $file, $row );
		}
	}
	$output.= '</table>';
	print $output;



  Database::disconnect();
	// print_r($result);
?>
