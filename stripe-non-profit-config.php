<?php
require_once('./stripe-php-4.3.0/init.php');

$stripe = array(
  "secret_key"      => "<secret_key>",
  "publishable_key" => "<live_key>"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
