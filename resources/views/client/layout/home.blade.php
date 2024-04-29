@extends('client.app')


@section ('content')
<!--main content start-->
<section id="main-content">
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;" >

        <div class="col-lg-12">
            <div class="form-panel" style=" border-radius: 15px;">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Assign</h4>
                <form class="form-horizontal style-form"action="{{ route('addIdea') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control conten" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input name="image[]"  type="file" multiple >
                        </div>
                    </div>
           <div class="row">
            <div class="col-lg-3">
                <label class="">Designer:</label>
                    <select class="col-lg-3 form-control " id="cars" name="User_id" required>
                        @foreach ($designers as $designer)
                        <option value="{{ $designer->id }}" >{{  $designer->name }}</option>
                        @endforeach
                      </select> <br><br><br>
                    </div>
                     <div class="col-lg-3">
                         <label class="">Category :</label>
                        <select class="col-lg-3 form-control " name="type_id" id= "loaiSP" required>
                            <option value="">Chọn</option>
                            @foreach ($type_products as $type_product)
                            <option value="{{$type_product->id}}" >{{  $type_product->name }}</option>
                            @endforeach
                          </select> <br><br><br>
                     </div>
                     <div class="col-lg-3">
                        <label class="">Size :</label>
                         <select class="col-lg-3 form-control " name="size" id="size" required>
                            <option value="">Không size</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{  $size->name }}</option>
                            @endforeach
                          </select><br><br>
                        </div>
                        <div class="col-lg-3">
                        <label class="">Sku :</label>
                        <input type="text" name="Sku" class="form-control" required>

                        </div>
           </div>
                      <hr>
                      <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            </div>
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel"  style=" border-radius: 15px;background: rgba(255, 255, 255, 0.842)">
                        <h4><i class="fa fa-angle-right"></i> work presentation </h4>
                        <div class="col-lg-4">
                            <h5 style="margin-left: 2%;" class="category"><a style="color: gray" href="{{ route('done') }}"> Finish ({{ $totalDone ?? null}}) </a>
                                 | <a  style="color: rgb(13, 182, 36)" href="{{ route('Pending') }}"> Pending ({{ $totalPending ?? null}})</a>
                                 | <a style="color:red" href="{{ route('NotReceived') }}">Not Received ({{ $totalNotReceived ?? null}})</a>
                                 | <a style="color:red" href="{{ route('allidea') }}"> All ({{ $totalallidea ?? null}})</a>

                                </h5>
                        </div><!-- /col-lg-12 -->
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-lg-4">
                                    {{-- <form action="{{ route('find') }}" class="form-inline"role="form" method="GET"> --}}
                                    <form  class="form-inline"role="form" >
                                      @csrf
                                        <select class="form-control "  id="cars" name="type" >
                                            <option value=" ">Search by type</option>
                                            @foreach ($type_products as $type_product)
                                            <option value="{{$type_product->id}}">{{  $type_product->name }}</option>
                                            @endforeach
                                          </select>
                                          <button type="submit" class="btn btn-theme "><i class="fa-solid fa-magnifying-glass"></i> </button>
                                        </form>
                                </div>
                                <div class="col-lg-4">
                                    <form class="form-inline" role="form">
                                        <div class="form-group">
                                            <label class="sr-only" for="exampleInputEmail2">Search</label>
                                            <input type="text" class="form-control" name="keyword" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword }}" placeholder="Search">
                                        </div>
                                        <button type="submit" class="btn btn-theme"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                </div>
                                <div class="col-lg-4">
                                <div class="row" >
                                    <div class="col-lg-8">
                                        <form class="form-inline" action="{{ route('addplasform') }}" role="form" >
                                            @csrf
                                            <select name="plasform" id="cars" style="border-radius: 5px;"  class="form-control ">
                                            @foreach ($showcornerstones as $show)
                                                <option value="{{ $show->id }}">{{  $show->name }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" style="border-radius: 5px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>

                                    </div>
                                    <div class="col-lg-4">
                                        <span class="btn btn-success btn-xs" alt="acvtiver"><a class=" w-75 " style="color:white" href=" #"><i class="fa fa-check"></i></a></span>
                                    </div>
                                </div>
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

                                @foreach ($reports as  $report)
                                <tr>
                                    <td ><input type="checkbox" name="check_box[]"  value="{{ $report->id }}"></td>
                                    <td><a href="basic_table.html#">{{ $report->User->name ?? null }}</a></td>
                                    <td>{{ $report->type_product->name ?? null }}<b>({{ $report->size->name ?? null  }})</b></td>
                                    <td  style=" max-width: 200px;"><b>{{ $report->title ?? null }}</b></td>
                                    <td  style=" max-width: 200px;"><b>
                                        @foreach ($report->cornerstones as $cornerstone)
                                        <span class="label label-info label-mini">{{ $cornerstone->name}}</span>
                                        @endforeach
                                    <form class="form-inline" action="{{ route('cornerstoneProduct',[$report->id]) }}" method="post">
                                        @csrf
                                    <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                                        @foreach ($showcornerstones as $show)
                                            <option value="{{ $show->id }}">{{  $show->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                     </form>
                                        </b>
                                    </td>
                                    <td class="hidden-phone" style=" max-width: 300px;
                                    overflow: hidden;
                                    text-overflow: ellipsis;
                                   word-wrap: break-word;">{!!  $report->description ?? null !!}
                                        <form class="form-inline" action="{{ route('comment',[$report->id]) }}" method="post">
                                      @csrf
                                          <div class="form-group">
                                                <input type="text" style="border-radius: 15px;" class="form-control" id="exampleInputEmail2" name="comment" placeholder="comment">
                                            </div>
                                            <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                        </form>
                                    </td>
                                    <td><a href="basic_table.html#">{{ $times[$i++] ?? null }}</a></td>
                                    @if(count($report->product_details)!=0)
                                    <td data-toggle="modal" data-target="#a{{$report->id}}">
                                        <div >
                                            <!-- @if(Storage::exists($report->product_details[0]->ImageDetail) == 1)
                                            <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->product_details[0]->ImageDetail}}" style="width: 150px; border-radius: 5%;" >
                                            @else
                                            <img src="{{asset('/storage/'.$report->product_details[0]->ImageDetail)}}" style="width: 150px; border-radius: 5%;" >
                                        @endif -->
                                        <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->product_details[0]->ImageDetail}}" style="width: 150px; border-radius: 5%;" >
                                      @else
                                    <td data-toggle="modal" data-target="#a{{$report->id}}"></td>
                                    @endif
                                    </td>
                                    <div class="modal fade" id="a{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <section id="main-content">
                                            <section class="wrapper">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header" style="display: block">
                                              {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5> --}}
                                              <form class="form-inline" action="{{ route('addImage',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]" class="form-control" type="file" multiple required>
                                                <button type="submit" style="border-radius: 10px;background: rgb(228, 250, 106);color:red" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                            </form>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                              @foreach ($report->product_details as $rep)
                                              <div  class="post-Image-{{ $rep->id  }}">
                                                <div class="project" id="projectClick" >
                                                    <button onclick="deleteImage({{ $rep->id }})">Delete</button>
                                                    <h5> {{$rep->ImageDetail}} </h5>

                                                    {{-- <a href="{{ route('deleteImage',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a> --}}
                                                    <div class="photo-wrapper" >
                                                        <div class="photo" onclick="photoClick({{ $rep->id }})">
                                                            <!-- @if(Storage::exists($rep->ImageDetail) == 1)
                                                            <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}"  width="100%"></a>
                                                        @else
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImageDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImageDetail)}}"  width="100%"></a>
                                                        @endif -->
                                                        <!-- <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImageDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImageDetail)}}"  width="100%"></a> -->
                                                        <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail}}"  width="100%"></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              @endforeach
                                            <div class="modal-footer">
                                              <form class="form-inline" action="{{ route('addImage',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]"  type="file" multiple required>
                                              <button type="submit" class="btn btn-primary" >Add Image Idea</button>
                                            </form>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                    </section>
                                    </section>
                                      </div>
                                      @if (count($report->mocups)!=0)
                                      <td data-toggle="modal" data-target="#c{{$report->id}}">
                                         <span class="badge bg-info">{{ count($report->mocups) }}</span>
                                         <!-- @if(Storage::exists($report->mocups[0]->mocup) == 1)
                                         <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->mocups[0]->mocup}}" style="width: 150px;  border-radius: 5%;" >
                                         @else
                                         <img src="{{asset('/storage/'.$report->mocups[0]->mocup)}}" style="width: 150px;  border-radius: 5%;" >
                                      @endif -->
                                      <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->mocups[0]->mocup}}" style="width: 150px;  border-radius: 5%;" >


                                    </td>
                                        @else
                                        <td data-toggle="modal" data-target="#c{{$report->id}}"></td>
                                       @endif
                                    <div class="modal fade" id="c{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <section id="main-content">
                                            <section class="wrapper">
                                        <div class="modal-dialog modal-dialog-centered" role="doc ument">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                <a href="{{ route('dowloadMocupAll',[$report->id]) }}"><buttontype="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></buttontype=></a>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>

                                              @foreach ($report->mocups as $rep)
                                              <div class="project-wrapper">
                                                <h5  id="myInputs-{{$rep->id}}" onclick="myFunctions({{$rep->id}})">https://cantim.s3.ap-southeast-2.amazonaws.com/{{ $rep->mocup }} </h5>
                                                <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadMocupURL',[$rep->id]) }}">
                                                    <i class="fa-solid fa-circle-down"></i>
                                                </a>
                                                <div class="project" id='projectMocups'>
                                                    <div class="photo-wrapper">
                                                        <div class="photo" onclick="photoMocups({{ $rep->id }})" >
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
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                    </section>
                                    </section>
                                      </div>

                                        @if (count($report->ProductPngDetails)!=0)
                                    <td data-toggle="modal" data-target="#b{{$report->id}}">
                                        <span class="badge bg-info">{{ count($report->ProductPngDetails) }}</span>
                                        <!-- @if(Storage::exists($report->ProductPngDetails[0]->ImagePngDetail) == 1)
                                        <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail  ?? null }}" style="border-radius: 5%;width: 150px;"  >
                                        @else
                                        <img src="{{asset('/storage/'.$report->ProductPngDetails[0]->ImagePngDetail)}}" style="width: 150px; border-radius: 5%;" >
                                    @endif -->
                                    <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail  ?? null }}" style="border-radius: 5%;width: 150px;"  >

                                    </td>
                                        @else
                                        <td style=" max-width: 250px;">
                                            <form class="form-inline" action="{{ route('addPngDetailsIdea',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                             @csrf
                                             <input name="image[]" class="form-control" type="file"  style="max-width: 200px;height: 100px;background:#FFE4B5" multiple  required><br>
                                             <button type="submit" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i></button><br>
                                            </form>
                                        </td>
                                         @endif

                                    <div class="modal fade" id="b{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <section id="main-content">
                                            <section class="wrapper">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                                {{-- <a href="{{ route('dowloadPNGAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a> --}}
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>

                                              @foreach ($report->ProductPngDetails as $rep)
                                              <div class="project-wrapper">
                                                <div style="display: flex;flex-direction: space-between;">
                                                    @if($report->Sku!=null)
                                                    <span style="margin-right:5px" class="label label-info label-mini" id="myInput-{{$rep->id}}" onclick="myFunction({{$rep->id}})" ><h5 >{{$report->Sku}}</h5></span>
                                                    <div class="col-lg-12">
                                                        <div class="form-panel">
                                                        <form class="form-inline" action="{{ route('addSku',[$report->id]) }}" method="GET" role="form">
                                                            <div class="form-group">
                                                                <label class="sr-only" for="exampleInputEmail2">Sku</label>
                                                                <input type="text" name="Sku" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                                            </div>
                                                            <button type="submit" class="btn btn-theme">Add Sku</button>
                                                        </form>
                                                        </div><!-- /form-panel -->
                                                    </div>
                                                    @else
                                                     <div class="col-lg-12">
                                                        <div class="form-panel">
                                                        <form class="form-inline" action="{{ route('addSku',[$report->id]) }}" method="GET" role="form">
                                                            <div class="form-group">
                                                                <label class="sr-only" for="exampleInputEmail2">Sku</label>
                                                                <input type="text" name="Sku" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                                            </div>
                                                            <button type="submit" class="btn btn-theme">Add Sku</button>
                                                        </form>
                                                        </div><!-- /form-panel -->
                                                    </div>
                                                    @endif
                                                    <h5 id="myInput1-{{$rep->id}}" onclick="myFunction1({{$rep->id}})"> <a href="#">https://cantim.s3.ap-southeast-2.amazonaws.com/{{$rep->ImagePngDetail}}</a></h5>
                                                    <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadURL',[$rep->id]) }}" >
                                                        <i class="fa-solid fa-circle-down"></i>
                                                    </a>
                                                    </div>
                                                <div class="project" id="projectPng">
                                                    <div class="photo-wrapper">
                                                        <div class="photo" id="photoPng" onclick="photoPng({{ $rep->id }})">
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
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </div>
                                          </div>
                                        </div>
                                    </section>
                                    </section>
                                      </div>


                                    @if ($report->status == 1)
                                    <td><span class="label label-warning label-mini">Not Received</span></td>
                                    @elseif ( $report->status == 2)
                                    <td><span class="label label-info label-mini">Accept</span></td>
                                    @elseif ( $report->status == 3)
                                    <td><span class="label label-info label-mini">Pending</span></td>
                                    @elseif ( $report->status == 4)
                                    <td><span class="label label-warning label-mini">Remake</span></td>
                                    @else
                                    <td><span class="label label-success label-mini">Finish</span></td>
                                    @endif
                                    <td>
                                        <span class="btn btn-success btn-xs" alt="chi tiết">
                                            {{-- @if( $report->status == 3) --}}
                                            <a class=" w-75 " style="color:white" href="{{ route('success',[$report->id]) }}"><i class="fa fa-check" alt="chi tiết"></i></a>
                                            {{-- @else
                                            <i class="fa fa-check" alt="chi tiết"></i>
                                            @endif --}}
                                              </span>
                                              <span class="btn btn-primary btn-xs">
                                                @if( $report->status == 3)
                                                <a class=" w-75 " style="color:white" href="{{ route('approvalShow',[$report->id]) }}"><i class="fa fa-pencil"></i></a>
                                                @else
                                                <a class=" w-75 " style="color:white" href="{{ route('EditShow',[$report->id]) }}"><i class="fa fa-pencil"></i></a>
                                                @endif
                                              </a>
                                             </span>
                                             <span class="btn btn-danger btn-xs">
                                                <a class=" w-75 " style="color:white" href="{{ route('delete',[$report->id]) }}"><i class="fa fa-trash-o"></i></a>
                                              </a>
                                             </span>
                                             <span class="btn btn-success btn-xs">
                                                <a class=" w-75 " style="color:white" href="{{ route('exportsamz',[$report->id]) }}"><i class="fa-solid fa-circle-down"></i></a>
                                              </a>
                                             </span>
                                             @if($report->action== 1 &&  $report->status != 5)
                                             <span class="label label-warning btn-xs">
                                                <a class=" w-75 " style="color:white" href="{{ route('important',[$report->id]) }}">Impor</a>
                                              </a>
                                             </span>
                                             @endif

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </form>
                        </table>

                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->

                {{ $reports->links() }}
            </div>
             <!-- Modal -->

    </section>
</section>

<!--main content end-->
@endsection

@push('scripts')

<script>

    function myFunction(id) {

        // Get the text field
        var copyText = document.getElementById('myInput-'+id);

        // Select the text field
        // copyText.select();
        // alert("Copied the text: " + copyText.innerText);

        // copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.innerText);
        document.getElementById('myInput-'+id).style.color = "magenta";

        // alert("Copied the text: " + copyText.innerText);
        // Alert the copied text

    }

</script>
<script>

    function myFunctions(id) {

        // Get the text field
        var copyText = document.getElementById('myInputs-'+id);

        // Select the text field
        // copyText.select();
        // alert("Copied the text: " + copyText.innerText);

        // copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.innerText);

        document.getElementById('myInputs-'+id).style.color = "magenta";

        // alert("Copied the text: " + copyText.innerText);
        // Alert the copied text

    }

</script>
<script>
        function myFunction1(id) {
            // Get the text field
            var copyText = document.getElementById('myInput1-'+id);

            // Select the text field
            // copyText.select();

            // copyText.setSelectionRange(0, 99999); // For mobile devices

            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.innerText);

            document.getElementById('myInput1-'+id).style.color = "magenta";

            // alert("Copied the text: " + copyText.innerText);
// Alert the copied text

}
</script>
<script>
var imageAPI='/deleteImage'
//api xoa api
function deleteImage(id) {
      var option = {
          method: 'GET', // *GET, POST, PUT, DELETE, etc.
          headers: {
              'Content-Type': 'application/json',
                  // 'Content-Type': 'application/x-www-form-urlencoded',
            //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
      }
      alert
      fetch(imageAPI + '/' + id, option)
          .then(function(response) {
              console.log(response);
              return response.json();
          })
          .then(function() {
                  var xoaHtml = document.querySelector('.post-Image-' + id)
                  if (xoaHtml) {
                      xoaHtml.remove();
              };
          });
  }
  //ket thuc
$(document).ready(function(){

  $("#loaiSP").change(function(){
    var loaiSP = $(this).val();
    // alert(loaiSP);
    $.get("ajax/"+loaiSP, function(data){
        console.log(data);
      $("#size").html(data);
    });
  });
});

function photoClick(id) {
    var text = "1"
    $.get("checkdownloadClick/"+text);
    return text
}
function photoMocups(id) {
    var text = "2"
    $.get("checkdownloadClick/"+text);
    return text
}
function photoPng(id) {
    var text = "3"
    $.get("checkdownloadClick/"+text);
    return text
}
</script>
<script language="JavaScript">
    window.onload = function() {
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        }, false);
        document.addEventListener("keydown", function(e) {
            //document.onkeydown = function(e) {
            // "I" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                disabledEvent(e);
            }
            // "J" key
            if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                disabledEvent(e);
            }
            // "S" key + macOS
            if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                disabledEvent(e);
            }
            // "U" key
            if (e.ctrlKey && e.keyCode == 85) {
                disabledEvent(e);
            }
            // "F12" key
            if (event.keyCode == 123) {
                disabledEvent(e);
            }
        }, false);

        function disabledEvent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            } else if (window.event) {
                window.event.cancelBubble = true;
            }
            e.preventDefault();
            return false;
        }
    };
</script>



@endpush
