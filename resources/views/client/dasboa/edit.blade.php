@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">


        <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Chỉnh Sửa Giao Việc</h4>
                <form class="form-horizontal style-form"action="{{ route('Edit',[$show->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Tiêu Đề</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" value="{{$show->title}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control conten" name="description" v id="exampleFormControlTextarea1" rows="5">{{$show->description}}</textarea>                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input name="image[]"  type="file" multiple >
                            <span class="help-block">kèm theo Image để Designer được rõ hơn</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                    <label class="col-sm-4 control-label">chon designer</label>
                    <select class="col-lg-4 form-control " id="cars" name="User_id">
                        <option value="{{$show->user->id}}">{{ $show->user->name }}</option>
                        @foreach ($designers as $designer)
                        <option value="{{ $designer->id }}">{{  $designer->name }}</option>
                        @endforeach
                      </select> <br>
                    </div>
                    <div class="col-lg-4">
                    <label class="col-sm-4 control-label">chon loai Sp</label>
                        <select class="col-lg-4 form-control " name="type_id" id="loaiSP">
                            <option value="{{$show->type_product->id}}">{{ $show->type_product->name }}</option>
                            @foreach ($type_products as $type_product)
                            <option value="{{$type_product->id}}">{{  $type_product->name }}</option>
                            @endforeach
                          </select> <br>
                        </div>
                     <div class="col-lg-4">
                         <label class="col-sm-4 control-label">chon size</label><br/>
                         <select class="col-lg-4 form-control " id="size" name="size">
                            <option value="{{$show->size->id}}">{{ $show->size->name }}</option>

                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}">{{  $size->name }}</option>
                            @endforeach
                          </select> <br><br>
                      <!-- /form-panel -->
                    </div>
                </div>
                      <hr>
                      <button type="submit" class="btn btn-success"> Sửa giao việc</button>
                </form>
            </div>
            </div>

</section>
</section>

@endsection


@push('scripts') --}}
<script>


$(document).ready(function(){

  $("#loaiSP").change(function(){
    var loaiSP = $(this).val();
    $.get("ajax/"+loaiSP, function(data){
      $("#size").html(data);
    });
  });
});



</script>
@endpush
