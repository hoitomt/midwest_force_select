<?php
require_once('./stripe-php-4.3.0/init.php');

$stripe = array(
  "secret_key"      => "<sk_test_key>",
  "publishable_key" => "<pk_test_key>"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
