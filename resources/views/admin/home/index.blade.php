@extends('admin.app')


@section ('content')
<section id="main-content">
        <section class="wrapper" style="color:black; font-family:Roboto,sans-serif;background-image: url('https://msmobile.com.vn/upload_images/images/hinh-nen-powerpoint-mau-den-8.jpg');background-size: cover;">

            <div class="row">
                <div class="col-lg-9 main-chart">
                    <br /><br /><br /><br />
                    <div class="row" style="text-align: center;">
                        <a href="{{ route('showIdea') }}"><span class="label label-info">Idea</span></a>  <a  href="{{ route('showPNG') }}"><span class="label label-warning">PNG</span></a>
                    </div><br /><br /><br /><br />
                    <div  class="row" style="background:#373a36; color:white">
                        @if($users[0]->payment==1)
                        <div class="border-head">
                            <h3 style="color: #54bae6;">IDEA TABLE</h3>
                        </div>
                        <div class="custom-bar-chart" >
                            <ul class="y-axis" style = "color:white;">
                                <li ><span>100</span></li>
                                <li><span>80</span></li>
                                <li><span>60</span></li>
                                <li><span>40</span></li>
                                <li><span>20</span></li>
                                <li><span>0</span></li>
                            </ul>
                            @foreach ($totalidea as $show)
                            <div class="bar">
                                <div class="title">{{  $show->date }}</div>
                                <div class="value tooltips" data-original-title="{{ $show->value }}" data-toggle="tooltip" data-placement="top">{{ $show->value }}%</div>
                            </div>
                            @endforeach
                        </div>
                        <!--custom chart end-->
                        @elseif($users[0]->payment==2)
                        <div class="border-head">
                            <h3 style="color: #ff865c;">PNG TABLE</h3>
                        </div>
                        <div class="custom-bar-chart">
                            <ul class="y-axis">
                                <li><span>100</span></li>
                                <li><span>80</span></li>
                                <li><span>60</span></li>
                                <li><span>40</span></li>
                                <li><span>20</span></li>
                                <li><span>0</span></li>
                            </ul>
                            @foreach ($totalPNG as $show)
                            <div class="bar">
                                <div class="title">{{  $show->date }}</div>
                                <div class="value tooltips" data-original-title="{{ $show->value }}" data-toggle="tooltip" data-placement="top">{{ $show->value }}%</div>
                            </div>
                            @endforeach
                        </div>


                        @endif

                    </div>
                    <!-- /row mt -->


                    <div class="row mt" >
                        <!-- SERVER STATUS PANELS -->

                        <div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="weather-2 pn">
								<div class="weather-2-header">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<p>TOP IDEA</p>
										</div>
										<div class="col-sm-6 col-xs-6 goright">
											<p class="small">{{ $timess }}</p>
										</div>
									</div>
								</div><!-- /weather-2 header -->

								<div class="row centered">
									<img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-cartoon-flat-man-holding-a-trophy-png-image_4486875.jpg" class="img-circle" width="80">
								</div>
                                @if(count($Idea)>0)
								<div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>MEMBER </b></h4>
										<h6>{{ $Idea[0]->name }}</h6>
										<h6>{{ $Idea[0]->email }}</h6>
									</div>
									<div class="col-sm-6 col-xs-6 goright">
										<h5><i class="fa fa-sun-o fa-2x"></i></h5>
										<h6><b>TOTAL IDEA</b></h6>
										<h5>{{ $Idea[0]->sum }}</h5>
									</div>
								</div>
                                @else
								<div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>ngày nghỉ </b></h4>
									</div>
								</div>
                                @endif
							</div>
						</div>
                        <!-- /col-md-4-->


                        <div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="weather-2 pn">
								<div class="weather-2-header">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<p>TOP MOCKUP</p>
										</div>
										<div class="col-sm-6 col-xs-6 goright">
											<p class="small">{{ $timess }}</p>
										</div>
									</div>
								</div><!-- /weather-2 header -->

								<div class="row centered">
									<img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-cartoon-flat-man-holding-a-trophy-png-image_4486875.jpg" class="img-circle" width="80">
								</div>
                                @if(count($mocup)>0)
								<div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>MEMBER </b></h4>
										<h6>{{ $mocup[0]->name }}</h6>
										<h6>{{ $mocup[0]->email }}</h6>
									</div>
									<div class="col-sm-6 col-xs-6 goright">
										<h5><i class="fa fa-sun-o fa-2x"></i></h5>
										<h6><b>TOTAL MOCKUP</b></h6>
										<h5>{{ $mocup[0]->mocup_products }}</h5>
									</div>
								</div>
                                @else
                                <div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>ngày nghỉ </b></h4>
									</div>
								</div>
                                @endif
							</div>
						</div>
                        <!-- /col-md-4 -->

                        <div class="col-lg-4 col-md-4 col-sm-4 mb">
							<div class="weather-2 pn">
								<div class="weather-2-header">
									<div class="row">
										<div class="col-sm-6 col-xs-6">
											<p>TOP PNG</p>
										</div>
										<div class="col-sm-6 col-xs-6 goright">
											<p class="small">{{ $timess }}</p>
										</div>
									</div>
								</div><!-- /weather-2 header -->
								<div class="row centered">
									<img src="https://png.pngtree.com/png-clipart/20190904/original/pngtree-cartoon-flat-man-holding-a-trophy-png-image_4486875.jpg" class="img-circle" width="80">
								</div>
                                @if(count($designer)>0)
								<div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>MEMBER </b></h4>
										<h6>{{ $designer[0]->name }}</h6>
										<h6>{{ $designer[0]->email }}</h6>
									</div>
									<div class="col-sm-6 col-xs-6 goright">
										<h5><i class="fa fa-sun-o fa-2x"></i></h5>
										<h6><b>TOTAL PNG</b></h6>
										<h5>{{ $designer[0]->product_png_details }}</h5>
									</div>
								</div>
                                @else
                                <div class="row data">
									<div class="col-sm-6 col-xs-6 goleft">
										<h4><b>ngày nghỉ </b></h4>
									</div>
								</div>
                                @endif
							</div>
						</div>
                        <!-- /col-md-4 -->


                    </div>
                    <!-- /row -->
                    <div class="row" >
                    <section class="task-panel tasks-widget" style="background-color:#fafeff;">
                        <div class="panel-heading" style="background-color:#54bae6;">
                            <div class="pull-left"><h5 style = "color:white; margin-top: 1%;" class="category"><i class="fa fa-tasks"></i> Todo List - Sortable Style</h5></div>
                            <br>
                         </div>
                          <div class="panel-body">
                              <div class="task-content" >
                                  <ul id="sortable" class="task-list ui-sortable" >
                                        @php
                                            $list= ['primary','danger','success','info','warning'];
                                            $i=0
                                        @endphp
                                      @foreach ($jobs as $job )
                                      @if($job->private == 1)
                                      <li class="list-{{ $list[$i++] ?? null }}">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="list-child" value="">
                                        </div>
                                        <div class="task-title">
                                            <span class="task-title-sp">{{ $job->Conten ?? null }}</span>
                                            <span class="badge bg-info"> Public</span>
                                            @if($job->action==2)
                                            <span class="badge bg-important" value="{{ $job->action ?? null}}">Quan trọng</span>
                                            @else
                                            <span class="badge bg-warning" value="{{ $job->action ?? null}}">Chú ý</span>
                                            @endif
                                            @if ($job->status==2)
                                            <span class="badge bg-success" value="{{ $job->status ?? null }}">success</span>
                                            @endif
                                            <div class="pull-right hidden-phone">
                                                <a class=" w-75 " style="color:white" href="{{ route('updateJob',[$job->id]) }}">  <button class="btn btn-success btn-xs fa fa-check"></button></button></a>
                                                <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                <a class=" w-75 " style="color:white" href="{{  route('deletejob',[$job->id])  }}">
                                                    <span class="btn btn-danger btn-xs fa fa-trash-o">
                                                       <i class="fa fa-trash-o"></i></a>
                                                     </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @else
                                    <li class="list-{{ $list[$i++] }}">
                                        <i class=" fa fa-ellipsis-v"></i>
                                        <div class="task-checkbox">
                                            <input type="checkbox" class="list-child" value="">
                                        </div>
                                        <div class="task-title">
                                            <span class="task-title-sp">{{ $job->Conten }}</span>
                                            <span class="badge bg-info" value="">{{ $job->User->name ?? null}}</span>
                                            @if($job->action==2)
                                            <span class="badge bg-important" value="{{ $job->action ?? null }}">Quan trọng</span>
                                            @else
                                            <span class="badge bg-warning" value="{{ $job->action ?? null }}">Chú ý</span>
                                            @endif
                                            @if ($job->status==2)
                                            <span class="badge bg-success" value="{{ $job->status ?? null }}">success</span>
                                            @endif
                                            <div class="pull-right hidden-phone">
                                                <a class=" w-75 " style="color:white" href="{{ route('updateJob',[$job->id]) }}">
                                                    <button class="btn btn-success btn-xs fa fa-check"></button>
                                                </a>
                                                <button class="btn btn-primary btn-xs fa fa-pencil"></button>
                                                <a class=" w-75 " style="color:white" href="{{  route('deletejob',[$job->id])  }}">
                                                <span class="btn btn-danger btn-xs fa fa-trash-o">
                                                   <i class="fa fa-trash-o"></i></a>
                                                 </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                      @endforeach
                                  </ul>
                                  {{ $jobs->links() }}
                              </div>
                              <div class=" add-task-row">
                                  <button type="button" class="btn btn-success btn-sm pull-left" data-toggle="modal" data-target=".bs-example-modal-lg">Add Public Tasks</button>
                                  {{-- <a class="btn btn-default btn-sm pull-right" href="todo_list.html#">add Private Tasks</a> --}}
                                  <button type="button" class="btn btn-default btn-sm pull-right" data-toggle="modal" data-target="#examplechinh">Add Private Tasks</button>
                                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="form-panel">
                                            <h4 class="mb"><i class="fa fa-angle-right"></i> Inline Form</h4>
                                          <form class="form-inline" role="form" method="post" action="{{ route('jobPublic') }}">
                                            @csrf
                                            <div class="form-group">
                                                  <label class="sr-only" for="exampleInputEmail2">content</label>
                                                  <input type="text" class="form-control" name="content" id="inputSuccess">
                                                </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="exampleInputPassword2">notes</label>
                                                  <input type="text" class="form-control" name="note" id="inputSuccess">
                                                  <div class="form-group">
                                                    <select class="form-control" name="option" aria-label="Default select example">
                                                        <option selected value="1">trạng thái</option>
                                                        <option value="1">Lưu ý</option>
                                                        <option value="2">Uu tiên</option>
                                                      </select>
                                                    </div>
                                                    </div>
                                              <button type="submit" class="btn btn-theme">submit</button>
                                          </form>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal fade " id="examplechinh" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                      <div class="modal-content">
                                        <div class="form-panel">
                                            <h4 class="mb"><i class="fa fa-angle-right"></i> Inline Form</h4>
                                            <form class="form-inline" role="form" method="post" action="{{ route('jobPrivate') }}">
                                                @csrf
                                                <div class="form-group">
                                                  <label class="sr-only" for="exampleInputEmail2">content</label>
                                                  <input type="text" class="form-control" name="content" id="inputSuccess">                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="exampleInputPassword2">notes</label>
                                                  <input type="text" class="form-control" name="note" id="inputSuccess">
                                                  <div class="form-group">
                                                    <select class="form-control" name="option" aria-label="Default select example">
                                                        <option selected value="1">trạng thái</option>
                                                        <option value="1">Lưu ý</option>
                                                        <option value="2">Uu tiên</option>
                                                      </select>
                                                    </div>
                                                  <div class="form-group">
                                                    <select class="form-control" name="User_id" aria-label="Default select example">
                                                        <option selected>chọn người</option>
                                                        @foreach ($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                        @endforeach
                                                        {{ $users->links() }}
                                                      </select>
                                                    </div>
                                              <button type="submit" class="btn btn-theme">submit</button>
                                          </form>
                                          </div>
                                      </div>
                                    </div>
                                  </div>
                              </div>

                          </div>
                      </section>

                    <!-- /row -->
                    </div>

                </div>
                <!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
  RIGHT SIDEBAR CONTENT
  *********************************************************************************************************************************************************** -->

                <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                    <h3>NOTIFICATIONS</h3>
                   @php
                       $i=0;
                   @endphp
                    <!-- First Action -->
                    @foreach ($shows as $show)
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>{{ $time[$i++] }}</muted><br/>
                                <a href="#"> {{  $show->User->name ?? null }}</a>  was assigned a job .<br/>
                            </p>
                        </div>
                    </div>
                    @endforeach

                    <!-- USERS ONLINE SECTION -->
                    <h3>TEAM MEMBERS</h3>
                    <!-- First Member -->
                    @foreach ($users as $user)
                    <div class="desc">
                        <div class="thumb">
                            <img class="img-circle" src="https://ambe.vn/wp-content/uploads/2020/08/5-buoc-xay-dung-hinh-anh-ca-nhan-noi-bat-va-chuyen-nghiep-1.jpg" width="35px" height="35px" align="">
                        </div>
                        <div class="details">
                            <p><a href="#">{{ $user->name }}</a><br/>
                                @if($user->role ==1)
                                <muted>DESIGNER</muted>
                                @elseif ($user->role ==2)
                                <muted>IDEA</muted>
                                @else
                                <muted>ADMIN</muted>
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                    <!-- Second Member -->
                    {{ $users->links() }}

                    <!-- / calendar -->

                </div>
                <!-- /col-lg-3 -->

            </div>
            <! --/row -->

    </section><!-- --/wrapper ---->
</section>

@endsection


@push('scripts')
<script src=" {{ asset('admin/js/sparkline-chart.js') }}"></script>
<script src="{{ asset('admin/js/zabuto_calendar.js') }}"></script>
<script src="{{ asset('admin/js/chart-master/Chart.js') }}"></script>
<script src="{{ asset('admin/js/chartjs-conf.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Welcome to Media-Sytem By CanTeam !',
            // (string | mandatory) the text inside the notification
            text: 'Chúc bạn 1 ngày làm việc thật vui vẻ năng lượng.',
            // (string | optional) the image to display on the left
            image: 'https://png.pngtree.com/png-vector/20210514/ourlarge/pngtree-red-wolf-logo-template-for-esport-team-png-image_3293973.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
    });
</script>


@endpush

