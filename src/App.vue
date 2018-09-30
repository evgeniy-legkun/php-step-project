<template>
  <div id="app">
    <!-- Modals -->
    <Modal v-model="showModal" title="Registration">
      You have registered successfully
    </Modal>

    <h1>{{ currentTitle }}</h1>
    <FormSelect
        v-model="selectedLocale"
        :options="options"
        class="form-select"
        @change="changeLocalization"
    />
    <!--<img src="./assets/logo.png">-->
    <router-view></router-view>
  </div>
</template>

<script>
  import FormSelect from 'bootstrap-vue/es/components/form-select/form-select';
  import Modal from 'bootstrap-vue/es/components/modal/modal';
  import { EventBus } from './EventBus';

  export default {
    name: 'App',

    components: {
      FormSelect,
      Modal
    },

    computed: {
      currentTitle: function () {
        return this.$t("index.title");
      }
    },

    created () {
      EventBus.$on('open-modal', (userId = 0) => {
        this.showModal = true;
      });
    },

    beforeDestroy () {
      EventBus.$off('open-modal');
    },

    data () {
      return {
        title: this.$t("index.title"),

        showModal: false,

        selectedLocale: this.$locale,

        options: [
          { value: 'ru', text: 'Russian' },
          { value: 'en', text: 'English' }
        ]
      };
    },

    methods: {
      changeLocalization (localValue) {
        this.$locale = localValue;
      }
    }
  };
</script>

<style>
  #app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  .form-select {
    width: 10%;
    margin-top: 1rem;
    margin-bottom: 1rem;
  }
</style>
