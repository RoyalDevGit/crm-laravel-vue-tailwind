<template>
    <div class="flex justify-between space-x-3 min-h-screen">
        <div>
            <div class="m-16">
                <div class="flex block dark:text-white text-gray-900">
                    <div class="flex rounded mx-2 py-1 pt-1">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <h3 class="mx-2">Kullanıcı Bilgileri</h3>
                    </div>
                </div>
                <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                    <form v-on:submit.prevent="updateUser">
                        <div class="grid lg:grid-cols-3 gap-6">
                            <div>
                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                        <p>
                                            <label for="name" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Ad Soyad</label>
                                        </p>
                                    </div>
                                    <p>
                                        <input id="name" v-model="user.name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                    </p>
                                </div>
                            </div>
                            <div>
                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="name"/>
                            </div>
                        </div>
                        <div class="border-t mt-6 pt-3">
                            <button type="submit" class="rounded text-sm text-white dark:text-black px-3 py-1 dark:bg-white bg-gray-800 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                Kaydet
                            </button>
                        </div>
                    </form>

                </div>

                <div class="flex block dark:text-white text-gray-900 mt-3">
                    <div class="flex rounded mx-2 py-1 pt-1 mt-5php ">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        <h3 class="mx-2">Şifre Değiştir</h3>
                    </div>
                </div>
                <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                    <form v-on:submit.prevent="updateForm">
                        <div class="grid lg:grid-cols-3 gap-6">
                            <div>
                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                        <p>
                                            <label for="old_password" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Eski şifre</label>
                                        </p>
                                    </div>
                                    <div>
                                        <p>
                                            <input id="old_password" v-model="password.old_password" autocomplete="false" tabindex="0" type="password" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="old_password"/>
                                </div>
                            </div>
                            <div>
                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                        <p>
                                            <label for="new_password" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Yeni şifre</label>
                                        </p>
                                    </div>
                                    <p>
                                        <input id="new_password" v-model="password.new_password" autocomplete="false" tabindex="0" type="password" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                    </p>
                                </div>
                                <div>
                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="new_password"/>
                                </div>
                            </div>
                            <div>
                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                        <p>
                                            <label for="new_password_confirmation" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Yeni şifre tekrar</label>
                                        </p>
                                    </div>
                                    <p>
                                        <input id="new_password_confirmation" v-model="password.new_password_confirmation" autocomplete="false" tabindex="0" type="password" class="py-1 px-1 dark:bg-gray-800 dark:text-white bg-white  text-gray-900 outline-none block h-full w-full">
                                    </p>
                                </div>
                                <div>
                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="new_password_confirmation"/>
                                </div>
                            </div>
                        </div>
                        <div class="border-t mt-6 pt-3">
                            <button type="submit" class="rounded text-sm text-white dark:text-black px-3 py-1 dark:bg-white bg-gray-800 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                Kaydet
                            </button>
                        </div>
                    </form>
                </div>


            </div>


        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import ValidationErrorHelp from "../components/ValidationErrorHelp";
import Toasted from 'vue-toasted';


export default {
    name: "Profile",
    components: {ValidationErrorHelp},
    computed : {
        ...mapGetters({ user: "getUser" }),
    },
    data(){
        return {
            errors: null,
            status : null,
            password : {
                old_password : '',
                new_password : '',
                new_password_confirmation : '',
            },
        }
    },
    methods : {
        updateForm : function(){
            axios({
                url: `/password-reset`,
                method: "PUT",
                data: this.password,
            }).then(res => {
                this.$notify(
                    { group: res.data.status, title: "Başarılı", text: res.data.message},
                    2000
                );
            }).catch(error => {
                if(422 === error.response.status){
                    this.errors = error.response.data.errors;
                }
                this.status = error.response.status;
                this.loading = true;
            });
        },
        updateUser : function (){
            axios({
                url: `/profile-update`,
                method: "PUT",
                data: this.user,
            }).then(res => {
                this.$notify(
                    { group: res.data.status, title: "Başarılı", text: res.data.message},
                    2000
                );
            })
        }
    },
}
</script>

<style scoped>

</style>
