@extends('admin.layouts.app')
@section('sidebar_title','مدیریت دسته بند ی ها')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مدیریت ارتباطات</h4>
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col">
                                <h4>جست و جو</h4>
                            </div>
                            <div class="col">
                                <label for="title_search">عنوان </label>
                                <input id="title_search" class="form-control" placeholder="مثال: عنوان 1" v-model="title_search" type="text">
                            </div>


                        </div>

                    </h6>
                    <div class="table-responsive table-hover table-striped">
                        <table class="table">
                            <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>نام</th>
                                <th>شماره</th>
                                <th>ایمیل</th>
                                <th>تاریخ</th>
                                <th>{{__('persian.operation')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(category , index) in categories.data" :key="category.id">
                                    <td>@{{ index+1 }}</td>
                                    <td>@{{ category.name }}</td>
                                    <td>@{{ category.mobile }}</td>
                                    <td>@{{ category.email }}</td>
                                    <td>@{{ category.updated_at | moment}}</td>
                                    <td>
                                        <a @click="deleteCategory(category.id)" class="btn btn-outline-danger btn-rounded waves-effect waves-light" href="#">حذف<i
                                                class="ti-trash"></i></a>
                                        <a class="btn btn-outline-info btn-rounded waves-effect waves-light" :href="'/admin/contact/'+category.id">مشاهده<i
                                                class="ti-pencil"></i></a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :limit="5" :data="categories" @pagination-change-page="getResults">
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
                    categories: {},
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
                    axios.get('/admin/contacts?title=' + title +'&page=' + page)
                        .then(response => {
                            this.categories = response.data;
                        });
                },
                deleteCategory(id) {
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
                            axios.delete('/admin/contact/' + id)
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
