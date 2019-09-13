@extends('admin.layouts.app')
@section('sidebar_title','مقالات')
@section('header')
    <link rel="stylesheet" type="text/css"
          href="/admin_template/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" type="text/css" href="/admin_template/assets/libs/ckeditor/samples/css/samples.css">
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
            <div class="card-header">مقاله جدید</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ایجاد مقاله جدید</h4>

                                <form method="POST" method="post" enctype="multipart/form-data"
                                      @submit.prevent="submit" @keydown="form.errors.clear($event.target.name)">
                                    @csrf
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="title"
                                                       class="col-md-4 col-form-label text-md-right">عنوان</label>
                                                <div class="col-md-8">
                                                    <input placeholder="مثال: آخرین نمایشگاه صنایع در تهران" id="title"
                                                           type="text" class="form-control " name="title"
                                                           v-bind:class="getClass(form.errors.has('title'))" required
                                                           autocomplete="title" v-model="form.title" autofocus>
                                                    <div class="invalid-feedback " v-show="form.errors.has('title')">
                                                        <strong>@{{ form.errors.get('title') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="slug"
                                                       class="col-md-4 col-form-label text-md-right">slug</label>

                                                <div class="col-md-8">
                                                    <input placeholder="ex : the-last-industrial-exhibition-in-tehran"
                                                           id="slug" type="text" class="form-control " name="slug"
                                                           v-bind:class="getClass(form.errors.has('slug'))"
                                                           autocomplete="slug"
                                                           v-model="slug" autofocus>
                                                    <div class="invalid-feedback " v-show="form.errors.has('slug')">
                                                        <strong>@{{ form.errors.get('slug') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">آپلود عکس</span>
                                        </div>
                                        <div class="custom-file">
                                            <input v-on:change="onImageChange" type="file" class="custom-file-input" id="inputGroupFile01">
                                            <label class="custom-file-label" for="inputGroupFile01">عکس را انتخاب کنید</label>
                                        </div>
                                    </div>


                                    <select v-model="form.page" class="select2 form-control custom-select mb-5" style="width: 100%; height:36px;">
                                        <option>انتخاب کنید</option>
                                        <optgroup label="نمایش در صفحه">
                                            <option value="0">مقاله</option>
                                            <option value="1">اخبار</option>
                                        </optgroup>

                                    </select>




                                    <textarea  id="editor">
                                                 <h1>محل ایجاد محتوا ...</h1>
                                    </textarea>
                                    <div class="form-group row mt-5 mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button :disabled="form.errors.any()" type="submit" class="btn btn-primary">
                                                <i class="ti-save"></i>
                                                ذخیره
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

@endsection


@section('script')
    <script src="/admin_template/assets/libs/ckeditor/ckeditor.js"></script>
    <script src="/admin_template/assets/libs/ckeditor/samples/js/sample.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                form: new Form({
                    content: "",
                    title: "",
                    slug: "",
                    page:"",
                    image:""
                }),

            },
            computed: {
                slug() {
                    this.form.slug = this.sanitizeTitle(this.form.title);
                    return this.form.slug;

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
                    this.form.content = CKEDITOR.instances.editor.getData();
                    this.form.submit('post', '/admin/register')
                        .then(response =>

                            Swal.fire(
                                'ثبت شد!',
                                'اطلاعات به درستی ثبت شد.',
                                'success'
                            )
                        )
                        .catch(e => Swal.fire(
                            'ثبت نشد!',
                            'اطلاعات به درستی ثبت نشد.',
                            'warning'
                        ));
                },
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
                onImageChange(e) {
                    this.form.image = e.target.files[0];
                    },

            }
        });
        var options = {
            filebrowserImageBrowseUrl: '/admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/admin/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/admin/laravel-filemanager/upload?type=Files&_token=',
            contentsLangDirection: 'rtl',
            height: 400
        };
        CKEDITOR.replace('editor', options);
        initSample();


    </script>
    <script src="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.all.min.js"></script>

@endsection
