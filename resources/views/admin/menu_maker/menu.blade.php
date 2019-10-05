@extends('admin.layouts.app')
@section('sidebar_title','مدیریت منو ها')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

@endsection

@section('content')

    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">منو ساز پارس پروشات</h4>
                        <div class="myadmin-dd-empty dd" id="nestable-json"></div>
                        <a @click="store()" class="btn btn-outline-purple btn-rounded waves-effect waves-light m-t-20" href="#">ذخیره<i
                                class="ti-pencil"></i></a>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection
@section('script')
    <script src="/admin_template/assets/libs/nestable/jquery.nestable.min.js"></script>
    <script>
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    menu:""
                }
            },

            mounted() {
                this.fetchMenu();


            },
            methods:{
                fetchMenu(){
                    axios.get('/admin/page/fetch_menu')
                        .then(function (response) {
                            // handle success
                            this.menu = JSON.stringify(response.data);
                            var options =
                                {'json': this.menu,
                                 maxDepth:3,

                                'contentCallback':function(item) {return item.title || '' ? item.title : item.id;}

                            };
                            $('#nestable-json').nestable(options);
                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })
                },
                store()
                {
                    let store = $('#nestable-json').nestable('serialize');
                    axios.post('/admin/page/rebuilt_menu', {
                            data:store
                    })
                        .then(response => {
                            Swal.fire(
                                'ثبت شد!',
                                'اطلاعات به درستی ثبت شد.',
                                'success'
                            );
                            this.changePage();
                        }) .catch(function (error) {
                        Swal.fire(
                            'ثبت نشد!',
                            'اطلاعات به درستی ثبت نشد.',
                            'warning'
                        )
                    });
                },
                changePage() {
                    window.location.href = '/admin/page/menu';
                }
            }


        });




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



    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
