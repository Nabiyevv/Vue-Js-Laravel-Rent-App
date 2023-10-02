<template>
    <div class="ml-8">
        <div class="flex-row my-8 ml-5">
            <div class="text-3xl font-bold" v-text="product.title"></div>
            <div class="text-lg font-medium" v-text="product.city"></div>
        </div>
        <div class="flex gap-10 items-center">
            <div class="max-w-4xl rounded-3xl shadow-[0_3px_10px_rgb(0,0,0,0.5)]">
                <img class="rounded-2xl" :src="product?.image" alt="Product Image" />
            </div>
            <div class="flex-row max-w-2xl">
                <div class="flex gap-5 items-center">
                    <div class="font-medium text-lg" v-text="product.user?.name"></div>
                    <img
                        class="flex-shrink-0 object-cover mx-1 rounded-full dark:invert w-12"
                        :src="product.user?.avatar"
                        v-if="product.user?.avatar"
                        :alt="product.user?.name + ' avatar'"
                    />
                    <img
                        v-else
                        class="flex-shrink-0 object-cover mx-1 rounded-full dark:invert w-12"
                        src="/storage/avatar/defaultProfile.svg"
                        :alt="product.user?.name + ' avatar'"
                    />
                </div>
                <div class="mt-4 mb-6">
                    <div class="text-xl">Category</div>
                    <div class="text-base">Category Description</div>
                </div>
                <div class="text-xl">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Autem esse quam vitae suscipit mollitia consequuntur. Quas
                    dolores totam eligendi pariatur iste corporis cupiditate eos
                    esse? Atque ipsum provident similique saepe! Assumenda
                    praesentium nemo officiis dicta at nihil quibusdam
                    repudiandae! Quod aperiam temporibus delectus distinctio
                    suscipit perspiciatis quasi, quis ea consectetur perferendis
                    laborum veniam fugiat nisi. Facere distinctio fuga illo
                    accusamus. Velit, ipsam repellendus neque provident sed
                    necessitatibus rerum! Nulla dolores nemo, explicabo minima
                    voluptas distinctio numquam odit nisi reiciendis iste
                    quidem, neque debitis, assumenda enim quae ipsum accusamus
                    est corrupti!
                </div>
            </div>
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
