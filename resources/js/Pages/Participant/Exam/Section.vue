<template>
    <layout :title="'Proses Ujian - ' + $page.app.name" active="participant.exams.form">
        <b-card class="col-auto mb-2" v-if="section">
            <h4>{{ section.name }}</h4>
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
            <div class="row justify-content-center pt-5">
                <inertia-link :href="$route('participant.exams.process', {'participant' : participant.uuid, 'answer' : answer.uuid})"
                              class="btn btn-outline-secondary col-md-4 col-sm-8 col-8"
                              type="submit">Mulai
                </inertia-link>
            </div>
        </b-card>
    </layout>
</template>

<script>
import Layout from '@/Layouts/Exam'
import InputText from '@/Shared/InputText'
import ButtonLoading from '@/Shared/ButtonLoading'
import VueMarkdown from 'vue-markdown'

export default {
    components: {
        Layout,
        InputText,
        ButtonLoading,
        VueMarkdown
    },
    props: {
        answer: Object,
        answers: Array,
        config: Object,
        exam: Object,
        section: Object,
        participant: Object,
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
                code: null
            }
        }
    },
    methods: {
        alpha (key) {
            return String.fromCharCode('A'.charCodeAt() + key)
        },
        details () {
            this.$inertia.post(
                this.$route('participant.exams.details.post'),
                this.form
            )
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
</style>>
