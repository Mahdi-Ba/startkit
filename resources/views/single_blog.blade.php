

    <!-- ========================================= -->
    <!-- =========== Related Blogs Section =============== -->




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
                        <li class="breadcrumb-item"><a href="home">خانه</a></li>
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
        <section id="single-blog">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <!-- Post -->
                        <div class="post">
                            <!-- post image -->
                            <div class="post-image"><img src="{{asset($post->img)}}" title="{{$post->title}}" alt="{{$post->title}}"/></div>
                            <!-- /. post image -->
                            <!-- Details -->
                            <div class="post-details">
                                <!-- title -->
                                <div class="title"><h4>{{$post->title}}</h4></div>
                                <!-- /.title -->
                                <!-- date , tags and more -->
                                <div class="info">
                                    <ul class="list-inline">
                                        <li class="author list-inline-item"><a href="#aboutAuthor"><i
                                                    class="fas fa-user"></i><span>{{ $post->user->name }}</span></a></li>

                                        <li class="categories list-inline-item"><a href="#aboutAuthor"><i
                                                    class="fas fa-eye"></i><span>{{ $post->category->title }}</span></a></li>
                                        <li class="date list-inline-item"><i class="far fa-calendar-alt"></i><span>{{ new Verta($post->cteated_at) }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /.date , tags and more -->
                            </div>
                            <!-- /Details -->
                            <!-- Post Content -->
                            <div class="post-content">
                                {!!$post->content  !!}

                            </div>
                            <!--/.PostContent -->
                            <!-- Tags & Share info  -->
                            <div class="info">
                                <div class="tags">
                                    <ul class="list-inline">
                                        @foreach($post->tags as $tag)
                                        <li class="list-inline-item"><a href="/tag/{{$tag->slug}}"> {{$tag->name}}</a></li>
                                            @endforeach
                                    </ul>
                                </div>
                                <div class="share"><p><a href="#"><i class="fas fa-share-alt"></i>این مقاله را به اشتراک بگذارید </a></p>
                                </div>
                            </div>
                            <!-- / Tags & Share info  -->
                        </div>
                        <!-- /.Post -->


                    </div>
                    <div class="col-lg-4 col-md-12">
                        <!-- Sidebar -->
                        <div id="sidebar">
                            <!-- search form -->
                            <div class="search">
                                <form class="needs-validation form" novalidate>
                                    <div class="input-group mb-3"><input class="form-control" type="text"
                                                                         aria-describedby="basic-addon2"
                                                                         aria-label="جستجو..." placeholder="جستجو..."
                                                                         required>
                                        <div class="invalid-tooltip">لطفا اطلاعات را وارد کنید</div>
                                        <div class="input-group-append">
                                            <button class="btn" type="submit"><i class="fas fa-search"
                                                                                 id="basic-addon2"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- / search form -->
                            <!-- Categories -->
                            <div class="categories">
                                <!-- Title -->
                                <h5 class="title style-2">دسته بندی ها</h5>
                                <!-- /Title -->
                                <ul class="list-group">
                                    @foreach(\App\Category::all() as $category)
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

        <section class="pt-0" id="blogs">
            <div class="container">
                <!-- Section-title -->
                <div class="section-title text-center"><h3><strong>پست ها</strong>مرتبط</h3>
{{--
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
--}}
                </div>
                <!--/ section-title -->
                <div class="row">
                    @foreach($related as $related)
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <!-- blog  -->
                        <div class="card blog">
                            <!-- Blog Image -->

                                <div class="card-img-top"><img src="{{asset($related->img)}}" title="Xena" alt="Xena"/></div>
                                <!-- Blog Details -->
                                <div class="card-body">
                                    <div class="card-title">
                                        <!-- Blog Title -->
                                        <h6 class="blog-title"><a
                                                href="single-blog.html">{{$related->title}}</a></h6>
                                        <!-- Blog info -->
                                        <ul class="blog-info text-muted list-inline">
                                            <li class="list-inline-item"><i class="fas fa-user"></i><span>{{$related->user->name}}</span></li>
                                            <li class="list-inline-item"><i
                                                    class="far fa-calendar-alt"></i><span>{{ new Verta($related->cteated_at) }}</span></li>
                                            </li>
                                        </ul>
                                        <!-- / Blog Info -->
                                    </div>
                                    <!-- Blog Content -->
                                    <p class="card-text blog-content">
                                        {!! substr($related->content, 0, 40) !!}
                                    </p>

                                    <a class="btn-gradient" href="/single_blog/{{$related->id}}/{{$data->slug}}"><i
                                            class="fas fa-chevron-right"></i></a></div>

                        </div>



                        <!-- / blog  -->
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!-- ========================================= -->
    </main>

@endsection
