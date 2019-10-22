'use strict';
import validator from 'validator';
import isEmpty from 'lodash/isEmpty';

export function LoginFormValidate(data) {
	let errors = {};
	if(!validator.isEmail(data.email)){
		errors.email = "Địa chỉ email không hợp lệ !";
	}

	if(validator.isEmpty(data.password)){
		errors.password = "Mật khẩu không được để trống";
	}
	return {
		errors,
		isValid:isEmpty(errors)
	}
}


export function createUserFormValidate(data){
	let errors = {};

	if(!validator.isEmail(data.email)){
		errors.email = "Địa chỉ email không hợp lệ !";
	}
}