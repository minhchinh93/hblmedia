@extends('admin.app')
@section ('content')
d
<section id="main-content">
    <section class="wrapper"  style="color:black; font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;">
        <div claa='row'>
        <div class="col-md-12 mt">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Check Download</h4><hr><table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>acction</th>
                        <th>tải vào lúc</th>
                    </tr>
                    </thead>
                    <tbody>
                  
                        @foreach ($datas as $data)

                    <tr>
                        <td>{{ $data->checkDowload->name }}</td>
                        @if($data->statusAbsolute!= null)
                        <td>{{ $data->statusAbsolute }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td><span class="label label-info label-mini">Absolute</span></td>
                        @else
                        <td>{{ $data->statusRelative }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td><span class="label label-warning label-mini">Relative</span></td>
                        @endif

                    </tr>
                    @endforeach

                    </tbody>
                    {{ $datas->links() }}
                </table>
              </div><!-- --/content-panel ---->
        </div>
    </div>
    </section><!-- --/wrapper ---->
</section>

@endsection
