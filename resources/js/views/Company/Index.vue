<template>
    <div class="flex flex-col space-x-3 min-h-screen">
        <div class="flex-col">
            <div>
               <h3 class="text-xl font-bold">Firmalar</h3>
            </div>
            <div class="m-1 p-3 dark:text-gray-400 text-gray-500 font-bold my-3 text-right">
                <router-link :to="{name : 'company.create' }"
                             class="bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Yeni
                </router-link>
            </div>
        </div>
        <div class="flex-col">

            <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                <div v-if="company.data">
                    <table v-if="company.data" class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Firma Adı
                            </th>
                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Firma Telefon
                            </th>
                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Firma Kayıt Sahibi
                            </th>
                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                web Sitesi
                            </th>

                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aktif
                            </th>

                            <th class="px-5 py-3 border-b-2 dark:bg-gray-800 dark:border-gray-800 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                İşlemler
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in company.data" :key="item.id">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-800">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-gray-900 dark:text-white">{{ item.id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                <p class="text-gray-900 dark:text-white text-sm">{{ item.company_name }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                <p class="text-gray-900 dark:text-white text-sm">{{ item.company_phone }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                <p class="text-gray-900 dark:text-white text-sm">{{ item.company_author }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                <p class="text-gray-900 dark:text-white text-sm">{{ item.company_web_site }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-500">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight">
                                        <span aria-hidden
                                              :class="item.is_active == 1 ? 'bg-green-200 dark:bg-green-500' : 'bg-red-200 dark:bg-red-400'"
                                              class="absolute inset-0 opacity-50 rounded-full"></span>
                                        <span class="relative">{{ item.is_active == 1 ? 'Aktif' : 'Pasif' }}</span>
                                    </span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-500">
                                İşlemler
                                <router-link :to="{ name : 'company.update',params : {id : item.id } }"
                                             class="whitespace-no-wrap dark:bg-green-800 dark:text-white dark:hover:bg-white dark:hover:text-gray-800 hover:bg-green-700 text-white bg-green-500 text-sm rounded-xl  font-bold p-1 m-1 inline-flex items-center">
                                    <span>
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </span>
                                </router-link>
                                <!--
                                <button @click="deleteCategories(category.id)"
                                        class="whitespace-no-wrap bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                                    <span><i class="fa fa-trash"></i></span>
                                </button>
                                -->
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="place-content-center">
                        <Pagination :links="company.meta.links" :method="this.getCompany" name="company"/>
                    </div>
                </div>
                <div v-else>
                    <div
                        class="dark:bg-gray-800 dark:text-white bg-gray-100 border text-center border-gray-200 text-gray--300 px-4 py-4 rounded relative"
                        role="alert">
                        <strong class="font-bold">Veri Bulunamadı.</strong>
                        <span class="block sm:inline">Aradığınız kriterlere göre bir veri bulunamadı.</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-orange-500" role="button"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Kapat</title><path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                  </span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import AddButton from "../../components/AddButton";
import Pagination from "../../components/Pagination";

export default {
    name: "Index",
    data: function () {
        return {
            company: [],
        }
    },
    components: {
        AddButton,
        Pagination
    },
    mounted() {
        this.getCompany();
    },
    methods: {
        getCompany() {
            axios.get(`/company?page=${this.$route.query.page}`).then(res => {
                this.company = res.data
            });
        }
    }
}
</script>

<style scoped>

</style>
