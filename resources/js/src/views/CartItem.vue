<template>
    <div class="mx-8">
        <div class="flex-row my-8 ml-5">
            <div class="text-3xl font-bold" v-text="product.title"></div>
            <div class="text-lg font-medium" v-text="product.city"></div>
        </div>
        <div class="xl:flex gap-10 items-center">
            <div
                class="max-w-4xl mb-6 rounded-3xl shadow-[0_3px_10px_rgb(0,0,0,0.5)]"
            >
                <img
                    class="rounded-2xl"
                    :src="product?.image"
                    alt="Product Image"
                />
            </div>
            <div class="flex-row 2xl:max-w-2xl lg:max-w-lg">
                <div class="flex gap-5 items-center">
                    <img
                        class="flex-shrink-0 object-cover mx-1 rounded-full w-12 h-12"
                        :src="product.user?.avatar"
                        v-if="product.user?.avatar"
                        :alt="product.user?.name + ' avatar'"
                    />
                    <img
                        v-else
                        class="flex-shrink-0 object-cover mx-1 rounded-full dark:invert w-12 h-12"
                        src="/storage/avatar/defaultProfile.svg"
                        :alt="product.user?.name + ' avatar'"
                    />
                    <div
                        class="font-medium text-lg"
                        v-text="product.user?.name"
                    ></div>
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
        <div class="flex justify-between max-w-xl items-center">
            <div class="text-xl font-bold">{{ product?.price }} ₼</div>

            <div class="text-base font-medium">
                Quantity : &nbsp; {{ product?.count }}
            </div>
            <a
                class="font-medium"
                :href="`https://wa.me/${contact}`"
                target="_blank"
                >{{ product?.user?.contact }}</a
            >
        </div>
    </div>
</template>

<script>
import { useUserStore } from "../store/user";
import { useProductStore } from "../store/product";
import { getCategories } from "../components/Categories.vue";
export default {
    data() {
        return {
            userStore: useUserStore(),
            productStore: useProductStore(),
            product: [],
            categories: getCategories(),
            contact:'',
        };
    },
    async created() {
        this.product = await this.productStore.getProductsById(
            this.$route.params.id
        );
        this.contact = this.formatPhoneNumber(this.product.user.contact);
        console.log(
            "🚀 ~ file: CartItem.vue:18 ~ created ~ this.products:",
            this.product
        );
    },
    methods:{
        formatPhoneNumber(phoneNumber) {
            let cleaned = phoneNumber.replace(/\D/g, ""); // remove non-digits
            cleaned = cleaned.substring(0); // remove leading +
            return cleaned;
        },
        
    },

};
</script>
