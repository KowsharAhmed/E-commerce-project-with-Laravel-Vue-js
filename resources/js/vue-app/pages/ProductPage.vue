<template>
  <div class="container">
   <h2>Product Page</h2>
   <hr />

      <div>
         <div class="media">
          <div class="product-image">
              <img 
              :src="'/'+product.image"
              class="mr-3" 
              alt="..." 
              />
          </div>
          <div class="media-body">
         <h5 class="mt-0 ml-3">{{ product.name }}</h5>
          <div class="ml-3">
              <p>Price: {{ product.price }} Taka</p>
          
          <div>
              <input type="number" v-model="buyQuantity" placeholder="quantity">
          </div>
          <div class="mt-3">
              <button @click="buyNow" class="btn btn btn-warning">Buy Now</button>
          </div>
      </div>
          </div>
        </div> 
      </div>
      <div class="py-3">
          <h4>Details</h4>
          <p>{{ product.description }}</p> 
    </div>
  </div>
</template>

<script>

import Axios from "axios";

export default {
   data() {
      return {
         product:{},
         buyQuantity:1
      };
   },
   methods:{
      async buyNow(){
           let ckoutData = {
               image: this.product.image,
               product_name: this.product.name,
               price: this.product.price,
               cktQty: this.buyQuantity,
               productId: this.product.id,
           };
           await this.$store.dispatch('setCheckoutData',ckoutData);
           this.$router.push({'name':'checkout-page'});
       }
   },
  async beforeMount() {
      let slug = this.$route.params.slug;
      console.log(slug);
       const response = await Axios.get("/api/product/"+slug);
       this.product = response.data;
   },
};
</script>
<style>
  .product-image{
      width: 300px
  }
  .product-image img{
      max-width: 100%;
  }
    
</style>