@extends('admin.layouts.app')
@section('sidebar_title','مدیریت اعضا')
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
                        <a class="btn btn-outline-primary" href="{{action('RegistrationController@create')}}">افزودن کاربر جدید
                            <i class="ti-save"></i>
                        </a>
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
                            @foreach($users as $user)

                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->updated_at}}</td>
                                    <td>
                                        <a  @click="deleteUser({{$user->id}})" class="btn btn-outline-danger" href="#">حذف<i class="ti-trash"></i></a>
                                        <a class="btn btn-outline-info" href="{{action('RegistrationController@create')}}">ویرایش<i class="ti-trash"></i></a>

                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script !src="">
        var vm = new Vue({
            el: '#app',
            data: function () {
                return {
                    test: 'jkkjdekdej'
                }
            },mounted(){

            },methods:{
                deleteUser(id){
                    this.ali(id);
                },
                ali(id){
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
                        axios.delete('/admin/register/'+id)
                            .then(function (response) {
                                Swal.fire(
                                    'پاک شد!',
                                    'اطلاعات به درستی پاک شد.',
                                    'success'
                                )
                            })
                            .catch(function (error) {
                                Swal.fire(
                                    'پاک نشد!',
                                    'اطلاعات به درستی پاک نشد.',
                                    'warning'
                                )
                            });


                    });

            }
        }});




    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>
@endsection
