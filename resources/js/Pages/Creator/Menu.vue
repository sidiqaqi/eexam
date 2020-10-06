<template>
    <layout :title="'Menu Penyelenggara Ujian - ' + $page.app.name" active="creator.exams.index">
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Penyelenggara Ujian
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1 mb-4">
                        <div class="px-4 sm:px-0"><h3 class="text-lg font-medium text-gray-900">
                            Menu penyelenggara
                        </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Berikut daftar aksi yang dapat dilakukan oleh anda sebagai penyelenggara ujian.
                            </p>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md mb-4">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid">
                                    <div class="p-3">
                                        <div class="flex items-center">
                                            <svg width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="bi bi-pencil-square w-8 h-8 text-gray-400"><path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path></svg>
                                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                                <inertia-link :href="'/creator/exams/create'">Buat Ujian</inertia-link>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500">
                                                Membuat ujian baru dari awal. Semua pengaturan akan ditetapkan secara default. Anda dapat menggantinya sewaktu-waktu.
                                            </div>
                                            <link-arrow href="/creator/exams/create">Lanjut membuat ujian</link-arrow>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-md mb-4">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid">
                                    <div class="p-3">
                                        <div class="flex items-center">
                                            <icon name="list-task" class="w-8 h-8 text-gray-400"/>
                                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                                <inertia-link :href="'/creator/exams'">Daftar ujian</inertia-link>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500">
                                                Daftar ujian yang telah anda buat. Anda juga dapat melakukan duplikat ujian yang sudah ada untuk memudahkan membuat soal dengan soal-soal yang ada pada ujian sebelumnya.
                                            </div>
                                            <link-arrow href="/creator/exams">Lanjut ke daftar ujian</link-arrow>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shadow overflow-hidden sm:rounded-md mb-4">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid">
                                    <div class="p-3">
                                        <div class="flex items-center">
                                            <icon name="file-check" class="w-8 h-8 text-gray-400"/>
                                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                                <inertia-link :href="'/creator/exams'">Hasil ujian</inertia-link>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500">
                                                Hasil Ujian. Daftar peserta yang telah mengerjakan ujian akan ditampilkan pada halaman ini.
                                            </div>
                                            <link-arrow href="/creator/results">Lanjut ke daftar hasil ujian</link-arrow>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/AppLayout'
import Icon from '@/Shared/Icon'
import LinkArrow from '@/Shared/LinkArrow'

export default {
    components: {
        Layout,
        Icon,
        LinkArrow,
    },
};
</script>
