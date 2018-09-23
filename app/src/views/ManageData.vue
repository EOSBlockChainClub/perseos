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
      <v-layout column fill-height>
        <v-flex xs12 class="white">
          <div class="pa-3">
            <v-stepper v-model="step" vertical non-linear class="elevation-0">
              <v-stepper-step :complete="step > 1" step="1" editable>Your name</v-stepper-step>
              <v-stepper-content step="1">
                <v-text-field v-model="firstname" label="Firstname" required />
                <v-text-field v-model="lastname" label="Lastname" required />
              </v-stepper-content>

              <v-stepper-step :complete="step > 2" step="2" editable>Your e-mail</v-stepper-step>
              <v-stepper-content step="2">
                <v-text-field type="email" v-model="email" label="E-mail" required />
              </v-stepper-content>
              
              <v-stepper-step :complete="step > 3" step="3" editable>Your phone number</v-stepper-step>
              <v-stepper-content step="3">
                <v-text-field v-model="phoneNumber" label="Phone number" required />
              </v-stepper-content>

              <v-stepper-step :complete="step > 4" step="4" editable>Live ID photo</v-stepper-step>
              <v-stepper-content step="4">
                <v-layout row>
                  <v-flex sm7>
                    <v-text-field v-model="liveIdPhoto" label="Live ID photo" required box />
                  </v-flex>
                  <v-flex sm1>
                    <v-btn depressed>Select</v-btn>
                  </v-flex>
                  <v-flex sm2>
                    <v-dialog v-model="dialog" width="672">
                      <v-btn slot="activator" depressed @click="this.initMediaStream"><v-icon left>camera</v-icon> Take picture</v-btn> 
                      <v-card>
                        <v-card-title class="headline grey lighten-2" primary-title>Take picture</v-card-title>
                        <v-card-text>
                          <video id="streem" width="640" height="480" autoplay></video>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="primary" flat @click="this.takePicture">Take</v-btn>
                        </v-card-actions>
                      </v-card>
                    </v-dialog>
                  </v-flex>
                  <v-flex sm2 id="preview">
                    <canvas id="previewImage"></canvas>
                  </v-flex>
                </v-layout>            
              </v-stepper-content>
              
              <v-stepper-step :complete="step > 5" step="5" editable>Government ID number</v-stepper-step>
              <v-stepper-content step="5">
                <v-text-field v-model="govIdNumber" label="Government ID number" required></v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 6" step="6" editable>Government ID photo</v-stepper-step>
              <v-stepper-content step="6">
                <v-text-field v-model="govIdPhoto" label="Government ID photo" required>
                  <v-btn slot="append-outer">Select</v-btn>
                </v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 7" step="7" editable>Passport ID number</v-stepper-step>
              <v-stepper-content step="7">
                <v-text-field v-model="passportIdNumber" label="Passport ID number" required />
              </v-stepper-content>

              <v-stepper-step :complete="step > 8" step="8" editable>Passport ID photo</v-stepper-step>
              <v-stepper-content step="8">
                <v-text-field v-model="passportIdPhoto" label="Passport ID photo" required>
                  <v-btn slot="append-outer">Select</v-btn>
                </v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 9" step="9" editable>Driving Licence ID number</v-stepper-step>
              <v-stepper-content step="9">
                <v-text-field v-model="drivingLicenceIdNumber" label="Driving Licence ID number" required />
              </v-stepper-content>

              <v-stepper-step :complete="step > 10" step="10" editable>Driving Licence ID photo</v-stepper-step>
              <v-stepper-content step="10">
                <v-text-field v-model="drivingLicenceIdPhoto" label="Driving Licence ID photo" required>
                  <v-btn slot="append-outer">Select</v-btn>
                </v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 11" step="11" editable>Your address</v-stepper-step>
              <v-stepper-content step="11">
                <v-text-field v-model="street" label="street" required />
                <v-text-field v-model="city" label="city" required />
              </v-stepper-content>

              <v-stepper-step :complete="step > 12" step="12" editable>Proof of address</v-stepper-step>
              <v-stepper-content step="12">
                <v-text-field v-model="proofOfAddress" label="Proof of address" required>
                  <v-btn slot="append-outer">Select</v-btn>
                </v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 13" step="13" editable>Your certified income</v-stepper-step>
              <v-stepper-content step="13">
                <v-text-field v-model="certifiedIncome" label="Your certified income" required>
                  <v-btn slot="append-outer">Select</v-btn>
                </v-text-field>
              </v-stepper-content>

              <v-stepper-step :complete="step > 14" step="14" editable>Country</v-stepper-step>
              <v-stepper-content step="14">
                <v-select v-model="country" :items="countries" item-text="name" item-value="code" />
              </v-stepper-content>
            </v-stepper>
            <p class="text-center">
              <v-btn color="success" @click="this.updateUser">Save my data</v-btn>
            </p>
          </div>
        </v-flex>
      </v-layout>
    </v-layout>
    <v-snackbar v-model="snackbar" :color="snackbarColor" top>
      {{ error }}
      <v-btn dark flat @click="snackbar = false">Close</v-btn>
    </v-snackbar>
  </v-layout>
