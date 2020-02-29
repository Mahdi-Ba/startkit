
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
                    <li class="breadcrumb-item"><a href="blog">وبلاگ</a></li>
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
                <div class="col-lg-8 col-md-12">
                    <!-- Blogs List -->
                    <div class="blog-list masonry-view">
                        <div class="card-columns mb-4">
                            <!-- blog  -->
                            @foreach($blog as $data)
                                <div class="card blog">
                                    <!-- Blog Image -->
                                    <div class="card-img-top"><img src="{{asset($data->img)}}" title="{{$data->title}}"
                                                                   alt="{{$data->title}}"/>
                                    </div>
                                    <!-- Blog Details -->
                                    <div class="card-body">
                                        <div class="card-title">
                                            <!-- Blog Title -->
                                            <h6 class="blog-title"><a
                                                    href="/single_blog/{{$data->id}}/{{$data->slug}}">
                                                    {{$data->title}}

                                                </a></h6>
                                            <!-- Blog info -->
                                            <ul class="blog-info text-muted list-inline">
                                                <li class="list-inline-item"><i
                                                        class="fas fa-user"></i><span>{{$data->user->name}}</span>
                                                </li>
                                                <li class="list-inline-item"><i
                                                        class="far fa-calendar-alt"></i><span>{{ new Verta($data->cteated_at) }}</span>
                                                </li>
                                                {{-- <li class="list-inline-item"><i
                                                         class="far fa-comments"></i><span>30</span><span>نظرات</span></li>--}}
                                            </ul>
                                            <!-- / Blog Info -->
                                        </div>
                                        <!-- Blog Content -->
                                        <p class="card-text blog-content">
                                            {!! substr($data->content, 0, 60) !!}

                                        </p>

                                        <a
                                            class="btn-gradient" href="/single_blog/{{$data->id}}/{{$data->slug}}"><i
                                                class="fas fa-chevron-right"></i></a></div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <!-- / blog-list -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <!-- pagination -->


                            <nav class="mt-5" aria-label="Page navigation">
                                {!! $blog->links() !!}
                            </nav>
                            <!-- /pagination -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <!-- Sidebar -->
                    <div id="sidebar">
                        <!-- search form -->
{{--                        <div class="search">--}}
{{--                            <form class="needs-validation form" novalidate>--}}
{{--                                <div class="input-group mb-3"><input class="form-control" type="text"--}}
{{--                                                                     aria-describedby="basic-addon2"--}}
{{--                                                                     aria-label="جستجو..." placeholder="جستجو..."--}}
{{--                                                                     required>--}}
{{--                                    <div class="invalid-tooltip">لطفا اطلاعات را وارد کنید</div>--}}
{{--                                    <div class="input-group-append">--}}
{{--                                        <button class="btn" type="submit"><i class="fas fa-search"--}}
{{--                                                                             id="basic-addon2"></i></button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <!-- / search form -->
                        <!-- Categories -->
                        <div class="categories">
                            <!-- Title -->
                            <h5 class="title style-2">دسته بندی ها</h5>
                            <!-- /Title -->
                            <ul class="list-group">
                                @foreach(\App\Category::whereIs_active(1)->get() as $category)
                                    <li class="list-group-item"><p><a href="/category/{{$category->title}}"> <span
                                                    class="cat_name">{{$category->title}}</span><span
                                                    class="badge">{{$category->blog()->count()}}</span></a></p></li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.Categories -->
                        <!-- latest posts -->
                        <div class="latestPosts">
                            <!-- Title -->
                            <h5 class="title style-2">آخرین پست ها</h5>
                            <!-- /Title -->
                            <ul class="list-unstyled">
                                <!-- post 1 -->
                                @foreach($latest as $data)
                                    <li>
                                        <div class="media post">
                                            <!-- Post image -->
                                            <div class="post-img"><a
                                                    href="/single_blog/{{$data->id}}/{{$data->slug}}"><img
                                                        src="{{asset($data->img)}}" title="{{$data->title}}"
                                                        alt="{{$data->title}}"/></a></div>
                                            <!-- /.Post image -->
                                            <!-- Post title and desc -->
                                            <div class="post-details media-body"><a
                                                    href="/single_blog/{{$data->id}}/{{$data->slug}}"><h5
                                                        class="title">{{$data->title}}</h5>
                                                    {!! substr($data->content, 0, 40) !!}
                                                    <p class="text-muted"><i
                                                            class="far fa-calendar-alt"></i><span>{{ new Verta($data->cteated_at) }}</span>
                                                    </p></a>
                                            </div>
                                            <!-- / Post title and desc -->
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /.latest posts -->
                        <!-- tags -->
                        <div class="tags">
                            <!-- Title -->
                            <h5 class="title style-2"> برچسب ها</h5>
                            <!-- /Title -->
                            <p>
                                @foreach(Spatie\Tags\Tag::all() as $data)
                                    <a
                                        href="/tag/{{$data->slug}}">{{$data->name}}
                                    </a>
                                @endforeach
                            </p>

                        </div>
                        <!-- /.tags -->
                    </div>
                    <!-- / sidebar -->
                </div>
            </div>
        </div>
    </section>
    <!-- ========================================= -->
</main>

    @endsection
