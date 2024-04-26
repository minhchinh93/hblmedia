@extends('admin.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Add User</h4>
                <form class="form-horizontal style-form"  method="post" action="{{ route('postProduct') }}" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">danh muc</label>
                        <div class="col-sm-10">
                            <select name="id_type"  class="form-control">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>d
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Định dạng</label>
                        <div class="col-sm-10">
                            <select class="col-lg-4 form-control "  id="cars" name="action">
                                <option value="type-1">ID|password|2fa|mail|MailPass</option>
                                <option value="type-2">ID|password|2fa</option>
                              </select> <br /><br /><br />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">input</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="textarea" ></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-success">submit</button>
                        </div>
                    </div>
                </form>
            </div>
            </div><!-- col-lg-12-->
        </div>
    </section>
@endsection
