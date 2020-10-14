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
.twig-profile--light{
  --text-color: #000;
  --link-color: blue;
}
.twig-profile--dark{
  --text-color: #fff;
  --link-color: cyan;
}
</style>
