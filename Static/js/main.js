
// variable
var bool_form_password = false;
var bool_form_email = false;
var bool_form_username = false;
var api = "API/api.php"; // api


$(document).ready(function(){
	// var location = window.location.pathname;
	if (typeof page !== 'undefined') {
		
		switch(page){
			case "inscription":
			action_inscription();
			break;
		}
	}

	$('.add-message').on('mousedown', '.poster',function(e){
		if(e.which==3)
			return;
		data = {
			"action": "post_message",
			"parent": null,
			"subject": null,
			"message": null,
		};
		data.parent = $(this).data('parent');
		data.subject = $(this).data('subject');
		data.message = $(this).parent().find('.new-message').val();
		
		$.post(api, data)
		.success(function(data){

		})
		.fail(function(data){

		});
	});
});


// action inscription
function action_inscription(){
	console.log("banana");
	// gestion du champ comfirmation mdp
	function valid_password(){
		var pass = $('#password').val();
		var pass_c = $('#password_confirmed').val();
		var len = pass.length;
		if(pass_c == pass && len >= 6){
			if(!bool_form_password) bool_form_password = true;
		}else{
			console.log(pass, len, bool_form_password);
			if(bool_form_password) bool_form_password = false;
		}
	}

	// gestion du champ username
	function valid_username(){
		var username = $('#username').val().trim();
		var len = username.length;
		if(len > 4){
			$.post(api, {
				"action":"valid_username",
				"username": username
			})
			.done(function(data){
				if(username == "" && !(data.valid)){
					if(bool_form_username) bool_form_username = false;
				}else{
					if(!bool_form_username) bool_form_username = true;
				}
			})
			.fail(function(e){
				console.log(e);
			});
		}
	}

	//gestion du champ email
	function valid_email_form(){
		if(!valid_email($('#email').val().trim())){
			if(bool_form_email) bool_form_email = false;
		}else{
			if(!bool_form_email) bool_form_email = true;	
		}
	}

	$('input').on('change keyup', function(){

		if($(this).is('#password_confirmed')){
			valid_password();
		}

		if($(this).is('#username')){
			valid_username();
		}

		if($(this).is('#email')){
			valid_email_form();
		}

		// if condition is validate
		if(bool_form_password && bool_form_username && bool_form_email){
			if($("#valid_inscription").hasClass('hide')){
				$("#valid_inscription").removeClass('hide');
			}
		}else{
			if(!$("#valid_inscription").hasClass('hide')){
				$("#valid_inscription").addClass('hide');
			}
		}
	});

	$('#valid_inscription').on('mousedown', function(e){
		if(e.which == 3)
				return;

		var data = {"action": "signup"};

		if($('#name').val().trim() != "")
			data['name'] = $('#name').val().trim();
		if(bool_form_email)
			data['email'] = $('#email').val();
		if(bool_form_username)
			data['username'] = $('#username').val();
		if(bool_form_password)
			data['password'] = $('#password').val();

		// On s'inscrit
		if(bool_form_password && bool_form_username && bool_form_email){
			$.post(api, data)
			.done(function(data){
				data = JSON.parse(data);
				
				if(data.valid==true){
					login_data = {
						"username_login": $('#username').val(),
						"password_login": $('#password').val()
					}
					$.post("/index.php?page=signin", login_data)
					.success(function(){
						document.location.href= "/index.php?page=signin";
					}).fail(function(){
						console.log('erreur');
					});
				}
			})
			.fail(function(e){
				console.log(e);
			});
		}
	});

	valid_username();
	valid_email_form();
}


// check an email
function valid_email(email){
	var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}