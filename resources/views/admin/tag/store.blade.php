@extends('admin.layouts.app')
@section('sidebar_title','مدیریت تگ ها')
@section('header')
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
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
                        <label for="name" class="col-md-4 col-form-label text-md-right">نام</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control " name="name"  v-bind:class="getClass(form.errors.has('name'))"
                                  required autocomplete="name" v-model="form.name" autofocus>
                            <div class="invalid-feedback " v-show="form.errors.has('name')">
                                <strong>@{{ form.errors.get('name') }}</strong>
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

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4" v-bind:class="getClass(form.errors.has('is_active'))">
                            <button  :disabled="form.errors.any()" type="submit" class="btn btn-primary">
                                <i class="ti-save"></i>
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
                    id:"{{$tag->id}}",
                    name: "{{$tag->name}}",
                    slug: "{{$tag->slug}}",


                }),

            },
            watch:{
                'form.name':function (nval,val)
                {
                    this.form.slug = sanitizeTitle(nval);
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
                        this.form.slug = sanitizeTitle(this.form.name);
                    }
                    this.form.submit('post', '/admin/tag')
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
                    this.form.slug ="";
                    this.form.name ="";
                },
            }
        });
    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
