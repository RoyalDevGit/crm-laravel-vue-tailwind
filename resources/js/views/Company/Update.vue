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
                <div v-if="!this.loading">
                    <div class="mb-10">
                        <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                            <div>
                                <div class="flex block dark:text-white text-gray-900">
                                    <div class="flex rounded mx-2 py-1 pt-1">
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <h3 class="mx-2">Firma Düzenle</h3>
                                    </div>
                                </div>
                                <div>

                                </div>
                            </div>
                            <div class="mt-5">
                                <form v-on:submit.prevent="updateCompany">
                                    <div class="grid lg:grid-cols-3 gap-6">
                                        <div class="col-span-2">
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
                                                        <label for="user_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Kayıt Sahibi</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <input disabled :value="attributes.user.name" id="user_id" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
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
                                                        <label for="company_main_country" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Ana Ülke</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="company_main_country" id="company_main_country" v-model="company.company_main_country">
                                                            <option v-if="country" v-for="item in country" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_main_country"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="company_country" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Ülke</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="company_country" id="company_country" v-model="company.company_country">
                                                            <option v-for="item in country" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_country"/>
                                            </div>
                                        </div>
                                        <div v-if="company.company_country == 1">
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="company_city" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Şehir</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="company_city" id="company_city" v-model="company.company_city">
                                                            <option v-if="city" v-for="item in city" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_city"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t my-6 pt-3">
                                        <div class="grid lg:grid-cols-3 gap-6 my-3">
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
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="tax_number" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Vergi Adresi</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <input id="tax_number" v-model="company.tax_number" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="tax_number"/>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="sector" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Sektör</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <input id="sector" v-model="company.sector" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="sector"/>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="field" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Alan</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <input id="field" v-model="company.field" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="field"/>
                                                </div>
                                            </div>
                                            <div class="col-span-2">
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="company_address" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma Adres</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                    <textarea id="company_address" v-model="company.company_address" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">

                                                    </textarea>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="company_address"/>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="potential_fleet" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Potansiyel Filo</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <input id="potential_fleet" v-model="company.potential_fleet" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="potential_fleet"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t my-6 pt-3">
                                        <div class="grid lg:grid-cols-3 gap-6 my-3">
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="status_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Status</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="status_id" id="status_id" v-model="company.status_id">
                                                                <option v-if="attributes.status" v-for="item in attributes.status" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="status_id"/>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="customer_type_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Müşteri Tipi</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="customer_type_id" id="customer_type_id" v-model="company.customer_type_id">
                                                                <option v-if="attributes.customer_type" v-for="item in attributes.customer_type" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="customer_type_id"/>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="size_code_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Boyut Kodu</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="size_code_id" id="size_code_id" v-model="company.size_code_id">
                                                                <option v-if="attributes.size_code" v-for="item in attributes.size_code" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="customer_type_id"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border-t mt-6 pt-3">
                                        <button type="submit" class="rounded text-sm text-white dark:text-black px-3 py-1 dark:bg-white bg-gray-800 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                            Güncelle
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div v-else>
                    <Spinner/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ValidationErrorHelp from "../../components/ValidationErrorHelp";
import Spinner from "../../components/Spinner";

export default {
    name: "Update",
    data(){
        return {
            loading : false,
            errors: null,
            status : null,
            company : {},
            attributes : {},
            country : {},
            city : {},
        }
    },
    components : {
        ValidationErrorHelp,
        Spinner
    },
    mounted() {
        this.getCountry();
        this.getCity();
        this.getCompany()
    },
    methods : {
        getCompany(){
            this.loading = true;
            axios({
                url : `/company/${this.$route.params.id}`,
                method : 'get',
            }).then(response => {
                this.loading = false;
                this.company = response.data.data
                this.attributes = response.data.attributes
            }).catch(error => {
                console.log(error)
            })
        },
        updateCompany(){
            axios({
                url : `/company/${this.$route.params.id}`,
                method : 'put',
                data : this.company,
            }).then(response => {
                this.company = response.data.data
                this.$notify(
                    { group: response.data.status, title: "Başarılı", text: response.data.message},
                    2000
                );
                //this.$router.go(-1);
            }).catch(error => {
                if(422 === error.response.status){
                    this.errors = error.response.data.errors;
                }
                this.status = error.response.status;
                this.loading = true;
            })
        },
        getCountry(){
            axios({
                url : `/country`,
                method : 'get',
            }).then(response => {
                this.country = response.data
            });
        },
        getCity(){
            axios({
                url : `/city`,
                method : 'get',
            }).then(response => {
                this.city = response.data
            });
        }
    },

}
</script>

<style scoped>

</style>
