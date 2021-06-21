<template>
  <div>
    <Navigation/>
    <div class="py-5">
      <router-view/>
    </div>
    
  </div>
</template>

<script>
import Navigation from './components/Navigation.vue'
export default {
  components: {
    Navigation
  }
}
</script>

<style>

</style>
