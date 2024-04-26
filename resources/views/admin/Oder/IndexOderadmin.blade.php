@extends('admin.app')


@section ('content')

<section id="main-content">
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">
        <div class="row mtbox">
            <div class="col-md-3 col-sm-3 col-md-offset-1 box0" >
                <div class="box1" style=" border-radius: 20px;
                background-image: linear-gradient(90deg, #fe9e75, rgb(245, 45, 78)); ">
                    <span class="li_heart" style="color:rgb(252, 250, 247);"></span>
                    <h5  style="color:rgb(250, 250, 250)">TOTAL ODER  : {{ $totalItemEsty }} </h5>
                    <h4  style="color:rgb(248, 245, 241)">TOTAL MONEY : ${{ $totalPriceEsty }}</h4>
                </div>
                <a style="color:red" href="{{ route('totalidea') }}"><p>see more ESTY !</p></a>
            </div>
            <div class="col-md-4 col-sm-4 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #0bd48e, rgba(158, 168, 8, 0.829));  border-radius:20px;">
                    <span class="li_cloud" style="color:rgb(255, 255, 255)"></span>
                    <h5 style="color:rgb(250, 250, 253)">TOTAL ODER  :{{ $totalItemEBay}}</h5>
                    <h4 style="color:rgb(243, 242, 247)">TOTAL MONEY :${{$totalPriceEBay }}</h4>
                </div>
                <a style="color:red" href="{{ route('totalDesigner') }}"><p>see EBAY !</p></a>
            </div>
            <div class="col-md-3 col-sm-3 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #fe6c7d, rgba(37, 8, 168, 0.829));  border-radius: 20px;">
                    <span class="li_news" style="color:rgb(250, 245, 247)"></span>
                    <h5 style="color:rgb(247, 245, 246)">TOTAL ODER  : {{ $totalItemAmz }}</h5>
                    <h5 style="color:rgb(247, 245, 246)">TOTAL MONEY :{{ $totalPriceEAmz }}</h5>
                    <h4><b style="color:rgb(248, 245, 246)">{{ null }} </b></h4>
                </div>
                <a style="color:rgb(0, 60, 255)" href="{{ route('totalall') }}"><p>see more AMAZON !</p></a>
            </div>
            {{-- <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #01b5c1, rgba(194, 6, 6, 0.829));  border-radius: 20px;">
                    <span class="li_data" style="color:rgb(246, 242, 247)"></span>
                    <h5 style="color:rgb(250, 248, 250)"> TOTAL DESIGNER:</h5>
                    <h4 style="color:rgb(252, 250, 252)"><b>{{ null }} </b></h4>
                </div>
                <a style="color:rgb(0, 60, 255)" href="{{ route('findPNG') }}"><p>see more !</p></a>
            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, rgba(255, 42, 59, 0.541), rgba(9, 221, 236, 0.829));  border-radius: 20px;">
                    <span class="li_stack" style="color:rgb(252, 244, 244)"></span>
                    <h5 style="color:rgb(255, 255, 255)">MEMBER IDEA: {{ null }} </h5>
                    <h4 style="color:rgb(253, 249, 249)">MEMBER DESIGNER: {{ null }}</h4>
                </div>
                <a style="color:red" href="{{ route('showUser') }}"><p>see more !</p></a>
            </div> --}}
        </div>
        <div class="row mtbox">
            <div class="col-md-4 col-sm-4 mb">
                <!-- REVENUE PANEL -->
                <div class="darkblue-panel pn">
                    <div class="darkblue-header">
                        <img src="https://s.yimg.com/ny/api/res/1.2/EW1Z5anjtiAbyW5Uj3SOQQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTY0MDtoPTM1Mg--/https://s.yimg.com/uu/api/res/1.2/1ZQYMuRNeUzhz_it7cpN6g--~B/aD00MDA7dz03Mjg7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/investorplace_417/9f93c2cee41c63e47e3ecec6c5ae5275" width="40px">
                    </div>
                    <div class="chart mt">
                        <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[{{ $StrsicharEsty }}]"><canvas width="358" height="75" style="display: inline-block; width: 358px; height: 75px; vertical-align: top;"></canvas></div>
                    </div>
                    <p class="mt"><b>$ {{ $totolEsty }}</b><br>Total 30 Day</p>
                </div>
            </div>
        <div class="col-md-4 col-sm-4 mb">
            <!-- REVENUE PANEL -->
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <td><img src="https://payload.cargocollective.com/1/3/121291/4281202/ebay%20logo%20new2_1_o.jpg" width="40px"></td>
                </div>
                <div class="chart mt">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[{{ $StrsicharEbay }}]"><canvas width="358" height="75" style="display: inline-block; width: 358px; height: 75px; vertical-align: top;"></canvas></div>
                </div>
                <p class="mt"><b>$ {{ $totolEbay }}</b><br>Total 30 Day</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 mb">
            <!-- REVENUE PANEL -->
            <div class="darkblue-panel pn">
                <div class="darkblue-header">
                    <td><img src="https://images-na.ssl-images-amazon.com/images/G/01/gc/designs/livepreview/amazon_dkblue_noto_email_v2016_us-main._CB468775337_.png" width="40px"></td>
                </div>
                <div class="chart mt">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[{{ $totalsicharAmz }}]"><canvas width="358" height="75" style="display: inline-block; width: 358px; height: 75px; vertical-align: top;"></canvas></div>
                </div>
                <p class="mt" ><b >$ {{ $totolAmz }}</b><br>Total 30 Day</p>
            </div>
        </div>
    </div>
    <div class="row mt" >
        <div class="col-md-12">

            <div class="content-panel" style="border-radius: 10px;background: rgba(255, 255, 255, 0.842)" >
                <h4><i class="fa fa-angle-right"></i> ODER MANAGER  </h4><hr><table class="table table-striped table-advance table-hover">
                    <div class="col-lg-3">
                        <form class="form-inline" role="form">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">    </label>
                                <input type="text" class="form-control" name="keyword1" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword1 }}" placeholder="ESTY (m/d)">
                                <input type="text" class="form-control" name="keyword2" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword2 }}" placeholder="EBAY (mar-dd)">
                                <input type="text" class="form-control" name="keyword3" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword3 }}" placeholder="AMZ (dd-mm)">
                                <button type="submit" class="btn btn-theme"><i class="fa-solid fa-magnifying-glass">tim kiem</i></button>
                            </div>
                        </form>
                    </div>
                    <thead>
                    <tr>
                        <th><i class="fa fa-bullhorn"></i> NAME SALLER</th>
                        <th><i class="fa fa-bookmark"></i> TOTAL ODER</th>
                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> TOTAL PRICE</th>
                        <th><i class=" fa fa-edit"></i> Status</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($estys as $show)
                    <tr>
                        <td><a href="">{{ $show->name?? null }}</a></td>
                        <td> {{ $show->Number_Items?? null }} </td>
                        <td>${{ $show->order_Total?? null }} </td>
                        <td><img src="https://s.yimg.com/ny/api/res/1.2/EW1Z5anjtiAbyW5Uj3SOQQ--/YXBwaWQ9aGlnaGxhbmRlcjt3PTY0MDtoPTM1Mg--/https://s.yimg.com/uu/api/res/1.2/1ZQYMuRNeUzhz_it7cpN6g--~B/aD00MDA7dz03Mjg7YXBwaWQ9eXRhY2h5b24-/https://media.zenfs.com/en/investorplace_417/9f93c2cee41c63e47e3ecec6c5ae5275" width="40px"></td>
                        <td>
                            <span class="btn btn-success btn-xs">
                                <a style="color:rgb(2, 2, 0)" href="{{route('estydetail',[$show->name])}}">
                                    <i class="fa-solid fa-user"></i>
                              </a>
                            </span>
                        </td>
                    </tr>
                        @endforeach
                        @foreach ($ebays as $show)
                    <tr>
                        <td><a href="">{{ $show->name?? null }}</a></td>
                        <td> {{ $show->Number_Items?? null }} </td>
                        <td>${{ $show->order_Total?? null }} </td>
                        <td><img src="https://payload.cargocollective.com/1/3/121291/4281202/ebay%20logo%20new2_1_o.jpg" width="40px"></td>
                        <td>
                            <span class="btn btn-success btn-xs">
                                <a style="color:rgb(0, 31, 37)" href="{{route('ebaydetail',[$show->name])}}">
                                    <i class="fa-solid fa-user"></i>
                              </a>
                             </span>
                        </td>
                    </tr>
                        @endforeach
                        @foreach ($Amz as $show)
                    <tr>
                        <td><a href="">{{ $show->name?? null }}</a></td>
                        <td> {{ $show->Number_Items?? null }} </td>
                        <td>${{ $show->order_Total?? null }} </td>
                        <td><img src="https://images-na.ssl-images-amazon.com/images/G/01/gc/designs/livepreview/amazon_dkblue_noto_email_v2016_us-main._CB468775337_.png" width="40px"></td>
                        <td>
                            <span class="btn btn-success btn-xs">
                                <a style="color:rgb(0, 31, 37)" href="#">
                                    <i class="fa-solid fa-user"></i>
                              </a>
                             </span>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div>
    </section>
</section>


@endsection
@push('scripts')
    <!--script for this page-->
    {{-- <script src="assets/js/sparkline-chart.js"></script>
    <script src="assets/js/zabuto_calendar.js"></script> --}}

    <script type="text/javascript" src="{{ asset('admin/js/sparkline-chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/js/zabuto_calendar.js') }}"></script>
@endpush
