<template>
    <div class="flex flex-col space-x-5 min-h-screen">
        <div class="flex-col">
            <a @click="$router.go(-1)" class="cursor-pointer bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white float-right text-sm font-bold py-1 px-2 rounded inline-flex items-center">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                </svg>
                <span class="m-1">Geri Dön</span>
            </a>
        </div>
        <div v-if="!this.loading" class="flex-col mt-5">
            <div class="flex justify-center h-full w-full items-center space-x-3 mt-5">
                <div class="mb-10 w-full">
                    <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                        <div>
                            <div class="flex block dark:text-white text-gray-900">
                                <div class="flex rounded mx-2 py-1 pt-1">
                                    <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="mx-2">Kişi Güncelle</h3>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <form v-on:submit.prevent="updatePerson">
                                <div class="grid lg:grid-cols-3 gap-6">
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_first_name" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Ad</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_first_name" v-model="person.person_first_name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_first_name"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_last_name" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Soyad</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_last_name" v-model="person.person_last_name" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_last_name"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="companies_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Firma</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <select v-model="person.companies_id" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="companies_id" id="companies_id">
                                                        <option value="" selected>Firma seçiniz</option>
                                                        <option v-if="attributes.company" v-for="item in attributes.company" :value="item.id" :key="item.id">{{ item.company_name }}</option>
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1" :status="this.status" :errors="this.errors" field-value="companies_id"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_gender" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Cinsiyet</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <select class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="person_gender" id="person_gender" v-model="person.person_gender">
                                                        <option value="" selected>Cinsiyet Seçiniz</option>
                                                        <option v-for="item in attributes.gender" :value="item">{{item}}</option>
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_gender"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_title" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Ünvan</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_title" v-model="person.person_title" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_title"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_department" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Bölümü</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_department" v-model="person.person_department" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_department"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_email" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">E-mail</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_email" v-model="person.person_email" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_email"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_phone" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Telefon</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_phone" v-model="person.person_phone" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_phone"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="person_phone2" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Kişi Telefon 2</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="person_phone2" v-model="person.person_phone2" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_phone2"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="preferred_contact" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Tercih Edilen Kontat</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="preferred_contact" v-model="person.preferred_contact" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="preferred_contact"/>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                            <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                <p>
                                                    <label for="skype" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Skype</label>
                                                </p>
                                            </div>
                                            <div>
                                                <p>
                                                    <input id="skype" v-model="person.skype" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                </p>
                                            </div>
                                        </div>
                                        <div>
                                            <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="skype"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-t my-6 pt-3">
                                    <div class="grid lg:grid-cols-3 gap-6 my-3">
                                        <div>
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="person_countries" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Ülke</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select v-if="person.person_countries" v-model="person.person_countries" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="person_countries" id="person_countries">
                                                            <option v-for="item in country" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_countries"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="person_cities" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Şehir</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select @change="this.getDistrict" v-model="person.person_cities" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="person_cities" id="person_cities">
                                                            <option value="">Şehir seçiniz</option>
                                                            <option v-for="item in city" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_cities"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="person_cities" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">İlçe</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select v-model="person.person_district" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="person_district" id="person_district">
                                                            <option value="" selected>Önce ilçe seçiniz</option>
                                                            <option v-for="item in district" :value="item.id" :key="item.id">{{ item.ilce }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="person_district"/>
                                            </div>
                                        </div>
                                        <div class="col-span-3">
                                            <div class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                    <p>
                                                        <label for="address" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Kişi Adres</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                    <textarea id="address" v-model="person.address" autocomplete="false" tabindex="0" type="text" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">

                                                    </textarea>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="address"/>
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
                                                        <label for="mod_id" class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Mod Seçiniz</label>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p>
                                                        <select v-if="person.mod_id" v-model="person.mod_id" class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full" name="mod_id" id="mod_id">
                                                            <option value="" selected>Mod seçiniz</option>
                                                            <option v-if="attributes.mod" v-for="item in attributes.mod" :value="item.id" :key="item.id">{{ item.name }}</option>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                            <div>
                                                <validation-error-help class="my-1 mx-1"  :status="this.status" :errors="this.errors" field-value="mod_id"/>
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
        </div>
        <div v-else>
            <Spinner/>
        </div>
    </div>
</template>

<script>
import ValidationErrorHelp from "../../components/ValidationErrorHelp";
import Spinner from "../../components/Spinner";

export default {
    name: "Update",
    components : {
        ValidationErrorHelp,
        Spinner
    },
    data : function (){
        return {
            loading: false,
            errors: null,
            status : null,
            country : {},
            company : {},
            city : {},
            district : {},
            attributes : {},
            person: {},
        }
    },
    mounted() {
        this.getPerson()
        this.getCountry()
        this.getCity()
    },
    methods : {
        getPerson(){
            this.loading = true;
            axios({
                url : `/persons/${this.$route.params.id}`,
                method : 'get',
            }).then(response => {
                this.loading = false;
                this.person = response.data.data
                this.attributes = response.data.attributes
                this.getDistrict()
            }).catch(error => {
                console.log(error)
            })
        },
        updatePerson(){
            axios({
                url : `/persons/${this.$route.params.id}`,
                method : 'put',
                data : this.person
            }).then(result => {
                this.person = result.data.data
                this.$notify(
                    { group: result.data.status, title: "Başarılı", text: result.data.message},
                    2000
                );
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
        },
        getDistrict(){
            axios({
                url : `district/${this.person.person_cities}`,
                method : 'get',
            }).then(response => {
                this.district = response.data
            })
        }
    }
}
</script>

<style scoped>
input:checked + svg {
    display: block;
}
</style>
