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
                :isFavorite="true"
            />
        </div>
    </Container>
</template>

<script>
import CategoryBar from "../components/CategoryBar.vue";
import CategorCart from "../components/CategoryCard.vue";
import Container from "../components/Container.vue";
import { useProductStore } from "../store/product.js";

export default {
    data() {
        return {
            products: {},
            productStore: useProductStore(),
            isLoading:true,
        };
    },
    components: {
        CategoryBar,
        CategorCart,
        Container,
    },
    watch:{
        async '$route.params.categoryName'(newVal,oldVal){
            await this.getData(newVal);
        }
    },
    async created() {
        await this.productStore.getProductsByCategory(this.$route.params.categoryName);       
        this.products = this.productStore.products;
        // console.log("🚀 ~ file: Categories.vue:54 ~ created ~ this.products:", this.products)
        this.isLoading = false;
    },
    methods:{
       async getData(catId)
       {
            this.isLoading = true;
            await this.productStore.getProductsByCategory(catId);
            this.products = this.productStore.products;
            this.isLoading = false;
            // console.log("🚀 ~ file: Categories.vue:50 ~ catId:", catId)
            // console.log("🚀 ~ file: Categories.vue:52 ~ this.products:", this.products)
        }
    },
};
</script>
