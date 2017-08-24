$ = jQuery;

var graduationYear = {
  '1': '2029',
  '2': '2028', 
  '3': '2027', 
  '4': '2026', 
  '5': '2025', 
  '6': '2024', 
  '7': '2023', 
  '8': '2022', 
  '9': '2021', 
  '10': '2020', 
  '11': '2019', 
  '12': '2018',
}

var Form = {
	init: function() {
	  console.log("Let's Go!");
	  this.listenForFormSubmit();
	},
	determineGraduationYear: function() {
	  var grade = jQuery('select[name=grade]').val();
	  return graduationYear[grade];
	},
	listenForFormSubmit: function() {
	  _this = this;
	  $("form.form-js").submit(function(event) {
	    event.preventDefault();
	    _this.handleFormSubmit(this);
	  })
	},
	handleFormSubmit: function(submittedForm){
	  var formName = $('form.form-js').data("form_name");
	  var formObject = this.buildFormObject(submittedForm)
	  console.log("Form Object", formObject);
	  this.persistForm(formObject);
	},
	buildFormObject: function(submittedForm) {
	  var formFields = $(submittedForm).find(":input");
	  var formObject = {}
	  $(formFields).each(function(index, field){
	  	var input = $(this);
	  	if(input.attr('type') != "submit" && input.attr('name') != "undefined") {
	  		formObject[input.attr('name')] = input.val();
	  	}
	  });
	  formObject['graduation_year'] = this.determineGraduationYear();
	  return formObject;
	},
	persistForm: function(formData) {
	  console.log("Persist Form");
	  $.post("/forms.php", {"form_data": formData}, function(data){
	  	console.log("Data: ", data);
	  })
	  .fail(function(){
	  	console.log("Fail");
	  });
	}
}

$(function(){
	console.log("Init Forms");
	Form.init();
});