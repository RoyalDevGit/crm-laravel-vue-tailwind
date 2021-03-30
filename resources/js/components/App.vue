<template class="dark">
    <div>
        <div>
            <div>
                <div class="flex h-screen bg-gray-100 dark:bg-gray-800 font-roboto">
                    <div :class="sideBarOpen ? 'block' : 'hidden'" @click="setState('setSideBarOpen',!sideBarOpen)"
                         class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

                    <div :class="sideBarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
                         class="fixed z-30 inset-y-0 left-0 w-60 transition duration-300 transform bg-white dark:bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
                        <div class="flex items-center justify-center mt-8">
                            <div class="flex items-center">
                                <span class="text-gray-800 dark:text-white text-2xl font-semibold">CRM</span>
                            </div>
                        </div>

                        <Menu/>
                    </div>

                    <div class="flex-1 flex flex-col overflow-hidden">
                        <header class="flex justify-between items-center p-6">
                            <div class="flex items-center space-x-4 lg:space-x-0">
                                <button @click="setState('setSideBarOpen',!sideBarOpen)"
                                        class="text-gray-500 dark:text-gray-300 focus:outline-none lg:hidden">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                              stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div>
                                    <h1 class="text-2xl font-medium text-gray-800 dark:text-white"><!-- Ana Sayfa --></h1>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <button @click="toggleTheme"
                                        class="flex text-gray-600 dark:text-gray-300 focus:outline-none" aria-label="Color Mode">
                                    <svg v-if="theme == 'dark'" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <svg v-if="theme == 'light'" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                </button>
                                <button class="flex text-gray-600 dark:text-gray-300 focus:outline-none">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                        <path
                                            d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <button class="flex text-gray-600 dark:text-gray-300 focus:outline-none">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </button>

                                <div class="relative">
                                    <button @click="setState('setDropDownOpen',!dropDownOpen)"
                                            class="flex items-center space-x-2 relative focus:outline-none">
                                        <h2 class="text-gray-700 dark:text-gray-300 text-sm hidden sm:block"> {{user.name}} </h2>
                                        <img class="h-9 w-9 rounded-full border-2 border-gray-800 object-cover" v-if="user.profile_image"
                                             :src="user.profile_image"
                                             alt="Your avatar">
                                    </button>

                                    <transition enter-class="transition ease-out duration-100 transform" enter-active-class="opacity-0 scale-95" enter-to-class="opacity-100 scale-100" leave-class="transition ease-in duration-75 transform" leave-active-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-95">
                                        <div @click.away="setState('setSideBarOpen',!sideBarOpen)" v-show="dropDownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10">
                                            <router-link :to="{name : 'profile' }"
                                                         class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white dark:text-white dark:bg-white dark:hover:bg-white dark:hover:text-gray-800 dark:bg-gray-800">
                                                Profil
                                            </router-link>
                                            <a href="http://crm-app.test/logout" @click="logout"
                                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-800 hover:text-white dark:text-white dark:bg-white dark:hover:bg-white dark:hover:text-gray-800 dark:bg-gray-800">Çıkış Yap</a>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </header>

                        <notificationGroup group="success">
                            <div
                                class="fixed inset-0 flex px-4 py-6 pointer-events-none p-6 items-start justify-end"
                            >
                                <div class="max-w-sm w-full">
                                    <notification v-slot="{notifications}">
                                        <div
                                            class="flex max-w-sm w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4"
                                            v-for="notification in notifications"
                                            :key="notification.id"
                                        >
                                            <div class="flex justify-center items-center w-12 bg-green-500">
                                                <svg
                                                    class="h-6 w-6 fill-current text-white"
                                                    viewBox="0 0 40 40"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                >
                                                    <path
                                                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"
                                                    />
                                                </svg>
                                            </div>

                                            <div class="-mx-3 py-2 px-4">
                                                <div class="mx-3">
                                                    <span class="text-green-500 font-semibold">{{notification.title}}</span>
                                                    <p class="text-gray-600 text-sm">{{notification.text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </notification>
                                </div>
                            </div>
                        </notificationGroup>
                        <notificationGroup group="error">
                            <div
                                class="fixed inset-0 flex px-4 py-6 pointer-events-none p-6 items-start justify-end"
                            >
                                <div class="max-w-sm w-full">
                                    <notification v-slot="{notifications}">
                                        <div
                                            class="flex max-w-sm w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4"
                                            v-for="notification in notifications"
                                            :key="notification.id"
                                        >
                                            <div class="flex justify-center items-center w-12 bg-red-500">
                                                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 3.36667C10.8167 3.36667 3.3667 10.8167 3.3667 20C3.3667 29.1833 10.8167 36.6333 20 36.6333C29.1834 36.6333 36.6334 29.1833 36.6334 20C36.6334 10.8167 29.1834 3.36667 20 3.36667ZM19.1334 33.3333V22.9H13.3334L21.6667 6.66667V17.1H27.25L19.1334 33.3333Z"/>
                                                </svg>
                                            </div>

                                            <div class="-mx-3 py-2 px-4">
                                                <div class="mx-3">
                                                    <span class="text-red-500 font-semibold">{{notification.title}}</span>
                                                    <p class="text-gray-600 text-sm">{{notification.text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </notification>
                                </div>
                            </div>
                        </notificationGroup>
                        <notificationGroup group="info">
                            <div
                                class="fixed inset-0 flex px-4 py-6 pointer-events-none p-6 items-start justify-end"
                            >
                                <div class="max-w-sm w-full">
                                    <notification v-slot="{notifications}">
                                        <div
                                            class="flex max-w-sm w-full mx-auto bg-white shadow-md rounded-lg overflow-hidden mt-4"
                                            v-for="notification in notifications"
                                            :key="notification.id"
                                        >
                                            <div class="flex justify-center items-center w-12 bg-blue-500">
                                                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                                                </svg>
                                            </div>
                                            <div class="-mx-3 py-2 px-4">
                                                <div class="mx-3">
                                                    <span class="text-blue-500 font-semibold">{{notification.title}}Info</span>
                                                    <p class="text-gray-600 text-sm">{{notification.text}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </notification>
                                </div>
                            </div>
                        </notificationGroup>

                        <main class="overflow-x-auto overflow-y-auto text-gray-500 dark:text-gray-300 bg-white dark:bg-gray-900" >
                            <div class="dark:bg-gray-700 bg-gray-200 ">
                                <div class="container mx-auto px-6 py-8">
                                    <transition name="fade">
                                        <router-view></router-view>
                                    </transition>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import Vue from 'vue'
import Menu from "./Menu";
import {mapGetters} from "vuex"
import Toasted from 'vue-toasted'
import Navbar from "./Navbar"
import Notifications from "vt-notifications"
import moment from 'moment';

Vue.use(Notifications)
Vue.use(Toasted)


Vue.filter('formatDate',function(value){
    if(value){
        return moment(String(value)).locale('tr').startOf('day').fromNow();
    }
});



export default {
    components: {
        Navbar,
        Menu
    },
    beforeMount() {
        this.$store.dispatch("initTheme");
        this.$store.dispatch("actionsUser");
    },
    methods: {
        toggleTheme() {
            this.$store.dispatch("toggleTheme");
        },
        logout(e){
            e.preventDefault()
            axios.post('http://crm-app.test/logout').then(res => this.$router.go()).catch(err => console.log(err))
        },
        setState(name,data){
            this.$store.dispatch('changeState', {name, data});
        }
    },
    computed: {
        ...mapGetters({ theme: "getTheme" }),
        ...mapGetters({ user: "getUser" }),
        ...mapGetters({ sideBarOpen: "getSideBarOpen"}),
        ...mapGetters({ dropDownOpen: "getDropDownOpen"}),
        ...mapGetters({ toggle: "getToggle"}),
    },
    watch: {
        theme(newTheme, oldTheme) {
            newTheme === "light"
                ? document.querySelector("html").classList.remove("dark")
                : document.querySelector("html").classList.add("dark");
        },
    },
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition-property: opacity;
    transition-duration: .25s;
}

.fade-enter-active {
    transition-delay: .25s;
}

.fade-enter, .fade-leave-active {
    opacity: 0
}
</style>
