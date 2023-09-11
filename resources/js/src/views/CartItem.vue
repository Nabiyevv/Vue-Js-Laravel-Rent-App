<template>
    <div class="flex-row">
        <div class="flex-row">
            <div v-text="product.title"></div>
            <div v-text="product.city"></div>
        </div>
        <div>
            <img :src="product?.image" alt="" />
        </div>
        <div class="flex gap-5">
            <div v-text="product.user?.name"></div>
            <img
                :src="product.user?.avatar"
                v-if="product.user?.avatar"
                alt=""
            />
            <img
                v-else
                class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9 dark:invert"
                src="/storage/avatar/defaultProfile.svg"
                alt="Avatar"
            />
        </div>
        <div>
            <div>Category</div>
            <div>Category Description</div>
        </div>
        <div>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem esse
            quam vitae suscipit mollitia consequuntur. Quas dolores totam
            eligendi pariatur iste corporis cupiditate eos esse? Atque ipsum
            provident similique saepe! Assumenda praesentium nemo officiis dicta
            at nihil quibusdam repudiandae! Quod aperiam temporibus delectus
            distinctio suscipit perspiciatis quasi, quis ea consectetur
            perferendis laborum veniam fugiat nisi. Facere distinctio fuga illo
            accusamus. Velit, ipsam repellendus neque provident sed
            necessitatibus rerum! Nulla dolores nemo, explicabo minima voluptas
            distinctio numquam odit nisi reiciendis iste quidem, neque debitis,
            assumenda enim quae ipsum accusamus est corrupti!
        </div>
    </div>
</template>

<script>
import { useUserStore } from "../store/user";
import { useProductStore } from "../store/product";

export default {
    data() {
        return {
            userStore: useUserStore(),
            productStore: useProductStore(),
            product: [],
        };
    },
    async created() {
        this.product = await this.productStore.getProductsById(
            this.$route.params.id
        );
        console.log(
            "🚀 ~ file: CartItem.vue:18 ~ created ~ this.products:",
            this.product
        );
    },
};
</script>
