@extends('admin.layouts.app')
@section('sidebar_title','مدیریت اعضا')
@section('header')
    <link href="/admin_template/assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

@endsection

@section('content')
    @if($errors->any())
        <h4>{{$errors->first()}}</h4>
    @endif
    @if (Session::has('success'))

        <div class="alert alert-success alert-rounded"><i class="ti-save"></i> {!! Session::get('success') !!}</li>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">×</span></button>
        </div>
    @endif
    <div class="col">
        <div class="card">
            <div class="card-header">{{ __('Register') }}</div>

            <div class="card-body">
                <form method="POST" method="post" enctype="multipart/form-data"
                      @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('persian.name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control " name="name"  v-bind:class="getClass(form.errors.has('name'))"
                                  required autocomplete="name" v-model="form.name" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('name')">
                                <strong>@{{ form.errors.get('name') }}</strong>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('persian.email') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control " name="email"  v-bind:class="getClass(form.errors.has('email'))"
                                   required autocomplete="email" v-model="form.email" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('email')">
                                <strong>@{{ form.errors.get('email') }}</strong>
                            </div>
                        </div>
                    </div>



                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('persian.password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control " name="password"  v-bind:class="getClass(form.errors.has('password'))"
                                    required autocomplete="new-password" v-model="form.password" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('password')">
                                <strong>@{{ form.errors.get('password') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('persian.password_confirmation') }}</label>

                        <div class="col-md-6">
                            <input id="password_confirmation" type="password" class="form-control " name="password_confirmation"  v-bind:class="getClass(form.errors.has('password_confirmation'))"
                                  required autocomplete="new-password" v-model="form.password_confirmation" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('password')">
                                <strong>@{{ form.errors.get('password_confirmation') }}</strong>
                            </div>
                        </div>
                    </div>





                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button  :disabled="form.errors.any()" type="submit" class="btn btn-primary">
                                <i class="ti-save"></i>
                              ذخیره
                            </button>
                        </div>
                    </div>

                </form>




            </div>
        </div>
    </div>

@endsection


@section('script')
    <script !src="">


        new Vue({
            el: '#app',
            data: {
                form: new Form({
                    id:"{{$user->id}}",
                    name: "{{$user->name}}",
                    email: "{{$user->email}}",
                    password:"",
                    password_confirmation:""
                }),
            },
            methods: {
                getClass(input) {
                    if (input) {
                        return 'is-invalid'
                    } else {
                        return ''
                    }
                },

                submit() {
                    this.form.submit('post', '/admin/register')
                        .then(response =>

                                Swal.fire(
                                    'ثبت شد!',
                                    'اطلاعات به درستی ثبت شد.',
                                    'success'
                                )


                        )
                        .catch(e =>   Swal.fire(
                            'ثبت نشد!',
                            'اطلاعات به درستی ثبت نشد.',
                            'warning'
                        ));
                },
            }
        });


    </script>
    <script src="/admin_template/assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
