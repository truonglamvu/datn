<!DOCTYPE html>
<!-- saved from url=(0064)#documenter-2 -->
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mytour Docs API</title>
      <link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon">
      <meta name="description" content="Pixxett API Docs Theme">
      <meta name="author" content="Pixxett">
      <meta name="copyright" content="Pixxett">
      <meta name="date" content="2014-12-02">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mobile-menu.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}" media="all">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css')}}">
      <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
       <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
      <style type="text/css">
          #pixxett-api .method .method-area:first-child .method-copy{
            padding-top:0px;
          }
          #pixxett-api .method .method-area:first-child .method-example{
            padding-top:0px;
          }
          #pixxett-api .header-section-wrapper{
            z-index:9;
          }
          .modal-header{
            border-bottom: none;
          }
      </style>
      <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
      <script type="text/javascript" src="{{ asset('js/jquery.scrollTo-1.4.2-min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/jquery-scrolltofixed.js') }}"></script>
      <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
   </head>
    <body id="pixxett-api">
      <div id="page">
         <header class="header" id="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-1 col-sm-2">
                     <div class="mm-toggle-wrap">
                        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
                     </div>
                     <a class="header__block header__brand" href="#">
                        <h1> <img src="{{ asset('images/logo.png')}}" alt="API UI logo"></h1>
                     </a>
                  </div>
                  <div class="col-lg-8 col-sm-8">
                  </div>
                  <div class="col-lg-3 col-sm-2">
                     <div class="header__nav">
                        <div class="header__nav--right">
                           <div class="dx-auth-block">
                              <div class="dx-auth-logged-out">
                                 @if(!isset(Auth::user()->name))
                                 <a class="dx-auth-login dx-btn dx-btn-primary" href="{{ route('login') }}">Log In</a>
                                 @else
                                   Xin chào:<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                   </a>

                                   <ul class="hidden-menu">
                                       <li>
                                           <a class="logout" href="{{ route('guestLogout') }}"
                                               onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                               <i class="glyphicon glyphicon-off"></i> Logout
                                           </a>

                                           <form id="logout-form" action="{{ route('guestLogout') }}" method="POST" style="display: none;">
                                               {{ csrf_field() }}
                                           </form>
                                       </li>
                                    </ul>
                                 @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </header>
         <div class="header-section-wrapper hidden">
            <div class="header-section header-section-example">
               <div id="language">
                  <ul class="language-toggle">
                     <li>
                        <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-curl" data-language="curl" checked="checked">
                        <label for="toggle-lang-curl" class="language-toggle-button language-toggle-button--curl">Json</label>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div id="documenter_sidebar">
            <div id="scrollholder" class="scrollholder">
                <div id="scroll" class="scroll">
                    <nav class="bs-docs-sidebar" id="bs-docs-sidebar">
                        <ul class="nav bs-docs-sidenav">
                            @foreach($menus as $key => $menu)
                                @php
                                    $check_unique = 0;
                                @endphp
                                @foreach(Auth::user()->roles()->get() as $ur)
                                    @if(in_array($ur->name, $menu->visible_on))
                                        @php
                                            $check_unique = 1;
                                                break;
                                        @endphp
                                    @endif
                                @endforeach
                                @if($check_unique == 1)
                                <li> <a href="#documenter-{{ $menu->id }}">{{ $menu->menu_name }}</a>
                                    <ul class="nav">
                                        @foreach($menu->posts as $post)
                                        <li class="{{ strtolower($post->getMethod()) }}" data-href="documenter-{{ $menu->id }}-{{ $post->id }}">
                                            <a href="#documenter-{{ $menu->id }}-{{ $post->id }}">
                                                <span class="text-method">{{ $post->getMethod() }}</span>
                                                <span class="text-title" title="{{ $post->title }}">{{ $post->title }}</span>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </nav>
                </div>
            </div>
         </div>
         <div id="background">
            <div class="background-actual"></div>
         </div>
          @yield('content')
         <div id="mobile-menu" style="left: -250px; width: 250px;">
            <div class="mobile-menu-inner">
               <ul class="mobile-menu">
                  <li>
                     <div class="mm-search">
                        <form id="search1" name="search">
                           <div class="input-group">
                              <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                              <div class="input-group-btn">
                                 <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </li>
                  <li>
                     <span class="expand fa-plus"></span>
                     <a href="#documenter-1" style="padding-right: 55px;">Page links</a>
                     <ul style="display: none;">
                        <li><a href="#documenter-1">API Reference</a> </li>
                        <li><a href="#documenter-2">Authentication </a> </li>
                        <li>
                           <span class="expand fa-plus"></span>
                           <a href="#documenter-3" style="padding-right: 55px;">Errors </a>
                           <ul style="display: none;">
                              <li><a href="#documenter-3-1">Handling errors</a></li>
                           </ul>
                        </li>
                        <li><a href="#documenter-4">Expanding Objects</a> </li>
                        <li><a href="#documenter-5">Idempotent Requests</a> </li>
                     </ul>
                  </li>
               </ul>
               <div class="top-links">
                  <ul class="links">
                     <li><a title="Docs" href="javascript:void(0)">Docs</a> </li>
                     <li><a title="API Reference" href="javascript:void(0)">API Reference</a> </li>
                     <li><a title="Support" href="javascript:void(0)">Support</a> </li>
                     <li><a title="Dashboard" href="javascript:void(0)">Dashboard</a> </li>
                     <li class="last"><a title="Login" href="javascript:void(0)">Login</a> </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
        <script type="text/javascript" src="{{ asset('js/prism.js')}}"></script> 
        
        <script type="text/javascript" src="{{ asset('js/jquery.easing.js')}}"></script>
        <script type="text/javascript">
            var duration = 500, easing = 'swing';
        </script>
        <script type="text/javascript" src="{{ asset('js/slides.min.jquery.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/common.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mobile-menu.min.js')}}"></script>
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('body').scrollspy({ target: '#bs-docs-sidebar' });
                $('#bs-docs-sidebar').on('activate.bs.scrollspy', function (e) {
                    var $that = $(e.target);
                    var $cur_docs = $that.data('href');
                    console.log($cur_docs);
                    if ($cur_docs && typeof $cur_docs != 'undefined') {
                        $('#documenter_content section').each(function () {
                            if($(this).attr('id') == $cur_docs) $(this).find('.method-example-part').addClass('current-data-return');
                            else $(this).find('.method-example-part').removeClass('current-data-return');
                        });
                        $('#scrollholder').animate({ scrollTop: $that.offset().top + 200 }, 600);
                    }
                });
                $('.fa-folder-o').css('color','orange');
                $('.bs-docs-sidenav > li').click(function(){
                    $('.bs-docs-sidenav > li').not(this).removeClass('active');
                    $(this).toggleClass('active');
                    // var menu_id = $(this).attr('data-id-menu');
                    // if($(this).hasClass('menu-documenter')){
                    //   $(this).parents('li').find('.menu-toggle').slideDown();
                    //   $(this).removeClass('menu-documenter');
                    //   $(this).find('i').removeClass('fa fa-folder-o').addClass('fa fa-folder-open-o').css('color','orange');
                    // }
                    // else{
                    //   $(this).parents('li').find('.menu-toggle').slideUp();
                    //   $(this).addClass('menu-documenter');
                    //   $(this).find('i').removeClass('fa fa-folder-open-o').addClass('fa fa-folder-o').css('color','orange');;
                    // }
                });
                $('#fountainTextG').scrollToFixed();
                console.log($("#box-type-params").val());
            })
        </script>
        <script>
          var myVar;

          function myFunction() {
              myVar = setTimeout(showPage, 4000);
          }

          function showPage() {
            document.getElementById("fountainTextG").style.display = "none";
            document.getElementById("page").style.opacity = 1;
          }
        </script>
        @section('js-footer')
        @show
   </body>
</html>