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
                'form.name':function (val,nval)
                {
                    this.form.slug = this.sanitizeTitle(nval);
                }
            },
            methods: {
                sanitizeTitle(title) {
                    var slug = "";
                    // Change to lower case
                    var titleLower = title.toLowerCase();
                    // Letter "e"
                    slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
                    // Letter "a"
                    slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
                    // Letter "o"
                    slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
                    // Letter "u"
                    slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
                    // Letter "d"
                    slug = slug.replace(/đ/gi, 'd');
                    // Trim the last whitespace
                    slug = slug.replace(/\s*$/g, '');
                    // Change whitespace to "-"
                    slug = slug.replace(/\s+/g, '-');

                    return slug;
                },
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
                        this.form.slug = this.sanitizeTitle(this.form.name);
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
