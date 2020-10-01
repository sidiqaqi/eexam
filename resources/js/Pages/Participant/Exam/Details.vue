<template>
    <layout :title="'Detail Ujian - ' + $page.app.name" active="participant.exams.form">
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Details Ujian
            </h2>
        </template>

        <div>
            <error-message :message="$page.errors.join"/>
            <div class="grid max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 justify-items-center">
                <div class="grid w-full md:w-4/5 sm:w-full xs:w-full rounded bg-white justify-items-center p-5">
                    <div class="mb-5">
                        <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ exam.data.name }}</h1>
                        <p>oleh: {{ creator }}</p>
                    </div>
                    <div class="mb-5">
                        <p>{{ exam.data.description }}</p>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            Pengaturan Ujian:
                            <ul style="list-style: disc">
                                <li>Waktu pengerjaan: <strong>{{ config.data.time_mode_text }} <span
                                    v-if="config.data.time_mode === 2">({{ config.data.time_limit }})</span></strong></li>
                                <li>Urutan Pertanyaan : <strong>{{ config.data.question_order }}</strong></li>
                                <li>Urutan jawaban : <strong>{{ config.data.answer_order }}</strong></li>
                                <li>Menampilakan Hasil : <strong>{{ config.data.result_status }}</strong></li>
                                <li>Menampilakan Ranking : <strong>{{ config.data.ranking_status }}</strong></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-5">
                        <jet-button @click.native="join">Mulai Ujian</jet-button>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "@/Layouts/Exam";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import ErrorMessage from "@/Shared/ErrorMessages";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        Layout,
        JetInput,
        JetLabel,
        ErrorMessage,
        JetButton,
    },
    props: {
        creator: String,
        exam: Object,
        config: Object,
    },
    data() {
        return {
            showError: false
        }
    },
    watch: {
        "$page.errors.join": {
            handler() {
                this.showError = true;
            },
            deep: true
        }
    },
    methods: {
        join() {
            this.$inertia.post('/participant/exams/join/' + this.exam.data.uuid);
        }
    }
};
</script>
