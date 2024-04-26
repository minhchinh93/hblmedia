<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>MEDIA - System Mr.Hải</title>
    <link rel="icon" href="{{ asset('admin/img/Logo.png') }}" type="image/icon type">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('admin/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/gritter/css/jquery.gritter.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/lineicons/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Custom styles for this template -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style-responsive.css') }}" rel="stylesheet">

    <script src="{{ asset('admin/js/chart-master/Chart.js') }}"></script>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background-color: #ff865c;">
              <div class="sidebar-toggle-box">
                <div data-placement="right" >
                    {{-- <a href="{{ route('AadminHome') }}"> --}}
                    <img  src="https://prpinkrainstore.com/admin/img/Logo.png" width="55"style="margin-top:-15px;border-radius:30%" class=" fa fa-bars tooltips">
                </a>
            </div>
              </div>
            <!--logo start-->
            <a href="index.html" class="logo"><b>MEDIA - System Mr.Hải</b></a>
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
      <aside>
          <div id="sidebar"  class="nav-collapse " style="background-color:#24292f;max-width:70px">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  {{-- <p class="centered"><a href="profile.html"><img src="http://hblmedia.online/admin/img/Logo.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Chào Mừng Admin !</h5>--}}

                 <li class="mt" title="DASHBOARD">
                      <a  class="{{ (request()->is('admin/AadminHome')) ? 'active' : 'sub-menu' }}" href="{{ route('AadminHome') }}">
                          <i class="fa fa-dashboard"></i>

                      </a>
                  </li>
                  <li class="sub-menu" title="STATIC">
                      <a class="{{ (request()->is('admin/showList/dasboa')) ? 'active' : 'sub-menu' }}" href="{{ route('showdasboa') }}">
                          <i class="fa fa-cogs"></i>
                      </a>
                  </li>

                  <li class="sub-menu" title="USERS">
                      <a 	class="{{ (request()->is('admin/showList/User')) ? 'active' : 'sub-menu' }}"
                        href="{{ route('showUser') }}" >
                          <i class="fa fa-desktop"></i>
                      </a>
                  </li>
                  <li class="sub-menu" title="DOCUMENTS">
                    <a class="{{ (request()->is('/showDoc')) ? 'active' : 'sub-menu' }}" href="{{ route('showDoc') }}" >
                        <i class="fa fa-th"></i>
                    </a>
                </li>
                  {{-- <li class="sub-menu" title="ODER DETAIL">
                    <a class="{{ (request()->is('admin/OderAdmin')) ? 'active' : 'sub-menu' }}" href="{{ route('OderAdmin') }}" >
                        <i class="fa-solid fa-money-bill-1-wave"></i>
                    </a>
                </li> --}}
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

                <li class="sub-menu" title="SELLERWIX-ODER">
                    <a class="{{ (request()->is('getIdStore')) ? 'active' : 'sub-menu' }}" href="{{ route('getIdStore') }}" >
                        <i class="fa-solid fa-fire"></i>
                    </a>
                </li>
                <li class="sub-menu" title="SELLERWIX-transaction">
                    <a class="{{ (request()->is('transactions')) ? 'active' : 'sub-menu' }}" href="{{ route('transactions') }}" >
                        <i class="fa-solid fa-wallet"></i>
                     </a>
                </li>
                <li class="sub-menu" title="Check Download">
                    <a class="{{ (request()->is('admin/checkDownload')) ? 'active' : 'sub-menu' }}" href="{{ route('checkDownload') }}" >
                        <i class="fa-solid fa-eye"></i>
                     </a>
                </li>
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
    </script>




  </body>
</html>
