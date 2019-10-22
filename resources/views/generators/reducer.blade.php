'use strict';
import { 
    {{strtoupper($ClassName)}}_CREATE,
    {{strtoupper($ClassName)}}_UPDATE,
    {{strtoupper($ClassName)}}_DELETE,
    {{strtoupper($ClassName)}}_ERROR
} from './{{$ClassName}}Types';

const INITIAL_STATE = {
    error: '',
    message: '',
    content: '',
    data: null,
    isLoading:false
}

export default function(state = INITIAL_STATE, action) {
    switch (action.type) {
        case {{strtoupper($ClassName)}}_CREATE:
            return {...state, error: '', data: action.payload, message: '', isLoading:false };
        case {{strtoupper($ClassName)}}_ERROR:
            return {...state, isLoading:false,error: action.payload };
        case {{strtoupper($ClassName)}}_DELETE:
            return {...state };
        case {{strtoupper($ClassName)}}_UPDATE:
            return {...state };
    }

    return state;
}
