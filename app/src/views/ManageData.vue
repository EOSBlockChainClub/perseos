<template>
  <v-container fluid>
    <v-layout row align-center>
      <v-flex xs12>
        <h1 class="text-xs-center">New global secure ID</h1>
      </v-flex>
    </v-layout>
    <v-layout row align-center>
      <v-flex xs12>
        <v-stepper v-model="step" vertical>
          <v-stepper-step :complete="step > 1" step="1">Your name</v-stepper-step>
          <v-stepper-content step="1">
            <v-text-field v-model="firstname" label="Firstname" required />
            <v-text-field v-model="lastname" label="Lastname" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" hideBack="true" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 2" step="2">Your e-mail</v-stepper-step>
          <v-stepper-content step="2">
            <v-text-field type="email" v-model="email" label="E-mail" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>
          
          <v-stepper-step :complete="step > 3" step="3">Your phone number</v-stepper-step>
          <v-stepper-content step="3">
            <v-text-field v-model="phoneNumber" label="Phone number" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 4" step="4">Live ID photo</v-stepper-step>
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
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>
          
          <v-stepper-step :complete="step > 5" step="5">Government ID number</v-stepper-step>
          <v-stepper-content step="5">
            <v-text-field v-model="govIdNumber" label="Government ID number" required></v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 6" step="6">Government ID photo</v-stepper-step>
          <v-stepper-content step="6">
            <v-text-field v-model="govIdPhoto" label="Government ID photo" required>
              <v-btn slot="append-outer">Select</v-btn>
            </v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 7" step="7">Passport ID number</v-stepper-step>
          <v-stepper-content step="7">
            <v-text-field v-model="passportIdNumber" label="Passport ID number" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 8" step="8">Passport ID photo</v-stepper-step>
          <v-stepper-content step="8">
            <v-text-field v-model="passportIdPhoto" label="Passport ID photo" required>
              <v-btn slot="append-outer">Select</v-btn>
            </v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 9" step="9">Driving Licence ID number</v-stepper-step>
          <v-stepper-content step="9">
            <v-text-field v-model="drivingLicenceIdNumber" label="Driving Licence ID number" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 10" step="10">Driving Licence ID photo</v-stepper-step>
          <v-stepper-content step="10">
            <v-text-field v-model="drivingLicenceIdPhoto" label="Driving Licence ID photo" required>
              <v-btn slot="append-outer">Select</v-btn>
            </v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 11" step="11">Your address</v-stepper-step>
          <v-stepper-content step="11">
            <v-text-field v-model="street" label="street" required />
            <v-text-field v-model="city" label="city" required />
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 12" step="12">Proof of address</v-stepper-step>
          <v-stepper-content step="12">
            <v-text-field v-model="proofOfAddress" label="Proof of address" required>
              <v-btn slot="append-outer">Select</v-btn>
            </v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 13" step="13">Your certified income</v-stepper-step>
          <v-stepper-content step="13">
            <v-text-field v-model="certifiedIncome" label="Your certified income" required>
              <v-btn slot="append-outer">Select</v-btn>
            </v-text-field>
            <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 14" step="14">Country</v-stepper-step>
          <v-stepper-content step="14">
             <v-select v-model="country" :items="countries" item-text="name" item-value="code" />  
             <StepperButtons v-on:continue="this.continue" v-on:skip="this.skip" v-on:back="this.back" />
          </v-stepper-content>

          <v-stepper-step :complete="step > 15" step="15">Everythink is ready</v-stepper-step>
          <v-stepper-content step="15">
            <v-btn color="success">Create my account!</v-btn>
          </v-stepper-content>
        </v-stepper>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import StepperButtons from '../components/StepperButtons.vue'

export default {
  components: {
    StepperButtons
  },
  data: function() {
    return {
      step: 4,
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
  methods: {
    continue: function() {
      // ToDo: Some validations
      this.$data.step++
    },
    skip: function() {
      this.$data.step++
    },
    back: function() {
      this.$data.step--
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
#previewImage {
  width: 100%;
}
</style>
