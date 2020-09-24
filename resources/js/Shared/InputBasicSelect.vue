<template>
    <select ref="input" v-model="selected" :class="{ error: errors.length }"
            class="form-select">
        <slot/>
    </select>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        value: [String, Number, Boolean],
        errors: {
            type: String,
            default: ''
        }
    },
    data() {
        return {
            selected: this.value
        };
    },
    watch: {
        selected(selected) {
            this.$emit("input", selected);
        }
    },
    methods: {
        focus() {
            this.$refs.input.focus();
        },
        select() {
            this.$refs.input.select();
        }
    }
};
</script>
