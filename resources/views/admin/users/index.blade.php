@extends('admin.app')
@section ('content')
<section id="main-content" style="color:black; font-family:Roboto,sans-serif;  background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;">
    <section class="wrapper">
<div class="row mt" >
    <div class="col-md-12" >
        <div class="content-panel" style = "background: rgba(255, 255, 255, 0.842)">
            <h4><i class="fa fa-angle-right"></i> Manager User </h4><hr><table class="table table-striped table-advance table-hover">
                <button type="button" class="btn btn-theme02 left"><a style="color:white" href="{{ route('addUser') }}" >thêm mới</a></button>
                <div class="row mt">
                    <div class="col-lg-4">
                        <div class="form-panel">
                            <p class="category"><a style="color: gray" href="{{ route('showUser') }}">total user ({{ $index ?? null}}) </a> | <a  style="color: rgb(13, 182, 36)" href="{{ route('activeruser') }}">user activer ({{ $activeruser ?? null}})</a> | <a style="color:red" href="{{ route('trackuser') }}">user disable ({{ $trackuser ?? null}})</a></p>
                <form class="form-inline" role="form">
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail2">tim kiem</label>
                        <input type="text" class="form-control" name="keyword" aria-label=" Search" id="exampleInputEmail2" value="{{ request()->keyword }}" placeholder="tim kiem">
                    </div>
                    <button type="submit" class="btn btn-theme">tim kiem</button>
                </form>
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
        <div class="col-lg-4">
            <div class="form-panel">
                <span class="">Tìm Nhân Viên</span>
           <form action="{{ route('findUser') }}" class="form-inline col-lg-4 " method="get" role="form">
        @csrf
        <select class="col-lg-4 form-control "  id="cars" name="role">
            <option >chon</option>
            <option value="1">Designer</option>
            <option value="2">Idea </option>
            <option value="3">admin</option>
          </select> <br /><br /><br />
          <button type="submit" class="btn btn-theme mt-1">Submit</button>
           </form>
        </div><!-- /form-panel -->
    </div><!-- /col-lg-12 -->
        <div class="col-lg-4">
            <div class="form-panel">
                <span class="">Action</span>

    <form action="{{ route('action') }}" class="form-inline col-lg-4 " role="form">
        <select class="col-lg-4 form-control "  id="cars" name="action">
            <option >chon</option>
            <option value="disabled">disabled</option>
            <option value="restore">restore</option>
            <option value="delete">delete</option>
          </select> <br /><br /><br />
          <button type="submit" class="btn btn-theme mt-1">Submit</button>
        </div><!-- /form-panel -->
    </div><!-- /col-lg-12 -->

</div>
                <thead>
                <tr>
                    <th><input type="checkbox" name="checkall" value=""></th>
                    <th>ID</th>
                    <th><i class="fa fa-bullhorn"></i> sad</th>
                    <th><i class="fa fa-bullhorn"></i> EMAIL</th>
                    <th class="hidden-phone"><i class="fa fa-question-circle"></i> ROLE</th>
                    <th><i class=" fa fa-edit"></i> Status</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @php
                    $i=0
                    @endphp
                    @foreach ($shows as $show )
                    @php
                    $i++
                    @endphp
                <tr>
                    <td ><input type="checkbox" name="checkbox[]"  value="{{ $show->id ?? null }}"></td>
                    <td>{{ $i }}</td>
                    @if($show->role ==1)
                    <td ><a href="{{route('detailUser',[$show->id])}}">{{ $show->name?? null }}</a></td>
                    <td ><a href="{{route('detailUser',[$show->id])}}">{{ $show->email ?? null}}</a></td>
                    @elseif ($show->role ==2)
                    <td ><a href="{{route('detailUserIdea',[$show->id])}}">{{ $show->name?? null }}</a></td>
                    <td ><a href="{{route('detailUserIdea',[$show->id])}}">{{ $show->email ?? null}}</a></td>
                    @else
                    <td ><a href="#">{{ $show->name?? null }}</a></td>
                    <td><a href="#">{{ $show->email ?? null}}</a></td>
                    @endif
                    @if($show->role ==1)
                    <td  class="hidden-phone" ><span class="label label-info label-mini">DESIGNER</span></td>
                    @elseif ($show->role ==2)
                    <td  class="hidden-phone"><span class="label label-warning label-mini">IDEA</span></td>
                    @elseif ($show->role ==0)
                    <td  class="hidden-phone"><span class="label label-danger label-mini">Chưa cấp quyền</span></td>
                    @else
                    <td  class="hidden-phone"><span class="label label-success label-mini">ADMIN</span></td>
                    @endif
                    <td  class="hidden-phone">
                        @if (  $show->deleted_at ==  null)
                        <span class="label label-info label-mini">active</span></td>
                        @else
                        <span class="label label-danger">disabled</span>
                        @endif
                    <td >
                            @if ( $show->deleted_at != null)
                            <span class="btn btn-success btn-xs">
                                <a style="color:white" href="{{ route('restoreUser',[$show->id]) }}">
                                 <i class="fa fa-check"></i>
                              </a>
                             </span>
                           @endif
                        <span class="btn btn-primary btn-xs"><a style="color:white" class=" w-75 " href="{{ route('editUser',[$show->id]) }}"><i class="fa fa-pencil"></i></span>

                            @if ( $show->id != 1)
                            <button class="btn btn-danger btn-xs">
                            <a style="color:white" href="{{ route('deleteUser',[$show->id]) }}">
                             <i class="fa fa-trash-o "></i>
                            </a>
                        </button>
                            @endif

                    </td>
                </tr>
                @endforeach
                </tbody>
    </form>
            </table>
        </div><!-- /content-panel -->
        {{ $shows->links() }}
    </div><!-- /col-md-12 -->
    </div>
  </section><!-- --/wrapper ---->
</section>

@endsection
