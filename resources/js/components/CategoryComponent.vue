<template>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right">دسته بندی</label>

                <!--   <multiselect
                       :preserve-search="true"
                       :close-on-select="true"
                       placeholder="لطفا یکی از دسته بندی ها را انتخاب نمایید"
                       label="name"
                       track-by="key"
                       v-model="selected"
                       :multiple="true"
                       :loading="isLoading"
                       @select="onSelect"
                       :options="options">
                   </multiselect>-->
          <multiselect v-model="selected" id="ajax" label="name" track-by="key"
                             placeholder="Type to search" open-direction="bottom" :options="options" :multiple="true"
                       @select="onSelect"
                             :searchable="true"  :internal-search="false" :clear-on-select="false"
                             :close-on-select="false" :options-limit="300" :limit="4" :limit-text="limitText"
                              :show-no-results="false" :hide-selected="true"
                             @search-change="asyncFind">
               <!--     <template slot="tag" slot-scope="{ option, remove }"><span class="custom__tag"><span>{{ option.name }}</span><span
                        class="custom__remove" @click="remove(option)">❌</span></span></template>
                    <template slot="clear" slot-scope="props">
                        <div class="multiselect__clear" v-if="selected.length"
                             @mousedown.prevent.stop="clearAll(props.search)"></div>
                    </template>-->
                    <span slot="noResult">Oops! No elements found. Consider changing the search query.</span>
                </multiselect>
            </div>
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
                    {key: 1, name: 'JavaScript'},
                    {key: 2, name: 'Ruby'},
                    {key: 3, name: 'Ruby'},
                    {key: 4, name: 'dsw'},
                    {key: 4, name: 'dsw'},
                    {key: 4, name: 'dsw'},

                ]
            }
        },
        methods: {
            onSelect(option, id) {
                this.$parent.$emit('category', this.selected);
            },
            limitText(count) {
                return `  و${count} تعداد باقی تگ های انتخاب شده`
            },
            asyncFind(query) {
                this.options = [   {key: 10, name: 'test11'},
                    {key: 11, name: 'test12'},];
            },
            clearAll() {
                this.selected = []
            }
        }
    }
</script>

