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
                       @select="onSelect"
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
        /*    components: {
                /!*      Multiselect: window.VueMultiselect.default*!/
            },*/
        data() {
            return {
                selected: "",
                options: [
                ]
            }
        },
        methods: {
            onSelect(option, id) {
                this.$parent.$emit('category', this.selected);
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