</template>


<script>
import StepperButtons from '../components/StepperButtons.vue'
import axios from 'axios'
import Querystring from 'querystring'

export default {
  components: {
    StepperButtons
  },
  data: function() {
    return {
      step: 1,
      dialog: false,
      imageCapture: null,
      countries: [ {name: 'Afghanistan', code: 'AF'}, {name: 'Åland Islands', code: 'AX'}, {name: 'Albania', code: 'AL'}, {name: 'Algeria', code: 'DZ'}, {name: 'American Samoa', code: 'AS'}, {name: 'AndorrA', code: 'AD'}, {name: 'Angola', code: 'AO'}, {name: 'Anguilla', code: 'AI'}, {name: 'Antarctica', code: 'AQ'}, {name: 'Antigua and Barbuda', code: 'AG'}, {name: 'Argentina', code: 'AR'}, {name: 'Armenia', code: 'AM'}, {name: 'Aruba', code: 'AW'}, {name: 'Australia', code: 'AU'}, {name: 'Austria', code: 'AT'}, {name: 'Azerbaijan', code: 'AZ'}, {name: 'Bahamas', code: 'BS'}, {name: 'Bahrain', code: 'BH'}, {name: 'Bangladesh', code: 'BD'}, {name: 'Barbados', code: 'BB'}, {name: 'Belarus', code: 'BY'}, {name: 'Belgium', code: 'BE'}, {name: 'Belize', code: 'BZ'}, {name: 'Benin', code: 'BJ'}, {name: 'Bermuda', code: 'BM'}, {name: 'Bhutan', code: 'BT'}, {name: 'Bolivia', code: 'BO'}, {name: 'Bosnia and Herzegovina', code: 'BA'}, {name: 'Botswana', code: 'BW'}, {name: 'Bouvet Island', code: 'BV'}, {name: 'Brazil', code: 'BR'},
{name: 'British Indian Ocean Territory', code: 'IO'}, {name: 'Brunei Darussalam', code: 'BN'}, {name: 'Bulgaria', code: 'BG'}, {name: 'Burkina Faso', code: 'BF'}, {name: 'Burundi', code: 'BI'}, {name: 'Cambodia', code: 'KH'}, {name: 'Cameroon', code: 'CM'}, {name: 'Canada', code: 'CA'}, {name: 'Cape Verde', code: 'CV'}, {name: 'Cayman Islands', code: 'KY'}, {name: 'Central African Republic', code: 'CF'}, {name: 'Chad', code: 'TD'}, {name: 'Chile', code: 'CL'}, {name: 'China', code: 'CN'}, {name: 'Christmas Island', code: 'CX'}, {name: 'Cocos (Keeling) Islands', code: 'CC'}, {name: 'Colombia', code: 'CO'}, {name: 'Comoros', code: 'KM'}, {name: 'Congo', code: 'CG'}, {name: 'Congo, The Democratic Republic of the', code: 'CD'}, {name: 'Cook Islands', code: 'CK'}, {name: 'Costa Rica', code: 'CR'}, {name: 'Cote D\'Ivoire', code: 'CI'}, {name: 'Croatia', code: 'HR'}, {name: 'Cuba', code: 'CU'}, {name: 'Cyprus', code: 'CY'}, {name: 'Czech Republic', code: 'CZ'}, {name: 'Denmark', code: 'DK'},
{name: 'Djibouti', code: 'DJ'}, {name: 'Dominica', code: 'DM'}, {name: 'Dominican Republic', code: 'DO'}, {name: 'Ecuador', code: 'EC'}, {name: 'Egypt', code: 'EG'}, {name: 'El Salvador', code: 'SV'}, {name: 'Equatorial Guinea', code: 'GQ'}, {name: 'Eritrea', code: 'ER'}, {name: 'Estonia', code: 'EE'}, {name: 'Ethiopia', code: 'ET'}, {name: 'Falkland Islands (Malvinas)', code: 'FK'}, {name: 'Faroe Islands', code: 'FO'}, {name: 'Fiji', code: 'FJ'}, {name: 'Finland', code: 'FI'}, {name: 'France', code: 'FR'}, {name: 'French Guiana', code: 'GF'}, {name: 'French Polynesia', code: 'PF'}, {name: 'French Southern Territories', code: 'TF'}, {name: 'Gabon', code: 'GA'}, {name: 'Gambia', code: 'GM'}, {name: 'Georgia', code: 'GE'}, {name: 'Germany', code: 'DE'}, {name: 'Ghana', code: 'GH'}, {name: 'Gibraltar', code: 'GI'}, {name: 'Greece', code: 'GR'}, {name: 'Greenland', code: 'GL'}, {name: 'Grenada', code: 'GD'}, {name: 'Guadeloupe', code: 'GP'}, {name: 'Guam', code: 'GU'}, {name: 'Guatemala', code: 'GT'},
{name: 'Guernsey', code: 'GG'}, {name: 'Guinea', code: 'GN'}, {name: 'Guinea-Bissau', code: 'GW'}, {name: 'Guyana', code: 'GY'}, {name: 'Haiti', code: 'HT'}, {name: 'Heard Island and Mcdonald Islands', code: 'HM'}, {name: 'Holy See (Vatican City State)', code: 'VA'}, {name: 'Honduras', code: 'HN'}, {name: 'Hong Kong', code: 'HK'}, {name: 'Hungary', code: 'HU'}, {name: 'Iceland', code: 'IS'}, {name: 'India', code: 'IN'}, {name: 'Indonesia', code: 'ID'}, {name: 'Iran, Islamic Republic Of', code: 'IR'}, {name: 'Iraq', code: 'IQ'}, {name: 'Ireland', code: 'IE'}, {name: 'Isle of Man', code: 'IM'}, {name: 'Israel', code: 'IL'}, {name: 'Italy', code: 'IT'}, {name: 'Jamaica', code: 'JM'}, {name: 'Japan', code: 'JP'}, {name: 'Jersey', code: 'JE'}, {name: 'Jordan', code: 'JO'}, {name: 'Kazakhstan', code: 'KZ'}, {name: 'Kenya', code: 'KE'}, {name: 'Kiribati', code: 'KI'}, {name: 'Korea, Democratic People\'S Republic of', code: 'KP'}, {name: 'Korea, Republic of', code: 'KR'}, {name: 'Kuwait', code: 'KW'},
{name: 'Kyrgyzstan', code: 'KG'}, {name: 'Lao People\'S Democratic Republic', code: 'LA'}, {name: 'Latvia', code: 'LV'}, {name: 'Lebanon', code: 'LB'}, {name: 'Lesotho', code: 'LS'}, {name: 'Liberia', code: 'LR'}, {name: 'Libyan Arab Jamahiriya', code: 'LY'}, {name: 'Liechtenstein', code: 'LI'}, {name: 'Lithuania', code: 'LT'}, {name: 'Luxembourg', code: 'LU'}, {name: 'Macao', code: 'MO'}, {name: 'Macedonia, The Former Yugoslav Republic of', code: 'MK'}, {name: 'Madagascar', code: 'MG'}, {name: 'Malawi', code: 'MW'}, {name: 'Malaysia', code: 'MY'}, {name: 'Maldives', code: 'MV'}, {name: 'Mali', code: 'ML'}, {name: 'Malta', code: 'MT'}, {name: 'Marshall Islands', code: 'MH'}, {name: 'Martinique', code: 'MQ'}, {name: 'Mauritania', code: 'MR'}, {name: 'Mauritius', code: 'MU'}, {name: 'Mayotte', code: 'YT'}, {name: 'Mexico', code: 'MX'}, {name: 'Micronesia, Federated States of', code: 'FM'}, {name: 'Moldova, Republic of', code: 'MD'}, {name: 'Monaco', code: 'MC'}, {name: 'Mongolia', code: 'MN'},
{name: 'Montserrat', code: 'MS'}, {name: 'Morocco', code: 'MA'}, {name: 'Mozambique', code: 'MZ'}, {name: 'Myanmar', code: 'MM'}, {name: 'Namibia', code: 'NA'}, {name: 'Nauru', code: 'NR'}, {name: 'Nepal', code: 'NP'}, {name: 'Netherlands', code: 'NL'}, {name: 'Netherlands Antilles', code: 'AN'}, {name: 'New Caledonia', code: 'NC'}, {name: 'New Zealand', code: 'NZ'}, {name: 'Nicaragua', code: 'NI'}, {name: 'Niger', code: 'NE'}, {name: 'Nigeria', code: 'NG'}, {name: 'Niue', code: 'NU'}, {name: 'Norfolk Island', code: 'NF'}, {name: 'Northern Mariana Islands', code: 'MP'}, {name: 'Norway', code: 'NO'}, {name: 'Oman', code: 'OM'}, {name: 'Pakistan', code: 'PK'}, {name: 'Palau', code: 'PW'}, {name: 'Palestinian Territory, Occupied', code: 'PS'}, {name: 'Panama', code: 'PA'}, {name: 'Papua New Guinea', code: 'PG'}, {name: 'Paraguay', code: 'PY'}, {name: 'Peru', code: 'PE'}, {name: 'Philippines', code: 'PH'}, {name: 'Pitcairn', code: 'PN'}, {name: 'Poland', code: 'PL'}, {name: 'Portugal', code: 'PT'},
{name: 'Puerto Rico', code: 'PR'}, {name: 'Qatar', code: 'QA'}, {name: 'Reunion', code: 'RE'}, {name: 'Romania', code: 'RO'}, {name: 'Russian Federation', code: 'RU'}, {name: 'RWANDA', code: 'RW'}, {name: 'Saint Helena', code: 'SH'}, {name: 'Saint Kitts and Nevis', code: 'KN'}, {name: 'Saint Lucia', code: 'LC'}, {name: 'Saint Pierre and Miquelon', code: 'PM'}, {name: 'Saint Vincent and the Grenadines', code: 'VC'}, {name: 'Samoa', code: 'WS'}, {name: 'San Marino', code: 'SM'}, {name: 'Sao Tome and Principe', code: 'ST'}, {name: 'Saudi Arabia', code: 'SA'}, {name: 'Senegal', code: 'SN'}, {name: 'Serbia and Montenegro', code: 'CS'}, {name: 'Seychelles', code: 'SC'}, {name: 'Sierra Leone', code: 'SL'}, {name: 'Singapore', code: 'SG'}, {name: 'Slovakia', code: 'SK'}, {name: 'Slovenia', code: 'SI'}, {name: 'Solomon Islands', code: 'SB'}, {name: 'Somalia', code: 'SO'}, {name: 'South Africa', code: 'ZA'}, {name: 'South Georgia and the South Sandwich Islands', code: 'GS'}, {name: 'Spain', code: 'ES'},
{name: 'Sri Lanka', code: 'LK'}, {name: 'Sudan', code: 'SD'}, {name: 'Suriname', code: 'SR'}, {name: 'Svalbard and Jan Mayen', code: 'SJ'}, {name: 'Swaziland', code: 'SZ'}, {name: 'Sweden', code: 'SE'}, {name: 'Switzerland', code: 'CH'}, {name: 'Syrian Arab Republic', code: 'SY'}, {name: 'Taiwan, Province of China', code: 'TW'}, {name: 'Tajikistan', code: 'TJ'}, {name: 'Tanzania, United Republic of', code: 'TZ'}, {name: 'Thailand', code: 'TH'}, {name: 'Timor-Leste', code: 'TL'}, {name: 'Togo', code: 'TG'}, {name: 'Tokelau', code: 'TK'}, {name: 'Tonga', code: 'TO'}, {name: 'Trinidad and Tobago', code: 'TT'}, {name: 'Tunisia', code: 'TN'}, {name: 'Turkey', code: 'TR'}, {name: 'Turkmenistan', code: 'TM'}, {name: 'Turks and Caicos Islands', code: 'TC'}, {name: 'Tuvalu', code: 'TV'}, {name: 'Uganda', code: 'UG'}, {name: 'Ukraine', code: 'UA'}, {name: 'United Arab Emirates', code: 'AE'}, {name: 'United Kingdom', code: 'GB'}, {name: 'United States', code: 'US'},
{name: 'United States Minor Outlying Islands', code: 'UM'}, {name: 'Uruguay', code: 'UY'}, {name: 'Uzbekistan', code: 'UZ'}, {name: 'Vanuatu', code: 'VU'}, {name: 'Venezuela', code: 'VE'}, {name: 'Viet Nam', code: 'VN'}, {name: 'Virgin Islands, British', code: 'VG'}, {name: 'Virgin Islands, U.S.', code: 'VI'}, {name: 'Wallis and Futuna', code: 'WF'}, {name: 'Western Sahara', code: 'EH'}, {name: 'Yemen', code: 'YE'}, {name: 'Zambia', code: 'ZM'}, {name: 'Zimbabwe', code: 'ZW'} ],
      items: [
        { title: 'Dashboard', icon: 'dashboard', name: 'home' },
        { title: 'Manage data', icon: 'fingerprint', name: 'manageData' },
        { title: 'Activity', icon: 'history', name: 'activity' },
        { title: 'Services', icon: 'store', name: 'services' }
      ],
      error: '',
      snackbar: false,
      snackbarColor: 'error',

      firstname: '',
      lastname: '',
      email: '',
      phoneNumber: '',
      liveIdPhoto: '',
      govIdNumber: '',
      govIdPhoto: '',
      passportIdNumber: '',
      passportIdPhoto: '',
      drivingLicenceIdNumber: '',
      drivingLicenceIdPhoto: '',
      street: '',
      city: '',
      proofOfAddress: '',
      certifiedIncome: '',
      country: ''
    }
  },
  computed: {
    user: function() {
      const user = this.$store.getters.getUser
      this.lastname = user.lastname
      this.firstname = user.firstname
      this.email = user.email
      this.phoneNumber = user.phoneNumber
      this.liveIdPhoto = user.liveIdPhoto
      this.govIdNumber = user.govIdNumber
      this.govIdPhoto = user.govIdPhoto
      this.passportIdNumber = user.passportIdNumber
      this.passportIdPhoto = user.passportIdPhoto
      this.drivingLicenceIdNumber = user.drivingLicenceIdNumber
      this.drivingLicenceIdPhoto = user.drivingLicenceIdPhoto
      this.street = user.street
      this.city = user.city
      this.proofOfAddress = user.proofOfAddress
      this.certifiedIncome = user.certifiedIncome
      this.country = user.country

      return user
    },
    initial: function() {
      return this.$store.getters.getUser.email.substring(0, 1).toUpperCase()
    }
  },
  methods: {
    updateUser: function() {
      axios.post(`http://perseos.ja/perseos/update`, Querystring.stringify({
        firstname: this.$data.firstname,
        lastname: this.$data.lastname,
        email: this.$data.email,
        phoneNumber: this.$data.phoneNumber,
        liveIdPhoto: this.$data.liveIdPhoto,
        govIdNumber: this.$data.govIdNumber,
        govIdPhoto: this.$data.govIdPhoto,
        passportIdNumber: this.$data.passportIdNumber,
        passportIdPhoto: this.$data.passportIdPhoto,
        drivingLicenceIdNumber: this.$data.drivingLicenceIdNumber,
        drivingLicenceIdPhoto: this.$data.drivingLicenceIdPhoto,
        street: this.$data.street,
        city: this.$data.city,
        proofOfAddress: this.$data.proofOfAddress,
        certifiedIncome: this.$data.certifiedIncome,
        country: this.$data.country
      }), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
      .then((response) => {
        if(response.data.status == 'success') {
          this.$store.dispatch('setUser', response.data.user)
          this.error = response.data.message
          this.snackbarColor = 'success'
          this.snackbar = true
        }
        else {
          this.error = response.data.error
          this.snackbarColor = 'error'
          this.snackbar = true
        }
      })
      .catch(e => {
        this.error = e.message
        this.snackbarColor = 'error'
          this.snackbar = true
      })
    },
    setImage: function (file) {
      this.$data.liveIdPhoto = file
    },
    initMediaStream: function() {
      navigator.mediaDevices.getUserMedia({video: true})
      .then((mediaStream) => {
        document.querySelector('video').srcObject = mediaStream;

        const track = mediaStream.getVideoTracks()[0];
        this.$data.imageCapture = new ImageCapture(track);
      })
      .catch(error => console.log(error));
    },
    takePicture: function() {
      this.$data.imageCapture.takePhoto()
        .then(blob => createImageBitmap(blob))
        .then((imageBitmap) => {
          const canvas = document.querySelector('#previewImage');
          this.drawCanvas(canvas, imageBitmap);

          this.$data.dialog = false;
        })
        .catch(error => console.log(error));
    },
    drawCanvas: function(canvas, img) {
      canvas.width = getComputedStyle(canvas).width.split('px')[0];
      canvas.height = getComputedStyle(canvas).height.split('px')[0];
      let ratio  = Math.min(canvas.width / img.width, canvas.height / img.height);
      let x = (canvas.width - img.width * ratio) / 2;
      let y = (canvas.height - img.height * ratio) / 2;
      canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
      canvas.getContext('2d').drawImage(img, 0, 0, img.width, img.height,
          x, y, img.width * ratio, img.height * ratio);
    }
  }
}
</script>

<style scoped>
#previewImage {
  width: 100%;
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
