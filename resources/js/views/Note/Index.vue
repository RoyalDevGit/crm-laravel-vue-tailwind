<template>
    <div>
        <div class="flex flex-col space-x-3 min-h-screen">
            <div class="flex-col mb-5">
                <div class="dark:text-gray-400 text-gray-500 font-bold my-3 pl-5">
                    <nav class="float-left text-gray-900 dark:text-gray-400 mt-2 text-sm float-left font-bold"
                         aria-label="Breadcrumb">
                        <ol class="list-none p-0 inline-flex">
                            <li class="flex items-center">
                                <router-link :to="{name : 'home'}">Ana Sayfa</router-link>
                                <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 320 512">
                                    <path
                                        d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/>
                                </svg>
                            </li>
                            <li>
                                <router-link :to="{ name : 'note' }" class="text-gray-500" aria-current="note">
                                    Notlar
                                </router-link>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="flex-col mb-5">
                <div class="my-2 flex sm:flex-row flex-col">
                    <div class="flex flex-row mb-1 sm:mb-0">
                        <div class="relative">
                            <select v-model="filtered.paginate" @change="getNote()"
                                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
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
                        <input @change="getNote()" placeholder="Arama Yap" v-model="filtered.search"
                               class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"/>
                    </div>

                    <button @click="getNote()"
                            class="lg:ml-2 bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Yenile
                    </button>

                    <button @click="showCreate = !showCreate"
                            class="lg:ml-2 bg-gray-800 hover:bg-gray-400 hover:text-gray-800 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200 text-white text-sm font-bold py-2 px-4 rounded inline-flex items-center">
                        <svg v-if="!this.showCreate" class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ this.showCreate ? 'Listele' : 'Yeni' }}
                    </button>

                </div>
            </div>


            <div v-if="showCreate" class="flex-col">
                <div class="mt-5">
                    <div class="flex justify-center items-center space-x-3 mt-5">
                        <div class="mb-10 w-full">
                            <div class="mt-5 dark:bg-gray-800 bg-white shadow rounded-lg p-6">
                                <div>
                                    <div class="flex block dark:text-white text-gray-900">
                                        <div class="flex rounded mx-2 py-1 pt-1">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>

                                            <h3 class="mx-2">Yeni Not Ekle</h3>
                                        </div>
                                    </div>
                                    <div>

                                    </div>
                                </div>
                                <div class="mt-5">
                                    <form v-on:submit.prevent="createNote">
                                        <div class="grid lg:grid-cols-3 gap-3">
                                            <div>
                                                <div
                                                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="title"
                                                                   class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Başlık</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <input id="title" v-model="create.title"
                                                                   autocomplete="false" tabindex="0" type="text"
                                                                   class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                        </p>
                                                    </div>

                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1" :status="this.status"
                                                                           :errors="this.errors" field-value="title"/>
                                                </div>
                                            </div>
                                            <div class="col-span-3">
                                                <div
                                                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="content"
                                                                   class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">İçerik</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                                <textarea id="content" v-model="create.content"
                                                                          autocomplete="false" tabindex="0" type="text"
                                                                          class="py-1 px-1 dark:bg-gray-800 bg-white dark:text-white text-gray-900 outline-none block h-full w-full">
                                                                </textarea>

                                                        </p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <validation-error-help class="my-1 mx-1" :status="this.status"
                                                                           :errors="this.errors" field-value="content"/>
                                                </div>
                                            </div>
                                            <div class="col-span-3">
                                                <div
                                                    class="border focus-within:border-blue-500 focus-within:text-blue-500 transition-all duration-500 relative rounded p-1">
                                                    <div class="-mt-4 absolute tracking-wider px-1 uppercase text-xs">
                                                        <p>
                                                            <label for="dropzone"
                                                                   class="bg-white dark:bg-gray-800 dark:text-white text-gray-600 px-1">Dosya
                                                                Yükle (Zorunlu Değil)</label>
                                                        </p>
                                                    </div>
                                                    <div>
                                                        <p>
                                                            <vue-dropzone
                                                                class="bg-white dark:hover:bg-white dark:bg-gray-800 dark:hover:bg-gray-800"
                                                                ref="uploadFile" id="dropzone"
                                                                v-on:vdropzone-success="uploadSuccess"
                                                                :options="dropzoneOptions"></vue-dropzone>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-6 pt-3">
                                                <button type="submit"
                                                        class="rounded text-sm text-white dark:text-black px-3 py-1 dark:bg-white bg-gray-800 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                                    Kaydet
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div v-else class="flex-col">
                <div v-if="!this.loading">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <div v-if="note.data">
                            <table v-if="note.data" class="min-w-full leading-normal border-2 dark:border-gray-500">
                                <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Başlık
                                    </th>
                                    <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Ön izleme
                                    </th>
                                    <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-widerr">
                                        Oluşturan
                                    </th>

                                    <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Oluşturulma Tarihi
                                    </th>

                                    <th class="px-5 py-3 border-b-2 dark:bg-gray-600 dark:border-gray-700 dark:text-white border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        İşlemler
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in note.data" :key="item.id">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                        <p class="text-gray-900 dark:text-white text-sm cut">{{ item.title }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                        <p class="text-gray-900 dark:text-white text-sm cut">{{ item.content }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                        <p v-if="item.user" class="font-semibold text-gray-900 dark:text-white text-sm">
                                            {{ item.user.name }}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white dark:bg-gray-800 dark:border-gray-500">
                                        <p class="text-gray-900 dark:text-white text-sm">{{
                                                item.created_at | formatDate
                                            }}</p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm dark:bg-gray-800 dark:border-gray-500">
                                        <router-link :to="{ name : 'note.update',params : {id : item.id } }"
                                                     class="whitespace-no-wrap dark:bg-green-800 dark:text-white dark:hover:bg-white dark:hover:text-gray-800 hover:bg-green-700 text-white bg-green-500 text-sm rounded-xl  font-bold p-1 m-1 inline-flex items-center">
                                    <span>
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </span>
                                        </router-link>

                                        <button type="button" @click="deleteNote(item.id)"
                                                class="whitespace-no-wrap dark:bg-red-800 dark:text-white dark:hover:bg-white dark:hover:text-gray-800 hover:bg-red-700 text-white bg-red-500 text-sm rounded-xl  font-bold p-1 m-1 inline-flex items-center">
                                            <span>
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                  <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"/>
                                                </svg>
                                            </span>
                                        </button>

                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="place-content-center">
                                <Pagination :links="note.meta.links" :method="this.getNote" name="note"/>
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
    </div>
