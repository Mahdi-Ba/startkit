<template>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <a v-show="imageUrl" @click="deleteImg(imageUrl)" class="btn btn-outline-danger" href="#">حذف<i
                    class="ti-trash"></i></a>
                <img v-show="imageUrl" width="100" height="100" :src="'\/'+imageUrl">
                <div class=" files color">
                    <label v-show="!imageUrl" class="text-warning" >هنوز تصویری آپلود نشده است.لطفا عکس را انتخاب کنید </label>
                    <label v-show="imageUrl" class="text-success" >تصویر  با موفقیت آپلود شد </label>
                    <input  @change="onImageChange()" ref="file"   type="file" class="form-control" >
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
<script>


    export default {
        props: {'imageName':String},

        data() {
            return {
                imageTitle:"",
                imageFile:null,
                imageUrl:"",
                status:""
            }
        },
        mounted()
        {
            this.imageTitle = this.imageName;
        },
        methods: {
            onImageChange() {
                let formData = new FormData();
                formData.append('image', this.$refs.file.files[0]);
                formData.append('address', "/files/shares/blog");
                axios.post('/admin/image',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(data =>{
                    this.imageUrl = data.data.path;
                })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
                this.$parent.$emit('image', this.$data);
            },
            deleteImg(imgPath){
                axios.post('/admin/image/deleted' , {img_url:imgPath})
                    .then(response =>{
                        this.imageFile = '';
                        this.imageUrl = '';
                        this.$parent.$emit('image', this.$data);
                    });

            },

        }
    }
</script>

