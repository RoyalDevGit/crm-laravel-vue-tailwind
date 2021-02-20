<template>
    <div>
        <!-- navbar goes here -->
        <nav class="bg-gray-800 dark:bg-gray-700">
            <div class="mx-auto px-8">
                <div class="flex justify-between">
                    <div class="flex space-x-4">
                        <!-- logo -->
                        <div>
                            <router-link :to="{name : 'home' }" class="flex items-center py-5 text-white">
                                <svg class="h-6 w-6 mr-1 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13 7H7v6h6V7z" />
                                    <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-2xl font-bold">CRM</span>
                            </router-link>
                        </div>
                    </div>
                    <!-- primary nav -->
                    <div class="hidden md:flex  items-center space-x-1">
                        <div class="mx-14">
                            <a href="#" class="hover:bg-blue-300 hover:text-black rounded-xl py-3 px-3 text-white">Ana Sayfa</a>
                            <a href="#" class="hover:bg-blue-300 hover:text-black rounded-xl py-3 px-3 text-white">Firmalar</a>
                            <a href="#" class="hover:bg-blue-300 hover:text-black rounded-xl py-3 px-3 text-white">Satış Fırsatları</a>
                            <a href="#" class="hover:bg-blue-300 hover:text-black rounded-xl py-3 px-3 text-white">Projeler</a>
                        </div>
                    </div>

                    <!-- mobile button menu -->
                    <div class="md:hidden flex items-center">
                        <button type="button" @click="setState('setToggle',!toggle)">
                            <svg class="text-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <!-- mobile menu -->
            <div v-if="toggle">
                <a href="#" class="block py-2 px-10 text-sm text-white hover:bg-blue-300">Ana Sayfa</a>
                <a href="#" class="block py-2 px-10 text-sm text-white hover:bg-blue-300">Firmalar</a>
                <a href="#" class="block py-2 px-10 text-sm text-white hover:bg-blue-300">Satış Fırsatları</a>
                <a href="#" class="block py-2 px-10 text-sm text-white hover:bg-blue-300">Projeler</a>
            </div>
        </nav>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "Navbar",
    methods : {
        setState(name,data){
            this.$store.dispatch('changeState', {name, data});
        }
    },
    computed : {
        ...mapGetters({ toggle: "getToggle"}),
    }
}
</script>

<style scoped>

</style>
