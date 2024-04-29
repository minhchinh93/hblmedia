@extends('admin.app')


@section ('content')
<section id="main-content">
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif; ">
        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel" >
                    <h4><i class="fa fa-angle-right"></i>Nhận việc</h4><hr>
                    <table class="table table-striped table-advance table-hover">
                        <h4 style="margin-left: 2%;" class="category"><a style="color: rgb(13, 182, 36)" href="#">Hoàn thành ({{ $totalDone ?? null}}) </a>
                            | <a  style="color: rgb(79, 76, 230)" href="#">làm lại ({{ $totalPending ?? null}})</a>
                            | <a style="color:orange" href="#">chưa nhận ({{ $totalNotSeen ?? null}})</a>
                            | <a style="color:rgb(225, 0, 255)" href="#">Đang làm ({{ $totalPendingDS ?? null}})</a>
                            | <a style="color:red" href="#">ưu tiên ({{ $totalprioritize ?? null}})</a></h4>

                        <thead>
                        <tr>

                            <th><i class="fa fa-bullhorn"></i>checkbox</th>
                            <th><i class="fa fa-bullhorn"></i>Idea</th>
                            <th><i class="fa fa-bullhorn"></i> categories(size)</th>
                            <th><i class="fa fa-bullhorn"></i> Title</th>
                            <th><i class="fa fa-bullhorn"></i> cornerstones</th>
                            <th><i class="fa fa-bullhorn"></i> time</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description </th>
                            <th><i class="fa fa-bookmark"></i> Idea </th>
                            <th><i class=" fa fa-edit"></i> Mockup </th>
                            <th><i class=" fa fa-edit"></i> PNG</th>
                            <th><i class=" fa fa-edit"></i> status</th>
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
                                <td ><input type="checkbox" name="checkbox[]"  value="{{ $report->id ?? null }}"></td>
                                <td><a href="basic_table.html#">{{ $report->User->name ?? null }}</a></td>
                                <td><a href="basic_table.html#">{{ $report->type_product->name ?? null }}({{ $report->size->name ?? null  }})</a></td>
                                <td  style=" max-width: 200px;"><b>{{ $report->title ?? null }}</b></td>
                                <td  style=" max-width: 100px;"><b>@foreach ($report->cornerstones as $cornerstone)
                                    <span class="label label-info label-mini">{{ $cornerstone->name}}</span>
                                    @endforeach</b></td>
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
                                </td>
                                   <td data-toggle="modal" data-target="#a{{$report->id}}">
                                    @if  (count($report->product_details)!=0)
                                   <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->product_details[0]->ImageDetail)}}" style="width: 150px; height :150px;  border-radius: 5%;" >
                                   @else

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
                                                        <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail)}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImageDetail)}}"  width="100%"></a>
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
                                  <td data-toggle="modal" data-target="#c{{$report->id}}"><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->mocups[0]->mocup)}}" style="width: 150px; height :150px;  border-radius: 5%;" >
                                    @else
                                    <td  data-toggle="modal" data-target="#c{{$report->id}}">
                                   @endif
                            </td>
                                <div class="modal fade" id="c{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          {{-- <h5 class="modal-title" id="exampleModalLongTitle">Moccup</h5> --}}
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                          <a class=" w-75 " style="color:white" href="{{ route('deleteMocupAll',[$report->id]) }}">
                                            <span type="button" class="btn btn-danger" data-dismiss="modal">DELETE ALL</span>
                                        </a>
                                        </div>

                                          @foreach ($report->mocups as $rep)
                                          <div class="project-wrapper">
                                            <div class="project">
                                                <a href="{{ route('deletemocups',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a>
                                                <div class="photo-wrapper">
                                                    <div class="photo">
                                                        <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->mocup)}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->mocup)}}"  width="100%"></a>
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
                                    <img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$report->ProductPngDetails[0]->ImagePngDetail)}}" style="border-radius: 5%;width: 150px; height :150px"  >
                                </td>
                                  @else
                                    <td data-toggle="modal" data-target="#b{{$report->id}}">
                                   @endif
                                <div class="modal fade" id="b{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

                                          @foreach ($report->ProductPngDetails as $rep)
                                          <div class="project-wrapper">
                                            <div class="project">
                                                <a href="{{ route('deleteProductPngDetails',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a>
                                                <div class="photo-wrapper">
                                                    <div class="photo">
                                                        <a class="fancybox" target="_blank" href="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImagePngDetail)}}" alt="" ><img src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$rep->ImagePngDetail)}}"  width="100%"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                          @endforeach
                                        <div class="modal-footer">
                                            <form class="form-inline" action="{{ route('addPngDetails',[$report->id]) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input name="image[]"  type="file" multiple required>
                                              <button type="submit" class="btn btn-primary" >Add Image Idea</button>
                                            </form>
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
                    <button type="button" class="btn btn-primary"><a style="color:white" href="{{ route('Dashboard') }}">refresh trang</a></button>

                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div>
        {{ $reports->links() }}
    </section>
</section>
@endsection
