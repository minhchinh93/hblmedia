@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper" data-dismiss="modal" style="color:black; font-family:Roboto,sans-serif;background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;">
        <div class="row mt" >
            <div class="col-md-12">
                <div class="content-panel" style=" border-radius: 20px;background: rgba(236, 240, 240, 0.876)">
                    <h4><i class="fa fa-angle-right"></i> Daily Work </h4><hr>

                    <table class="table table-striped table-advance table-hover">
                        <div class="row">
                            <div class="col-lg-9">
                        <h5 style="margin-left: 2%;" class="category"><a style="color: rgb(13, 182, 36)" href="{{ route('complete') }}">Finish ({{ $totalDone ?? null}}) </a>
                            | <a  style="color: rgb(79, 76, 230)" href="{{ route('replay') }}">Remake ({{ $totalPending ?? null}})</a>
                            | <a style="color:orange" href="{{ route('NotSeen') }}">Not Received ({{ $totalNotSeen ?? null}})</a>
                            | <a style="color:rgb(225, 0, 255)" href="{{ route('PendingDS') }}">Pending ({{ $totalPendingDS ?? null}})</a>
                            | <a style="color:red" href="{{ route('prioritize') }}">Important ({{ $totalprioritize ?? null}})</a></h5>
                        </div>
                            <div class="col-lg-3">
                                <form class="form-group" role="form">
                                    <div class="form-group">
                                        <label class="sr-only" for="exampleInputEmail2">tim kiem</label>
                                        <input type="text" class="form-group" name="keyword" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword }}" placeholder="Search">
                                    <button type="submit" class="btn btn-theme"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <thead>
                        <tr>
                            <th><i class="fa fa-bullhorn"></i>Checkbox</th>
                            <th><i class="fa fa-bullhorn"></i>Idea</th>
                            <th><i class="fa fa-bullhorn"></i> Categories(size)</th>
                            <th><i class="fa fa-bullhorn"></i> Title</th>
                            <th><i class="fa fa-bullhorn"></i> Time</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> Description </th>
                            <th><i class="fa fa-bookmark"></i> Idea </th>
                            <th><i class=" fa fa-edit"></i> Mockup </th>
                            <th><i class=" fa fa-edit"></i> PNG</th>
                            <th><i class=" fa fa-edit"></i> Status</th>
                            <th><i class=" fa fa-edit"></i> Action </th>
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
                    <button type="button" class="btn btn-primary"><a style="color:white" href="{{ route('Dashboard') }}">refresh</a></button>

                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div>
        {{ $reports->links() }}
    </section>
</section>

@endsection

@push('scripts')
 <script>
 var deletemocupApi = "/deletemocups"
 var deletePngApi = "/deleteProductPngDetails"

function deleteComment(id) {
      var option = {
          method: 'GET', // *GET, POST, PUT, DELETE, etc.
          headers: {
              'Content-Type': 'application/json'
                  // 'Content-Type': 'application/x-www-form-urlencoded',
          },
      }

      fetch(deletemocupApi + '/' + id, option)
          .then(function(response) {
              console.log(response);
              return response.json();
          })
          .then(function() {
                  var xoaHtml = document.querySelector('.post-content-' + id)
                  if (xoaHtml) {
                      xoaHtml.remove();
              };
          });
  }
  function deletePng(id) {
      var option = {
          method: 'GET', // *GET, POST, PUT, DELETE, etc.
          headers: {
              'Content-Type': 'application/json'
                  // 'Content-Type': 'application/x-www-form-urlencoded',
          },
      }

      fetch(deletePngApi + '/' + id, option)
          .then(function(response) {
              return response.json();
          })
          .then(function() {
                  var xoaHtml = document.querySelector('.post-Png-' + id)
                  if (xoaHtml) {
                      xoaHtml.remove();
              };
          });
  }
    //<![CDATA[
    $('input.input-qty').each(function() {
      var $this = $(this),
        qty = $this.parent().find('.is-form'),
        min = Number($this.attr('min')),
        max = Number($this.attr('max'))
      if (min == 0) {
        var d = 0
      } else d = min
      $(qty).on('click', function() {
        if ($(this).hasClass('minus')) {
          if (d > min) d += -1
        } else if ($(this).hasClass('plus')) {
          var x = Number($this.val()) + 1
          if (x <= max) d += 1
        }
        $this.attr('value', d).val(d);
         var qty = $(".input-qty").val();
         var price = $("#price").val();
         var total = qty * price;
         $("#total").html(total);
      })
    })




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
@endpush
