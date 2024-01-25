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
          <select @change="update()" v-model="language">
            <option disabled value="0">Select your preferred language</option>
            <option
              v-for="lang in languages"
              v-bind:key="lang.id"
              :value="lang.name"
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
          <select @change="update()" v-model="timezone">
            <option disabled value="0">Select your preferred timezone</option>
            <option
              v-for="tz in timezones"
              v-bind:key="tz.id"
              :value="tz.text"
              >{{ tz.text }}</option
            >
          </select></span
        >
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
      language: "",
      timezone: "",
      languages: "",
      timezones: ""
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
        language: this.language,
        timezone: this.timezone
      };

      await editUserSettings(settings).then(response => {
        this.$store
          .dispatch("notification", {
            message: response.data[0].response
          })
          .then(() => {
            //this.$router.push('dashboard');
          })
          .catch(errors => {
            console.log(errors);
          });
      });
    }
  },
  async mounted() {
    this.languages = languages;
    this.timezones = timezones;

    await getUserSettings().then(response => {
      if (!response.data.length) {
        this.nightmode = false;
        this.anonymity = false;
        this.voice = false;
      } else {
        this.nightmode = response.data[0].nightmode;
        this.anonymity = response.data[0].anonymity;
        this.voice = response.data[0].voice;
        this.language = response.data[0].language;
        this.timezone = response.data[0].timezone;
      }
    });
  },
  watch: {
    nightmode: function() {
      // add/remove class to/from html tag
      let htmlElement = document.documentElement;

      if (this.nightmode) {
        htmlElement.setAttribute("theme", "dark");
        this.$emit("emitToMode", "dark");
      } else {
        htmlElement.setAttribute("theme", "light");
        this.$emit("emitToMode", "light");
      }
    }
  }
};
</script>

<style></style>
