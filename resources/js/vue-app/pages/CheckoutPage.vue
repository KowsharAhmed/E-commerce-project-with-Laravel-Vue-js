<template>
  <div class="container">
   <h2>Checkout Page</h2>
   <hr />
    <div class="row">
        <div class="col-md-6">
           <div class="media">
          <div class="product-image">
              <!-- <img src="https://via.placeholder.com/800" class="mr-3" alt="..." /> -->
              <img :src= "checkoutData.image" class="mr-3" alt="..." />
          </div>
          <div class="media-body">
         <h5 class="mt-0 ml-3">{{ checkoutData.product_name }}</h5>
          <div class="ml-3">
              <p> price {{ checkoutData.price }} Taka </p>
              <p> Quantity {{ checkoutData.ckt_qty }} Piece </p>
      </div>
          </div>
        </div>
            <hr>
    <div class="text-right">
        Total: {{ checkoutData.price * checkoutData.ckt_qty }} Taka
    </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Shipping Info</h4>
            </div>
            <div class="card-body">
                <form action="" @submit.prevent="placeOrder">
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input type="text" v-model="shippingInfo.customer_name" class="form-control">
                        <p v-if="v$.shippingInfo.customer_name.$invalid" class="text-danger">Name is Required</p>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control" v-model="shippingInfo.address"></textarea>
                        <p v-if="v$.shippingInfo.address.$invalid" class="text-danger">Address are required</p>

                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" v-model="shippingInfo.phone" class="form-control">
                        <p v-if="v$.shippingInfo.phone.$invalid" class="text-danger">phone are required</p>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-warning">Pleace Order</button>
                      
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
  </div>
</template>

<script>
import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'
import Axios from 'axios';
export default {
    setup () {
        return { v$: useVuelidate() }
    },
    data(){
        return {
            checkoutData:{
                image:'',
                product_name:'',
                price:'',
                ckt_qty:0,
                product_id:null
            },
            shippingInfo:{
                customer_name:'',
                address:'',
                phone:''

            }
        }
    },
    methods:{
        
            async placeOrder() {
                if(!this.v$.$invalid){
                    let orderData = {
                    product_id: this.checkoutData.product_id,
                    qty: this.checkoutData.ckt_qty,
                    price: this.checkoutData.price,
                    shipping_info: this.shippingInfo
                    };
                    const response = await Axios.post('/api/place-order', orderData);
                    if(response.data.success){
                    this.$router.push({
                    'name':'checkout-success-page',
                    })
                    } else{
                    this.$router.push({
                    'name':'checkout-failure-page',
                    })
                    
                    }
                }

                              

            }     
    },
    beforeMount(){
        this.checkoutData.image = this.$store.getters.getCheckoutData.image;
        this.checkoutData.product_name = this.$store.getters.getCheckoutData.product_name;
        this.checkoutData.price = this.$store.getters.getCheckoutData.price;
        this.checkoutData.ckt_qty = this.$store.getters.getCheckoutData.cktQty;
        this.checkoutData.product_id = this.$store.getters.getCheckoutData.productId;
    },
    validations: {
            shippingInfo:{
                customer_name:{required},
                address:{required},
                phone:{required},

            }
    }
}
</script>



<style>
  .product-image{
      width: 100px
  }
  .product-image img{
      max-width: 100%;
  }
    
</style>