import { createApp } from "vue";
import {createRouter, createWebHistory} from 'vue-router';
import { createStore } from 'vuex'
import App from './App.vue' 
import Axios from "axios";
import HomePage from './pages/HomePage.vue'
import ProductPage from './pages/ProductPage.vue'
import CheckoutPage from './pages/CheckoutPage.vue'
import CheckoutSuccessPage from './pages/CheckoutSuccessPage.vue'
import CheckoutFailurePage from './pages/CheckoutFailurePage.vue'


            // Thats called Vuex
const vuexStore = createStore({
  state: {

      products: [],
      cktData:{}
    
  },
  actions:{
    async loadDataFromMysql({ commit}){
      const response = await Axios.get("/api/product-list");
      let data = response.data;
      commit('SET_PRODUCTS',data);
    },
    async setCheckoutData({ commit}, data){
      commit('SET_CKT_DATA',data);
    }

  },
  getters:{
    getProducts(state){
      return state.products;
    },
    getCheckoutData(state){
      return state.cktData;
    }

  },
  mutations:{
    SET_PRODUCTS(state, data){
      state.products = data;
    },
    SET_CKT_DATA(state, data){
      state.cktData = data;
    }
  }

});






const routes = [
    {
       name: 'home-page', 
       path: '/', 
       component: HomePage 
      },
    {
       name: 'product-page', 
       path: '/product/:slug', 
       component: ProductPage
       
      },
    { 
       name: 'checkout-page',
       path: '/checkout', 
       component: CheckoutPage 
      },
    { 
       name: 'checkout-success-page',
       path: '/checkout/success', 
       component: CheckoutSuccessPage
      },
    { 
       name: 'checkout-failure-page',
       path: '/checkout/failure', 
       component: CheckoutFailurePage 
      }
]

  const router = createRouter({
    history: createWebHistory(),
    routes,
  })
  

const myApp = createApp(App);
myApp.use(vuexStore);
myApp.use(router);

myApp.mount('#myApp');