<template>
    <nav class="flex justify-center items-center space-x-2">
        <a
            class="text-gray-500 hover:text-blue-600 p-4 inline-flex items-center gap-2 rounded-md"
            href="#"
        >
            <span aria-hidden="true">«</span>
            <span class="sr-only">Previous</span>
        </a>
        <span v-for="page in productStore.totalPages"
            @click="getProductByPage(page)"
            :class="{
              'cursor-pointer w-10 h-10 bg-blue-500 text-white p-4 inline-flex items-center text-sm font-medium rounded-full':page==productStore.curretPage,
              'cursor-pointer w-10 h-10 text-gray-500 hover:text-blue-600 p-4 inline-flex items-center text-sm font-medium rounded-full':page!=productStore.curretPage
            }"
            aria-current="page"
            >{{ page }}</span
        >
        <a
            class="cursor-pointer text-gray-500 hover:text-blue-600 p-4 inline-flex items-center gap-2 rounded-md"
            :class="{
              'pointer-events-none': productStore.curretPage==4,
            }"
           
        >
            <div @click="nextPage">
              <span class="sr-only">Next</span>
              <span aria-hidden="true">»</span>
            </div>
        </a>
    </nav>
</template>

<script>

import {useProductStore} from '../store/product'

export default {
    data() {
      return {
        productStore:useProductStore(),
        lastPage:1,
        current_page:1,
      }
    },
    methods:{
      async getProductByPage(pageId){
        await this.productStore.getProducts(pageId);
      },  
      async nextPage(){
        await this.productStore.getProducts(this.productStore.curretPage +1);
      }
    },

};
</script>
