<template>
    <layout :title="'Hasil Ujian - ' + $page.app.name" active="participant.results.index">
        <template v-slot:header>
            <h3 class="d-inline">
                Hasil Ujian
            </h3>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                            <div class="mt-2 text-2xl">
                                Ujian: {{ report.exam.name }}
                            </div>
                            <div class="mt-3 text-gray-500">
                                <div class="mb-2">oleh: <b>{{ report.exam.creator }}</b></div>
                                <p>
                                    {{ report.exam.description }}
                                </p>
                            </div>
                        </div>
                        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-3">
                            <div class="p-6">
                                <div class="flex items-center">
                                    <icon name="file-check" class="w-8 h-8 text-gray-400" />
                                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                        Hasil
                                    </div>
                                </div>
                                <div class="ml-12">
                                    <div class="mt-2 text-sm text-gray-500">
                                        <div v-if="report.config.result_status == 1 || report.config.result_status == 2">
                                            <strong>{{ report.result }}</strong>
                                        </div>
                                        <div v-if="report.config.result_status == 3">
                                            <p> Tidak ditampilkan </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                                <div class="flex items-center">
                                    <icon name="file-check" class="w-8 h-8 text-gray-400" />
                                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                        Rekapitulasi
                                    </div>
                                </div>
                                <div class="ml-12">
                                    <div class="mt-2 text-sm text-gray-500">
                                        <div v-if="report.config.result_status == 1">
                                            <ul class="ml-5" style="list-style: circle">
                                                <li v-for="(section, key) in report.section" :key="key">
                                                    <p>Sesi: {{ section.name }}</p>
                                                    <p>Skor: <b>{{ section.score }}</b></p>
                                                    <p v-if="section.passing_grade">Skor: {{ section.passing_grade }}</p>
                                                </li>
                                            </ul>
                                            <div v-if="report.passing_grade">Passing Grade : {{ report.passing_grade }}</div>
                                            <div v-if="report.total_score">Total Skor: <b>{{ report.total_score }} </b></div>
                                        </div>
                                        <div v-else>
                                            <p> Tidak ditampilkan </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
                                <div class="flex items-center">
                                    <icon name="graph-up" class="w-8 h-8 text-gray-400" />
                                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                                        Ranking
                                    </div>
                                </div>
                                <div class="ml-12">
                                    <div class="mt-2 text-sm text-gray-500">
                                        <div v-if="report.config.ranking_status == 1">
                                            <p> Rank : {{ report.rank }} dari {{ report.rank_from }} Peserta</p>
                                        </div>
                                        <div v-if="report.config.ranking_status == 2">
                                            <p> {{ report.config.ranking_status_verb }} </p>
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
import Layout from "@/Layouts/AppLayout"
import Icon from "@/Shared/Icon";

export default {
    components: {
        Layout,
        Icon
    },

    props: [
        'report'
    ],
    data() {
        return {
            form : {
                code : null
            }
        }
    },
    methods: {
        join() {
            this.$inertia.post(this.$route("participant.exams.join", this.form))
        },
    }
};
</script>
