@extends('admin.app')


@section ('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Phản hồi cho Designer </h4>
                <form class="form-horizontal style-form"  method="post" action="{{ route('approval',[$id->id]) }} "
                    enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Phản hồi</label>
                        <div class="col-sm-10">
                            <input type="text" name="approval" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">approval</button>
                        </div>
                    </div>
                </form>
            </div>
            </div><!-- col-lg-12-->
        </div>
    </section>
</section>
@endsection
