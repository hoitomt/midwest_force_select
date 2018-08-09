function fetchTransactionDetails() {
	var transactionDetails = {text: "", amount: 0, playerName: "", parentName: "", teamName: "", registrationFee: 0};

	var parentName = jQuery('input#parent-name').val();
	var playerName = jQuery('input#player-name').val();
	var teamName = jQuery("#jsTeamSelect").find(":selected").text();
	var registrationFee = jQuery('input#registration-fee').val();
	var playerDetails = parentName + ' - ' + playerName + " - " + teamName;

	transactionDetails.parentName = parentName;
	transactionDetails.playerName = playerName;
	transactionDetails.teamName = teamName;
	transactionDetails.registrationFee = registrationFee
	transactionDetails.amount = registrationFee * 100;
	transactionDetails.text = playerDetails + ' ($' + registrationFee + ')';
	return transactionDetails;
}

var handler = StripeCheckout.configure({
  key: '<pk_live_key>',
  image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
  locale: 'auto',
  token: function(token) {
    // You can access the token ID with `token.id`.
    // Get the token ID to your server-side code for use.
    transactionDetails = fetchTransactionDetails();
    var chargeData = {
	"stripeToken": token.id,
	"email": token.email,
	"registration_fee": transactionDetails.amount,
	"transaction_description": transactionDetails.text,
	"customer_description": transactionDetails.playerName
    }
    jQuery.post("/stripe-charge.php", chargeData, function(){
    	alert("Thank you for registering " + transactionDetails.playerName + "! You will receive a receipt via email.");
    	location.reload();
    });
  }
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});


jQuery(function() {
	jQuery('#registrationButton').on('click', function(e) {
  		// Open Checkout with further options:
		var transactionDetails = fetchTransactionDetails();
		if(transactionDetails.parentName.length == 0) {
			alert("Please specify a Parent Name");
			return null;
		}
		if(transactionDetails.teamName.length == 0) {
			alert("Please specify a Team");
			return null;
		}
		if(transactionDetails.playerName.length == 0) {
			alert("Please specify a Player Name");
			return null;
		}
		if(transactionDetails.amount == 0) {
			alert("Please specify an Amount to Be Paid");
			return null;
		}
		console.log("selectedValue:", transactionDetails);
  		handler.open({
    			name: 'Midwest Force Select',
    			description: transactionDetails.text,
    			amount: transactionDetails.amount,
    			image: "https://www.midwestforceselect.com/wp-content/uploads/2016/06/Logo-Midwest-FORCE-Black-Text-512_mod.png"
  		});
		e.preventDefault();
	});
});
