<template>
    <div>
        <div class="flex-col">
            <div class="mt-20">
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
                                <form v-on:submit.prevent="updateNote">
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
                                                        <input id="title" v-model="update.title"
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
                                                                <textarea id="content" v-model="update.content"
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
                                    </div>
                                    <div class="grid lg:grid-cols-10 gap-6">
                                        <div v-if="update.storage" v-for="item in update.storage" class="dark:bg-gray-700 bg-gray-200 grid grid-cols-3 grid-rows-7 grid-flow-row overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                            <div class="col-span-3 row-span-4 p-1 m-1">
                                                <img
                                                    :src="item.mime == 'application/pdf' ? 'https://img.icons8.com/cotton/2x/file.png' : item.image_url"
                                                    alt="Storage Image"
                                                    class="rounded-t-xl object-cover h-24 w-full"
                                                />
                                            </div>

                                            <div class="col-span-3 row-span-1">
                                                <div class="flex items-center justify-center leading-tight p-2 md:p-4">
                                                    <p class="text-center text-grey-darker text-sm">
                                                        {{ item.mime }}
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-center text-grey-darker text-sm">
                                                        {{ item.file_size }}
                                                    </p>
                                                </div>
                                                <div class="mt-1 p-3">
                                                    <a :href="item.image_url" download class="flex justify-center mt-2 text-sm dark:bg-white bg-gray-800  dark:text-gray-800 text-gray-200 rounded-xl">
                                                        İndir
                                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                        </svg>
                                                    </a>
                                                    <a href="" class="flex justify-center mt-2 text-sm dark:bg-white bg-gray-800  dark:text-gray-800 text-gray-200 rounded-xl">
                                                        Sil
                                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-span-10">
                                            <div class="pt-3">
                                                <button type="submit"
                                                        class="rounded text-sm text-white dark:text-black px-3 py-1 dark:bg-white bg-gray-800 hover:shadow-inner hover:bg-blue-700 transition-all duration-300">
                                                    Güncelle
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import ValidationErrorHelp from "../../components/ValidationErrorHelp";

export default {
    name: "Update",
    components: {
        ValidationErrorHelp,
        vueDropzone: vue2Dropzone
    },
    data() {
        return {
            errors: null,
            status: null,
            loading: false,
            update: {
                title: '',
                content: '',
            }
        }
    },
    mounted() {
        this.getNote()
    },
    methods: {
        updateNote() {
            this.loading = true;
            axios({
                url: `/notes/${this.$route.params.id}`,
                method: 'put',
                data : this.update,
            }).then(result => {
                this.loading = false;
                this.note = result.data.data
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
            axios({
                url: `/notes/${this.$route.params.id}`,
                method: 'get',
            }).then(response => {
                this.loading = false;
                this.update = response.data.data
            }).catch(error => {
                console.log(error)
            })
        }
    },
}
</script>

<style scoped>

</style>
