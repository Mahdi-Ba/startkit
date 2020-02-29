
@extends('layouts.front_app')
@section('content')

    <main>
        <!-- =========== Inner Title Page Section =============== -->
        <div id="innerPageTitle">
            <div class="container">
                <!-- Title -->
                <div class="title"><h1>وبلاگ پلکانی با ساید بار چپ</h1></div><!-- / Title -->
                <!-- breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">خانه</a></li>
                        {{--
                                                <li class="breadcrumb-item active">وبلاگ پلکانی با ساید بار چپ</li>
                        --}}
                    </ol>
                </nav>
                <!-- / breadcrumb -->
            </div>
        </div>
        <!-- ========================================= -->
        <!-- =========== All Blogs Section =============== -->
        <section id="blogs">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                        <img src="{{asset($page->img)}}" alt="">
                        <!-- Blogs List -->


                                <!-- blog  -->


                                        <!-- Blog Image -->
                                      {{--  <div class="card-img-top"><img src="{{asset($page->img)}}" title="{{$data->title}}"
                                                                       alt="{{$page->title}}"/>
                                        </div>--}}
                                        <!-- Blog Details -->

                        {!! $page->content !!}




                        <!-- / blog-list -->



                </div>

            </div>
        </section>
        <!-- ========================================= -->
    </main>

@endsection
