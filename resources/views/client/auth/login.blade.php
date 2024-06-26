@extends('client.auth.app')


@section ('content')
<div id="login-page">
    <div class="container">
        <form class="form-login" action="{{ route('auth.login') }}" method="post">
            @csrf
          <h2 class="form-login-heading">sign in now</h2>
          <div class="login-wrap">
            @if (session('success'))
            <div class="alert alert-success " role="alert">
                    {{  session('success') }}
            </div>
            @elseif (session('erros'))
            <div class="alert alert-danger " role="alert">
                {{ session('erros') }}
           </div>
           @elseif (session('message'))
           <div class="alert alert-danger " role="alert">
               {{ session('message') }}
          </div>
           @endif
              <input type="email" class="form-control" placeholder="User ID" name="email" autofocus>
              <br>
              <input type="password" class="form-control" placeholder="Password" name="password" autofocus>
              <label class="checkbox">
                  <span class="pull-right">
                      <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>

                  </span>
              </label>
              <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
              <hr>

              <div class="login-social-link centered">
              <p>or you can sign in via your social network</p>
                  <button class="btn btn-facebook" type="submit"><i class="fa fa-facebook"></i> Facebook</button>
                  <button class="btn btn-twitter" type="submit"><i class="fa fa-twitter"></i> Twitter</button>
              </div>
              <div class="registration">
                  Dont have an account yet?<br/>
                  <a class="" href="{{ route('regiter') }}">
                      Create an account
                  </a>
              </div>

          </div>
        </form>


            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Forgot Password ?</h4>
                        </div>
                        <form class="modal-content" action="{{ route('checkmail') }}" method="post">
                            @csrf
                        <div class="modal-body">
                            <p>Enter your e-mail address below to reset your password.</p>
                            <input type="text" name="email" placeholder="email" autocomplete="off" class="form-control placeholder-no-fix">
                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                            <button class="btn btn-theme" type="submit">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- modal -->



    </div>
</div>

@endsection
