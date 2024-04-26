@extends('client.auth.app')


@section ('content')
<div id="login-page">
    <div class="container">
        <form class="form-login" action="{{ route('changePass',[$email])}}" method="post">
            @csrf
          <h2 class="form-login-heading">Change Password</h2>

              <input type="password" class="form-control" placeholder="Password" name="password" autofocus>
              <br>
              <input type="comfimPassword" class="form-control" placeholder="comfimPassword" name="comfimPassword" autofocus>
              <br>
              <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>CHANGE PASSWORD</button>
             <hr>
              <div class="registration">
                  Dont have an account yet?<br/>
                  <a class="" href="{{ route('regiter') }}">
                      Create an account
                  </a>
              </div>

          </div>
        </form>

    </div>
</div>

@endsection
