@extends('admin.layouts.app')
@section('sidebar_title','عنوان')
@section('header')
    <link href="admin_template/assets/extra-libs/css-chart/css-chart.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body border-bottom">
                    <h4 class="card-title">خلاصه وضعیت</h4>
                    <h5 class="card-subtitle">اطلاعات کلی وضعیت سایت</h5>
                </div>
                <div class="card-body">
                    <div class="row ">
                        <!-- col -->
                        <div class="col-md-6 col-sm-12 col-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-orange display-5"><i class="mdi mdi-newspaper"></i></span></div>
                                <div><span class="text-muted">تعداد مقالات</span>
                                    <h3 class="font-medium m-b-0">{{$blog}}</h3></div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-md-6 col-sm-12 col-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="text-primary display-5"><i class="mdi mdi-file"></i></span></div>
                                <div><span class="text-muted">تعداد صفحات</span>
                                    <h3 class="font-medium m-b-0">{{$page}}</h3></div>
                            </div>
                        </div>
                        <!-- col -->
                        <!-- col -->
                        <div class="col-md-6 col-sm-12 col-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="m-r-10"><span class="display-5"><i class="mdi mdi-account-box"></i></span></div>
                                <div><span class="text-muted">تعداد کاربران</span>
                                    <h3 class="font-medium m-b-0">{{$user}}</h3></div>
                            </div>
                        </div>
                        <!-- col -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card ">
                <div class="card-body ">
                    <div class="row">
                        <!-- column -->
                        <div class="col-sm-12 col-md-8 " >
                            <h4 class="card-title">وضعیت سفارشات</h4>
                            <h5 class="card-subtitle m-b-0">میزان وضعیت سفارشات در این ماه</h5>

                            <div class="row m-t-20">
                                <div class="col-4 border-right">
                                    <i class="fa fa-circle text-cyan"></i>
                                    <h3 class="m-b-0 font-medium">5489</h3>
                                    <span>موفقیت</span>
                                </div>
                                <div class="col-4 border-right">
                                    <i class="fa fa-circle text-orange"></i>
                                    <h3 class="m-b-0 font-medium">954</h3>
                                    <span>در صف انتظار</span>
                                </div>
                                <div class="col-4">
                                    <i class="fa fa-circle text-info"></i>
                                    <h3 class="m-b-0 font-medium">736</h3>
                                    <span>ناموفق</span>
                                </div>
                            </div>
                        </div>
                        <!-- column -->
                        <div class="col-sm-12 col-md-4">
                            <div id="visitor" class="m-t-20" style="height:150px; width: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body border-top">
                    <div class="row m-t-10">
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="d-flex align-items-center">
                                <div class="m-r-20">
                                    <div data-label="20%" class="css-bar m-b-0 css-bar-primary css-bar-50"><i class="mdi mdi-magnify text-info"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="m-b-0">50%</h3><span>میزان جست و جو</span></div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="d-flex align-items-center">
                                <div class="m-r-20">
                                    <div data-label="20%" class="css-bar m-b-0 css-bar-danger css-bar-30"><i class="mdi mdi-link text-danger"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="m-b-0">30%</h3><span>میزان ترافیک</span></div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="d-flex align-items-center">
                                <div class="m-r-20">
                                    <div data-label="20%" class="css-bar m-b-0 css-bar-success css-bar-10"><i class="mdi mdi-lightbulb-outline text-cyan"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="m-b-0">10%</h3><span>شبکه های اجتماعی</span></div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="d-flex align-items-center">
                                <div class="m-r-20">
                                    <div data-label="20%" class="css-bar m-b-0 css-bar-purple css-bar-10"><i class="mdi mdi-laptop-mac text-purple"></i>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="m-b-0">10%</h3><span>مالتی مدیا</span></div>
                            </div>
                        </div>
                        <!-- Column -->
                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection

@section('script')
@endsection
