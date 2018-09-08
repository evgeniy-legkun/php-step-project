<template>
  <div class="hello">
    <LinksBlock>
      <router-link :to="{ name: 'Authorisation'}">
        Authorisation
      </router-link>
      <router-link :to="{ name: 'Registration'}" style="margin-left: 50px">
        Registration
      </router-link>
    </LinksBlock>
  </div>
</template>

<script>
    import styled from 'vue-styled-components';

    const LinksBlock = styled('div')`
      margin-top: 100px
    `;

    export default {
        name: 'HelloWorld',

        components: {
            LinksBlock
        },

        data () {
          return {
            msg: 'Welcome to Your Vue.js App',

              title: 'Simple TODO List'
          }
        }
  }
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

h1, h2 {
  font-weight: normal;
}
</style>
