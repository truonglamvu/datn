@extends('layouts.layout_admin')

@section('content')
    
	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header" align="center" style="border-bottom: 1px solid #ccc;padding-bottom: 10px;">Dashboard</h1>
            @if(session('notification'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>{{session('notification')}}</strong>
                </div>
            @endif
        </div>
        <!-- /.col-lg-12 -->
    </div>
    
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $user->count() }}</div>
                            <div>User!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <a href="{{ route('user.index') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-file-text-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $post }}</div>
                            <div>Document!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <a href="{{ route('document.index') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-pencil-square-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $role }}</div>
                            <div>Role!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <a href="{{ route('role.index') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-calendar-check-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{ $menu }}</div>
                            <div>Menu!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <a href="{{ route('menu.index') }}" class="pull-right"><i class="fa fa-arrow-circle-right"></i></a>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-clock-o fa-fw"></i> Activity chart for the week
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div id="myChart" class="chart--container">
                    </div>
                    <hr>
                    <div id="myChart1" class="chart--container">
                    </div>
                    <hr>
                    <div id="myChart2" class="chart--container">
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notifications
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> New User
                            <span class="pull-right text-muted small"><em>{{(isset($time_create_new_user->created_at)) ? $time_create_new_user->created_at->diffForHumans() : ""}}</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-twitter fa-fw"></i> New Post
                            <span class="pull-right text-muted small"><em>{{(isset($time_create_new_post->created_at)) ? $time_create_new_post->created_at->diffForHumans() : ""}}</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> New Menu
                            <span class="pull-right text-muted small"><em>{{(isset($time_create_new_menu->created_at)) ? $time_create_new_menu->created_at->diffForHumans() : ""}}</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> New Role
                            <span class="pull-right text-muted small"><em>{{(isset($time_create_new_role->created_at)) ? $time_create_new_role->created_at->diffForHumans() : ""}}</em>
                            </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> New Permission
                            <span class="pull-right text-muted small"><em>{{(isset($time_create_new_permission->created_at)) ? $time_create_new_permission->created_at->diffForHumans() : ""}}</em>
                            </span>
                        </a>
                        
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->
            </div>

            <div class="chat-panel panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Gender</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone number</th>
                          <th scope="col">Role</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($user as $key => $value)
                            <tr>
                              <th scope="row">{{$key + 1}}</th>
                              <td>{{$value->name}}</td>
                              <td>{{($value->gender == 1) ? "Nam" : "Nữ"}}</td>
                              <td>{{$value->email}}</td>
                              <td>{{$value->phone}}</td>
                              <td>{{$value->roles[0]->name}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script type="text/javascript">
        window.addEventListener('load', () => {
  
          const myConfig = {
            type: 'bar',
            title: {
              text: 'User Chart',
              fontSize: 24,
            },
            legend: {
                    draggable: true,
            },
            scaleX: {
              // set scale label
              label: { text: 'Days' },
              // convert text on scale indices
              labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            scaleY: {
              // scale label with unicode character
              label: { text: 'Users created during the week' }
            },
                plot: {
              // animation docs here:
              // https://www.zingchart.com/docs/tutorials/design-and-styling/chart-animation/#animation__effect
              animation:{
                effect: 'ANIMATION_EXPAND_BOTTOM', 
                method: 'ANIMATION_STRONG_EASE_OUT',
                sequence: 'ANIMATION_BY_NODE',
                speed: 275,
              }
            },
            series: [
              {
                // plot 1 values, linear data
                values: {{$user_count_chart}},
              },
            ]
          };
         
          // render chart with width and height to
          // fill the parent container CSS dimensions
          zingchart.render({ 
            id: 'myChart', 
            data: myConfig, 
            height: '100%', 
            width: '100%' 
          });
          const myConfig1 = {
            type: 'bar',
            title: {
              text: 'Post Chart',
              fontSize: 24,
            },
            legend: {
                    draggable: true,
            },
            scaleX: {
              // set scale label
              label: { text: 'Days' },
              // convert text on scale indices
              labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            scaleY: {
              // scale label with unicode character
              label: { text: 'Posts created during the week' }
            },
                plot: {
              // animation docs here:
              // https://www.zingchart.com/docs/tutorials/design-and-styling/chart-animation/#animation__effect
              animation:{
                effect: 'ANIMATION_EXPAND_BOTTOM', 
                method: 'ANIMATION_STRONG_EASE_OUT',
                sequence: 'ANIMATION_BY_NODE',
                speed: 275,
              }
            },
            series: [
              {
                // plot 1 values, linear data
                values: {{$post_count_chart}},
              },
            ]
          };
         
          // render chart with width and height to
          // fill the parent container CSS dimensions
          zingchart.render({ 
            id: 'myChart1', 
            data: myConfig1, 
            height: '100%', 
            width: '100%' 
          });

          const myConfig2 = {
            type: 'bar',
            title: {
              text: 'Menu Chart',
              fontSize: 24,
            },
            legend: {
                    draggable: true,
            },
            scaleX: {
              // set scale label
              label: { text: 'Days' },
              // convert text on scale indices
              labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
            },
            scaleY: {
              // scale label with unicode character
              label: { text: 'Menus created during the week' }
            },
                plot: {
              // animation docs here:
              // https://www.zingchart.com/docs/tutorials/design-and-styling/chart-animation/#animation__effect
              animation:{
                effect: 'ANIMATION_EXPAND_BOTTOM', 
                method: 'ANIMATION_STRONG_EASE_OUT',
                sequence: 'ANIMATION_BY_NODE',
                speed: 275,
              }
            },
            series: [
              {
                // plot 1 values, linear data
                values: {{$menu_count_chart}},
              },
            ]
          };
         
          // render chart with width and height to
          // fill the parent container CSS dimensions
          zingchart.render({ 
            id: 'myChart2', 
            data: myConfig2, 
            height: '100%', 
            width: '100%' 
          });
        });
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','success') }}"
            switch(type){
                case 'success':
                   toastr.success("{{ Session::get('message') }}");
                break;
                case 'error':
                   toastr.error("{{ Session::get('message') }}");
                break;
            }
        @endif
    </script>
    
@endsection