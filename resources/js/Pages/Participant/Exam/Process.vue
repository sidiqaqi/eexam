<template>
    <layout :title="'Proses Ujian - ' + $page.app.name" active="participant.exams.form">
        <div class="row">
            <div class="col-md-9">
                <p>{{ exam.data.name }} - {{ section.name }}
                    <button class="btn p-0" title="instruksi" v-b-modal="'instruction-' + section.uuid"><icon name="question" /></button>
                </p>
                <b-modal :id="'instruction-' + section.uuid" hide-backdrop :title="section.name">
                    <b class="mb-3">Instruksi:</b>
                    <vue-markdown
                        :breaks="markdown.breaks"
                        :emoji="markdown.emoji"
                        :html="markdown.html"
                        :linkify="markdown.linkify"
                        :show="markdown.show"
                        :source="section.instruction"
                        :toc="markdown.toc"
                        :typographer="markdown.typographer"
                        :watches="['markdown.show','markdown.html','markdown.breaks','markdown.linkify','markdown.emoji','markdown.typographer','markdown.toc']"
                        class="result-html full-height"
                        toc-id="toc"
                    ></vue-markdown>
                    <template v-slot:modal-footer>
                        <div class="w-100">
                            <b-button
                                variant="outline-secondary"
                                size="sm"
                                class="float-right mr-1"
                                @click="$bvModal.hide('instruction-' + section.uuid)"
                            >Tutup</b-button>
                        </div>
                    </template>
                </b-modal>

            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <b> Pertanyaan. {{ questionNumber }} </b>
                <b-card class="col-auto mb-2 mt-3" v-if="question">
                    <vue-markdown
                        :breaks="markdown.breaks"
                        :emoji="markdown.emoji"
                        :html="markdown.html"
                        :linkify="markdown.linkify"
                        :show="markdown.show"
                        :source="question.value"
                        :toc="markdown.toc"
                        :typographer="markdown.typographer"
                        :watches="['markdown.show','markdown.html','markdown.breaks','markdown.linkify','markdown.emoji','markdown.typographer','markdown.toc']"
                        class="result-html full-height"
                        toc-id="toc"
                    ></vue-markdown>
                    <div class="mb-3" v-if="question.type == 2">
                        <img :src="question.image" @error="imgError" alt="preview" class="img-fluid border"/>
                    </div>
                </b-card>
                <label :key="key" class="col-12" v-for="(option, key) in options.data">
                    <b-card>
                        <input :value="option.uuid" name="answer" v-model="form.option" type="radio"/>
                        <span>{{ alpha(key) }}.</span>
                        <img
                            :src="option.image"
                            @error="imgError"
                            alt="preview"
                            class="img-fluid border"
                            v-if="option.type == 2"
                        />
                        <span v-else>{{ option.value }}</span>
                    </b-card>
                </label>
                <div class="row pt-5">
                    <div class="col-12">
                        <button v-if="questionNumber === 1" class="btn btn-outline-secondary float-left" @click="prev">kembali</button>
                        <button class="btn btn-outline-secondary float-right" @click="saveNext">Simpan dan Lanjut</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">
                <b> Indeks: </b>
                </div>
                <div class="row mt-3">
                <inertia-link
                    :href="'/participant/exams/process/' + participant.data.uuid + '/' + answer.uuid"
                    class="btn col-md-4 col-sm-8 col-8 btn-sharp" v-bind:class="{ 'btn-outline-secondary' : isActiveAnswer(answer.uuid) , 'text-success' : answer.filled }"
                    type="submit"
                    :key="answer.uuid"
                    v-for="(answer, index) in answers.data">{{ index + 1 }}
                </inertia-link>
                </div>
            </div>
        </div>
    </layout>
</template>

<script>
import Layout from '@/Layouts/Exam'
import InputText from '@/Shared/InputText'
import Icon from '@/Shared/Icon'
import ButtonLoading from '@/Shared/ButtonLoading'
import VueMarkdown from 'vue-markdown'

export default {
    components: {
        Icon,
        Layout,
        InputText,
        ButtonLoading,
        VueMarkdown
    },
    props: {
        answer: Object,
        answers: Object,
        config: Object,
        exam: Object,
        options: Object,
        participant: Object,
        question: Object,
        section: Object,
        navigation: Object,
    },
    mounted () {
        this.form.option = this.answer.data.option_uuid
    },

    updated () {
        this.form.option = this.answer.data.option_uuid
    },

    computed: {
        questionNumber: function () {
            let number = 0
            let answer = this.answer.data
            this.answers.data.forEach(function (value, index,) {
                if (value.uuid === answer.uuid) {
                    number = index + 1
                }
            })
            return number
        },
    },
    data () {
        return {
            markdown: {
                show: true,
                html: false,
                breaks: true,
                linkify: false,
                emoji: true,
                typographer: true,
                toc: false
            },
            sending: false,
            form: {
                option: this.answer.data.option_uuid
            }
        }
    },
    methods: {
        isActiveAnswer(answerUUID) {
            return answerUUID === this.answer.data.uuid
        },
        alpha (key) {
            return String.fromCharCode('A'.charCodeAt() + key)
        },
        prev() {
            this.$inertia.post('/participant/exams/previous/' + this.participant.data.uuid + '/' + this.answer.data.uuid)
        },
        saveNext () {
            this.$inertia.post('/participant/exams/submit/' + this.participant.data.uuid + '/' + this.answer.data.uuid + '/' + this.form.option)
        }
    }
}
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

.btn-sharp {
    border-radius: 0 !important;
}
</style>>
