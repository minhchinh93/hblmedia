@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper" style=" background: rgba(236, 240, 240, 0.644);color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">

      <div class="row mt">
        @foreach($shows as $show)
        <div class="col-lg-4 col-md-4 col-sm-4 mb">
            <div class="content-panel pn">
                <div id="profile-01">
                    @if($show->action==1)
                    <button type="button" class="btn btn-theme04"><i class="fa fa-cog"></i> Chưa duyệt</button>
                    @else
                    <button type="button" class="btn btn-theme"><i class="fa fa-heart"></i> Đã duyệt</button>
                    @endif
                    <h3>{{ $show->title ?? null}}</h3>
                    {{-- <h6 style="color:rgb(255, 193, 111)">DOCUMENT BY SYTEM MR.HAI</h6> --}}
                </div>
                <div class="profile-01 centered">
                @if($show->action==1)
                 @if(Auth::user()->role == 3)
                   <a href= "{{ route('detailDoc',[$show->id]) ?? null}}"> <p>CLICK ĐỂ XEM CHI TIẾT</p></a>
                 @else
                   <a href= "#"> <p>CHƯA DUYỆT</p></a>
                 @endif
                @else
                  <a href= "{{ route('detailDoc',[$show->id]) ?? null}}"> <p>CLICK ĐỂ XEM CHI TIẾT</p></a>
                @endif
                </div>
                <div class="centered">
                    @if(Auth::user()->role == 3)
                    @foreach ($show->user as $users)
                    <span class="label label-info label-mini">{{ $users->name}}</span>
                    @endforeach
                        <form class="form-inline" action="{{ route('documentAddUser',[$show->id]) ?? null  }}" method="post">
                            @csrf
                            <select name="doccument" id="cars" style="border-radius: 15px;" class="form-control">
                            @foreach ($user as $show)
                                <option value="{{ $show->id }}">{{  $show->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" style="border-radius: 10px;" class="btn btn-theme"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                    @else
                    <h6 style="color: rgb(50, 2, 128)">CỐ GẮNG HỌC HÀNH- TƯƠNG LAI SÁNG LẠNG</h6>
                    @endif

                </div>
            </div><!-- --/content-panel ---->
        </div>
        @endforeach


    </div>

<div class="row mt">
<div style="text-align: center">
    <a href="{{ route('addlDoc') }}">
    <button type="button" class="btn btn-theme03"><i class="fa fa-heart"></i> Add Document</button>
    </a>
    <a target="_blank" href="https://www.ilovepdf.com/vi/word-sang-pdf">
        <button type="button" class="btn btn-theme"><i class="fa fa-cog"></i> Word to PDF</button>
    </a>
    @if(Auth::user()->role == 3)
    <a href="{{ route('AadminHome') }}">
        <button type="button" class="btn btn-theme02"><i class="fa fa-check"></i> Back to admin</button>
    </a>
    @endif
</div>
</div>
    </section><!-- --/wrapper ---->
</section>

@endsection
