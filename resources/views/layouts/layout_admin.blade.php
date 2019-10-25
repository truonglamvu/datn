<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator</title>
    <link rel="icon" href="{{ asset('images/favicon1.ico') }}" type="image/x-icon">
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{ asset('css/metisMenu.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}" />
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/pretty-checkbox.min.css') }}" rel="stylesheet">

     <style>
        .veryweak{
            border-top:5px solid #B40404;
            width: 100px;
            color:#B40404;
        }
        .weak{
            border-top:5px solid #DF7401;
            width: 200px;
            color:#DF7401;
        }
        .medium{
            border-top:5px solid #FFFF00;
            width: 300px;
            color:#FFFF00;
        }
        .strong{
            border-top:5px solid #9AFE2E;
            width: 400px;
            color:#9AFE2E;
        }
        .verystrong{
            border-top:5px solid #0B610B;
            width: 500px;
            color:#0B610B;
        }
        .col-half-offset{
            width:20%;
        }
        .chart--container {
            height: 100%;
            width: 100%;
            min-height: 250px;
        }

        .sidebar{
            margin-top: 10px !important;
        }
 
        .zc-ref {
            display: none;
        }
 
        zing-grid[loading] {
            height: 250px;
        }
    </style>

    <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
    {{-- <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> --}} 
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/sb-admin-2.js') }}"></script>
    <script src="{{ asset('js/metisMenu.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.pwdMeter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/passwordStrength.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-scrolltofixed.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
</head>
<body>
    <div id="wrapper" class="animate-bottom">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('document.index') }}">Administrator</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>{{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ route('informationUser',Auth::id()) }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>

                </li>

            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('dasboard') }}" class="row" style="width: 250px;margin-left:0px;"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-fw fa-dashboard"></i> Dashboard</span></a>

                        </li>
                        <li>
                            <a href="{{ route('document.index') }}" class="row" style="width: 250px;margin-left:0px"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-list" aria-hidden="true"></i> Danh sách Docs API </span> <span class="col-lg-2" style="background-color: #d9534f; border:1px solid #d9534f; color:white; height: 25px;"> <span class="post"> 0</span> </span></a>
                        </li>
                        <li>
                            <a href="{{ route('user.index') }}" class="row" style="width: 250px;margin-left:0px"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-users" aria-hidden="true"></i> Quản lý User</span> <span class="col-lg-2" style="background-color: #d9534f; border:1px solid #d9534f; color:white; height: 25px;"> <span class="user_count"> 0</span> </span></a>
                        </li>
                        <li>
                            <a href="{{ route('role.index') }}" class="row" style="width: 250px;margin-left:0px"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-edit fa-fw"></i> Quản lý Role</span> <span class="col-lg-2" style="background-color: #d9534f; border:1px solid #d9534f; color:white; height: 25px;"> <span class="role"> </span> 0</span></a>
                        </li>
                        <li>
                            <a href="{{ route('permission.index') }}" class="row" style="width: 250px;margin-left:0px"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-calendar-check-o"></i> Quản lý Permission</span> <span class="col-lg-2" style="background-color: #d9534f; border:1px solid #d9534f; color:white; height: 25px;"> <span class="permission"> 0</span> </span></a>
                        </li>
                        <li>
                            <a href="{{ route('menu.index') }}" class="row" style="width: 250px;margin-left:0px"><span class="col-lg-10" style="padding-left:-10px"><i class="fa fa-bars"></i> Quản lý Menu</span> <span class="col-lg-2" style="background-color: #d9534f; border:1px solid #d9534f; color:white; height: 25px;"> <span class="menu"> 0</span> </span></a>
                        </li>
                    </ul>
                </div>

            </div>

       </nav>

        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>

                </div>

            </div>

        </div>

    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.13.3/jsoneditor.min.css" type="text/css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsoneditor/5.13.3/jsoneditor-minimalist.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
    <script type="text/javascript">
        $('.datepicker').datepicker();
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "/admin/fetch-list-number-categories",
                data:{},
                success:function(data){
                    $(".user_count").html(data.number_of_user);
                    $(".role").html(data.number_of_role);
                    $(".menu").html(data.number_of_menu);
                    $(".post").html(data.number_of_post);
                    $(".permission").html(data.number_of_permission);
                }
            });

            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>
    @section('js-footer')
    @show
</body>

</html>
