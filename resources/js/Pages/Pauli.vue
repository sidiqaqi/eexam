<template>
  <layout :title="'Latihan Pauli - ' + $page.app.name" page="Dashboard" active="dashboard">
    <div v-if="!timeLimit">
      <form @submit.prevent="setLimit">
        <div
          id="input-group-1"
          label="Time Limit:"
          label-for="input-1"
          description="Please input in minute time limit for this section"
        >
          <jet-input
            id="input-1"
            v-model="form.number"
            type="number"
            required
            placeholder="Enter time limit in minute"
          ></jet-input>
        </div>

        <jet-button type="submit" variant="primary">Start</jet-button>
      </form>
    </div>
    <div v-if="timeLimit && !done">
      <vue-countdown :time="timeLimit" tag="p" @end="calculate">
        <template
          slot-scope="props"
        >Time Remaining：{{ props.minutes }} minutes, {{ props.seconds }} seconds.</template>
      </vue-countdown>
      <div class="mt-3" header="Form Data Result">
        <div class="row" v-if="!done">
          <div class="col-3">
            <h1>{{ questions.a }}</h1>
            <h1>{{ questions.b }}</h1>
          </div>
          <div class="col-3">
            <label>Last answer: {{ lastAnswer }}</label>
            <input
              class="form-input rounded-md shadow-sm"
              ref="inputForm"
              v-model="inputKey"
              type="number"
              @input="answerKey"
            />
          </div>
          <div class="row col-3">
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(1)" variant="outline-secondary">1</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(2)" variant="outline-secondary">2</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(3)" variant="outline-secondary">3</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(4)" variant="outline-secondary">4</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(5)" variant="outline-secondary">5</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(6)" variant="outline-secondary">6</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(7)" variant="outline-secondary">7</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(8)" variant="outline-secondary">8</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(9)" variant="outline-secondary">9</button>
            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150" type="button" @click.prevent="answer(0)" variant="outline-secondary">0</button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="done" class="mt-3" header="Form Data Result">
      <div class="row">
        <div class="col-12">
          <h1>In {{ form.number }} minute(s) total : {{ totalScore }}</h1>
          <h1 class="text-success">correct : {{ score.correct }}</h1>
          <h1 class="text-danger">false : {{ score.false }}</h1>
          <jet-button type="button" @click="restart" variant="primary">Try Again</jet-button>
        </div>
      </div>
    </div>
  </layout>
</template>

<script>
import Form from "./../Jetstream/FormSection"
import JetInput from "./../Jetstream/Input"
import Layout from "./../Layouts/Exam";
import VueCountdown from "@chenfengyuan/vue-countdown";
import JetButton from "../Jetstream/Button";

export default {
  components: {
    JetInput,
    Form,
    VueCountdown,
    Layout,
    JetButton
  },
  computed: {
    totalScore() {
      return this.score.correct + this.score.false;
    }
  },
  data() {
    return {
      form: {
        number: null
      },
      timeLimit: null,
      questions: {
        a: 0,
        b: 0
      },
      score: {
        correct: 0,
        false: 0
      },
      correct: 0,
      inputKey: null,
      done: 0,
      lastAnswer: null
    };
  },
  methods: {
    setLimit: function() {
      this.timeLimit = parseInt(this.form.number) * 60 * 1000;
      this.randomQuestion();
    },
    randomQuestion: function() {
      this.questions.a = Math.floor(Math.random() * 10);
      this.questions.b = Math.floor(Math.random() * 10);
      this.correct = this.questions.a + this.questions.b;
      this.correct = +this.correct
        .toString()
        .split("")
        .pop();

      this.$nextTick(() => this.$refs.inputForm.focus());
    },
    answer(answer) {
      if (answer == this.correct) {
        this.score.correct++;
      } else {
        this.score.false++;
      }
      this.randomQuestion();
    },
    answerKey() {
      if (this.inputKey == this.correct) {
        this.score.correct++;
      } else {
        this.score.false++;
      }
      this.lastAnswer = this.inputKey;
      this.inputKey = null;
      this.randomQuestion();
    },
    calculate() {
      this.done = 1;
    },
    restart() {
      this.timeLimit = null;
      this.score = {
        correct: 0,
        false: 0
      };
      this.done = 0;
    }
  }
};
</script>
