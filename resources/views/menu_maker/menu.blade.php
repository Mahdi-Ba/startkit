@extends('admin.layouts.app')
@section('sidebar_title','مدیریت تگ ها')
@section('header')

@endsection

@section('content')

    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
{{--<h1>        {{mix('css/app.css')}}


</h1>--}}
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Nestable2</h4>
                        <div class="myadmin-dd-empty dd" id="nestable-json"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>


@endsection
@section('script')
    <script src="/admin_template/assets/libs/nestable/jquery.nestable.min.js"></script>
    <script>

        $(function () {
            var json = '[{"id":"خانه","url":"/home"},{"id":2},{"id":3,"children":[{"id":4},{"id":5,"foo":"bar"}]}]';
            console.log(JSON.parse(json));

            var options = {'json': json};
            $('#nestable-json').nestable(options);


            /*            function makeNestableListUsingJSONArray(jsonArray, root) {

                            if (typeof root === 'undefined') {
                                root = $('body');
                            }
                            var $div = $('<div id="nestable2"><ol class="dd-list"></ol></div>');
                            root.append($div);
                            for (var i = 0; i < jsonArray.length; i++) {
                                var $li = $("<li class='dd-item' data-id='" + jsonArray[i].id + "'><div class='dd-handle'><span class='dd-content'>" + jsonArray[i].content + "</span></div></li>");
                                root.find('ol.dd-list:first').append($li);

                                if (typeof jsonArray[i].children !== 'undefined') {
                                    makeNestableListUsingJSONArray(jsonArray[i].children, $li);
                                }
                            }
                            $('#nestable').nestable({maxDepth:2});
                        }*/

            /*
                    makeNestableListUsingJSONArray(json);
            */


            /*
                        $('#nestable2').nestable('serialize');
                               console.log(typeof window.JSON.stringify(list.nestable('serialize')));
            */



        });
    </script>

@endsection
