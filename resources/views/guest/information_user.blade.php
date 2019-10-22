@extends('layouts.layout')

@section('content')
	<h3>{{ $user->name }}</h3>
    <img src="{{ asset('uploads/'.$user->avarta) }}">
    <hr>
    <table>
       <tbody>
          <tr>
             <td>Name: </td>
             <td>{{ $user->name }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Date of birth: </td>
             <td>{{ date('d-m-Y',$user->date_of_birth) }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Address: </td>
             <td>{{ $user->address }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>   
          <tr>
             <td>Gender: </td>
             <td>{{ $user->gender }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Phone: </td>
             <td>{{ $user->phone }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Email: </td>
             <td>{{ $user->email }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Login name:</td>
             <td>{{ $user->login_name }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Status:</td>
             <td>{{ $user->status }}</td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
             <td>Đổi mật khẩu: </td>
             <td><a href="{{ route('viewChangePassword',Auth::id()) }}">Đổi mật khẩu</a></td>
          </tr>
       </tbody>
    </table>
@endsection