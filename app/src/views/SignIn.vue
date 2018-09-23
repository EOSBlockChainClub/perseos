<template>
  <v-container fluid>
    <v-layout row justify-center>
      <v-flex xs1>
        <img src="/images/perseos_logo.png" class="logo" />
      </v-flex>
    </v-layout>
    <v-layout row justify-center>
      <v-flex xs10 sm5>
        <v-card>
          <v-card-text>
            <h2>Sing in to access your securely stored personal data</h2>
            <form>
              <v-text-field v-model="email" required label="E-mail" />
              <v-text-field v-model="password" type="password" required label="Password" />
              <div class="text-xs-right">
                <v-btn color="#7A589E" class="white--text" @click="signIn()">SIGN IN</v-btn>
                <v-btn flat @click="$router.push({name: 'signUp'})">SIGN UP</v-btn>
              </div>
            </form>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
    <v-snackbar v-model="snackbar" color="error" top>
      {{ error }}
      <v-btn dark flat @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-container>
</template>

<script>
import axios from 'axios'
import Querystring from 'querystring'

export default {
  data: function() {
    return {
      email: '',
      password: '',
      error: '',
      snackbar: false
    }
  },
  methods: {
    signIn: function() {
      axios.post(`http://perseos.ja/perseos/signIn`, Querystring.stringify({
        email: this.$data.email,
        password: this.$data.password
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then((response) => {
        if(response.data.status == 'success') {
          this.$store.dispatch('setUser', response.data.user)
          this.$router.push({name: 'home'})
        }
        else {
          this.error = response.data.error;
          this.snackbar = true
        }
      })
      .catch(e => {
        this.error = response.data.error;
        this.snackbar = true
      })
    }
  }
}
</script>


<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.logo {
  max-width: 100%;
  margin-bottom: 2rem;
  width: auto;
  height: auto;
}
</style>
