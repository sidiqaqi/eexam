<template>
    <layout :title="'Ikuti Ujian - ' + $page.app.name" active="participant.exams.form">
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ikuti Ujian
            </h2>
        </template>

        <div>
            <div class="grid max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 justify-items-center">

                <form @submit.prevent="details" class="grid w-4/5 md:w-4/5 sm:w-full rounded bg-white justify-items-center">
                    <div class="row">
                        <div class="py-5">
                            <div class="grid p-5">
                                <p>Untuk mengikuti ujian anda harus memasukan Kode ujian yang valid.</p>
                            </div>
                            <div class="grid grid-cols-2 px-5">
                                <jet-input
                                    id="exam_code"
                                    v-model="form.code"
                                    :required="true"
                                    placeholder="contoh: Ab2345Cz12"/>
                                <jet-button class="ml-5" @click.native type="submit">Cari Ujian</jet-button>
                                <jet-input-error :message="$page.errors.code" class="mt-2"/>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>

    </layout>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetButton from "@/Jetstream/Button";

export default {
    components: {
        Layout,
        JetInput,
        JetLabel,
        JetInputError,
        JetButton,
    },
    data() {
        return {
            sending: false,
            form: {
                code: null
            }
        };
    },
    methods: {
        details() {
            this.$inertia.post('/participant/exams/details', this.form);
        }
    }
};
</script>
