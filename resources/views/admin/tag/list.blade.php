@extends('admin.layouts.app')
@section('sidebar_title','مدیریت تگ ها')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مدیریت تگ ها</h4>
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-outline-primary" href="{{action('TagController@create')}}">افزودن
                                    تگ جدید
                                    <i class="ti-save"></i>
                                </a>
                            </div>
                            <div class="col">
                                <h4>جست و جو</h4>
                            </div>
                            <div class="col">
                                <label for="title_search">نام </label>
                                <input id="title_search" class="form-control" placeholder="مثال: نام 1" v-model="title_search" type="text">
                            </div>


                        </div>

                    </h6>
                    <div class="table-responsive table-hover table-striped">
                        <table class="table">
                            <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>slug</th>
                                <th>{{__('persian.updated_at')}}</th>
                                <th>{{__('persian.operation')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tag , index) in tags.data" :key="tag.id">
                                    <td>@{{ index+1 }}</td>
                                    <td>@{{ tag.name.fa }}</td>
                                    <td>@{{ tag.slug.fa }}</td>
                                    <td>@{{ tag.updated_at | moment}}</td>
                                    <td>
                                        <a @click="deleteTag(tag.id)" class="btn btn-outline-danger" href="#">حذف<i
                                                class="ti-trash"></i></a>
                                        <a class="btn btn-outline-info" :href="'/admin/tag/'+tag.id">ویرایش<i
                                                class="ti-trash"></i></a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :limit="5" :data="tags" @pagination-change-page="getResults">
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
                    tags: {},
                    title_search: "",

                }
            },
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
                    axios.get('/admin/tags?name=' + title +'&page=' + page)
                        .then(response => {
                            this.tags = response.data;
                        });
                },
                deleteTag(id) {
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
                            axios.delete('/admin/tag/' + id)
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
                }
            }

        });


    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
