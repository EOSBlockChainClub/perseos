<template>
  <v-layout fill-height>
    <v-layout fill-height class="grow0">
      <v-card class="d-inline-block elevation-12">
        <v-navigation-drawer permanent >
          <v-toolbar flat color="#7A589E" class="pb-3 pt-2">
            <v-list>
              <v-list-tile avatar>
                <v-list-tile-avatar color="white">
                  <span class="primary--text headline">{{ initial }}</span>
                </v-list-tile-avatar>
                <v-list-tile-content class="white--text">
                  {{ user.email }}
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-toolbar>

          <v-divider></v-divider>

          <v-list dense class="pt-0">
            <v-list-tile v-for="item in items" :key="item.title" @click="$router.push({name: item.name})">
              <v-list-tile-action>
                <v-icon>{{ item.icon }}</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>{{ item.title }}</v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>
          </v-list>
        </v-navigation-drawer>
      </v-card>
    </v-layout>
    <v-layout column>
      <v-toolbar light height="88">
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title class="logo">
          <v-img src="/images/perseos_logo_horizontal.png" />
        </v-toolbar-title>
      </v-toolbar>
      <div class="pa-5">
        <v-layout row>
          <v-flex>
            <v-card class="link-card" to="manageData">
              <v-card-title class="pink-bg">Manage data</v-card-title>
              <v-card-text>
                <p>Competently envisioneer revolutionary platforms whereas focused channels. Interactively exploit resource sucking systems and covalent functionalities.</p>
              </v-card-text>
            </v-card>
          </v-flex>
          <v-flex class="px-5">
            <v-card class="link-card" to="activity">
              <v-card-title class="pink-bg">Activity</v-card-title>
              <v-card-text>
                <p>Competently envisioneer revolutionary platforms whereas focused channels. Interactively exploit resource sucking systems and covalent functionalities.</p>
              </v-card-text>
            </v-card>
          </v-flex>
          <v-flex>
            <v-card class="link-card" to="services">
              <v-card-title class="pink-bg">Services</v-card-title>
              <v-card-text>
                <p>Competently envisioneer revolutionary platforms whereas focused channels. Interactively exploit resource sucking systems and covalent functionalities.</p>
              </v-card-text>
            </v-card>
          </v-flex>
        </v-layout>
      </div>
    </v-layout>
  </v-layout>
</template>

<script>
export default {
  data: function() {
    return {
      items: [
        { title: 'Dashboard', icon: 'dashboard', name: 'home' },
        { title: 'Manage data', icon: 'fingerprint', name: 'manageData' },
        { title: 'Activity', icon: 'history', name: 'activity' },
        { title: 'Services', icon: 'store', name: 'services' }
      ],
    }
  },
  computed: {
    user: function() {
      return this.$store.getters.getUser
    },
    initial: function() {
      return this.$store.getters.getUser.email.substring(0, 1).toUpperCase()
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
.grow0 {
  flex-grow: 0;
  flex-shrink: 0;
}
.logo {
  width: 153px;
  height: 60px;
}
.pink-bg {
  background: #7A589E;
  color: #fff;
  font-size: 1.3rem;
  padding-top: 2rem;
}
.link-card {
  cursor: pointer;
}
</style>
