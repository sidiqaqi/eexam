<template>
  <div>
    <label v-if="label" :for="id">
      {{ label }}
      <span v-if="required" class="text-danger">*</span>
    </label>
    <slot name="prepend"></slot>
    <input
      :id="id"
      v-bind="$attrs"
      :type="type"
      class="form-control"
      :for="id"
      :class="{ 'is-invalid' : errors.length }"
      :placeholder="placeholder"
      :value="value"
      @input="$emit('input', $event.target.value)"
    />
    <slot name="append"></slot>
    <span v-if="errors.length" class="invalid-feedback" role="alert">
      <strong>{{ errors[0] }}</strong>
    </span>
  </div>
</template>


<script>
export default {
  inheritAttrs: false,
  props: {
    id: {
      type: String,
      default() {
        return `text-input-${this._uid}`;
      }
    },
    type: {
      type: String,
      default: "text"
    },
    placeholder: {
      type: String,
      default: ""
    },
    value: {},
    label: {
      type: String,
      default: null
    },
    required: {
      type: Boolean,
      default: false
    },
    errors: {
      type: Array,
      default: () => []
    }
  },
  methods: {
    focus() {
      this.$refs.input.focus();
    },
    select() {
      this.$refs.input.select();
    },
    setSelectionRange(start, end) {
      this.$refs.input.setSelectionRange(start, end);
    }
  }
};
</script>
