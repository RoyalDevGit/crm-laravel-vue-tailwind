<template>
    <div class="flex flex-col space-x-3 min-h-screen">
        <div class="flex-col mb-5">
            <div class="dark:text-gray-400 text-gray-500 font-bold my-3 pl-5">
                <nav class="float-left text-gray-900 dark:text-gray-400 mt-2 text-sm float-left font-bold" aria-label="Breadcrumb">
                    <ol class="list-none p-0 inline-flex">
                        <li class="flex items-center">
                            <router-link :to="{name : 'home'}">Ana Sayfa</router-link>
                            <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
                        </li>
                        <li>
                            <router-link :to="{ name : 'person' }" class="text-gray-500" aria-current="person">Kişiler</router-link>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="flex-col mb-5">
            <div class="my-2 flex sm:flex-row flex-col">
                <div class="flex flex-row mb-1 sm:mb-0">
                    <div class="relative">
                        <select v-model="filtered.paginate" @change="getPerson()"
                                class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                        <div
                            class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>


                <div class="block flex-row relative">
                    <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                        <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                            </path>
                        </svg>
                    </span>
                    <input @change="getPerson()" placeholder="Arama Yap" v-model="filtered.search"
                           class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                </div>

                <button @click="getPerson()"
                        class="lg:ml-2 bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Yenile
                </button>


                <router-link :to="{name : 'person.create'}"
                             class="lg:ml-2 bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
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
            <div v-if="!this.loading">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <div v-if="person.data">
                        <table v-if="person.data" class="min-w-full leading-normal border-2 dark:border-gray-500">
                            <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    ID
                                </th>
                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Adı Soyadı
                                </th>
                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    E-posta
                                </th>
                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-widerr">
                                    Cep Telefonu
                                </th>

                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Mod
                                </th>

                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Durum
                                </th>

                                <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    İşlemler
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in person.data" :key="item.id">
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-800">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 dark:text-white">{{ item.id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                    <p class="text-gray-900 dark:text-white text-sm">{{ `${item.person_first_name} ${item.person_last_name}` }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                    <p class="text-gray-900 dark:text-white text-sm">{{ item.person_email }}</p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                    <p class="text-gray-900 dark:text-white text-sm">{{ item.person_phone }}</p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                    <p class="text-gray-900 dark:text-white text-sm" v-if="item.mod">{{ item.mod.name }}</p>
                                </td>

                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-500">
                                    <label class="flex items-center">
                                        <input  @change="setIsActive(item.id)" :checked="item.is_active == 1" class="relative w-10 h-5 transition-all duration-200 ease-in-out bg-gray-400 rounded-full shadow-inner outline-none appearance-none " type="checkbox" />
                                        <span class="ml-2">{{  item.is_active == 1 ? 'Aktif' : 'Pasif' }}</span>
                                    </label>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-500">
                                    İşlemler
                                    <br>
                                    <router-link :to="{ name : 'person.update',params : {id : item.id } }"
                                                 class="whitespace-no-wrap dark:bg-green-800 dark:text-white dark:hover:bg-white dark:hover:text-gray-800 hover:bg-green-700 text-white bg-green-500 text-sm rounded-xl  font-bold p-1 m-1 inline-flex items-center">
                                    <span>
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </span>
                                    </router-link>

                                    <button type="button" @click="deletePerson(item.id)"
                                            class="whitespace-no-wrap dark:bg-red-800 dark:text-white dark:hover:bg-white dark:hover:text-gray-800 hover:bg-red-700 text-white bg-red-500 text-sm rounded-xl  font-bold p-1 m-1 inline-flex items-center">
                                            <span>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                    </button>

                                </td>
                            </tr>

                            </tbody>
                        </table>
                        <div class="place-content-center">
                            <Pagination :links="person.meta.links" :method="this.getPerson" name="person"/>
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
            <div v-else>
                <div class="flex justify-center items-center">
                    <Spinner/>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import Pagination from "../../components/Pagination";
import AddButton from "../../components/AddButton";
import Spinner from "../../components/Spinner";

export default {
    name: "Index",
    data(){
        return {
            loading : false,
            person : {},
            filtered : {
                search : '',
                paginate : 5,
            }
        }
    },
    components : {
        AddButton,
        Pagination,
        Spinner
    },
    mounted() {
        this.getPerson()
    },
    methods : {
        getPerson(){
            this.loading = true;
            axios.get(`/persons?page=${this.$route.query.page}&filter[personSearch]=${this.filtered.search}&paginate=${this.filtered.paginate}&sort=id`).then(res => {
                this.loading = false;
                this.person = res.data
            })
        },
        deletePerson(id){
            this.loading = true;
            axios.delete(`/persons/${id}`).then(res => {
                this.loading = false;
                this.$notify(
                    { group: res.data.status, title: "Başarılı", text: res.data.message },
                    2000
                );
                this.getPerson();
            });
        },
        setIsActive(id){
            axios({
                url : `/person-active/${id}`,
                method : 'put',
            }).then(response => {
                this.getPerson()
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
        }
    }
}
</script>

<style scoped>
input:before {
    content: '';
    position: absolute;
    width: 1.25rem;
    height: 1.25rem;
    border-radius: 50%;
    top: 0;
    left: 0;
    transform: scale(1.1);
    box-shadow: 0 0.125rem 0.5rem rgba(0, 0, 0, 0.2);
    background-color: white;
    transition: .2s ease-in-out;
}

input:checked {
    @apply: bg-indigo-400;
    background-color:#7f9cf5;
}

input:checked:before {
    left: 1.25rem;
}
</style>
