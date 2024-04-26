@extends('admin.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
            <div class="form-panel">
                  <h4 class="mb"><i class="fa fa-angle-right"></i> Add User</h4>
                <form class="form-horizontal style-form" method="POST" action="{{ route('updatesuser',[$shows->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{ $shows->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" value="{{ $shows->email }}">
                        </div>
                    </div>

                        {{-- <label class="col-sm-2 col-sm-2 control-label">role</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="role" value="{{ $shows->role }}">
                        </div> --}}
                        <select class="form-control "  id="cars" name="role" >>
                            <option value="1">designer</option>
                            <option value="3">admin</option>
                            <option value="2">idea</option>
                            <option value="0">xóa quyền khỏi hệ thống</option>
                          </select><br/><br/>

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
</section>

@endsection
