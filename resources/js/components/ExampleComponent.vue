<template>
    <div>
        <h1>Vue JS MultiSelect Dropdown Example - ItSolutionStuff.com</h1>
        <multiselect
            v-model="selected"
            :multiple="true"
            :options="options">
        </multiselect>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'
    export default {
        components: { Multiselect },
        data () {
            return {
                selected: null,
                options: ['Laravel', 'Laravel 5', 'Vue JS', 'ItSolutionStuff.com', 'HDTuto.com']
            }
        }
    }
</script>

