<template>
    <div>
      <app-header></app-header>
    

<div class="main-content py-3" style="min-height: calc(100vh - 18vh)">
<router-view></router-view>
</div>
<app-footer></app-footer>


    </div>

</template>

<script>
import AppHeader from './components/Header.vue'
import AppFooter from './components/Footer.vue'

export default {
  components:{ AppHeader, AppFooter,}
}
</script>

<style>
  
</style>
