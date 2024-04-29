@extends('client.app')


@section ('content')
@if(Auth::user()->role != 3)
<section id="main-content" oncontextmenu="return false;"
style="-moz-user-select: none !important;
-webkit-touch-callout: none!important;
-webkit-user-select: none!important;
-khtml-user-select: none!important;
-moz-user-select: none!important;
-ms-user-select: none!important;
user-select: none!important;">
@else
<section id="main-content">
@endif
    <section class="wrapper" style=" background: rgba(236, 240, 240, 0.644);color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">
        <div class="row mt">
        <div class="col-lg-2 col-md-2 col-sm-2 mb" >
            @if(Auth::user()->role == 3)
                 @if($show->action==1)
                <a href="{{ route('accset',[$show->id])}}">
                    <button type="button" class="btn btn-theme04"><i class="fa fa-check"></i> chưa duyệt </button>
                </a>
                @else
                    <button type="button" class="btn btn-theme02"><i class="fa fa-heart"></i> đã duyệt </button>
                @endif
            @endif
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8 mb">
            @if($show->video)
            <video width="100%" controls controlsList="nodownload">
                <source  false src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$show->video ?? null}}" type="video/mp4">
              Your browser does not support the video tag.
          </video>
          @else
          @endif
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 mb">
            @if(Auth::user()->role == 3)
            <a href="{{ route('deleteDoc',[$show->id])}}">
                <button type="button" class="btn btn-theme04"><i class="fa fa-trash-o"></i> Xóa </button>
            </a>
            @endif
        </div>
    </div>
    @if($show->file)
    <div oncontextmenu="return false" class="row mt" style="margin:auto;" >
        <div class="card" style="width: 99%;height: 80vh">
            <div class="row mt" style="margin:auto;height: 80vh;">
                    <iframe frameborder="0" src="{{'https://cantim.s3.ap-southeast-2.amazonaws.com/'.$show->file) ?? null}}#toolbar=0&navpanes=0&scrollbar=0" width="100%;" height="100%"></iframe>
            </div>
          </div>
    </div>
    @else
    <div></div>
    @endif
    @if($show->description)
    <div class="row mt" style="margin:auto;height: 100%">
        <div class="card" style="width: 99%;height: 100%;margin:auto">
            <div class="card-body"style="width: 96%;margin:auto">
              <h2 class="card-title">{{ $show->title }}</h2>
              <p class="card-text bg-light" style="transform: rotate(0);">
                {!! $show->description !!}
             </p>
            </div>
          </div>

    </div>
    @else
    <div></div>
    @endif
    </section><!-- --/wrapper ---->
</section>

@endsection
@push('scripts')
<script type="text/javascript" src="https://cloudpdf.io/viewer.min.js"></script>
<script>
document.addEventListener('contextmenu', event => event.preventDefault());
</script>
@endpush
