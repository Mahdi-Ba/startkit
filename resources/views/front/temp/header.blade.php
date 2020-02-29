<header id="header">
    <nav class="navbar navbar-expand-lg  fixed-top" id="navbar">
        <div class="container"><!-- Brand -->
            <a class="navbar-brand mb-0" href="index-2.html"><img class="logo"
                                                                  src="{{asset('front/assets/images/logo/logo_white.png')}}"
                                                                  title="Xena"
                                                                  alt="Xena"/></a>
            <button class="navbar-toggler" data-target="#navbar-collapse" data-toggle="collapse" type="button"
                    aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span></span><span></span><span></span></button>
            <div class="collapse navbar-collapse " id="navbar-collapse">
                <!-- Nav Links -->
                <ul class="navbar-nav nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="/#intro-section">خانه</a></li>
                    <li class="nav-item"><a class="nav-link" href="/blog">وبلاگ </a></li>

                    @foreach(\App\Menu::where('parent_id',null)->get() as $header)
                        @if($header->sub_category()->count())
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown1"
                                   data-toggle="dropdown" href="#" role="button"
                                   aria-expanded="false" aria-haspopup="true">{{$header->title}}</a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($header->sub_category as $data)
                                        <a class="dropdown-item"
                                           href="/page/{{$data->slug}}">
                                            {{$data->title}}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link"
                                                    href="/page/{{$header->slug}}">{{$header->title}} </a>
                            </li>
                        @endif



                    @endforeach
                </ul>
                <!-- / Nav Links -->
            </div>
        </div>
    </nav>
</header>
