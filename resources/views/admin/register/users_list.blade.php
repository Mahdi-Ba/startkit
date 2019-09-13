@extends('admin.layouts.app')
@section('sidebar_title','مدیریت کاربران')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">مدیریت کاربران</h4>
                    <h6 class="card-subtitle">
                        <div class="row">
                            <div class="col-3">
                                <a class="btn btn-outline-primary" href="{{action('RegistrationController@create')}}">افزودن
                                    کاربر جدید
                                    <i class="ti-save"></i>
                                </a>
                            </div>
                            <div class="col">
                                <h4>جست و جو</h4>
                            </div>
                            <div class="col">
                                <label for="name_search">نام کاربری</label>
                                <input id="name_search" class="form-control" placeholder="مثال: مهدی بهاری" v-model="name_search" type="text">
                            </div>

                            <div class="col">
                                <label for="email_search">ایمیل</label>

                                <input id="email_search" class="form-control" placeholder="مثال: baharimahdi93@gmail.com" v-model="email_search" type="text">
                            </div>
                        </div>

                    </h6>
                    <div class="table-responsive table-hover table-striped">
                        <table class="table">
                            <thead class="bg-success text-white">
                            <tr>
                                <th>#</th>
                                <th>{{__('persian.name')}}</th>
                                <th>{{__('persian.email')}}</th>
                                <th>{{__('persian.updated_at')}}</th>
                                <th>{{__('persian.operation')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user , index) in Users.data" :key="user.id">
                                    <td>@{{ index+1 }}</td>
                                    <td>@{{ user.name }}</td>
                                    <td>@{{ user.email }}</td>
                                    <td>@{{ user.updated_at | moment}}</td>
                                    <td>
                                        <a @click="deleteUser(user.id)" class="btn btn-outline-danger" href="#">حذف<i
                                                class="ti-trash"></i></a>
                                        <a class="btn btn-outline-info" :href="'register/'+user.id">ویرایش<i
                                                class="ti-trash"></i></a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <pagination :limit="5" :data="Users" @pagination-change-page="getResults">
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
                    Users: {},
                    name_search: "",
                    email_search: ""
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
                getResults(page = 1, name = "", email = "") {
                    axios.get('/admin/users?name=' + name + '&email=' + email + '&page=' + page)
                        .then(response => {
                            this.Users = response.data;
                        });
                },
                deleteUser(id) {
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
                            axios.delete('/admin/register/' + id)
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
                name_search() {
                    this.getResults(1, this.name_search, this.email_search)
                },
                email_search() {
                    this.getResults(1, this.name_search, this.email_search)
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
