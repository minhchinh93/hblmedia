@extends('admin.app')
@section ('content')
<section id="main-content" >
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">
        <div class="row mtbox">
            <div class="col-md-2 col-sm-2 col-md-offset-1 box0" >
                <div class="box1" style=" border-radius: 20px;
                background-image: linear-gradient(90deg, #fe9e75, rgb(245, 45, 78)); ">
                    <span class="li_heart" style="color:rgb(252, 250, 247);"></span>
                    <h5  style="color:rgb(250, 250, 250)">IDEA OF THE DAY : {{ $totaDay }} </h5>
                    <h4  style="color:rgb(248, 245, 241)">IDEA SUCCESS : {{ $totaSusecDay }}</h4>
                </div>
                <a style="color:red" href="{{ route('totalidea') }}"><p>see more !</p></a>
            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #0bd48e, rgba(158, 168, 8, 0.829));  border-radius:20px;">
                    <span class="li_cloud" style="color:rgb(255, 255, 255)"></span>
                    <h5 style="color:rgb(250, 250, 253)">DESIGNER/DAY: {{ $totalDayDesigner }}</h5>
                    <h4 style="color:rgb(243, 242, 247)">DESIGNER SUCCESS : {{ NULL }}</h4>
                </div>
                <a style="color:red" href="{{ route('totalDesigner') }}"><p>see more !</p></a>
            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #fe6c7d, rgba(37, 8, 168, 0.829));  border-radius: 20px;">
                    <span class="li_news" style="color:rgb(250, 245, 247)"></span>
                    <h5 style="color:rgb(247, 245, 246)">TOTAL IDEA:</h5>
                    <h4><b style="color:rgb(248, 245, 246)">{{ $totalIdea }} </b></h4>
                </div>
                <a style="color:rgb(0, 60, 255)" href="{{ route('totalall') }}"><p>see more !</p></a>
            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, #01b5c1, rgba(194, 6, 6, 0.829));  border-radius: 20px;">
                    <span class="li_data" style="color:rgb(246, 242, 247)"></span>
                    <h5 style="color:rgb(250, 248, 250)"> TOTAL DESIGNER:</h5>
                    <h4 style="color:rgb(252, 250, 252)"><b>{{ $totalDesign }} </b></h4>
                </div>
                <a style="color:rgb(0, 60, 255)" href="{{ route('findPNG') }}"><p>see more !</p></a>
            </div>
            <div class="col-md-2 col-sm-2 box0">
                <div class="box1" style="background-image: linear-gradient(90deg, rgba(255, 42, 59, 0.541), rgba(9, 221, 236, 0.829));  border-radius: 20px;">
                    <span class="li_stack" style="color:rgb(252, 244, 244)"></span>
                    <h5 style="color:rgb(255, 255, 255)">MEMBER IDEA: {{ $totalIdeamember }} </h5>
                    <h4 style="color:rgb(253, 249, 249)">MEMBER DESIGNER: {{ $totalDesigner }}</h4>
                </div>
                <a style="color:red" href="{{ route('showUser') }}"><p>see more !</p></a>
            </div>
        </div>

        <div class="row mt" >
            <div class="col-md-12">
                <div class="content-panel" style="border-radius: 10px;background: rgba(255, 255, 255, 0.842)" >
                    <h4><i class="fa fa-angle-right"></i> IDEA MANAGER  </h4><hr><table class="table table-striped table-advance table-hover">


                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> NAME</th>
                            <th><i class="fa fa-bookmark"></i> EMAIL</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> ROLE</th>
                            <th><i class="fa fa-bookmark"></i> TOTAL IDEA</th>
                            <th><i class=" fa fa-edit"></i> Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($shows as $show)
                        <tr>
                            <td><a href="{{ route('DetailIdea',[$show->id]) }}">{{ $show->name?? null }}</a></td>
                            <td>{{$show->email}} </td>
                            @if($show->role ==1)
                            <td><span class="label label-info label-mini">DESIGNER</span></td>
                            @elseif ($show->role ==2)
                            <td><span class="label label-warning label-mini">IDEA</span></td>
                            @else
                            <td><span class="label label-success label-mini">ADMIN</span></td>
                            @endif
                            <td><h4>{{$show->sum}}</h4></td>
                            <td>
                                @if (  $show->deleted_at ==  null)
                                <span class="label label-info label-mini">active</span></td>
                                @else
                                <span class="label label-danger">disabled</span>
                                @endif
                            </td>
                            <td>
                                <span class="btn btn-success btn-xs">
                                    <a style="color:white" href="{{ route('DetailIdea',[$show->id]) }}">
                                     Detail
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
        <div class="row mt" >
            <div class="col-md-12">
                <div class="content-panel" style="border-radius: 10px;background: rgba(255, 255, 255, 0.842)">
                    <h4><i class="fa fa-angle-right"></i> DESIGNER MANAGER PNG </h4><hr><table class="table table-striped table-advance table-hover">
                        <div class="col-lg-3">
                            <form class="form-inline" role="form">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail2">    </label>
                                    <input type="text" class="form-control" name="keyword1" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword1 }}" placeholder="yyyy-mm-dd">
                                    <input type="text" class="form-control" name="keyword2" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword2 }}" placeholder="yyyy-mm-dd">
                                    <button type="submit" class="btn btn-theme"><i class="fa-solid fa-magnifying-glass">tim kiem</i></button>
                                </div>
                            </form>
                        </div>
                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> NAME</th>
                            <th><i class="fa fa-bullhorn"></i> EMAIL</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> ROLE</th>
                            <th><i class="fa fa-bookmark"></i> PNG/YES</th>
                            <th><i class=" fa fa-edit"></i> STATUS</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($designer as $show)
                        <tr>
                            <td><a href="{{ route('DetailDesigner',[$show->id]) }}">{{ $show->name?? null }}</a></td>
                            <td>{{ $show->email?? null }}</td>
                            @if($show->role ==1)
                            <td><span class="label label-info label-mini">DESIGNER</span></td>
                            @elseif ($show->role ==2)
                            <td><span class="label label-warning label-mini">IDEA</span></td>
                            @else
                            <td><span class="label label-success label-mini">ADMIN</span></td>
                            @endif
                             <td><h4>{{$show->product_png_details ?? null }}</h4></td>
                            <td>
                                @if (  $show->deleted_at ==  null)
                                <span class="label label-info label-mini">active</span></td>
                                @else
                                <span class="label label-danger">disabled</span>
                                @endif
                            </td>
                            <td>
                                <span class="btn btn-success btn-xs">
                                    <a style="color:white" href="{{ route('DetailDesigner',[$show->id]) }}">
                                     Detail
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
        <div class="row mt" >
            <div class="col-md-12">
                <div class="content-panel" style="border-radius: 10px;background: rgba(255, 255, 255, 0.842)">
                    <h4><i class="fa fa-angle-right"></i> DESIGNER MANAGER MOCKUP </h4><hr><table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> NAME</th>
                            <th><i class="fa fa-bullhorn"></i> EMAIL</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> ROLE</th>
                            <th><i class="fa fa-bookmark"></i> MOCKUP/YES</th>
                            <th><i class=" fa fa-edit"></i> STATUS</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=0
                          @endphp
                            @foreach ($mocup as $show)
                        <tr>
                            <td><a href="{{ route('DetailDesigner',[$show->id]) }}">{{ $show->name?? null }}</a></td>
                            <td>{{ $show->email?? null }}</td>
                            @if($show->role ==1)
                            <td><span class="label label-info label-mini">DESIGNER</span></td>
                            @elseif ($show->role ==2)
                            <td><span class="label label-warning label-mini">IDEA</span></td>
                            @else
                            <td><span class="label label-success label-mini">ADMIN</span></td>
                            @endif
                             <td><h4>{{$show->mocup_products ?? null }}</h4></td>
                            <td>
                                @if (  $show->deleted_at ==  null)
                                <span class="label label-info label-mini">active</span></td>
                                @else
                                <span class="label label-danger">disabled</span>
                                @endif
                            </td>
                            <td>
                                <span class="btn btn-success btn-xs">
                                    <a style="color:white" href="{{ route('DetailDesigner',[$show->id]) }}">
                                     Detail
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

  </section><!-- --/wrapper ---->
</section>
@endsection
