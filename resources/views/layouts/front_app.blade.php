<!DOCTYPE html>
<html dir="rtl" lang="fa">

<!-- Mirrored from netita.ir/theme/xena/rtl/ by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 31 Oct 2019 15:45:23 GMT -->
<head>
    <title>قالب Xena | قالب HTML لندینگ پیج</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="HTML App Landing Page Template">
    <meta name="keywords" content="Landing app ,HTML,Template,theme,themeforest,envato ">
    <meta name="Author" content="AliNiyazi , Netita">
    <meta name="copyright" content="© 2019 Xena All rights reserved ">
    <link rel="shortcut icon" href="{{ asset( 'front/assets/images/logo/favicon.png')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset( 'front/assets/css/main.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset( 'front/assets/css/main2.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset( 'front/assets/css/rtl.css')}}">
    <link type="text/css" rel="stylesheet" href="{{ asset( 'front/assets/css/bootstrap-colorpicker.min.css')}}">
</head>

<!-- !Important demo-1 for demo-1 shapes -->
<!-- For RTL You Must add "dir=rtl" to the body  -->

<body class="demo-1" data-offset="500" data-spy="scroll" data-target="#navbar" dir="rtl">

<!-- =============== Header =============== -->
@include('front.temp.header')
<!-- ========================================= -->

@yield('content')


<!-- =========== footer =============== -->
@include('front.temp.footer')

<!-- ========================================= -->
<!-- =========== Loading screen  =============== -->
<div id="loader">
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
</div>
<!-- ========================================= -->
<!-- =========== Modals =============== -->
<!-- Video Modal -->
<div class="modal fade" id="video-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="#" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Video Modal -->
<!-- Image Modal ( Zooming In )-->
<div class="modal fade" id="image-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal" type="button" aria-label="Close"><span aria-hidden="true">&times;   </span>
                </button>
                <img class="img-fluid" src="#" title="Xena" alt="Xena">
            </div>
        </div>
    </div>
</div>
<!-- / Image Modal -->
<!-- ========================================= -->
<!-- ===========  Scripts  =============== -->

<script src="{{ asset( 'front/assets/js/custom.js')}}"></script>
<script src="{{ asset( 'front/assets/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('front/assets/js/select.js' )}}"></script>

</body>

<!-- Mirrored from netita.ir/theme/xena/rtl/ by HTTrack Website Copier/3.x [XR&CO'2010], Thu, 31 Oct 2019 15:46:48 GMT -->
</html>
