<?php
require_once('./stripe-php-4.3.0/init.php');

$stripe = array(
  "secret_key"      => "<secret_key>",
  "publishable_key" => "<pk_key>"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
