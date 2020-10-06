<template>
    <layout :title="'Menu Peserta Ujian - ' + $page.app.name" active="creator.exams.index">
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Peserta Ujian
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1 mb-4">
                        <div class="px-4 sm:px-0"><h3 class="text-lg font-medium text-gray-900">
                            Menu peserta
                        </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                Berikut daftar aksi yang dapat dilakukan oleh anda sebagai peserta ujian.
                            </p>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md mb-4">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid">
                                    <div class="p-3">
                                        <div class="flex items-center">
                                            <icon name="people" class="w-8 h-8 text-gray-400"/>
                                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                                <inertia-link :href="'/participant/exams/form'">Ikut Ujian</inertia-link>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500">
                                                Mengikuti ujian yang ada dengan memasukan kode ujian yang valid.
                                            </div>
                                            <link-arrow href="/participant/exams/form">Lanjut mengikuti ujian</link-arrow>
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
                                                <inertia-link :href="'/participant/results'">Hasil ujian</inertia-link>
                                            </div>
                                        </div>
                                        <div class="ml-12">
                                            <div class="mt-2 text-sm text-gray-500">
                                                Hasil ujian telah anda ikuti.
                                            </div>
                                            <link-arrow href="/participant/results">Lanjut ke hasil ujian</link-arrow>
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
