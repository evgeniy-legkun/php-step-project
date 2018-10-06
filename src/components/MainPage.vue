<template>
  <div class="hello">
    {{ localDate }}
    <LinksBlock>
      <router-link :to="{ name: 'Authorisation'}">
        {{ $t("index.authorisation") }}
      </router-link>
      <router-link :to="{ name: 'Registration'}" style="margin-left: 50px">
        {{ $t("index.registration") }}
      </router-link>
    </LinksBlock>
  </div>
</template>

<script>
  import styled from 'vue-styled-components';
  import { mapState  } from 'vuex';

  const LinksBlock = styled('div')`
      margin-top: 100px
    `;

  export default {
    name: 'HelloWorld',

    components: {
      LinksBlock
    },

    computed: {
      ...mapState({
        localDate: state => {
          return state.now.format('hh:mm:ss');
        }
      })
    },

    data () {
      return {
        msg: 'Welcome to Your Vue.js App',

        title: 'Simple TODO List'
      };
    }
  };
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  h1, h2 {
    font-weight: normal;
  }
</style>
