<template>
  <div class='twig-profile' :class="'twig-profile--' + qm_dark_mode">
      <Profile :profile="currentProfile" :parentProfile="currentProfile" :rootProfile="currentProfile" />
  </div>
</template>

<script>
import Profile from './components/Profile.vue';

export default {
  name: 'App',
  props: [
    'profile',
    'qm_dark_mode'
  ],
  data: () => {
    return {
      currentProfile: null
    }
  },
  components: {
    Profile
  },
  mounted() {
    this.currentProfile = JSON.parse( this.profile )
  }
}
</script>

<style>
.twig-profile{
  font-size: 16px;
  line-height: 25px;
}

.twig-profile--light{
  --text-color: #000;
  --link-color: blue;
  --alert-color: #a00;
  --warning-color: #b33000;
  --muted-color: #333;
}

.twig-profile--dark{
  --text-color: #fff;
  --link-color: cyan;
  --alert-color: #f88;
  --warning-color: #ff4;
  --muted-color: #bbb;
}
</style>
