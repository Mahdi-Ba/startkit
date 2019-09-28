@extends('admin.layouts.app')
@section('sidebar_title','مقالات')
@section('header')
    <link rel="stylesheet" type="text/css"
          href="/admin_template/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" type="text/css" href="/admin_template/assets/libs/ckeditor/samples/css/samples.css">
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">


    <script src="https://unpkg.com/vue-multiselect@2.1.0"></script>
    <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">

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

                                    <image-component :editable="[form.img]"
                                                     {{-- multiple--}} callback-function="picture"></image-component>
                                    <p style="font-size: 80%" class="text-danger" v-show="form.errors.has('img')">
                                        @{{ form.errors.get('img') }}
                                    </p>
                                    <div class="row">
                                        <category-component
                                           :editable="editableCategory" callback-function="category"></category-component>

                                        <tag-component
                                            :editable="editableTags" callback-function="tag"></tag-component>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p style="font-size: 80%" class="text-danger"
                                               v-show="form.errors.has('category_id')">
                                                @{{ form.errors.get('category_id') }}
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
                                                    class="btn btn-primary">
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
        var blog = new Vue({

            el: '#app',
            data: {
                form: new Form({
                    id: "",
                    title: "",
                    slug: "",
                    content: "",
                    category_id: "",
                    tag: [],
                    img: "",
                    updating:"false"
                }),
                editableCategory:{},
                editableTags:[]
            },
            watch: {
                'form.title': function (nval,val ) {
                    this.form.slug = sanitizeTitle(nval);
                },
            },
            mounted(){
                if("{{$blogId}}")
                {
                    let blog_id = {{$blogId}}
                    this.form.id = blog_id
                    axios.get('/admin/blogs/'+ this.form.id)
                        .then(response => {
                            let post = response.data.post;
                            this.form.img =  post[0].img;
                            this.form.title =  post[0].title;
                            this.form.category_id =  post[0].category_id;
                            this.form.tag =post[0].tags.map(data => {
                                return data.name.fa;
                            });
                            this.editableCategory = {id:post[0].category.id,title:post[0].category.title};
                            this.editableTags = post[0].tags.map(data => {
                                return {'id':data.id,name:data.name.fa } ;
                            });
                            this.form.content = post[0].content;
                            CKEDITOR.instances['editor'].setData(this.form.content);




                        })
                        .catch(function (error) {
                            // handle error
                            console.log(error);
                        })

                } else{
                    console.log("insert new post")
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
                    if (this.form.slug == "") {
                        this.form.slug = sanitizeTitle(this.form.name);
                    }
                    this.form.content = CKEDITOR.instances.editor.getData();
                    this.form.submit('post', '/admin/blogs').then(response => {
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
                    window.location.href = '/admin/blogs';
                }


            }
        });
        blog.$on('category', function (value) {
            this.form.category_id = value.id;
        });
        blog.$on('tag', function (value) {
            console.log(value);
            this.form.tag = "";
            this.form.tag = value.map(data => {
                return data.name;
            });

        });
        blog.$on('picture', function (value) {
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
