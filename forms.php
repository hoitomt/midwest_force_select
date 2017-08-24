<?php
  include 'database.php';

  $form_data = $_POST['form_data'];
  $camp_name = $form_data['camp_name'];
  
  $pdo = Database::connect();
  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
  
  $stmt = $pdo->prepare("INSERT INTO camp_registrations (camp_name, participant_name, parent_name, email_address, mailing_address, mailing_city, mailing_state, mailing_zip_code, graduation_year) VALUES (:camp_name, :participant_name, :parent_name, :email_address, :mailing_address, :mailing_city, :mailing_state, :mailing_zip_code, :graduation_year)");
  
  $stmt->bindParam(':camp_name', $form_data['camp_name']);
  $stmt->bindParam(':participant_name', $form_data['participant_name']);
  $stmt->bindParam(':parent_name', $form_data['parent_name']);
  $stmt->bindParam(':email_address', $form_data['email_address']);
  $stmt->bindParam(':mailing_address', $form_data['mailing_address']);
  $stmt->bindParam(':mailing_city', $form_data['mailing_city']);
  $stmt->bindParam(':mailing_state', $form_data['mailing_state']);
  $stmt->bindParam(':mailing_zip_code', $form_data['mailing_zip_code']);
  $stmt->bindParam(':graduation_year', $form_data['graduation_year']);

  $persist_status = $stmt->execute();
  
  echo "Success: $persist_status";
  
  Database::disconnect();
?>