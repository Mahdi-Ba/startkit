<template>
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
            }
        },
        mounted()
        {
            this.imageTitle = this.imageName;
        },
        methods: {
            onImageChange() {
                this.imageFile = this.$refs.file.files[0];
                this.$parent.$emit('image', this.$data);
            },
        }
    }
</script>

