@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper" style=" background: rgba(236, 240, 240, 0.644);color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">

        <div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Add Document</h4>
                  <form class="form-horizontal style-form"action="{{ route('storeAdd') }}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control conten" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
                          </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">FILE PDF</label>
                        <div class="col-sm-10">
                            <input name="file"  type="file" multiple >
                            <span class="help-block" style="color:red">kèm theo file PDF</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">VIDEOS</label>
                        <div class="col-sm-10">
                            <input name="video"  type="file" multiple >
                            <span class="help-block" style="color:red">kèm theo video  </span>
                        </div>
                    </div>
                      <hr>
                      <button type="submit" class="btn btn-success">Save</button>
                </form>
            </div>
            </div><!-- col-lg-12-->
        </div>

</section><!-- --/wrapper ---->
</section>

@endsection
