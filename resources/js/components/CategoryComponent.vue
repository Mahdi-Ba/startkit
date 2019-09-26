<template>

        <div class="col-6">
            <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right">دسته بندی</label>

                   <multiselect
                       :preserve-search="true"
                       :close-on-select="true"
                       placeholder="لطفا یکی از دسته بندی ها را انتخاب نمایید"
                       label="title"
                       track-by="id"
                       v-model="selected"
                       :multiple="false"
                       :searchable="true"  :internal-search="false"
                       @input="onInput"
                       @search-change="asyncFind"
                       :options="options">
                   </multiselect>
            </div>
        </div>

</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: {Multiselect},
        props: {
            'callbackFunction': String,
            'editable':Object,
        },
        mounted() {
            this.selected = this.editable;
            this.callback_function = this.callbackFunction;
        },
        /*    components: {
                /!*      Multiselect: window.VueMultiselect.default*!/
            },*/
        data() {
            return {
                callback_function: "",
                selected: "",
                options: [
                ]
            }
        },
        methods: {
            onInput(value, id) {
                this.$parent.$emit(this.callback_function, value);
            },
            asyncFind(query) {
            axios.get('/admin/select_categories?title='+query)
                    .then(response =>{
                        this.options = response.data
                    });
            },
            clearAll() {
                this.selected = []
            }
        }
    }
</script>

