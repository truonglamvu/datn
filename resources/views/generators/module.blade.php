'use strict';
import { Route } from 'react';
import {{$ClassName}} from './Components/{{$ClassName}}';
import { isLogin , isNoLogin } from '../../Middleware/Auth';



/**
 *
 * {{$ClassName}}Module Router
 *
 */
const {{$ClassName}}Router = {
    path: '/{{$uri}}',
    component:{{$ClassName}}
};
export default {{$ClassName}}Router;
