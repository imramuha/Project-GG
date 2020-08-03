<template>
  <div class="settings">
    <h1>Settings & Preferences</h1>
    <div class="settingsBody">
      <h2>
        <span
          >Nightmode<span
            >Enable or disable it to change the theme to either day- or
            nightmode.</span
          ></span
        >
        <span
          ><label class="switch">
            <input type="checkbox" @change="update()" v-model="nightmode"/>
            <span class="slider round"></span></label
        ></span>
      </h2>
      <h2>
        <span
          >Anonymity<span
            >Whether or not if other should be able to see your data.</span
          ></span
        >
        <span
          ><label class="switch">
            <input type="checkbox" @change="update()" v-model="anonymity" />
            <span class="slider round"></span> </label
        ></span>
      </h2>
      <h2>
        <span
          >Voice<span
            >Whether or not if you prefer using voice chat.</span
          ></span
        >
        <span
          ><label class="switch">
            <input type="checkbox" @change="update()" v-model="voice" />
            <span class="slider round"></span> </label
        ></span>
      </h2>
      <h2>
        <span>Language(s)<span>Language that you prefer to speak. </span></span>
        <span>
          <select v-model="language">
            <option disabled value="0">Select your preferred language</option>
            <option
              v-for="lang in languages"
              v-bind:key="lang.id"
              :value="lang.id"
              >{{ lang.name }}</option
            >
          </select></span
        >
      </h2>
      <h2>
        <span
          >Timezone<span
            >Timezone that you prefer or most likely to play at.</span
          ></span
        >
            <span>
          <select v-model="timezone">
            <option disabled value="0">Select your preferred timezone</option>
            <option
              v-for="timezone in timezones"
              v-bind:key="timezone.id"
              :value="timezone.id"
              >{{ timezone.text }}</option
            >
          </select></span>
      </h2>
    </div>
  </div>
</template>

<script>
import { getUserSettings, editUserSettings } from "@/services/user.api";
import languages from "@/assets/data/languages.json";
import timezones from "@/assets/data/timezones.json";

export default {
  name: "Settings",
  data() {
    return {
      nightmode: false,
      anonymity: false,
      voice: false,
      language: null,
      timezone: null,
      languages: "",
      timezones: "",
    };
  },
  methods: {
    // is apparantly not really needed
    conversion(value) {
      if (value == true) {
        return 1;
      } else {
        return 0;
      }
    },
    async update() {
      let settings = {
        nightmode: this.conversion(this.nightmode),
        anonymity: this.anonymity,
        voice: this.voice,
      };
      console.log(settings);

      await editUserSettings(settings).then((response) => {
        console.log(response);
        this.$store
          .dispatch("notification", {
            message: response.data[0].response,
          })
          .then(() => {
            //this.$router.push('dashboard');
          })
          .catch((errors) => {
            console.log(errors);
          });
      });
    },
  },
  async mounted() {
    this.languages = languages;
    this.timezones = timezones;

    const response = await getUserSettings();

    console.log(response.data);
    if (!response.data.length) {
      console.log("this goes");
      this.nightmode = false;
      this.anonymity = false;
      this.voice = false;
    } else {
      console.log(response.data[0]);
      this.nightmode = response.data[0].nightmode;
      this.anonymity = response.data[0].anonymity;
      this.voice = response.data[0].voice;
      console.log(this.nightmode, this.anonymity, this.voice);
    }
  },
  watch: {
    nightmode: function() {
      // add/remove class to/from html tag
      let htmlElement = document.documentElement;

      if (this.nightmode) {
        htmlElement.setAttribute("theme", "dark");
      } else {
        htmlElement.setAttribute("theme", "light");
      }
    },
  },
};
</script>

<style></style>
