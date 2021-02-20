<template>
    <div v-if="showPagination">
        <ul class="flex pl-0 list-none rounded place-content-center my-2">
            <li v-for="(link, key) in this.links" :key="key" :class="isActive(link)"
                class="border text-sm border-gray-800 dark:border-white block rounded-sm font-bold py-2 px-3 mr-2 flex dark:hover:bg-gray-800 dark:hover:text-white hover:bg-gray-800 hover:text-white">
                <button @click="fetch(link.label)" v-if="link.url" class="page-link">{{ link.label }}</button>
                <button v-else @click.prevent="handleNoLink" class="page-link">{{ link.label }}</button>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Pagination',
    props:[
        'links',
        'method',
        'name',
    ],
    methods: {
        isActive(link) {
            return (link.active === true) ? 'dark:bg-gray-800 dark:text-white dark:border-white bg-gray-800 text-white' : 'dark:border-gray-800 dark:text-black bg-white indigo-500'
        },
        handleNoLink() {
            return false
        },
        fetch(linkLabel) {
            this.$router.push({path: `/${this.name}?page=${linkLabel}`});
            this.method();
        }
    },
    computed: {
        showPagination() {
            return this.links.length > 3
        }
    },
}
</script>
