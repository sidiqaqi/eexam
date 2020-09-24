<template>
    <textarea ref="input" :value="value" @input="$emit('input', $event.target.value)"></textarea>
</template>

<script>
export default {
    inheritAttrs: false,
    props: {
        value: String,
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
