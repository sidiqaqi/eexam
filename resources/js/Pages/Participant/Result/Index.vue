<template>
  <layout :title="'Hasil Ujian - ' + $page.app.name" active="participant.results.index">
    <template v-slot:header>
      <h3 class="d-inline">
        Hasil Ujian
      </h3>
    </template>
    <div class="row  no-gutters">
    </div>
  </layout>
</template>

<script>
import Layout from "@/Layouts/Participant"

export default {
  components: {
    Layout,
  },
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
