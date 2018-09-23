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
    <v-layout column fill-height>
      <v-toolbar light height="88">
        <v-toolbar-side-icon></v-toolbar-side-icon>
        <v-toolbar-title class="logo">
          <v-img src="/images/perseos_logo_horizontal.png" />
        </v-toolbar-title>
      </v-toolbar>
      <v-layout column fill-height>
        <v-flex xs12 class="white">
          <div class="pa-3">
            <h1>Last activity</h1>
            <v-data-table
              :headers="headers"
              :items="log"
              hide-actions
              class="elevation-1"
            >
              <template slot="items" slot-scope="props">
                <td>{{ props.item.timestamp }}</td>
                <td>{{ props.item.service }}</td>
                <td>{{ props.item.attribute }}</td>
                <td>{{ props.item.action }}</td>
              </template>
            </v-data-table>
          </div>
        </v-flex>
      </v-layout>
    </v-layout>
  </v-layout>
</template>


<script>
import axios from 'axios'
import Querystring from 'querystring'

export default {
  data: function() {
    return {
      items: [
        { title: 'Dashboard', icon: 'dashboard', name: 'home' },
        { title: 'Manage data', icon: 'fingerprint', name: 'manageData' },
        { title: 'Activity', icon: 'history', name: 'activity' },
        { title: 'Services', icon: 'store', name: 'services' }
      ],

      headers: [
        { text: 'Timestamp',   sortable: false },
        { text: 'Service', sortable: false },
        { text: 'Attribute', sortable: false },
        { text: 'Action',   sortable: false }
      ],
      
      log: [
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'Name', action: 'Access changed to "Full"' },
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'E-mail', action: 'Access changed to "Full"' },
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'Address', action: 'Access changed to "Full"' },
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'Phone number', action: 'Access changed to "Full"' },
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'Government ID', action: 'Access changed to "View"' },
        { timestamp: '2018/23/09', service: 'TradeX', attribute: 'Government ID', action: 'Viewed by service operator' }
      ]
    }
  },
  computed: {
    user: function() {
      return this.$store.getters.getUser
    },
    initial: function() {
      return this.$store.getters.getUser.email.substring(0, 1).toUpperCase()
    }
  }
}
</script>

<style scoped>
h1 {
  color: #7A589E;
}
.grow0 {
  flex-grow: 0
}
.logo {
  width: 153px;
  height: 60px;
}
.text-center {
  text-align: center;
}
</style>
