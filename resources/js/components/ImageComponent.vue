<template>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <p v-show="!imageUrl" class="text-warning">هنوز تصویری آپلود نشده است.لطفا عکس را انتخاب
                    کنید </p>
                <div v-for="(img , index) in imageUrl">
                    <a v-show="img" @click="deleteImg(img,index)" class="btn btn-outline-danger " href="#">حذف<i
                        class="ti-trash"></i></a>
                    <img v-show="img" width="100" height="100" :src="'\/'+img">
                    <label v-show="img" class="text-success">تصویر با موفقیت آپلود شد </label>
                </div>
                <div class=" files color">
                    <input :multiple="multiple_data" @change="onImageChange()" ref="file" type="file" class="form-control">
                </div>


            </div>
        </div>
    </div>
</template>
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

    .files input:focus {
        outline: 2px dashed #92b0b3;
        outline-offset: -10px;
        -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
        transition: outline-offset .15s ease-in-out, background-color .15s linear;
        border: 1px solid #92b0b3;
    }

    .files {
        position: relative
    }

    .files:after {
        pointer-events: none;
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

    .color input {
        background-color: #f1f1f1;
    }

    .files:before {
        position: absolute;
        bottom: 10px;
        left: 0;
        pointer-events: none;
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
<script>


    export default {
        props: {
            'editable':Array,
            'callbackFunction': String,
            'multiple': String,
        },

        data() {
            return {
                callback_function: "",
                imageFile: null,
                imageUrl: [],
                multiple_data: '',
                status: ""
            }
        },
        watch: {
            editable(newVal, oldVal) { // watch it
                this.imageUrl = newVal;
            }
        },
        mounted() {
            this.callback_function = this.callbackFunction;
            this.multiple_data = this.multiple;
        },
        methods: {
            onImageChange() {
                let formData = new FormData();
                let i = 0;
                let images = [];
                while (i < this.$refs.file.files.length) {
                    images.push(this.$refs.file.files[i]);
                    i += 1;
                }
                for (let i = 0; i < images.length; i++) {
                    formData.append('images[]', images[i]);
                }

                formData.append('address', "/files/shares/blog");

                axios.post('/admin/image',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                        }
                    }
                ).then(data => {

                    this.pushMethod(data.data)


                })
                    .catch(function () {
                        console.log('FAILURE!!');
                    });

            },
            pushMethod(data)
            {
                this.imageUrl=data.concat(this.imageUrl);
                this.$parent.$emit(this.callback_function, this.imageUrl);
            },
            deleteImg(imgPath, index) {
                axios.post('/admin/image/deleted', {img_url: imgPath})
                    .then(response => {
                        this.imageFile = '';
                        this.imageUrl.splice(index, 1);
                        this.$parent.$emit(this.callback_function, this.imageUrl);
                    });

            },

        }
    }
</script>

