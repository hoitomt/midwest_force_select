<?php
  require_once('./stripe-dev-config.php');

  $token  = $_POST['stripeToken'];
  $email = $_POST['email'];
  $amount = $_POST['registration_fee'];
  $transaction_description = $_POST['transaction_description'];
  $customer_description = $_POST['customer_description'];
  
  $customer = \Stripe\Customer::create(array(
      'email'   => $email,
      'source'  => $token,
      'description' => $customer_description
  ));

  $charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => $amount,
      'currency' => 'usd',
      'description' => $transaction_description,
      'receipt_email' => $email
  ));
?>