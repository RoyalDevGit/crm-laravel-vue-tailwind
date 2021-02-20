<template>
    <div class="flex flex-col space-x-5 min-h-screen">
        <div class="flex-col">
            <a @click="$router.go(-1)" class="cursor-pointer bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white float-right text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                <span class="m-1">Geri Dön</span>
            </a>
        </div>
        <div class="flex-col mt-5">
            <div class="flex justify-center items-center space-x-3 mt-5">
                <div>
                    <div class="mb-10">
                        <div class="flex block dark:text-white text-gray-900">
                            <div class="flex rounded mx-2 py-1 pt-1">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>

                                <h3 class="mx-2">Yeni Firma Ekle</h3>
                            </div>
                        </div>
                        <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                            <form v-on:submit.prevent="createCompany">
                                <div class="grid lg:grid-cols-2 gap-6">
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="company_name" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Adı</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="company_name" v-model="company.company_name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_name"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="company_phone" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Telefon</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="company_phone" v-model="company.company_phone" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_phone"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="company_author" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Yetkilisi</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="company_author" v-model="company.company_author" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_author"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="company_web_site" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Web Sitesi</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="company_web_site" v-model="company.company_web_site" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_web_site"/>
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
        </div>
    </div>
</template>

<script>
import ValidationErrorHelp from "../../components/ValidationErrorHelp";

export default {
    name: "Create",
    components : {
        ValidationErrorHelp,
    },
    data : function (){
        return {
            errors: null,
            status : null,
            company : {
                'company_name' : '',
                'company_phone' : '',
                'company_author' : '',
                'company_web_site' : '',
                'is_active' : '',
            },
        }
    },
    methods : {
        createCompany(){
            axios({
                url : '/company',
                method : 'post',
                data : this.company
            }).then(result => {
                this.$notify(
                    { group: result.data.status, title: "Başarılı", text: result.data.message},
                    2000
                );
                this.$router.go(-1);
            }).catch(error => {
                if(422 === error.response.status){
                    this.errors = error.response.data.errors;
                }
                this.status = error.response.status;
                this.loading = true;
            })
        }
    }
}
</script>

<style scoped>

</style>
