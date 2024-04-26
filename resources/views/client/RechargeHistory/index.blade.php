@extends('client.app')


@section ('content')

<section id="main-content">
    <section class="wrapper">
        <div class="col-lg-4 col-md-4 col-sm-4 mb" style="margin-top:3vh">
            <div class="content-panel pn ">
                <div id="profile-01" style="background-image: url('https://rubee.com.vn/admin/webroot/upload/image/images/logo-vietcombank.jpg') ">
                </div>
                <div class="profile-01 centered">
                    <p>Tên tài khoản : TRAN HUU DAT|Số tài khoản : 0161000879001</p>
                </div>
                <div class="centered">
                    <h6><i class="fa fa-envelope"></i><br>Nội dung :<strong>NAPTIEN 437</strong></h6>
                </div>
            </div><!-- --/content-panel ---->
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 mb" style="margin-top:3vh">
            <div class="content-panel pn">
                <div id="profile-01" style="background-image: url('https://batdongsanonline.vn/uploads/noidung/images/ngan-hang/techcombank-amp.jpg'); ">
                </div>
                <div class="profile-01 centered">
                    <p>Tên tài khoản : TRAN HUU DAT|Số tài khoản : 0161000879001</p>
                </div>
                <div class="centered">
                    <h6><i class="fa fa-envelope"></i><br>Nội dung :<strong>NAPTIEN 437</strong></h6>
                </div>
            </div><!-- --/content-panel ---->
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 mb" style="margin-top:3vh">
            <div class="content-panel pn">
                <div id="profile-01" style="background-image: url('http://static.ybox.vn/2018/10/4/1540460966309-Momo.png') ">
                </div>
                <div class="profile-01 centered">
                    <p>Tên tài khoản : TRAN HUU DAT|Số tài khoản : 0161000879001</p>
                </div>
                <div class="centered">
                    <h6><i class="fa fa-envelope"></i><br>Nội dung :<strong>NAPTIEN 437</strong></h6>
                </div>
            </div><!-- --/content-panel ---->
        </div>
        <div class="col-md-12">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> lịch sử nạp tiền </h4><hr><table class="table table-striped table-advance table-hover">


                    <thead>
                    <tr>
                        <th><input type="checkbox"  name="checkbox" ></th>
                        <th><i class="fa fa-bullhorn"></i> stt</th>
                        <th><i class="fa fa-bullhorn"></i>Bank</th>
                        <th><i class="fa fa-bullhorn"></i> số tiền</th>
                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> thời gian</th>
                        <th><i class="fa fa-bookmark"></i> Status</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th><input type="checkbox"  name="checkbox" ></th>
                        <td class="hidden-phone">Lorem Ipsum dolor</td>
                        <td>12000.00$ </td>
                        <td><a href="basic_table.html#">Company Ltd</a></td>
                        <td class="hidden-phone">Lorem Ipsum dolor</td>
                        <td><span class="label label-info label-mini">thành công</span></td>
                        <td>
                            <button class="btn btn-success btn-xs">check</button>
                            {{-- <button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button> --}}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->

  </section><!-- --/wrapper ---->
</section>
@endsection
