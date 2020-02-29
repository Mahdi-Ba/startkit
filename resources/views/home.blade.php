@extends('layouts.front_app')

@section('content')
    <main class="home">
        <!-- =============== Intro Section =============== -->
    @include('front.temp.intro')


    <!-- ============================================= -->
        <!-- =============== About Section =============== -->
    @include('front.temp.about')


    <!-- ============================================= -->
        <!-- =============== Features Section =============== -->
    @include('front.temp.feature')


    <!-- ====================================================== -->
        <!-- =============== How it working  Section =============== -->

    @include('front.temp.how_it_work')

    <!-- ====================================================== -->
        <!-- =============== Video Section =============== -->

    @include('front.temp.video_section')

    <!-- ====================================================== -->
        <!-- =============== Testimonials Section =============== -->

    @include('front.temp.testimonials_section')


    <!-- ====================================================== -->

        <!-- =============== screenshots Section =============== -->
    @include('front.temp.screenshots_section')

    <!-- ====================================================== -->
        <!-- =============== Our Team Section =============== -->
    @include('front.temp.team_section')


    <!-- ====================================================== -->
        <!-- =========== FQA Section =============== -->
    @include('front.temp.fqa')

    <!-- ========================================= -->

        <!-- =========== Prices Section =============== -->

    {{--
    @include('front.temp.price')
    --}}

    <!-- ========================================= -->
        <!-- =========== Achievement Section =============== -->

    @include('front.temp.achievements_section')

    <!-- ========================================= -->
        <!-- =============== Clients =============== -->
    @include('front.temp.client')


    <!-- ======================================= -->
        <!-- =========== Blog Section =============== -->

    @include('front.temp.blog')

    <!-- ========================================= -->

        <!-- =========== Download Section =============== -->

    @include('front.temp.download')


    <!-- ========================================= -->
        <!-- =========== Contact Section =============== -->
    @include('front.temp.contact')

    <!-- ========================================= -->
    </main>
@endsection
