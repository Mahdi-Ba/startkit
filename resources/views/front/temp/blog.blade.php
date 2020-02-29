<section id="blog-section">
    <div class="container">
        <!-- Section-title -->
        <div class="section-title text-center"><h3>آخرین<strong>وبلاگ ها</strong></h3>
            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
        </div>
        <!--/ section-title -->
        <!-- Blog List -->
        <div class="row blog-list">
            @foreach(\App\Blog::limit(3)->get() as $data)

            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                <!-- blog  -->
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
                                <li class="list-inline-item"><i class="fas fa-user"></i><span>{{$data->user->name}}</span></li>
                                <li class="list-inline-item"><i
                                        class="far fa-calendar-alt"></i><span>{{ new Verta($data->cteated_at) }}</span></li>
                          {{--      <li class="list-inline-item"><i class="far fa-comments"></i><span>30</span><span>نظرات</span>
                                </li>--}}
                            </ul>
                            <!-- / Blog Info -->
                        </div>
                        <!-- Blog Content -->
                        <p class="card-text blog-content">
                            {!! substr($data->content, 0, 60) !!}
                        </p>
                        <a class="btn-gradient" href="/single_blog/{{$data->id}}/{{$data->slug}}"><i
                                class="fas fa-chevron-right"></i></a></div>
                </div>
                <!-- / blog  -->
            </div>
            @endforeach

            <div class="col-12"><a class="btn-main load-more" href="/blog">بیشتر </a></div>
        </div>
        <!-- /Blog List -->
    </div>
</section>
