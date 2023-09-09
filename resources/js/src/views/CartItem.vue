<template >
 
</template>


<script>
import {useProductStore} from '../store/product';
import {useUserStore} from '../store/user';

export default {
  data(){
    return {
        userStore:useUserStore(),
        productStore:useProductStore(),
    }
  },
  created (){
    this.productStore.getProductsById(this.$route.params.id);
    console.log("🚀 ~ file: CartItem.vue:19 ~ created ~ this.productStore:", this.productStore)

  } 
}

</script>