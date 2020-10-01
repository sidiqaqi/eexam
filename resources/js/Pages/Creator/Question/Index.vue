<template>
    <layout :title="'Edit Pertanyaan - ' + $page.app.name" active="creator.exams.index">
        <template v-slot:header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <inertia-link :href="'/creator/exams'" type="submit">Daftar Ujian</inertia-link>
                /
                <inertia-link :href="'/creator/exams/' + exam.uuid + '/edit'" type="submit">{{
                        exam.name
                    }}
                </inertia-link>
                /
                <inertia-link :href="'/creator/sections/' + exam.uuid" type="submit">Daftar Sesi
                </inertia-link>
                /
                {{ section.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="row no-gutters">

                    <jet-form-section @submitted="false">
                        <template #title>
                            Daftar Sesi
                        </template>

                        <template #description>
                            Manajemen Sesi. Anda bisa mengubah urutan sesi dengan cara drag sesi yang anda inginkan.
                        </template>

                        <template #form>

                            <div class="grid col-span-8 sm:col-span-8">
                                <draggable
                                    class="mb-1"
                                    v-model="list_question"
                                    v-bind="dragOptions"
                                    group="soal"
                                    @change="updateOrder"
                                    @end="drag=false"
                                    @start="drag=true"
                                >
                                    <transition-group name="flip-list" type="transition">
                                        <div v-for="question in list_question"
                                             :key="question.uuid" class="max-w-sm w-full lg:max-w-full lg:flex my-2"
                                             no-body>
                                            <div
                                                class="max-w w-full border border-gray-400 lg:border-gray-400 bg-white rounded-b rounded p-4 hover:bg-gray-50 cursor-pointer lg:flex">
                                                <div class="w-full">
                                                    <div class=" w-full grid sm:grid-cols-2 gap-4 justify-items-start">
                                                        <div class="text-gray-900 font-semibold text-lg leading-6 mb-2">
                                                            <icon name="three-dots-v" class="inline" /> {{ question.title }}
                                                        </div>
                                                        <div class="justify-self-end">
                                                            <inertia-link
                                                                :href="'/creator/questions/' + question.uuid + '/edit'"
                                                                align-self="end"
                                                                class="ml-2 inline-flex items-center justify-center px-2 py-1 m-1 border border-transparent rounded-md hover:bg-gray-300"
                                                            >
                                                                <icon class="inline" name="pencil"/>
                                                                Edit
                                                            </inertia-link>
                                                            <button class="ml-2 inline-flex items-center justify-center px-2 py-1 bg-red-600 border border-transparent rounded-md text-white hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                                                                    @click.prevent="confirmingDelete = question.uuid">
                                                                <icon class="inline" name="trash"/>
                                                                Hapus
                                                            </button>
                                                        </div>
                                                        <jet-dialog-modal :show="confirmingDelete === question.uuid"
                                                                          @close="confirmingDelete = false">
                                                            <template #title>
                                                                Hapus Ujian
                                                            </template>

                                                            <template #content>
                                                                <small class="text-danger">
                                                                    Hapus pertanyaan
                                                                    <strong>{{ question.title }}</strong>?
                                                                </small>
                                                            </template>

                                                            <template #footer>
                                                                <jet-secondary-button
                                                                    @click.native="confirmingDelete = false">
                                                                    Batalkan
                                                                </jet-secondary-button>

                                                                <button
                                                                    :class="{ 'opacity-25': form.processing }"
                                                                    :disabled="form.processing"
                                                                    class="ml-2 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150"
                                                                    @click.prevent="deletQuestion(question.uuid)">
                                                                    Hapus
                                                                </button>
                                                            </template>
                                                        </jet-dialog-modal>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </transition-group>
                                </draggable>

                                <div class="max-w-sm w-full lg:max-w-full lg:flex" no-body>
                                    <div class="flex mb-2 w-full">
                                        <inertia-link
                                            :href="'/creator/questions/' + section.uuid + '/create'"
                                            class="w-full bg-gray-50 border border-gray-400 lg:border-gray-400 bg-white rounded-b rounded p-4 lg:flex text-gray-900 font-semibold text-lg mb-2 hover:bg-gray-100 cursor-pointer"
                                        >
                                            <icon class="inline" name="plus"/>
                                            Tambah Soal baru
                                        </inertia-link>
                                    </div>
                                </div>
                            </div>


                        </template>

                    </jet-form-section>

                </div>

            </div>
        </div>
    </layout>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import Icon from "@/Shared/Icon";
import Draggable from "vuedraggable";
import JetFormSection from "@/Jetstream/FormSection";
import JetButton from "@/Jetstream/Button";
import JetDialogModal from '@/Jetstream/DialogModal'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'

export default {
    components: {
        Layout,
        Icon,
        Draggable,
        JetFormSection,
        JetButton,
        JetDialogModal,
        JetDangerButton,
        JetSecondaryButton
    },
    props: {
        exam: Object,
        questions: Array,
        section: Object
    },
    mounted() {
        this.list_question = this.questions;
    },
    computed: {
        dragOptions() {
            return {
                animation: 0,
                group: "description",
                disabled: false,
                ghostClass: "ghost"
            };
        }
    },
    data() {
        return {
            confirmingDelete: false,
            form: this.$inertia.form({}, {bag: 'deleteSection'}),
            list_question: [],
            sending: false,
            show: null
        };
    },
    methods: {
        deletQuestion(uuid) {
            this.$inertia.delete('/creator/questions/' + uuid);
        },
        updateOrder(e) {
            if (e.moved) {
                this.$inertia.post('/creator/questions/' + e.moved.element.uuid + '/order', {
                        from: e.moved.oldIndex + 1,
                        to: e.moved.newIndex + 1
                    }
                );
            }
        }
    }
};
</script>

<style scoped>
.section-title {
    cursor: pointer;
}

.flip-list-move {
    transition: transform 0.5s;
}

.no-move {
    transition: transform 0s;
}

.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
</style>>