</template>

<script>

import ClickOutside from 'vue-click-outside'
import Pagination from "../../components/Pagination";
import AddButton from "../../components/AddButton";
import Spinner from "../../components/Spinner";
import ValidationErrorHelp from "../../components/ValidationErrorHelp";
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'

export default {
    name: "Index",
    directives: {
        ClickOutside
    },
    components: {
        AddButton,
        Pagination,
        Spinner,
        ValidationErrorHelp,
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            loading: false,
            create: {
                title: '',
                content: '',
            },
            errors: null,
            status: null,
            note: {},
            attributes: {},
            showCreate: true,
            filtered: {
                search: '',
                paginate: 5,
            },
            dropzoneOptions: {
                url: 'http://crm-app.test/api/upload-image',
                autoProcessQueue: false,
                thumbnailWidth: 150,
                addRemoveLinks: true,
                maxFilesize: 0.5,
                params: {'folderName': 'note'},
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
        }
    },
    mounted() {
        this.getNote()
    },
    methods: {
        uploadSuccess(file, response) {

            console.log(response.data.image_url);
        },
        createNote() {
            axios({
                url: '/notes',
                method: 'post',
                data: this.create
            }).then(result => {

                this.$refs.uploadFile.processQueue()
                this.$notify(
                    {group: result.data.status, title: "Başarılı", text: result.data.message},
                    2000
                );
            }).catch(error => {
                if (422 === error.response.status) {
                    this.loading = false;
                    this.errors = error.response.data.errors;
                }
                this.status = error.response.status;

            })
        },
        getNote() {
            this.loading = true;
            axios.get(`/notes?page=${this.$route.query.page}&filter[noteSearch]=${this.filtered.search}&paginate=${this.filtered.paginate}&sort=id`).then(res => {
                this.loading = false;
                this.note = res.data
            })
        },
        deleteNote(id) {
            this.loading = true;
            axios.delete(`/notes/${id}`).then(res => {
                this.loading = false;
                this.$notify(
                    {group: res.data.status, title: "Başarılı", text: res.data.message},
                    2000
                );
                this.getNote();
            });
        },

    }
}
</script>

<style scoped>
@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

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
    background-color: #7f9cf5;
}

input:checked:before {
    left: 1.25rem;
}

.cut {
    width: 300px;
    overflow: hidden; /* taşanları gizle */
    white-space: nowrap; /* alt satıra hiç inme */
    text-overflow: ellipsis; /* eğer uzunsa üç nokta koy */
}

</style>
