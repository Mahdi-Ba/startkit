<template>

        <div class="col-6">
            <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right">تگ ها</label>

                <multiselect v-model="selected"  label="name" track-by="id"
                             placeholder="Type to search"  :options="options" :multiple="true"
                             @input="onInput"
                             :searchable="true" :internal-search="false" :clear-on-select="false"
                             :close-on-select="false" :options-limit="300" :limit="4" :limit-text="limitText"
                             :show-no-results="false" :hide-selected="true"
                             @search-change="asyncFind">
                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
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
            'editable':Array,
        },
        mounted() {
            this.callback_function = this.callbackFunction;
        },
        watch: {
            editable(newVal, oldVal) { // watch it
                this.selected = newVal;
            }
        },
        /*    components: {
                /!*      Multiselect: window.VueMultiselect.default*!/
            },*/
        data() {
            return {
                callback_function: "",
                selected: [],
                options: [],
            }
        },
        methods: {
            onInput(value, id) {
                this.$parent.$emit(this.callback_function, value);
            },
            limitText(count) {
                return `  و${count} تعداد باقی تگ های انتخاب شده`
            },
            asyncFind(query) {
                axios.get('/admin/select_tags?title=' + query)
                    .then(response => {
                        this.options = response.data.map(data => {
                            return {id:data.id,name:data.name.fa}
                        });
                    });

            },
            clearAll() {
                this.selected = []
            }
        }
    }
</script>

