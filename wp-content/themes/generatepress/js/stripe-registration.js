function fetchTransactionDetails() {
	var transactionDetails = {};

	var clubName = jQuery('input[name=club_name]').val();
	var teamName = jQuery('select[name=team_name]').val();
	var registrationFee = jQuery('input[name=registration_fee]').val();

	transactionDetails.club_name = clubName;
	transactionDetails.team_name = teamName;
	transactionDetails.email_address = getEmailAddress();
	transactionDetails.registration_fee = registrationFee;
	transactionDetails.amount = registrationFee * 100;

	transactionDetails.text = clubName + ' ' + teamName  + ' ($' + registrationFee + ')';
	return transactionDetails;
}

function getEmailAddress() {
  return jQuery('input[name=email_address]').val();
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
	"customer_description": transactionDetails.club_name
    }
    jQuery.post("/stripe-dev-charge.php", chargeData, function(){
    	alert("Thank you for registering " + transactionDetails.club_name + " - " + transactionDetails.team_name + "! You will receive a receipt via email.");
	window.location = "http://www.midwestforceselect.com/";
    });
  }
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});


jQuery(function() {
	console.log("Add Tournament Registration");
	jQuery('button.stripe-registration').on('click', function(e) {
		console.log("Submit");
		e.preventDefault();

  		// Open Checkout with further options:
		var transactionDetails = fetchTransactionDetails();
		if(transactionDetails.club_name.length == 0) {
			alert("Please specify a Club Name");
			return null;
		}
		if(transactionDetails.email_address.length == 0) {
			alert("Please specify an Email Address for your receipt");
			return null;
		}
		if(transactionDetails.team_name.length == 0) {
			alert("Please specify a Team");
			return null;
		}
		console.log("selectedValue:", transactionDetails);
  		handler.open({
    			name: 'Midwest Force Select',
    			email: getEmailAddress(),
    			description: transactionDetails.text,
    			amount: transactionDetails.amount,
    			image: "https://www.midwestforceselect.com/wp-content/uploads/2016/06/Logo-Midwest-FORCE-Black-Text-512_mod.png"
  		});
	});
});
