@extends('admin.layouts.app')
@section('sidebar_title','مدیریت مقالات')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        #blogContent * {
            font-size: 15px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مدیریت مقالات</h4>
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-outline-primary  btn-rounded waves-effect waves-light m-t-20" href="{{action('BlogController@create')}}">افزودن
                                    مقاله جدید
                                    <i class="ti-save"></i>
                                </a>
                            </div>
                            <div class="col">
                                <h4>جست و جو</h4>
                            </div>
                            <div class="col">
                                <label for="title_search">عنوان </label>
                                <input id="title_search" class="form-control" placeholder="مثال: عنوان 1"
                                       v-model="title_search" type="text">
                            </div>


                        </div>

                    </h6>
                    <div class="row">
                        <div v-for="(post , index) in posts.data" :key="post.id" class="col-4">
                            <img class="card-img-top img-responsive" :src="'/'+post.img" alt="card">
                            <div class="card-body">
                                <div class="d-flex no-block align-items-center m-b-15">
                                    <span><i class="ti-calendar"></i>  @{{ post.updated_at | moment }}</span>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0)" class="link"><i class="ti-user"></i>@{{
                                            post.user.name }}</a>
                                    </div>
                                </div>
                                <h3 class="font-normal">@{{ post.title }}</h3>
                                <p class="m-b-0 m-t-10" id="blogContent"
                                   v-html="$options.filters.truncate(post.content,100)"></p>
                                <button class="btn btn-success btn-rounded waves-effect waves-light m-t-20">
                                    @{{post.category.title }}
                                </button>
                                <a @click="deletePost(post.id)"
                                   class="btn btn-outline-danger btn-rounded waves-effect waves-light m-t-20" href="#">حذف<i
                                        class="ti-trash"></i></a>
                                <a class="btn btn-outline-info btn-rounded waves-effect waves-light m-t-20"
                                   :href="'/admin/blogs/'+post.id+'/edit'">ویرایش<i
                                        class="ti-pencil"></i></a>
                            </div>
                        </div>


                    </div>
                    <div class="row col-12">
                        <pagination :limit="5" :data="posts" @pagination-change-page="getResults">
                            <span slot="prev-nav">&lt; قبلی</span>
                            <span slot="next-nav">بعدی &gt;</span>
                        </pagination>
                    </div>
                </div>

            </div>

        </div>

    </div>


@endsection
@section('script')
    <script !src="">
        const app = new Vue({
            el: '#app',
            data() {
                return {
                    // Our data object that holds the Laravel paginator data
                    posts: {},
                    title_search: "",

                }
            },
            computed: {},
            mounted() {
                // Fetch initial results
                this.getResults();
            },
            methods: {

                responseAlert(input) {
                    if (input) {
                        this.getResults();
                        Swal.fire(
                            'پاک شد!',
                            'اطلاعات به درستی پاک شد.',
                            'success'
                        );

                    } else {
                        Swal.fire(
                            'پاک نشد!',
                            'اطلاعات به درستی پاک نشد.',
                            'warning'
                        );
                    }
                },
                // Our method to GET results from a Laravel endpoint
                getResults(page = 1, title = "") {
                    axios.get('/admin/blog/posts?title=' + title + '&page=' + page)
                        .then(response => {
                            this.posts = response.data;
                        });
                },
                deletePost(id) {
                    this.confirm(id);
                },
                confirm(id) {
                    var self = this;
                    Swal.fire({
                        title: 'از انجام عملیات مطمئن هستید؟',
                        text: "برگشت اطلاعات امکان پذیر نیست",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'بله',
                        cancelButtonText: 'خیر'
                    }).then((result) => {
                        if (result.value) {
                            axios.delete('/admin/blogs/' + id)
                                .then(function (response) {
                                    self.responseAlert(response.data);
                                })
                                .catch(function (error) {
                                    self.responseAlert(false);
                                });
                        }
                    });

                }
            },
            watch: {
                title_search() {
                    this.getResults(1, this.title_search)
                },

            },
            filters: {
                moment: function (date) {
                    return moment(date).fromNow();
                },
                truncate(value, limit) {
                    if (value.length > limit) {
                        value = value.substring(0, (limit - 3)) + '...';
                    }
                    return value;


                },

            }

        });


    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
