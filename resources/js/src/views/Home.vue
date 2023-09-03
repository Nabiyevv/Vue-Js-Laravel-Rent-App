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
                v-for="(product, index) in products"
                :name="product.title"
                :location="product.city"
                :cost="product.price"
                :url="product.image"
                :index="index"
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

export default {
    data() {
        return {
            products: {},
            userStore: useUserStore(),
            productStore: useProductStore(),
            isLoading:true,
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
        this.products = this.productStore.products;
        this.isLoading = false;
        console.log(
            "🚀 ~ file: Home.vue:33 ~ created ~ this.products:",
            this.products
        );
    },
};
</script>
