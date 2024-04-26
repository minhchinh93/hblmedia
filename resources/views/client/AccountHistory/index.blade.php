@extends('client.app')
@section ('content')
<section id="main-content">
    <section class="wrapper">

        <div class="row mt">
            <div class="col-md-12">
                <div class="content-panel">
                    <h4><i class="fa fa-angle-right"></i> via đã mua </h4><hr><table class="table table-striped table-advance table-hover">


                        <thead>
                        <tr>
                            <th><input type="checkbox"  name="checkbox" ></th>
                            <th><i class="fa fa-bullhorn"></i> ID</th>
                            <th><i class="fa fa-bullhorn"></i> loại via</th>
                            <th><i class="fa fa-bullhorn"></i> số lượng</th>
                            <th><i class="fa fa-bullhorn"></i> đơn giá</th>
                            <th class="hidden-phone"><i class="fa fa-question-circle"></i> tổng tiền</th>
                            <th><i class="fa fa-bookmark"></i> ngày mua</th>
                            <th><i class="fa fa-bookmark"></i> Status</th>
                            <th><i class=" fa fa-edit"></i> check</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $t=0;
                            @endphp
                            @foreach ($tables as $table )
                        <tr>
                            <th><input type="checkbox"  name="checkbox" ></th>
                            <td class="hidden-phone">{{ $t=+1 }}</td>
                            <td>{{ $table->name }} </td>
                            <td><a href="basic_table.html#">{{ $table->qty }}</a></td>
                            <td><a href="basic_table.html#">{{ $table->price }}</a></td>
                            <td class="hidden-phone">{{ $table->total }}</td>
                            <td class="hidden-phone">{{ $table->time }}</td>
                            <td><span class="label label-info label-mini">live</span></td>
                            <td>
                                <button class="btn btn-success btn-xs"><a  style="color:white" href="{{ route('detailAccountHistory',[$table->id]) }}">chi tiết</a> </button>
                                {{-- <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> --}}
                            </td>
                        </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div><!-- /content-panel -->
            </div><!-- /col-md-12 -->
        </div>
  </section><!-- --/wrapper ---->
</section>

@endsection
