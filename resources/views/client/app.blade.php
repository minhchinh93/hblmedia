<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    {{-- <link rel="shortcut icon" href="blob:https://web.telegram.org/d54200bf-9471-486d-8945-0913f944ae09" /> --}}
    <title>MEDIA - System Mr.Hải</title>
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}" type="image/icon type">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--external css-->
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/gritter/css/jquery.gritter.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/lineicons/style.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style-responsive.css') }}" rel="stylesheet">

    <script src="{{ asset('admin/js/chart-master/Chart.js') }}"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://cdn.tiny.cloud/1/dcsnatacsvrpksxw5w1o45zs2pgilzbcboykxsj0ytoy8oxi/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
       var editor_config = {
    path_absolute : "",
    selector: 'textarea.conten',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
      'forecolor backcolor emoticons | help',file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
    </script>
  </head>

  <body>

  <section id="container" class="sidebar-close">
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background:#d48166">
              <div class="sidebar-toggle-box">
                <div data-placement="right" > <a href="{{ route('dasboa') }}"><img  src="https://prpinkrainstore.com/admin/img/Logo.png" width="55"style="margin-top:-15px;border-radius:30%"></a></div>
            </div>
            <!--logo start-->
            <a href="{{ route('home') }}" class="logo"><b>MEDIA - System Mr.Hải</b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">

            </div>
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    @if(Auth::check())
                    <li><a class="logout" href="{{ route('logout') }}">LOGOUT</a></li>
                    @else
                    <li><a class="logout" href="{{ route('login') }}">LOGIN</a></li>
                    @endif
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      {{-- {{ dd(Auth::user()->id); }} --}}
      @if(Auth::user()->role!=0)
      <aside>
          <div id="sidebar"  class="nav-collapse " style="background:#373a36;max-width:70px">
              <ul class="sidebar-menu" id="nav-accordion">
                  <li class="mt" title="DASHBOARD">
                      <a class="{{ (request()->is('/dasboa')) ? 'active' : 'sub-menu' }}" href="{{ route('dasboa') }}">
                          <i class="fa fa-dashboard"></i>
                      </a>
                  </li>
                     @if (Auth::user()->role==2)
                     <li class="sub-menu" title="IDEA">
                        <a 	class="{{ (request()->is('/home')) ? 'active' : 'sub-menu' }}"
                          href="{{ route('home') }}" >
                            <i class="fa fa-desktop"></i>
                        </a>
                    </li>
                     @endif
                     @if (Auth::user()->role==1)
                     <li class="sub-menu" title="DESIGNER">
                        <a class="{{ (request()->is('/Dashboard')) ? 'active' : 'sub-menu' }}" href="{{ route('Dashboard') }}" >
                            <i class="fa fa-cogs"></i>
                        </a>
                    </li>
                     @endif
                  <li class="sub-menu" title="TOOL">
                      <a class="{{ (request()->is('/showTool')) ? 'active' : 'sub-menu' }}" href="{{ route('showtool') }}" >
                        <i class="fa fa-th"></i>
                      </a>
                  </li>
                  <li class="sub-menu" title="DOCUMENT">
                    <a class="{{ (request()->is('/showDoc')) ? 'active' : 'sub-menu' }}" href="{{ route('showDoc') }}" >
                        <i class="fa fa-book"></i>

                    </a>
                </li>
                  <li class="sub-menu" title="Search PNG">
                    <a class="{{ (request()->is('/findPNG')) ? 'active' : 'sub-menu' }}" href="{{ route('findPNG') }}" >
                        <i class="fa-solid fa-file-image"></i>
                    </a>
                </li>
                  <li class="sub-menu" title="IMPORT CSV">
                    <a class="{{ (request()->is('/importCsv')) ? 'active' : 'sub-menu' }}" href="{{ route('importCsv') }}" >
                        <i class="fa-solid fa-file-import"></i>
                    </a>
                </li>
                @if (Auth::user()->id==69 or Auth::user()->id==31)
                <li class="sub-menu" title="SELLERWIX-ODER">
                    <a class="{{ (request()->is('getIdStore')) ? 'active' : 'sub-menu' }}" href="{{ route('getIdStore') }}" >
                        <i class="fa-solid fa-fire"></i>
                    </a>
                </li>
                @endif
                @if (Auth::user()->id==45)
                <li class="sub-menu" title="SELLERWIX-ODER">
                    <a class="{{ (request()->is('sellerwix/b96cab72-5c7a-4e7d-9dcf-4011293b295b')) ? 'active' : 'sub-menu' }}" href="{{ route('sellerwix',["b96cab72-5c7a-4e7d-9dcf-4011293b295b"]) }}" >
                        <i class="fa-solid fa-fire"></i>
                    </a>
                </li>
                @endif
              {{--   <li class="sub-menu" title="SELLERWIX-transaction">
                    <a class="{{ (request()->is('transactions')) ? 'active' : 'sub-menu' }}" href="{{ route('transactions') }}" >
                        <i class="fa-solid fa-wallet"></i>
                     </a>
                </li> --}}
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      @yield('content')
      <!--footer start-->
      @else
      <section id="main-content" style="margin-left: 0px;">
        <section class="wrapper" style="min-height: 90vh;color:rgb(0, 0, 0); font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;" >
            <div class="row mt">
            <div class="col-lg-12 col-md-12 col-sm-12 mb" >
                <div class="content-panel pn">
                    <div id="spotify" style="text-align=center">
                        <div class="col-xs-12 col-xs-offset-12">
                            <button class="btn btn-sm btn-clear-g">FOLLOW</button>
                        </div>
                        <div class="sp-title"  >
                            <h3>BÁO CHO ADMIN ĐỂ ĐƯỢC CẤP QUYỀN VÀO HỆ THỐNG !</h3>
                        </div>
                        <div class="play">
                            <i class="fa fa-play-circle"></i>
                        </div>
                    </div>
                    <p class="followers"><i class="fa fa-user"></i> MEDIA - System Mr.Hải</p>
                </div>
            </div>
            </div>
        </section>
    </section>

      @endif
      <footer class="site-footer">
          <div class="text-center">
              2014 - Alvarez.is
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('admin/js/jquery-1.8.3.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script class="include" type="text/javascript" src="{{ asset('admin/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/jquery.sparkline.js') }}"></script>


    <!--common script for all pages-->
    <script src="{{ asset('admin/js/common-scripts.js') }}"></script>

    <script type="text/javascript" src="{{ asset('admin/js/gritter/js/jquery.gritter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin//js/gritter-conf.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <!--script for this page-->
    @stack('scripts')
    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
        // $('#sidebar').hover(function() {
        //     if ($("#sidebar").first().is(":hidden")) {
        //         $("#sidebar").toggle("slow").show();
        //     } else {
        //         $("#sidebar").hide();
        //     }
        // });
    </script>

  </body>

</html>
