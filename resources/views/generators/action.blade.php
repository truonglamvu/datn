'use strict';
/**
 *
 * {{$ClassName}} Action
 *
 */
import NProgress from 'nprogress';
import { 
	{{strtoupper($ClassName)}}_CREATE,
	{{strtoupper($ClassName)}}_UPDATE,
	{{strtoupper($ClassName)}}_DELETE,
	{{strtoupper($ClassName)}}_ERROR
} from './{{$ClassName}}Types';


/**
 *
 * {{$ClassName}} errorHandler Action
 *
 */



export function errorHandler(dispatch, error, type) {
    let errorMessage = '';
    if (error.data.error) {
        errorMessage = error.data.error;
    } else if (error.data) {
        errorMessage = error.data;
    } else {
        errorMessage = error;
    }
    if (error.status === 401) {
        dispatch({
            type: type,
            payload: 'Sai tài khoản hoặc mật khẩu',
            isLoading: false
        });
        logoutUser();
    } else {
        dispatch({
            type: type,
            payload: errorMessage,
            isLoading: false
        });
    }
}




/**
 *
 * {{$ClassName}} Insert Action
 *
 */

export function {{$ClassName}}Create() {
    return function(dispatch) {
        NProgress.start();
        api.post('{{$uri}}').then((response) => {
            dispatch({ type: {{strtoupper($ClassName)}}_CREATE, payload: response.data });
        }).catch((error) => {
            errorHandler(dispatch, error.response, {{strtoupper($ClassName)}}_ERROR);
        })
    }
}

 /**
 *
 * {{$ClassName}} Update Action
 *
 */

export function {{$ClassName}}Update() {
    return function(dispatch) {
        NProgress.start();
        api.post('{{$uri}}/$`id`',{}).then((response) => {
            dispatch({ type: {{strtoupper($ClassName)}}_UPDATE, payload: response.data });
        }).catch((error) => {
            errorHandler(dispatch, error.response, {{strtoupper($ClassName)}}_ERROR);
        })
    }
}



 /**
 *
 * {{$ClassName}} Delete Action
 *
 */

 export function {{$ClassName}}Delete() {
    return function(dispatch) {
        NProgress.start();
        api.delete('{{$uri}}/$`id`',{}).then((response) => {
            dispatch({ type: {{strtoupper($ClassName)}}_DELETE, payload: response.data });
        }).catch((error) => {
            errorHandler(dispatch, error.response, {{strtoupper($ClassName)}}_ERROR);
        })
    }
}