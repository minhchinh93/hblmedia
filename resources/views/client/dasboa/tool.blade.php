@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper" style=" background: rgba(236, 240, 240, 0.644);color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">
        <div class="row mt">
            <div class="col-lg-3">
                <div class="form-panel"  style=" border-radius: 20px;">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Category</h4>
                    <form class="form-inline"action="{{ route('postTypeProduct') }}" method="post" >
                        @csrf
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">ten loai sp</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" name="name" placeholder="ten loai sp">
                        <label class="sr-only" for="exampleInputEmail3">Size cách nhau |(Không size)</label>
                        <input type="text" class="form-control" id="exampleInputEmail3" name="size" placeholder="Size cách nhau '|'">
                    </div>
                    <button type="submit" class="btn btn-theme">tao</button>
                </form>
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->

            <div class="col-lg-3" >
                <div class="form-panel" style=" border-radius: 20px;">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> cornerstone</h4>
                    <form class="form-inline"action="{{ route('cornerstone') }}" method="post" >
                        @csrf
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">ten loai nen tang</label>
                        <input type="text" class="form-control" id="exampleInputEmail2" name="name" placeholder="ten loai sp">
                        {{-- <label class="sr-only" for="exampleInputEmail3">Size cách nhau |(Không size)</label> --}}
                        {{-- <input type="text" class="form-control" id="exampleInputEmail3" name="size" placeholder="Size cách nhau '|'"> --}}
                    </div>
                    <button type="submit" class="btn btn-theme">tao</button>
                </form>
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->

            <div class="col-lg-3">
                <div class="form-panel"  style=" border-radius: 20px;">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> add cornerstone</h4>
                  <form class="form-inline" action="{{ route('cornerstoneadd') }}" method="post">
                    @csrf
                    <select name="users" id="cars" style="border-radius: 15px;" class="form-control">
                    @foreach ($users as $show)
                        <option value="{{ $show->id }}">{{  $show->name }}</option>
                    @endforeach
                    </select>
                    <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                    @foreach ($shows as $showss)
                        <option value="{{ $showss->id }}">{{  $showss->name }}</option>
                    @endforeach
                </select>
                <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->
            <div class="col-lg-3">
                <div class="form-panel"  style=" border-radius: 20px;">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> xoa cornerstone</h4>
                  <form class="form-inline" action="{{ route('cornerstonedele') }}" method="post">
                    @csrf
                    <select name="users" id="cars" style="border-radius: 15px;" class="form-control">
                    @foreach ($users as $show)
                        <option value="{{ $show->id }}">{{  $show->name }}</option>
                    @endforeach
                    </select>
                    <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                    @foreach ($shows as $showss)
                        <option value="{{ $showss->id }}">{{  $showss->name }}</option>
                    @endforeach
                </select>
                <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
                </div><!-- /form-panel -->
            </div><!-- /col-lg-12 -->
        </div>
     <hr>
        {{-- <div class="row mt" >
            <div class="col-md-12" >
                <div class="content-panel"  style=" border-radius: 20px;">
                    <h4><i class="fa fa-angle-right"></i>  Bảng Báo Cáo</h4>
                    @if(Auth::user()->role == 3)
                    <a href="{{ route('AadminHome') }}">
                        <button type="button" class="btn btn-theme02"><i class="fa fa-check"></i> Back to admin</button>
                    </a>
                    @endif
                    <div class="col-lg-4">
                        <h4 style="margin-left: 2%;" class="category"><a style="color: gray" href="#"> Hoàn thành ({{ $totalDone ?? null}}) </a>
                             | <a  style="color: rgb(13, 182, 36)" href="#">chờ duyệt ({{ $totalPending ?? null}})</a>
                             | <a style="color:red" href="#">chưa nhận ({{ $totalNotReceived ?? null}})</a>
                             | <a style="color:red" href="#"> tất cả ({{ $totalallidea ?? null}})</a>

                            </h4>
                    </div><!-- /col-lg-12 -->
                    <div class="col-lg-4">
                        <form class="form-inline" >
                            <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                            @foreach ($shows as $show)
                                <option value="{{ $show->id }}">{{  $show->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <form class="form-inline" role="form">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail2">tim kiem</label>
                                        <input type="text" class="form-control" name="keyword" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword }}" placeholder="tim kiem">
                                    </div>
                                    <button type="submit" class="btn btn-theme">tim kiem</button>
                                </form>
                            </div>
                        </div>
                   </div><!-- /col-lg-12 -->


                    <table class="table table-striped table-advance table-hover">
                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i> Designer</th>
                            <th><i class="fa fa-bullhorn"></i> Category(size)</th>
                            <th><i class="fa fa-bullhorn"></i> Title</th>
                            <th><i class="fa fa-bullhorn"></i> cornerstones</th>
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
                                <td><a href="#">{{$report->user->name ?? null }}</a></td>
                                <td>{{ $report->type_product->name ?? null }}<b>({{ $report->size->name ?? null  }})</b></td>
                                <td  style=" max-width: 150px;"><b>{{ $report->title ?? null }}</b></td>
                                <td  style=" max-width: 150px;"><br>@foreach ($report->cornerstones as $cornerstone)
                                    <span class="label label-info label-mini">{{ $cornerstone->name}}</span><br/><br/>
                                    @endforeach
                                    <form class="form-inline" action="{{ route('cornerstoneProduct',[$report->id]) }}" method="post">
                                        @csrf
                                        <select name="cornerstone" id="cars" style="border-radius: 15px;" class="form-control">
                                        @foreach ($shows as $show)
                                            <option value="{{ $show->id }}">{{  $show->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                                </form>
                                    </b></td>
                                <td class="hidden-phone"
                                style=" max-width: 300px;
                                color:black;
                                overflow: hidden;
                                text-overflow: ellipsis;
                               word-wrap: break-word;">{!!  $report->description ?? null !!}
                                    <form class="form-inline" action="{{ route('comment',[$report->id]) }}" method="post">
                                  @csrf
                                      <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputEmail2" name="comment" placeholder="comment">
                                        </div>
                                        <button type="submit" class="btn btn-theme">gửi</button>
                                    </form>
                                </td>
                                <td><a href="#">{{ $report->created_at ?? null }}</a></td>
                                @if(count($report->product_details)!=0)
                                <td data-toggle="modal" data-target="#a{{$report->id}}"><img src="{{asset('/storage/'.$report->product_details[0]->ImageDetail)}}" style="width: 150px; height :150px;  border-radius: 5%;" >
                                  @else
                                <td data-toggle="modal" data-target="#a{{$report->id}}"></td>
                                @endif
                                </td>
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
                                                {{ route('dowloadMocupURL',[$rep->id]) }}
                                                <a href="{{ route('deleteImage',[$rep->id]) }}"><span class="label label-info label-mini">xoa</span></a>
                                                <div class="photo-wrapper">
                                                    <div class="photo" onclick="photoClick({{ $rep->id }})">
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImageDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImageDetail)}}"  width="100%"></a>
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
                                    <img src="{{asset('/storage/'.$report->mocups[0]->mocup)}}" style="width: 150px; height :150px;  border-radius: 5%;" ></td>
                                    @else
                                    <td data-toggle="modal" data-target="#c{{$report->id}}"></td>
                                   @endif
                                <div class="modal fade" id="c{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <section id="main-content">
                                        <section class="wrapper">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                            <a href="{{ route('dowloadMocupAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>

                                          @foreach ($report->mocups as $rep)
                                          <div class="project-wrapper">
                                            <h5> <a href="{{ route('dowloadMocupURL',[$rep->id]) }}">{{$rep->mocup}}</a></h5>
                                            <div class="project">
                                                <div class="photo-wrapper">
                                                    <div class="photo" onclick="photoMocups({{ $rep->id }})">
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->mocup)}}" alt="" ><img src="{{asset('/storage/'.$rep->mocup)}}"  width="100%"></a>
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
                                <td data-toggle="modal" data-target="#b{{$report->id}}">
                                    @if (count($report->ProductPngDetails)!=0)
                                    <span class="badge bg-info">{{ count($report->ProductPngDetails) }}</span>
                                    <img src="{{asset('/storage/'.$report->ProductPngDetails[0]->ImagePngDetail ) ?? null }}" style="border-radius: 5%;width: 150px; height :150px"  >
                                    @endif

                                </td>
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
                                          <a href="{{ route('dowloadPNGAll',[$report->id]) }}"><button type="button" class="btn btn-warning"><i class="fa-solid fa-cart-arrow-down"></i></button></a>
                                        </div>
                                          @foreach ($report->ProductPngDetails as $rep)
                                          <div class="project-wrapper">
                                            <div style="display: flex;flex-direction: space-between;">
                                                <span style="margin-right:5px" class="label label-info label-mini"><h5>{{ $rep->Sku}}</h5></span>
                                                <h5> <a href="{{ route('dowloadURL',[$rep->id]) }}">{{$rep->ImagePngDetail}}</a></h5>
                                                </div>
                                            <div class="project">
                                                <div class="photo-wrapper">
                                                    <div class="photo" onclick="photoPng({{ $rep->id }})">
                                                        <a class="fancybox" target="_blank" href="{{asset('/storage/'.$rep->ImagePngDetail)}}" alt="" ><img src="{{asset('/storage/'.$rep->ImagePngDetail)}}"  width="100%"></a>
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
                                <td><span class="label label-warning label-mini">chưa nhận</span></td>
                                @elseif ( $report->status == 2)
                                <td><span class="label label-info label-mini">đã nhận</span></td>
                                @elseif ( $report->status == 3)
                                <td><span class="label label-info label-mini">chờ duyệt</span></td>
                                @elseif ( $report->status == 4)
                                <td><span class="label label-warning label-mini">làm lại</span></td>
                                @else
                                <td><span class="label label-success label-mini">hoàn thành</span></td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
            {{ $reports->links() }}
        </div> --}}
    </section>
</section>

@endsection


@push('scripts')
<script>
var imageAPI='/deleteImage'
//api xoa api
function deleteImage(id) {
      var option = {
          method: 'GET', // *GET, POST, PUT, DELETE, etc.
          headers: {
              'Content-Type': 'application/json'
                  // 'Content-Type': 'application/x-www-form-urlencoded',
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
