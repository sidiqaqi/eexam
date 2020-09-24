<template>
    <jet-form-section @submitted="submitConfig">
        <template #title>
            <icon class="inline" name="gear"/>
            Pengaturan
        </template>

        <template #description>
            Pengaturan dasar ujian.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="time-mode" value="Pengaturan waktu *"/>
                <input-basic-select id="time-mode" ref="time-mode" v-model="form.config.time_mode"
                                    autocomplete="time-mode"
                                    class="mt-1 block w-full"
                                    type="text">
                    <option v-for="(value, key) in time_mode" :key="key" :value="key">{{ value }}</option>
                </input-basic-select>
                <jet-input-error :message="$page.errors.name" class="mt-2"/>
            </div>

            <div v-if="parseInt(form.config.time_mode) === 2" class="col-span-6 sm:col-span-4">
                <jet-label for="time_limit" value="Batas waktu *"/>
                <jet-input
                    id="time_limit"
                    v-model="form.config.time_limit"
                    class="mt-1 block w-full"
                    placeholder="Batas waktu (dalam menit)"
                    type="number"
                />
                <jet-input-error :message="$page.errors.time_limit" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="question_order" value="Urutan soal *"/>
                <input-basic-select id="question_order" ref="time-mode" v-model="form.config.question_order"
                                    autocomplete="time-mode"
                                    class="mt-1 block w-full"
                                    type="text">
                    <option v-for="(value, key) in question_order" :key="key" :value="key">{{ value }}</option>
                </input-basic-select>
                <jet-input-error :message="$page.errors.question_order" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="answer_order" value="Urutan Jawaban *"/>
                <input-basic-select id="answer_order" ref="time-mode" v-model="form.config.answer_order"
                                    autocomplete="answer_order"
                                    class="mt-1 block w-full"
                                    type="text">
                    <option v-for="(value, key) in answer_order" :key="key" :value="key">{{ value }}</option>
                </input-basic-select>
                <jet-input-error :message="$page.errors.answer_order" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="ranking_status" value="Tampilkan Ranking *"/>
                <input-basic-select id="ranking_status" ref="time-mode" v-model="form.config.ranking_status"
                                    autocomplete="ranking_status"
                                    class="mt-1 block w-full"
                                    type="text">
                    <option v-for="(value, key) in ranking_status" :key="key" :value="key">{{ value }}</option>
                </input-basic-select>
                <jet-input-error :message="$page.errors.ranking_status" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <jet-label for="result_status" value="Tampilkan Hasil *"/>
                <input-basic-select id="result_status" ref="time-mode" v-model="form.config.result_status"
                                    autocomplete="ranking_status"
                                    class="mt-1 block w-full"
                                    type="text">
                    <option v-for="(value, key) in result_status" :key="key" :value="key">{{ value }}</option>
                </input-basic-select>
                <jet-input-error :message="$page.errors.result_status" class="mt-2"/>
            </div>

        </template>

        <template #actions>
            <jet-action-message :on="form.config.recentlySuccessful" class="mr-3">
                Disimpan.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.config.processing }" :disabled="form.config.processing"
                        type="submit" @click.prevent="submitConfig">
                Simpan
            </jet-button>
        </template>
    </jet-form-section>

</template>

<script>
import Icon from '@/Shared/Icon'
import InputBasicSelect from '@/Shared/InputBasicSelect'
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSectionBorder from '@/Jetstream/SectionBorder'

export default {
    components: {
        Icon,
        InputBasicSelect,
        JetFormSection,
        JetInput,
        JetLabel,
        JetButton,
        JetActionMessage,
        JetInputError,
        JetSectionBorder,
    },
    props: {
        question_order: Object,
        answer_order: Object,
        ranking_status: Object,
        result_status: Object,
        time_mode: Object,
        exam: Object,
        config: Object,
    },
    data() {
        return {
            sending: false,
            form: {
                config: this.$inertia.form({
                    question_order: this.config.question_order,
                    answer_order: this.config.answer_order,
                    time_mode: this.config.time_mode,
                    time_limit: this.config.time_limit,
                    ranking_status: this.config.ranking_status,
                    result_status: this.config.result_status
                }, {
                    bag: 'updateConfig',
                    resetOnSuccess: false,
                }),
            }
        }
    },
    methods: {
        submitConfig() {
            this.sending = true
            this.form.config.put(
                '/creator/configs/' + this.config.uuid, {
                    preserveScroll: true
                }).then(() => (this.sending = false))
        }
    }
}
</script>
