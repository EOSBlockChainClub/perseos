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
            <h1>TradeX</h1>
            <v-data-table
              :headers="headers"
              :items="access"
              hide-actions
              class="elevation-1"
            >
              <template slot="items" slot-scope="props">
                <td>{{ props.item.label }}</td>
                <td class="text-xs-right"><v-switch :name="props.item.attribute" value="full" v-model="props.item.access"></v-switch></td>
                <td class="text-xs-right"><v-switch :name="props.item.attribute" value="view" v-model="props.item.access"></v-switch></td>
                <td class="text-xs-right"><v-switch :name="props.item.attribute" value="none" v-model="props.item.access"></v-switch></td>
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
        { text: 'Attribute',   sortable: false },
        { text: 'Full access', sortable: false },
        { text: 'View access', sortable: false },
        { text: 'No access',   sortable: false }
      ],
      
      access: [
        { attribute: 'firstname',              label: 'Firstname', access: 'full' },
        { attribute: 'lastname',               label: 'Lastname', access: 'full' },
        { attribute: 'email',                  label: 'E-mail', access: 'full' },
        { attribute: 'phoneNumber',            label: 'Phone number', access: 'full' },
        { attribute: 'liveIdPhoto',            label: 'Live ID photo', access: 'view' },
        { attribute: 'govIdNumber',            label: 'Government ID number', access: 'view' },
        { attribute: 'govIdPhoto',             label: 'Government ID photo', access: 'view' },
        { attribute: 'passportIdNumber',       label: 'Passport ID number', access: 'view' },
        { attribute: 'passportIdPhoto',        label: 'Passport ID photo', access: 'view' },
        { attribute: 'drivingLicenceIdNumber', label: 'Driving license ID number', access: 'none' },
        { attribute: 'drivingLicenceIdPhoto',  label: 'Driving license ID photo', access: 'none' },
        { attribute: 'street',                 label: 'Street', access: 'full' },
        { attribute: 'city',                   label: 'City', access: 'full' },
        { attribute: 'proofOfAddress',         label: 'Proof of address', access: 'view' },
        { attribute: 'certifiedIncome',        label: 'Certified income', access: 'view' },
        { attribute: 'country',                label: 'Country', access: 'full' }
      ],

      state: {
        
      }
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
  methods: {
    getState: function(access, check) {
      console.log(access, check)
      return access == check
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
