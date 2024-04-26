@extends('admin.app')


@section ('content')
<section id="main-content">
    <section class="wrapper"  style="color:black; font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;">
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel" style = "background: rgba(255, 255, 255, 0.842)" >
                    <h4><i class="fa fa-angle-right"></i>Nhận việc</h4><hr>
                    <table class="table table-striped table-advance table-hover">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 style="margin-left: 2%;" class="category"><a style="color: rgb(13, 182, 36)" href="{{ route('detailUserdone',[$id]) }}">Hoàn thành ({{ $totalDone ?? null}}) </a>
                                    | <a  style="color: rgb(79, 76, 230)" href="#">làm lại ({{ $totalPending ?? null}})</a>
                                    | <a style="color:orange" href="#">chưa nhận ({{ $totalNotSeen ?? null}})</a>
                                    | <a style="color:rgb(225, 0, 255)" href="{{ route('detailUserPending',[$id])}}">Đang làm ({{ $totalPendingDS ?? null}})</a>
                                    | <a style="color:red" href="#">ưu tiên ({{ $totalprioritize ?? null}})</a></h4>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-panel">
                                    <h4 class="mb"><i class="fa fa-angle-right"></i>Add Cornerstones</h4>
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
                            {{-- <div class="col-lg-3">
                                    <div class="form-panel">
                                        <h4 class="mb"><i class="fa fa-angle-right"></i>delete Cornerstones</h4>
                                        <form class="form-inline" action="{{ route('deleteplasform') }}" role="form" >
                                            @csrf
                                        <select name="plasform" id="cars" style="border-radius: 5px;"  class="form-control ">
                                            @foreach ($showcornerstones as $show)
                                                <option value="{{ $show->id }}">{{  $show->name }}</option>
                                            @endforeach
                                        </select>
                                    <button type="submit" style="border-radius: 5px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                            </div> --}}
                        </div>
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="checkall" value=""></th>
                            <th><i class="fa fa-bullhorn"></i>Idea</th>
                            <th><i class="fa fa-bullhorn"></i> Categories(size)</th>
                            <th><i class="fa fa-bullhorn"></i> Title</th>
                            <th><i class="fa fa-bullhorn"></i> Cornerstones</th>
                            <th><i class="fa fa-bullhorn"></i> Time</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description </th>
                            <th><i class="fa fa-bookmark"></i> Idea </th>
                            <th><i class=" fa fa-edit"></i> Mockup </th>
                            <th><i class=" fa fa-edit"></i> PNG</th>
                            <th><i class=" fa fa-edit"></i> Status</th>
                            <th><i class=" fa fa-edit"></i> Action</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($reports as  $report)
                            <tr>
                                <td ><input type="checkbox" name="check_box[]"  value="{{ $report->id }}"></td>
                                <td><a href="basic_table.html#">{{$name[$i++][0]->name?? null }}</a></td>
                                <td><a href="basic_table.html#">{{ $report->type_product->name ?? null }}({{ $report->size->name ?? null  }})</a></td>
                                <td  style=" max-width: 200px;"><b>{{ $report->title ?? null }}</b></td>
                                <td  style=" max-width: 200px;"><b>
                                    @foreach ($report->cornerstones as $cornerstone)
                                    <span class="label label-info label-mini">{{ $cornerstone->name}}</span>
                                    @endforeach
                                     {{-- <form class="form-inline" action="{{ route('cornerstoneProduct',[$report->id]) }}" method="post">
                                    @csrf
                                    <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                                    @foreach ($showcornerstones as $show)
                                        <option value="{{ $show->id }}">{{  $show->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                            </form> --}}
                        </b></td>
                                @if (count($report->mocups)!=0)
                                    <td class="hidden-phone">{{  $report->mocups[0]->updated_at ?? null }}
                                    @elseif(count($report->ProductPngDetails)!=0)
                                    <td class="hidden-phone">{{  $report->ProductPngDetails[0]->updated_at ?? null }}
                                        @else
                                        <td class="hidden-phone">{{ 'doing' ?? null }}
                                     @endif
                                <td class="hidden-phone"
                                style=" max-width: 400px;
                                overflow: hidden;
                                text-overflow: ellipsis;
                               word-wrap: break-word;">{!!  $report->description ?? null !!}
                                    {{-- <form class="form-inline" action="{{ route('componentDesigner',[$report->id]) }}" method="post">
                                        @csrf
                                          <div class="form-group">
                                                  <input type="text" class="form-control" id="exampleInputEmail2" name="comment" placeholder="comment">
                                              </div>
                                              <button type="submit" class="btn btn-theme">gửi</button>
                                          </form> --}}
                                </td>
                                <td data-toggle="modal" data-target="#a{{$report->id}}">
                                    @if  (count($report->product_details)!=0)
                                    @if(Storage::exists($report->product_details[0]->ImageDetail) == 1)
                                <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->product_details[0]->ImageDetail}}" style="width: 150px; border-radius: 5%;" >
                                @else
                                <img src="{{asset('/storage/'.$report->product_details[0]->ImageDetail)}}" style="width: 150px; height :150px;  border-radius: 5%;" >
                                @endif
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
                                          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                          @foreach ($report->product_details as $rep)
                                          <div class="project-wrapper">
                                            <div class="project">
                                                <div class="photo-wrapper">
                                                    <div class="photo">
                                                        @if(Storage::exists($rep->ImageDetail) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImageDetail}}"  width="100%"></a>
                                                        @else
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImageDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImageDetail)}}"  width="100%"></a>
                                                        @endif
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
                                  <td data-toggle="modal" data-target="#c{{$report->id}}">
                                    @if(Storage::exists($report->mocups[0]->mocup) == 1)
                                    <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->mocups[0]->mocup}}" style="width: 150px;  border-radius: 5%;" >
                                    @else
                                    <img src="{{asset('/storage/'.$report->mocups[0]->mocup)}}" style="width: 150px; height :150px;  border-radius: 5%;" >
                                 @endif
                                    <span class="badge bg-info">{{ count($report->mocups) }}</span>
                                    @else
                                    <td data-toggle="modal" data-target="#c{{$report->id}}">
                                @endif
                            </td>
                                <div class="modal fade" id="c{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <a href="{{ route('dowloadMocupAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a> --}}
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                          @foreach ($report->mocups as $rep)
                                          <div class="project-wrapper">
                                            <div class="project">
                                                <a href="{{ route('deletemocups',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a>
                                                <h5> <a href="{{ route('dowloadMocupURL',[$rep->id]) }}">{{$rep->mocup}}</a></h5>
                                                {{-- <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadMocupURL',[$rep->id]) }}">
                                                    <i class="fa-solid fa-circle-down"></i>
                                                </a> --}}

                                                {{-- @if(Storage::exists($rep->mocup) == 1)
                                                <span class="label label-default">{{ getimagesize('https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->mocup)[3] ?? null }}</span>
                                                @else
                                                <span class="label label-default">{{ getimagesize(asset('/storage/'.$rep->mocup))[3] ?? null }}</span>
                                                @endif --}}

                                                <div class="photo-wrapper">
                                                    <div class="photo">
                                                        @if(Storage::exists($rep->mocup) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->mocup}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->mocup}}"  width="100%"></a>
                                                        @else
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->mocup)}}" alt="" ><img src="{{asset('/storage/'.$rep->mocup)}}"  width="100%"></a>
                                                         @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                            {{-- <form class="form-inline" action="{{ route('addmocups',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]"  type="file" multiple required>
                                              <button type="submit" class="btn btn-primary" >Add Image Idea</button>
                                            </form> --}}
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </section>
                                </section>
                                  </div>

                                    @if (count($report->ProductPngDetails)!=0)
                                    <td data-toggle="modal" data-target="#b{{$report->id}}">
                                        @if(Storage::exists($report->ProductPngDetails[0]->ImagePngDetail) == 1)
                                        <img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail  ?? null }}" style="border-radius: 5%;width: 150px;"  >
                                        @else
                                        <img src="{{asset('/storage/'.$report->ProductPngDetails[0]->ImagePngDetail ) ?? null }}" style="border-radius: 5%;width: 150px; height :150px"  >
                                    @endif
                                    <span class="badge bg-info">{{ count($report->ProductPngDetails) }}</span>
                                </td>
                                    @else
                                    <td>
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
                                            <div class="project">
                                                <a href="{{ route('deleteProductPngDetails',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a>
                                                <h5> <a href="{{ route('dowloadURL',[$rep->id]) }}">{{$rep->ImagePngDetail}}</a></h5>
                                                {{-- <a class=" w-75 " style="color:rgb(59, 25, 151)" href="{{ route('dowloadMocupURL',[$rep->id]) }}">
                                                    <i class="fa-solid fa-circle-down"></i>
                                                </a> --}}
                                                     {{-- @if(Storage::exists($rep->ImagePngDetail) == 1)
                                                        <span class="label label-default">{{ getimagesize('https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImagePngDetail)[3] ?? null}}</span>
                                                        @else
                                                        <span class="label label-default">{{ getimagesize(asset('/storage/'.$rep->ImagePngDetail))[3] ?? null}}</span>
                                                     @endif --}}
                                                <div class="photo-wrapper">
                                                    <div class="photo">
                                                        @if(Storage::exists($rep->ImagePngDetail) == 1)
                                                        <a class="fancybox" target="_blank" href="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImagePngDetail}}" alt="" ><img src="{{'https://hblmedia.s3.ap-southeast-1.amazonaws.com/'.$rep->ImagePngDetail}}"  width="100%"></a>
                                                        @else
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImagePngDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImagePngDetail)}}"  width="100%"></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                            {{-- <form class="form-inline" action="{{ route('addPngDetails',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]"  type="file" multiple required>
                                              <button type="submit" class="btn btn-primary" >Add Image Idea</button>
                                            </form> --}}
                                            <a class=" w-75 " style="color:white" href="{{ null }}">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">DELETE ALL</button>
                                            </a>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                      </div>
                                    </div>
                                </section>
                                </section>
                                  </div>

                                @if ($report->status == 1)
                                <td><span class="label label-warning label-mini"><a style="color:white" href="{{route('accept',[$report->id])}}">Nhận việc</a></span></td>
                                @elseif ( $report->status == 2)
                                <td><span class="label label-info label-mini">đã nhận</span></td>
                                @elseif ( $report->status == 3)
                                <td><span class="label label-info label-mini">chờ duyệt</span></td>
                                @elseif ( $report->status == 4)
                                <td><span class="label label-warning label-mini">Làm lại</span></td>
                                @else
                                <td><span class="label label-success label-mini">hoàn thành</span></td>
                                @endif

                                <td>
                                    <span class="btn btn-primary btn-xs">
                                        @if ($report->status != 1)
                                        <a class=" w-75 " style="color:white; border-radius: 3%;" href="{{ route('Detail',[$report->id]) }}"><i class="fa fa-pencil"></i></a>
                                      </a>
                                      @else
                                       <i class="fa fa-pencil"></i>
                                      @endif
                                     </span>
                                     @if($report->action== 2 &&  $report->status != 5)
                                     <td><span class="label label-danger label-mini">ưu tiên</span></td>
                                     @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                    <button type="button" class="btn btn-primary"><a style="color:white" href="{{ route('Dashboard') }}">refresh trang</a></button>

                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div>
        {{ $reports->links() }}
    </section>
</section>
@endsection
