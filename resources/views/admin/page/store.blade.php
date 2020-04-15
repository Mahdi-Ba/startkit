@extends('admin.layouts.app')
@section('sidebar_title','مقالات')
@section('header')
    <link rel="stylesheet" type="text/css"
          href="/admin_template/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" type="text/css" href="/admin_template/assets/libs/ckeditor/samples/css/samples.css">
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">


    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
    <style>

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
            <div class="card-header">صفحه جدید</div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">ایجاد صفحه جدید</h4>

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
                                                    <input id="slug" type="text" class="form-control " name="slug"
                                                           v-bind:class="getClass(form.errors.has('slug'))"
                                                           autocomplete="slug" v-model="form.slug" autofocus>
                                                    <div class="invalid-feedback " v-show="form.errors.has('slug')">
                                                        <strong>@{{ form.errors.get('slug') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <image-component :address="'/files/shares/page'" :editable="[form.img]"
                                                     {{-- multiple--}} callback-function="picture"></image-component>
                                    <p style="font-size: 80%" class="text-danger" v-show="form.errors.has('img')">
                                        @{{ form.errors.get('img') }}
                                    </p>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-md-4 col-form-label text-md-right">نوع قالب</label>
                                                <br>
                                                <select v-model="form.template_id" class="form-control custom-select" >
                                                    <option disabled value="" >قالب را انتخاب نمایید</option>
                                                    <option value="1">قالب اول</option>
                                                    <option value="2">قالب دوم</option>
                                                    <option value="3">قالب سوم</option>
                                                    <option value="4">قالب چهارم</option>
                                                </select>
                                            </div>
                                        </div>

                                        <tag-component
                                            :editable="editableTags" callback-function="tag"></tag-component>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p style="font-size: 80%" class="text-danger"
                                               v-show="form.errors.has('template_id')">
                                                @{{ form.errors.get('template_id') }}
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p style="font-size: 80%" class="text-danger"
                                               v-show="form.errors.has('tag')">
                                                @{{ form.errors.get('tag') }}
                                            </p>
                                        </div>
                                    </div>


                                    <textarea id="editor" >
                                        @{{form.content}}
                                    </textarea>

                                    <p style="font-size: 80%" class="text-danger"
                                       v-show="form.errors.has('content')">
                                        @{{ form.errors.get('content') }}
                                    </p>

                                    <div class="form-group row mt-5 mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button {{--:disabled="form.errors.any()"--}} type="submit"
                                                    class="btn btn-primary  btn-rounded waves-effect waves-light m-t-20">
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
        var page = new Vue({

            el: '#app',
            data: {
                form: new Form({
                    id: "",
                    title: "",
                    slug: "",
                    content: "",
                    template_id: "",
                    tag: [],
                    img: "",
                }),
                editableTags:[]
            },
            watch: {
                'form.title': function (nval,val ) {
                    this.form.slug = sanitizeTitle(nval);
                },
            },
            mounted(){
                @isset($pageId)
                    let page_id = {{$pageId}}
                    this.form.id = page_id;
                    axios.get('/admin/pages/'+ this.form.id)
                        .then(response => {
                            let page = response.data.page;
                            console.log(page);
                            this.form.img =  page[0].img;
                            var unwatch =this.$watch('form.title', function (newVal, oldVal) {
                                this.form.slug =page[0].slug;
                            });
                            this.form.title =  page[0].title;
                            this.form.template_id =  page[0].template_id;
                            this.form.tag =page[0].tags.map(data => {
                                return data.name.fa;
                            });
                            this.editableTags = page[0].tags.map(data => {
                                return {'id':data.id,name:data.name.fa } ;
                            });
                            this.form.content = page[0].content;
                            CKEDITOR.instances['editor'].setData(this.form.content);




                        })
                        .catch(function (error) {
                            console.log(error);
                        });


                @endisset

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
                    if (this.form.slug == "") {
                        this.form.slug = sanitizeTitle(this.form.title);
                    }
                    this.form.content = CKEDITOR.instances.editor.getData();
                    this.form.submit('post', '/admin/pages').then(response => {
                            Swal.fire(
                                'ثبت شد!',
                                'اطلاعات به درستی ثبت شد.',
                                'success'
                            );
                            this.changePage();
                        }
                    )
                        .catch(e => {
                            Swal.fire(
                                'ثبت نشد!',
                                'اطلاعات به درستی ثبت نشد.',
                                'warning'
                            )
                        });


                },
                changePage() {
                    window.location.href = '/admin/pages';
                }


            }
        });
        page.$on('tag', function (value) {
            this.form.tag = "";
            this.form.tag = value.map(data => {
                return data.name;
            });

        });
        page.$on('picture', function (value) {
            this.form.img = value[0];

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
