<template>
    <div
        class="sticky top-[79px] z-40 bg-white dark:text-white dark:bg-gray-900 w-full border-b border-gray-200 dark:border-gray-600 py-4 max-w-[2520px] mx-auto xl:px-20 md:px-10 sm:px-2 px-4 flex justify-between"
    >
    <!--  @click="productStore.getProductsByCategory(category.id)" -->
        <div v-for="(category, index) in categories">
            <RouterLink
            :to="`/category/${category.id}`"
            class="flex flex-col justify-center items-center"
            >
            <!-- :to="`/category/${category.label.toLocaleLowerCase().split(' ').join('')}`" -->
                <div>
                    <img
                        :src="category.icon"
                        class="max-h-7 dark:invert"
                        alt=""
                    />
                </div>
                <div class="text-xs">{{ category.label }}</div>
            </RouterLink>
        </div>
    </div>
</template>

<script>
import { getCategories } from "./Categories.vue";
import {useProductStore} from '../store/product'
export default {
    data() {
        return {
            categories: getCategories(),
            productStore:useProductStore(),
        };
    },
};
</script>
