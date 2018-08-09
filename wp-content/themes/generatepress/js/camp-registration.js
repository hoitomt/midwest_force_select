function fetchTransactionDetails() {
	var transactionDetails = {};

	var campName 	= jQuery('input[name=camp_name]').val();
	var parentName = jQuery('input[name=parent_name]').val();
	var participantName = jQuery('input[name=participant_name]').val();
	var registrationFee = jQuery('input[name=registration_fee]').val();
	var playerDetails = parentName + ' - ' + participantName + " - " + campName;

	transactionDetails.camp_name = campName;
	transactionDetails.parent_name = parentName;
	transactionDetails.participant_name = participantName;
	transactionDetails.registration_fee = registrationFee;
	transactionDetails.amount = registrationFee * 100;
	transactionDetails.email_address = getEmailAddress();
	transactionDetails.mailing_address = jQuery('input[name=mailing_address]').val();
	transactionDetails.mailing_city = jQuery('input[name=mailing_city]').val();
	transactionDetails.mailing_state = jQuery('input[name=mailing_state]').val();
	transactionDetails.mailing_zip_code = jQuery('input[name=mailing_zip_code]').val();
	transactionDetails.session = jQuery('input[name=session]').val();
	transactionDetails.t_shirt_size = jQuery('input[name=t_shirt_size]').val();
	transactionDetails.graduation_year = Form.determineGraduationYear();

	transactionDetails.text = playerDetails + ' ($' + registrationFee + ')';
	return transactionDetails;
}

function getEmailAddress() {
  return jQuery('input[name=email_address]').val();
}

function persistFormData() {
	var $form = $("form.form-js");
	var formData = Form.buildFormObject($form);
	jQuery.post("/camp-registration.php", {"form_data": formData}, function(data) {
		console.log("Successful Form Persistance", data);
		window.location = "http://www.midwestforceselect.com/";
	})
	.fail(function() {
		console.log("Failed Form Persistance");
	});
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
	"customer_description": transactionDetails.participant_name
    }
    jQuery.post("/stripe-non-profit-charge.php", chargeData, function(){
    	alert("Thank you for registering " + transactionDetails.participant_name + "! You will receive a receipt via email.");
    	persistFormData();
    });
  }
});

// Close Checkout on page navigation:
window.addEventListener('popstate', function() {
  handler.close();
});


jQuery(function() {
	console.log("Add Camp Registration");
	jQuery('#registrationButton').on('click', function(e) {
  		// Open Checkout with further options:
		var transactionDetails = fetchTransactionDetails();
		if(transactionDetails.parent_name.length == 0) {
			alert("Please specify a Parent Name");
			return null;
		}
		if(transactionDetails.participant_name.length == 0) {
			alert("Please specify a Participant Name");
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
		e.preventDefault();
	});
});
