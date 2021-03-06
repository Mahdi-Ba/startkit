@extends('admin.layouts.app')
@section('sidebar_title','مدیریت دسته بندی ها')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .switch input {
            display:none;
        }
        .switch {
            display:inline-block;
            width:60px;
            height:30px;
            margin:8px;
            transform:translateY(50%);
            position:relative;
        }

        .slider {
            position:absolute;
            top:0;
            bottom:0;
            left:0;
            right:0;
            border-radius:30px;
            box-shadow:0 0 0 2px #777, 0 0 4px #777;
            cursor:pointer;
            border:4px solid transparent;
            overflow:hidden;
            transition:.4s;
        }
        .slider:before {
            position:absolute;
            content:"";
            width:100%;
            height:100%;
            background:#777;
            border-radius:30px;
            transform:translateX(-30px);
            transition:.4s;
        }

        input:checked + .slider:before {
            transform:translateX(30px);
            background:limeGreen;
        }
        input:checked + .slider {
            box-shadow:0 0 0 2px limeGreen,0 0 2px limeGreen;
        }

    </style>
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
                        <label for="title" class="col-md-4 col-form-label text-md-right">عنوان</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control " name="title"  v-bind:class="getClass(form.errors.has('title'))"
                                  required autocomplete="title" v-model="form.title" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('title')">
                                <strong>@{{ form.errors.get('title') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="slug" class="col-md-4 col-form-label text-md-right">slug</label>

                        <div class="col-md-6">
                            <input id="slug" type="text" class="form-control " name="slug"  v-bind:class="getClass(form.errors.has('slug'))"
                                    autocomplete="slug" v-model="form.slug" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('slug')">
                                <strong>@{{ form.errors.get('slug') }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="myCheckbox" class="col-md-4 col-form-label text-md-right">وضعیت</label>

                        <label class="switch">
                            <input id="myCheckbox" v-model="form.is_active"  type="checkbox" >
                            <span class="slider"></span>
                        </label>
                    </div>




                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4" v-bind:class="getClass(form.errors.has('is_active'))">
                            <button  :disabled="form.errors.any()" type="submit" class="btn btn-primary  btn-rounded waves-effect waves-light m-t-20">
                                <i class="ti-save "></i>
                              ذخیره
                            </button>
                            <div class="invalid-feedback " v-show="form.errors.has('is_active')">
                                <strong>@{{ form.errors.get('is_active') }}</strong>
                            </div>
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
                    id:"{{$category->id}}",
                    title: "{{$category->title}}",
                    slug: "{{$category->slug}}",
                    is_active: "{{$category->is_active}}",

                }),

            },
            watch:{
                'form.title':function (nval,val)
                {
                    this.form.slug =sanitizeTitle(nval);
                }
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
                    if(this.form.slug == "")
                    {
                        this.form.slug = sanitizeTitle(this.form.title);
                    }
                    this.form.submit('post', '/admin/category')
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
                    this.form.title ="";
                    this.form.slug ="";
                },
            }
        });
        @if($category->is_active == true)
        $('#myCheckbox').prop('checked', true);
        @else
        $('#myCheckbox').prop('checked', false);
        @endif




    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
