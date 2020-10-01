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
                                            <inertia-link :href="'/participant/exams/form'">
                                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                                    <div>
                                                        Lanjut mengikuti ujian
                                                    </div>
                                                    <div class="ml-1 text-indigo-500">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </div>
                                                </div>
                                            </inertia-link>
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
                                            <inertia-link :href="'/participant/results'">
                                                <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                                    <div>Lanjut ke hasil ujian</div>
                                                    <div class="ml-1 text-indigo-500">
                                                        <svg viewBox="0 0 20 20" fill="currentColor" class="arrow-right w-4 h-4"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                    </div>
                                                </div>
                                            </inertia-link>
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
import Layout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";

export default {
    components: {
        Layout,
        Icon,
    },
};
</script>
