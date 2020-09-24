<template>
    <layout
        :title="'Halaman Penyelenggara - ' + $page.app.name"
        active="creator.exams.index"
        page="Daftar Ujian"
    >
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Ujian
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="grid sm:grid-cols-2 gap-4 justify-items-start">
                    <inertia-link
                        class="px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
                        href="/creator/exams/create"
                    >Buat ujian
                    </inertia-link>
                    <div class="flex items-center border-b border-teal-500 sm:w-64 justify-self-end">
                        <input v-model="form.search"
                               class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
                               maxlength="50" type="text"
                               placeholder="pencarian..."
                               @input="$emit('input', $event.target.value)"/>
                        <icon name="search"/>
                    </div>
                </div>
                <div class="grid gap-4 justify-items-stretch my-3 overflow-x-auto">
                    <table class="table-auto border-collapse border-2 border-gray-300">
                        <thead>
                        <tr class="bg-white border-2 border-gray-300">
                            <th class="w-2/10 py-3">Nama</th>
                            <th class="w-4/10 py-3">Deskripsi</th>
                            <th class="w-1/10 py-3">Status</th>
                            <th class="w-3/10 py-3">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="exam in exams.data" :key="exam.uuid">
                            <td class="align-middle border px-4 py-2">{{ exam.name }}</td>
                            <td class="align-middle overflow-hidden border px-4 py-2">{{ exam.description }}</td>
                            <td class="border px-4 text-center py-2">{{ exam.status }}</td>
                            <td class="align-middle border px-4 py-2">
                                <div class="d-flex">
                                    <inertia-link
                                        :href="'/creator/exams/'+exam.uuid+'/edit'"
                                        class="ml-1 inline-flex items-center justify-center px-2 py-1 border border-transparent rounded-md bg-white hover:bg-gray-300"
                                    >
                                        <icon class="inline" name="pencil"/>
                                        Edit
                                    </inertia-link>
                                    <inertia-link
                                        :href="'/creator/sections/' + exam.uuid"
                                        class="ml-1 inline-flex items-center justify-center px-2 py-1 border border-transparent rounded-md bg-white hover:bg-gray-300"
                                    >
                                        <icon class="inline" name="list-task"/>
                                        Sesi & Soal
                                    </inertia-link>
                                    <button
                                        align-self="end"
                                        class="ml-1 inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md text-white hover:bg-red-500 transition ease-in-out duration-150"
                                        variant="outline-secondary"
                                        @click="confirmingDelete = exam.uuid"
                                    >
                                        <icon class="inline" name="trash"/>
                                        Hapus
                                    </button>
                                    <jet-dialog-modal :show="confirmingDelete === exam.uuid"
                                                      @close="confirmingDelete = false">
                                        <template #title>
                                            Hapus Ujian
                                        </template>

                                        <template #content>
                                            <small class="text-danger">
                                                <strong>Peringatan!</strong> menghapus ujian akan menghapus semua detail
                                                tentang
                                                soal & hasil rekap ujian
                                            </small>
                                        </template>

                                        <template #footer>
                                            <jet-secondary-button @click.native="confirmingDelete = false">
                                                Batalkan
                                            </jet-secondary-button>

                                            <button
                                                :class="{ 'opacity-25': form.processing }"
                                                :disabled="form.processing"
                                                class="ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                                                @click.prevent="deleteExam(exam.uuid)">
                                                Hapus
                                            </button>
                                        </template>
                                    </jet-dialog-modal>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="!exams.meta.total">
                            <td class="text-center py-3" colspan="4">Tidak ada ujian</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <pagination :links="exams.meta.links" />
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "@/Layouts/Creator"
import Icon from "@/Shared/Icon"
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import Pagination from "@/Shared/Pagination";

export default {
    props: {
        exams: Object,
        filters: Object
    },
    components: {
        Layout,
        Icon,
        JetDialogModal,
        JetDangerButton,
        JetSecondaryButton,
        Pagination,
    },
    data() {
        return {
            confirmingDelete: false,
            form: {
                search: this.filters.search
            }
        }
    },
    watch: {
        form: {
            handler: throttle(function () {
                let query = pickBy(this.form)
                const params = new URLSearchParams(Object.keys(query).length ? query : {remember: 'forget'});
                this.$inertia.replace('/creator/exams?' + params.toString())
            }, 150),
            deep: true,
        }
    },
    methods: {
        deleteExam(uuid) {
            this.$inertia.delete('/creator/exams/' + uuid);
        }
    }
};
</script>
