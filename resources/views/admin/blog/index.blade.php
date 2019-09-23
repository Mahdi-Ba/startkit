@extends('admin.layouts.app')
@section('sidebar_title','مقالات')
@section('header')
    <link rel="stylesheet" type="text/css"
          href="/admin_template/assets/libs/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">
    <link rel="stylesheet" type="text/css" href="/admin_template/assets/libs/ckeditor/samples/css/samples.css">
    <link href="/admin_template//assets/libs/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
        <style>

        .files input {

            outline: 2px dashed #92b0b3;
            outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear;
            padding: 100px 100px 100px 35%;
            text-align: center !important;
            margin: 0;
            width: 100% !important;

        }
        .files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
            -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
            transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
        }
        .files{ position:relative}
        .files:after {  pointer-events: none;
            position: absolute;
            top: 60px;
            left: 0;
            width: 50px;
            right: 0;
            height: 56px;
            content: "";
            background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
            display: block;
            margin: 0 auto;
            background-size: 100%;
            background-repeat: no-repeat;
        }
        .color input{ background-color:#f1f1f1;}
        .files:before {
            position: absolute;
            bottom: 10px;
            left: 0;  pointer-events: none;
            width: 100%;
            right: 0;
            height: 57px;
            content: " عکس را بکشید و رها کنید ";
            display: block;
            margin: 0 auto;
            color: #2ea591;
            font-weight: 600;
            text-transform: capitalize;
            text-align: center;
        }
    </style>

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
                                                <label for="slug" class="col-md-4 col-form-label text-md-right">slug</label>

                                                <div class="col-md-8">
                                                    <input id="slug" type="text" class="form-control " name="slug"  v-bind:class="getClass(form.errors.has('slug'))"
                                                           autocomplete="slug" v-model="form.slug" autofocus>
                                                    <div class="invalid-feedback " v-show="form.errors.has('slug')">
                                                        <strong>@{{ form.errors.get('slug') }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <div class=" files color">
                                                    <label>عکس را انتخاب کنید </label>
                                                    <input  @change="onImageChange()" ref="file"   type="file" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <example-component></example-component>
                                    <multiselect
                                        v-model="value"
                                        :options="options"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :hide-selected="true"
                                        :preserve-search="true"
                                        placeholder="Pick some"
                                        label="name"
                                        track-by="name"
                                        :preselect-first="true"
                                        id="example"
                                        @select="onSelect"
                                    >
                                    </multiselect>



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
            components: {
                Multiselect: window.VueMultiselect.default
            },
            el: '#app',
            data: {
                form: new Form({
                    content: "",
                    title: "",
                    slug: "",
                    page:"",
                    image:"",
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }),
                value: '',
                options: [
                    { name: 'Vue.js', language: 'JavaScript' },
                    { name: 'Rails', language: 'Ruby' },
                    { name: 'Sinatra', language: 'Ruby' },
                    { name: 'Laravel', language: 'PHP', $isDisabled: true }
                ]

            },
            watch:{
                'form.title':function (val,nval)
                {
                    this.form.slug = this.sanitizeTitle(nval);
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
                        this.form.slug = this.sanitizeTitle(this.form.name);
                    }
                    let formData = new FormData();
                    formData.append('image', this.$refs.file.files[0]);
                    formData.append('slug', this.form.slug);
                    formData.append('title', this.form.title);

                    axios.post('/admin/blog',
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }
                    ).then(function(data){
                        console.log(data.data);
                    })
                        .catch(function(){
                            console.log('FAILURE!!');
                        });
          /*          if(this.form.slug == "")
                    {
                        this.form.slug = this.sanitizeTitle(this.form.name);
                    }
                    this.form.content = CKEDITOR.instances.editor.getData();
                    this.form.submit('post', '/admin/blog')
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
                        ));*/
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
                    this.form.image = this.$refs.file.files[0];
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
