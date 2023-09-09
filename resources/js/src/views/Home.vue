<template>

    <CategoryBar />
    
    <Container>
        <div v-if="isLoading">
            Loading ...
        </div>
        <div v-else-if="products.length == 0">
            We dont have any Product
        </div>  
        <div v-else
            class="mt-10 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-8"
        >
            <CategorCart
                v-for="product in products"
                :name="product.title"
                :location="product.city"
                :cost="product.price"
                :url="product.image"
                :index="product.id"
                :handleFavorite="favoriteProducts.includes(product.id)"
            />
        </div>
    </Container>
</template>

<script>
import CategoryBar from "../components/CategoryBar.vue";
import CategorCart from "../components/CategoryCard.vue";
import Container from "../components/Container.vue";
import { useUserStore } from "../store/user.js";
import { useProductStore } from "../store/product.js";
import AlertBar from '../components/Alert.vue';
import axios from "axios";
export default {
    data() {
        return {
            products: {},
            userStore: useUserStore(),
            productStore: useProductStore(),
            isLoading:true,
            favoriteProducts:[],
        };
    },
    components: {
        CategoryBar,
        CategorCart,
        Container,
        AlertBar,
    },
    async created() {
        await this.productStore.getProducts();
        if(this.userStore.token)
        {
            if( this.productStore.cache['/api/products/favorite']){
                this.favoriteProducts = this.productStore.cache['/api/products/favorite'];
            }
            else{
                this.favoriteProducts  = await this.productStore.getFavoriteProducts();  
                this.productStore.cache['/api/products/favorite'] = this.favoriteProducts;
            }
        }
        this.products = this.productStore.products;
        this.isLoading = false;
    },
};
</script>
