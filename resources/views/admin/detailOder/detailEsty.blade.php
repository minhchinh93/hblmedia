@extends('admin.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            @foreach($shows as $show)
            <div class="col-lg-3 col-md-3 col-sm-3 mb">
                <div class="content-panel pn "  style="display: flex;flex-direction: space-between;">
                    <div class="media"  style="margin-right:20px">
                        <img src="{{asset('/storage/'.$show->ImagePngDetail)}}" alt="..."  height="130px" width="130px" class="img-thumbnail">
                    </div>
                    <div class="media-body">
                          <h5 class="mt-0">Designer: {{ $show->name}}</h5>
                          <h5 class="mt-0">saller: {{ $show->saller}}</h5><hr>
                          <h6>Title: {{ $show->title}}</h6>
                          <h6>solt: {{ $show->Number_Items}}</h6>
                          <h6>Order_Total: ${{ $show->Order_Total}}</h6>
                          <h6>Sale_Date: {{ $show->Sale_Date}}</h6>
                          <h6>Date_Shipped: {{ $show->Date_Shipped}}</h6>
                    </div>
                    </div>
                </div><!-- --/panel ---->
            @endforeach
        </div>
        {{ $shows->links() }}
    </section>
</section>
@endsection
