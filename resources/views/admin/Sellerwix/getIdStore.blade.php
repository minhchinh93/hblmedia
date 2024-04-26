@extends('admin.app')


@section ('content')
<section id="main-content">
    <section class="wrapper" style="color:black; font-family:Roboto,sans-serif; background-image: url('https://allimages.sgp1.digitaloceanspaces.com/wikilaptopcom/2021/01/Background-tim-cuc-dep.png');background-size: cover;" >

    <div class="row mt">
        <div class="col-lg-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> Total Store : {{ $total }} </h4>
                    <section id="no-more-tables">
                        <table class="table table-bordered table-striped table-condensed cf">
                            <thead class="cf">
                            <tr>
                                <th>stt</th>
                                <th>names</th>
                                <th class="numeric">Saller</th>
                                <th class="numeric">Kế Toán</th>
                                <th class="numeric">shop_status </th>
                                <th class="numeric">type</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1
                                @endphp
                                @if($datas != null)
                                @foreach ($datas as $data)
                                <tr>
                                    <td data-title="Code">{{ $i++ }}</td>
                                    <td data-title="Code">{{ $data['name'] }}</td>
                                    <td data-title="Code" ><a target="_blank" href={{ route('sellerwix',['id'=>$data['id']]) ?? null }}><span class="label label-warning">click</span></a></td>
                                    <td data-title="Code" ><a target="_blank" href={{ route('sellerwixKetoan',['id'=>$data['id']]) ?? null }}><span class="label label-danger">click</span></a></td>
                                    <td data-title="Code">{{ $data['shop_status'] }}</td>
                                    <td data-title="Code">{{ $data['type'] }}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-12 -->
        </div>


</section>
</section>
@endsection
