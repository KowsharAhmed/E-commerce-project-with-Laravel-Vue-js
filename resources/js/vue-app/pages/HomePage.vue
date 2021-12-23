<template>
  <div class="container">
   <h2>Product List</h2>
   <hr />
  <div class="row">
      <div
       v-for="(value, index) in $store.getters.getProducts"
       :key="index" 
       class="col-md-3 clear-both mb-3"
       >
            <router-link :to="{ name:'product-page',params:{ slug:value.slug }}">
            <div class="card" >
            <img 
            :src="value.image" 
            class="card-img-top" 
            alt="IMG"
            />
         <div class="card-body">
         <h5 class="card-title">{{ value.name }}</h5>
        <p class="card-text">Price {{ value.price }} Taka</p>
       </div> 
            </div>
        </router-link>
      </div>
   </div>
  </div>
</template>

<script>
import Axios from "axios";

export default {
   // data() {
   //    return {
   //       products: [],
   //    };
   // },

  async beforeMount() {
     await this.$store.dispatch('loadDataFromMysql');
 
      // const response = await Axios.get("/api/product-list");
      // this.products = response.data;
        
 },
};
</script>