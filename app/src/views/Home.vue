<template>
  <v-container fluid>
    <v-slide-y-transition mode="out-in">
      <v-layout column align-center>
        <h1 class="text-xs-center">SecureID</h1>
        <v-flex xs12 class="text-xs-center">
          <v-btn to="CreateAccount" color="info">Create account</v-btn>
        </v-flex>
      </v-layout>
    </v-slide-y-transition>
  </v-container>
</template>

<script>
export default {
  data: function() {
    return {
      info: ''
    }
  },
  mounted() {
    if(!this.$store.getters.isUser) {
      this.$router.push({name: 'signIn'});
    }
  }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1, h2 {
  font-weight: normal;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #42b983;
}
</style>
