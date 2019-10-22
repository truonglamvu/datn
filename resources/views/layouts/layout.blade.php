<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <!--[if IE]>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <![endif]-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>API test</title>
      <link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon" />
      <meta name="description" content="Pixxett API Docs Theme">
      <meta name="author" content="Pixxett">
      <meta name="copyright" content="Pixxett">
      <meta name="date" content="2014-12-02">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.mobile-menu.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}" media="all">
      <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css')}}">
      <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
      <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
      <style type="text/css">
         .method,.method-area-wrapper,.background-actual {
            background-color: white;
         }
      </style>

        <script type="text/javascript" src="{{ asset('js/prism.js')}}"></script>
        <script src="{{ asset('js/jquery-2.1.4.min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.scrollTo-1.4.2-min.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.easing.js')}}"></script>
        <script type="text/javascript">document.createElement('section');
            var duration = 500, easing = 'swing';
        </script>
        <script type="text/javascript" src="{{ asset('js/slides.min.jquery.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/script.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/scroll.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/common.js')}}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery.mobile-menu.min.js')}}"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   </head>
   <body id="pixxett-api">
      <div id="page">
         <header class="header" id="header">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-8 col-sm-8">
                     <div class="mm-toggle-wrap">
                        <div class="mm-toggle"><i class="fa fa-align-justify"></i><span class="mm-label">Menu</span> </div>
                     </div>
                     <a class="header__block header__brand" href="">
                        <h1> <img src="{{ asset('images/logo.png')}}" alt="API UI logo"></h1>
                     </a>
                  </div>
                  <div class="col-lg-4 col-sm-4 hidden-xs">
                     <div class="header__nav">
                        <div class="header__nav--right">
                           <div class="dx-auth-block">
                              <div class="dx-auth-logged-out" style="margin-top:20px;font-size: 15px;">
                                 @if(!isset(Auth::user()->name))
                                 <a class="dx-auth-login dx-btn dx-btn-primary" href="{{ route('login') }}">Log In</a>
                                 @else
                                   Xin chào:<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                   </a>

                                   <ul class="hidden-menu" style="text-align:left;margin-top:15px;margin-right:-50px;border:1px solid #ccc; padding-left: 10px;width:200px;height: 100px;background-color: white;border-radius:5px;padding-top:10px;z-index: 1000;">
                                       <li>
                                          <a style="color: black;border:1px solid grey,border-radius:5px;margin-top:10px;" href="{{ route('informationUser',Auth::id()) }}">
                                            <i class="glyphicon glyphicon-user"></i> User Profile
                                          </a>
                                       </li>
                                       <hr style="width:100%;">
                                       <li>
                                           <a style="color: black;border:1px solid grey,border-radius:5px;margin-top:10px;" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                               <i class="glyphicon glyphicon-off"></i> Logout
                                           </a>

                                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
         <div id="documenter_sidebar">
            <div id="scrollholder" class="scrollholder">
               <div id="scroll" class="scroll">
                  @if(Auth::check())
                  <div class="header-section-wrapper">
                        <div class="header-section header-section-example">
                           <div id="language">
                              <ul class="language-toggle">
                                 <li>
                                    <input type="radio" class="language-toggle-source" name="language-toggle" id="toggle-lang-php" data-language="php">
                                    <label for="toggle-lang-php" class="language-toggle-button language-toggle-button--php">PHP</label>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div id="documenter_sidebar">
                        <div id="scrollholder" class="scrollholder">
                            <div id="scroll" class="scroll">
                                <ol id="documenter_nav">
                                    <li>
                                        <a href="#documenter-3">Errors </a>
                                        <ol>
                                           <li><a href="#documenter-3-1">Handling errors</a></li>
                                        </ol>
                                    </li>
                                    <li>
                                        <a href="#documenter-4">Tables</a>
                                        <ol>
                                           <li><a href="#documenter-4-1">Default Talbe</a></li>
                                           <li><a href="#documenter-4-2">exampled Rows</a> </li>
                                           <li><a href="#documenter-4-3">Bordered Table</a> </li>
                                           <li><a href="#documenter-4-4">Contextual Classes</a> </li>
                                        </ol>
                                    </li>
                                    <li>
                                        <a href="#documenter-5">General</a>
                                        <ol>
                                           <li><a href="#documenter-5-1">Headings</a> </li>
                                           <li><a href="#documenter-5-2">Paragraph</a> </li>
                                           <li><a href="#documenter-5-3">Inline Text Elements</a> </li>
                                           <li><a href="#documenter-5-4">Alignment and Transformation</a> </li>
                                           <li><a href="#documenter-5-5">Abbrevations</a> </li>
                                           <li><a href="#documenter-5-6">Addresses</a> </li>
                                           <li><a href="#documenter-5-7">Unordered and Ordered List</a> </li>
                                           <li><a href="#documenter-5-8">Unstyled and Inline list</a></li>
                                           <li><a href="#documenter-5-9">Blockquotes</a> </li>
                                           <li><a href="#documenter-5-10">Descriptions</a> </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                 @endif
               </div>

            </div>

         </div>
         <div id="background">
            <div class="background-actual"></div>
        </div>
         <div id="documenter_content" class="method-area-wrapper">
            @yield('contents')
         </div>
         <div id="mobile-menu">
            <div class="mobile-menu-inner">
               <ul>
                  <li>
                     <div class="mm-search">
                        <form id="search1" name="search">
                           <div class="input-group">
                              <input type="text" class="form-control simple" placeholder="Search ..." name="srch-term" id="srch-term">
                              <div class="input-group-btn">
                                 <button class="btn btn-404" type="submit"><i class="fa fa-search"></i> </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </li>
                  <li>
                     <a href="#documenter-1">Page links</a>
                     <ul>
                        <li><a href="#documenter-1">API Reference</a> </li>
                        <li><a href="#documenter-2">Authentication </a> </li>
                        <li>
                           <a href="#documenter-3">Errors </a>
                           <ul>
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

         <script type="text/javascript">
            ScrollLoad("scrollholder", "scroll", false);
         </script>
         <script type="text/javascript">
            $(document).ready(function(){
               $('.hiden-menu').hide();
               $('.hidden-menu').hide();
               $('#document5').click(function(){
                  $('.hiden-menu').toggle();
               });
               $('.dropdown-toggle').click(function(){
                  $('.hidden-menu').toggle();
               });
               
               
            });
         </script>
         
   </body>
</html>