@extends('client.app')


@section ('content')
<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> gửi file hoàn thành</h4>
                <form class="form-horizontal style-form"  method="post" action="{{ route('acceptDetail',[$id->id]) }} "
                    enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">upfilePNJ</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="ImagePNG[]"  multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Mocup</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="mocup[]"  multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Phản hồi</label>
                        <div class="col-sm-10">
                            <input type="text" name="approval" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">Hoàn thành</button>
                        </div>
                    </div>
                </form>
            </div>
            </div><!-- col-lg-12-->
        </div>
    </section>
</section>

@endsection
