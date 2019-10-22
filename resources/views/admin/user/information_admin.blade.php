@extends('layouts.layout_admin')

@section('content')
	<h3>{{ $user->name }}</h3>
    <img src="{{ asset('uploads/'.$user->avarta) }}" style="width: 200px;height:100px;">
    <hr>
    <table>
        <tbody>
            <tr>
                <td>Name: </td>
                <td style="padding-left: 400px;">{{ $user->name }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Date of birth: </td>
                <td style="padding-left: 400px;">{{ $user->date_of_birth }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Address: </td>
                <td style="padding-left: 400px;">{{ $user->address }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>   
            <tr>
                <td>Gender: </td>
                <td style="padding-left: 400px;">{{ $user->gender }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Phone: </td>
                <td style="padding-left: 400px;">{{ $user->phone }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td style="padding-left: 400px;">{{ $user->email }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Login name:</td>
                <td style="padding-left: 400px;">{{ $user->login_name }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Status:</td>
                <td style="padding-left: 400px;">{{ $user->status }}</td>
            </tr>
            <tr>
                <td colspan="2"><hr></td>
            </tr>
            <tr>
                <td>Đổi mật khẩu: </td>
                <td style="padding-left: 400px;"><a href="{{ route('viewChangePassword',Auth::id()) }}">Đổi mật khẩu</a></td>
            </tr>
        </tbody>
    </table>
@endsection