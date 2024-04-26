@extends('client.auth.app')


@section ('content')
<div id="login-page">
    <div class="container">

        <form class="form-login" action="{{ route('postregiter') }}" method="POST">
            @csrf
          <h2 class="form-login-heading">Register in now</h2>
          <div class="login-wrap">
              <input type="text" class="form-control" placeholder="name" name="name" required autofocus>
              <span style="color:red" class="error">{{ $errors->first('name') }}</span>
              <br>
              <input type="text" class="form-control" placeholder="email" name="email" required>
              <span style="color:red" class="error">{{ $errors->first('email') }}</span>
              <br>
              {{-- <select class="form-control "  id="cars" name="role" required>
                <option value="1">designer</option>
                <option value="2">idea</option>
              </select>   <br> --}}
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <span style="color:red" class="error">{{ $errors->first('Password') }}</span>
              <br>
              <input type="password" class="form-control" placeholder="nhập lại password" name="password_confirmation" required>
              <span style="color:red" class="error">{{ $errors->first('Password') }}</span>
              <label class="checkbox">
                  <span class="pull-right">
                      <a data-toggle="modal" href="#"> Forgot Password?</a>
                  </span>
              </label>
              <button  class="btn btn-theme btn-block"  type="submit"><i class="fa fa-lock"></i> Đăng Ký</button>
              <hr>

              <div class="login-social-link centered">
              <p>or you can sign in via your social network</p>
                  <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                  <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
              </div>
              <div class="registration">
                  bạn đã có tài khoản đăng nhập?<br/>
                  <a class="" href="{{ route('login') }}">
                      Đăng Nhập
                  </a>
              </div>

          </div>
        </form>
        <form class="form-login" action="{{ route('postregiter') }}" method="POST">
            <!-- Modal -->
            @csrf
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="email" name="Email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="button">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->

        </form>

    </div>
</div>

@endsection
