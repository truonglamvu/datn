$(document).ready(function() {
	// $('#password').keyup(function() {
	// $('#result').html(checkStrength($('#password').val()))
	// })
	// function checkStrength(password) {
	// 	var strength = 0
	// 	if (password.length < 6) {
	// 		$('#result').removeClass()
	// 		$('#result').addClass('short')
	// 		return 'Too short'
	// 	}
	// 	if (password.length > 7) strength += 1
	// 	if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
	// 	if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
	// 	if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
	// 	if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
	// 	if (strength < 2) {
	// 		$('#result').removeClass()
	// 		$('#result').addClass('weak')
	// 		return 'Weak'
	// 	}	 
	// 	else if (strength == 2) {
	// 		$('#result').removeClass()
	// 		$('#result').addClass('good')
	// 		return 'Good'
	// 	} 
	// 	else {
	// 		$('#result').removeClass()
	// 		$('#result').addClass('strong')
	// 		return 'Strong'
	// 	}
	// }
	
	// $('input[type=password]').keyup(function() {
 	//    var pswd = $(this).val();
	//    //validate the length
	//    if ( pswd.length < 6 ) {
	// 	    $('#length').removeClass('valid').addClass('invalid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	} else {
	// 	    $('#length').removeClass('invalid').addClass('valid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	}
	// 	//validate letter
	// 	if ( pswd.match(/[A-z]/) ) {
	// 	    $('#letter').removeClass('invalid').addClass('valid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	} else {
	// 	    $('#letter').removeClass('valid').addClass('invalid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	}

	// 	//validate capital letter
	// 	if ( pswd.match(/[A-Z]/) ) {
	// 	    $('#capital').removeClass('invalid').addClass('valid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	} else {
	// 	    $('#capital').removeClass('valid').addClass('invalid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	}

	// 	//validate number
	// 	if ( pswd.match(/\d/) ) {
	// 	    $('#number').removeClass('invalid').addClass('valid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	} else {
	// 	    $('#number').removeClass('valid').addClass('invalid').find('.fa').removeClass('fa-check').addClass('fa-times');
	// 	}
	// }).focus(function() {
	//     $('#pswd_info').show();
	// }).blur(function() {
	//     $('#pswd_info').hide();
	// });
	$('#pwdMeter').hide();
	$("#pswd").on('keyup',function(){
		$('#pwdMeter').show();
		$("#pswd").pwdMeter();
	});
	
});