@extends('client.auth.app')


@section ('content')
<div id="login-page">
    <div class="container">
        <form class="form-login" action="" method="post">

          <h2 class="form-login-heading">Thong Bao</h2>
          <div class="login-wrap">
            @if (session('success'))
            <div class="alert alert-success " role="alert">
                    {{  session('success') }}
            </div>
            @elseif (session('erros'))
            <div class="alert alert-danger " role="alert">
                {{ session('erros') }}
           </div>
            @endif


          </div>
        </form>


            <!-- modal -->



    </div>
</div>

@endsection
