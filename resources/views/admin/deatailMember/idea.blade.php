@extends('admin.app')


@section ('content')
<section id="main-content">
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;">
        <div class="row mt" >
            <div class="col-md-12" >
                <div class="content-panel" style = "background: rgba(255, 255, 255, 0.842)">
                    <h4><i class="fa fa-angle-right"></i>  Bảng Báo Cáo</h4>
                    <div class="col-lg-4">
                        <h4 style="margin-left: 2%;" class="category"><a style="color: gray" href="{{ route('detailUserIdeaDone',[$id]) }}"> Hoàn thành ({{ $totalDone ?? null}}) </a>
                             | <a  style="color: rgb(13, 182, 36)" href="{{ route('detailUserIdeaPending',[$id]) }}">chờ duyệt ({{ $totalPending ?? null}})</a>
                             | <a style="color:red" href="#">chưa nhận ({{ $totalNotReceived ?? null}})</a>
                             | <a style="color:red" href="#"> tất cả ({{ $totalallidea ?? null}})</a>

                            </h4>
                    </div><!-- /col-lg-12 -->
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail2">tim kiem</label>
                                        <input type="text" class="form-control" name="keyword" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword }}" placeholder="tim kiem">
                                    </div>
                                    <button type="submit" class="btn btn-theme">tim kiem</button>
                                </form>
                            </div>
                            <div class="col-lg-6">
                                <form class="form-inline" action="{{ route('addplasform') }}" role="form" >
                                    @csrf
                                    <select name="plasform" id="cars" style="border-radius: 5px;"  class="form-control ">
                                    @foreach ($showcornerstones as $show)
                                        <option value="{{ $show->id }}">{{  $show->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" style="border-radius: 5px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
        </div><!-- /col-lg-12 -->
        <div class="col-lg-1">
                <button  type="button" class="btn btn-primary"><a style="color:white" href="{{ route('home') }}">refresh trang</a></button>
            </div><!-- /col-lg-12 -->

                    <hr>
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="checkall" value=""></th>
                            <th><i class="fa fa-bullhorn"></i> Designer</th>
                            <th><i class="fa fa-bullhorn"></i> Category(size)</th>
                            <th><i class="fa fa-bullhorn"></i> Title</th>
                            <th><i class="fa fa-bullhorn"></i> Cornerstones</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description </th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i>Time</th>
                            <th><i class="fa fa-bookmark"></i>Idea </th>
                            <th><i class=" fa fa-edit"></i> Mockup </th>
                            <th><i class=" fa fa-edit"></i> PNG </th>
                            <th><i class=" fa fa-edit"></i>  Status </th>
                            <th></th>
                        </tr>
                        </thead>
                        @php
                          $i=0
                        @endphp
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($reports as  $report)
                            <tr>
                                <td ><input type="checkbox" name="checkbox[]"  value="{{ $report->id ?? null }}"></td>
                                <td><a href="basic_table.html#">{{$name[$i++][0]->name?? null }}</a></td>
                                <td><a href="basic_table.html#">{{ $report->type_product->name ?? null }}({{ $report->size->name ?? null  }})</a></td>
                                <td  style=" max-width: 200px;"><b>{{ $report->title ." ". $report->Sku ?? null }}</b></td>
                                <td class="hidden-phone">{!!  $report->created_at ?? null !!}
                                <td class="hidden-phone"
                                style=" max-width: 400px;
                                overflow: hidden;
                                text-overflow: ellipsis;
                               word-wrap: break-word;">{!!  $report->description ?? null !!}
                                    <form class="form-inline" action="{{ route('componentDesigner',[$report->id]) }}" method="post">
                                        @csrf
                                          <div class="form-group">
                                                  <input style="border-radius: 15px; "  type="text" class="form-control" id="exampleInputEmail2" name="comment" placeholder="comment">
                                              </div>
                                              <button style="border-radius: 10px;" type="submit" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                          </form>
                                </td>
                                <td data-toggle="modal" data-target="#a{{$report->id}}" >
                                    @if  (count($report->product_details)!=0)
                                    <!-- @if(Storage::exists($report->product_details[0]->ImageDetail) == 1)
                                    <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->product_details[0]->ImageDetail}}" style="width: 150px; border-radius: 5%;" >
                                    @else
                                    <img src="{{asset('/storage/'.$report->product_details[0]->ImageDetail)}}" style="width: 150px; border-radius: 5%;" >
                                @endif -->
                                <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->product_details[0]->ImageDetail}}" style="width: 150px; border-radius: 5%;" >

                                    @endif
                                </td>
                                {{-- @php
                                $i++
                                @endphp --}}
                                <div class="modal fade" id="a{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                          @foreach ($report->product_details as $rep)
                                          <div class="project-wrapper">
                                            <h5>{{ $rep->ImageDetail }} </h5>
                                            <div class="project" id="projectClick">
                                                <div class="photo-wrapper"  data-dismiss="modal" onclick="photoClick({{ $rep->id }})">
                                                    <div >
                                                        <!-- @if(Storage::exists($rep->ImageDetail) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}"  width="100%"></a>
                                                    @else
                                                    <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImageDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImageDetail)}}"  width="100%"></a>
                                                    @endif -->
                                                    <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail}}"  width="100%"></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </section>
                                </section>
                                  </div>
                                  @if (count($report->mocups)!=0)
                                  <td style=" max-width: 250px;">
                                    <!-- @if(Storage::exists($report->mocups[0]->mocup) == 1)
                                         <img  data-toggle="modal" data-target="#c{{$report->id}}" src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->mocups[0]->mocup}}" style="width: 150px; border-radius: 5%;" >

                                         @else
                                         <img data-toggle="modal" data-target="#c{{$report->id}}" src="{{asset('/storage/'.$report->mocups[0]->mocup)}}" style="width: 150px;  border-radius: 5%;" >
                                      @endif -->
                                      <img  data-toggle="modal" data-target="#c{{$report->id}}" src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->mocups[0]->mocup}}" style="width: 150px; border-radius: 5%;" >

                                    <span class="badge bg-info">{{ count($report->mocups) }}</span>
                                    <a class=" w-75 " style="color:white" href="{{ route('deleteMocupAll',[$report->id]) }}">
                                        <span type="button" class="btn btn-danger" data-dismiss="modal">&times;</span>
                                    </a>
                                  @else
                                   <td style=" max-width: 250px;">
                                   <form class="form-inline" action="{{ route('addmocups',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input name="image[]" class="form-control" type="file"  style="max-width: 200px;height: 100px;background:#FFE4B5" multiple  required><br>
                                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i></button><br>
                                </form>

                                @endif
                            </td>
                                <div class="modal fade" id="c{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-dismiss="modal">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered"  role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <form class="form-inline" action="{{ route('addmocups',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]" class="form-control"  type="file" multiple required>
                                                <button type="submit" class="btn btn-primary" ><i class="fa-solid fa-square-plus"></i></button><br>
                                            </form>
                                          {{-- <h5 class="modal-title" id="exampleModalLongTitle">Moccup</h5> --}}
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                       <a href="{{ route('dowloadMocupAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a> 
                                        </div>
                                          @foreach ($report->mocups as $rep)
                                          <div class="post-content-{{ $rep->id  }}">
                                            <div class="project" id="projectMocups">
                                            <div style="display: flex;flex-direction: space-between;">
                                                <button onclick="deleteComment({{ $rep->id }})">del</button>
                                                <h5 id="myInput1-{{$rep->id}}" onclick="myFunction1({{$rep->id}})"> <a href="#">https://cantim.s3.ap-southeast-2.amazonaws.com/{{$rep->mocup}}</a></h5>
                                                <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadMocupURL',[$rep->id]) }}" >
                                                        <i class="fa-solid fa-circle-down"></i>
                                                    </a>
                                                <!-- <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadMocupURL',[$rep->id]) }}">
                                                    <h5>{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'. $rep->mocup }} </h5>
                                                </a> -->
                                               </div>
                                                 {{-- <a href="{{ route('deletemocups',[$rep->id]) }}"><span onclick="deletemocups({{ $rep->id }})" class="label label-info label-mini">xoa</span></a> --}}
                                                <div class="photo-wrapper" data-dismiss="modal">
                                                    <div onclick="photoMocups({{ $rep->id }})" >
                                                        <!-- @if(Storage::exists($rep->mocup) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->mocup}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->mocup}}"  width="100%"></a>
                                                    @else
                                                    <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->mocup)}}" alt="" ><img src="{{asset('/storage/'.$rep->mocup)}}"  width="100%"></a>
                                                     @endif -->
                                                     <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->mocup}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->mocup}}"  width="100%"></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                            <form class="form-inline" action="{{ route('addmocups',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]" class="form-control"   type="file" multiple required>
                                                <button type="submit" class="btn btn-primary" ><i class="fa-solid fa-square-plus"></i></button><br>
                                            </form>
                                               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </section>
                                </section>
                                  </div>

                                    @if (count($report->ProductPngDetails)!=0)
                                    <td data-toggle="modal" data-target="#b{{$report->id}}" >
                                        <!-- @if(Storage::exists($report->ProductPngDetails[0]->ImagePngDetail) == 1)
                                        <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail  ?? null }}" style="border-radius: 5%;width: 150px;"  >
                                        @else
                                        <img src="{{asset('/storage/'.$report->ProductPngDetails[0]->ImagePngDetail)}}" style="width: 150px; border-radius: 5%;" >
                                        @endif -->
                                        <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail  ?? null }}" style="border-radius: 5%;width: 150px;"  >

                                    <span class="badge bg-info">{{ count($report->ProductPngDetails) }}</span>
                                    <a class=" w-75 " style="color:white" href="{{ route('deletePngAll',[$report->id]) }}">
                                        <button type="button" class="btn btn-danger" >&times;</button>
                                    </a>
                                </td>
                                    @else
                                    <td style=" max-width: 250px;">
                                    <form class="form-inline" action="{{ route('addPngDetails',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input name="image[]" class="form-control" style=" max-width: 200px;height: 100px;background:#ADD8E6"  type="file" multiple required><br>
                                        <button type="submit" style="border-radius: 10px;background: rgb(228, 250, 106);color:red" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                    </form>
                                </td>
                                  @endif
                                <div class="modal fade" id="b{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          {{-- <h5 class="modal-title" class="form-control" id="exampleModalLongTitle">Modal title</h5> --}}
                                          <form class="form-inline" action="{{ route('addPngDetails',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input name="image[]"  type="file"  multiple required>
                                            <button type="submit" style="border-radius: 10px;background: rgb(228, 250, 106);color:red" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                        </form>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <a href="{{ route('dowloadPNGAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a> 
                                        </div>

                                          @foreach ($report->ProductPngDetails as $rep)

                                          <div class="post-Png-{{ $rep->id  }}">
                                            <div class="project" id="projectPng">
                                                <div style="display: flex;flex-direction: space-between;">
                                                <button class="label label-danger label-mini" onclick="deletePng({{ $rep->id }})">del</button>
                                                <span class="label label-info label-mini"><h5>{{ $rep->Sku}}</h5></span>
                                                <!-- <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadURL',[$rep->id]) }}">
                                                    <h5> {{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImagePngDetail}}</h5>
                                                </a> -->
                                                <h5 id="myInput1-{{$rep->id}}" onclick="myFunction1({{$rep->id}})"> <a href="#">https://cantim.s3.ap-southeast-2.amazonaws.com/{{$rep->ImagePngDetail}}</a></h5>
                                                <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadURL',[$rep->id]) }}" >
                                                        <i class="fa-solid fa-circle-down"></i>
                                                    </a>
                                                </div>

                                                <div class="photo-wrapper" data-dismiss="modal">
                                                    <div onclick="photoPng({{ $rep->id }})">

                                                        <!-- @if(Storage::exists($rep->ImagePngDetail) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImagePngDetail}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImagePngDetail}}"  width="100%"></a>
                                                    @else
                                                    <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImagePngDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImagePngDetail)}}"  width="100%"></a>
                                                    @endif -->
                                                    <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImagePngDetail}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImagePngDetail}}"  width="100%"></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                            <form class="form-inline" action="{{ route('addPngDetails',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]" class="form-control"  type="file" multiple required>
                                                <button type="submit" style="border-radius: 10px;background: rgb(228, 250, 106);color:red" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                            </form>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </section>
                                </section>
                                  </div>

                                @if ($report->status == 1)
                                <td><span class="label label-warning label-mini"><a style="color:white" href="{{route('accept',[$report->id])}}">Get job</a></span></td>
                                @elseif ( $report->status == 2)
                                <td><span class="label label-info label-mini">Accept</span></td>
                                @elseif ( $report->status == 3)
                                <td><span class="label label-info label-mini">Pending</span></td>
                                @elseif ( $report->status == 4)
                                <td><span class="label label-warning label-mini">Remake</span></td>
                                @else
                                <td><span class="label label-success label-mini">Finish</span></td>
                                @endif
                                <td> <span class="btn btn-danger btn-xs">
                                    <a class=" w-75 " style="color:white" href="{{ route('deleteds',[$report->id]) }}"><i class="fa fa-trash-o"></i></a>
                                  </a>
                                 </span></td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
            {{ $reports->links() }}
        </div>


    </section><!-- --/wrapper ---->
</section>
@endsection
