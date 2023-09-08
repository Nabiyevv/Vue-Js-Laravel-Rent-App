<template>
    <nav
        class="sticky top-0 z-50 items-center bg-white dark:text-white dark:bg-gray-900 w-full border-b border-gray-200 dark:border-gray-600 flex justify-between py-4 max-w-[2520px] mx-auto xl:px-20 md:px-10 sm:px-2 px-4"
    >
        <RouterLink to="/"
            ><div class="leading-none py-2 px-4 rounded-2xl text-3xl">
                Rentlots
            </div></RouterLink
        >
        <div class="w-2/6">
            <SearchInput />
        </div>
        <div class="flex justify-between gap-5 items-center">
            <button @click="testReq">getProducts</button>
            <RentButton />
            <div class="flex">
                <div v-if="token" class="flex gap-5">
                    <button
                        @click="isVisible = !isVisible"
                        class="relative z-10 flex items-center p-2 text-sm text-gray-600 bg-gray-100 border border-transparent rounded-md focus:border-blue-500 focus:ring-opacity-40 dark:focus:ring-opacity-40 focus:ring-blue-300 dark:focus:ring-blue-400 focus:ring dark:text-white dark:bg-gray-800 focus:outline-none"
                    >
                        <span class="mx-1">Options</span>
                        <svg
                            class="w-5 h-5 mx-1"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 15.713L18.01 9.70299L16.597 8.28799L12 12.888L7.40399 8.28799L5.98999 9.70199L12 15.713Z"
                                fill="currentColor"
                            ></path>
                        </svg>
                    </button>
                    <SettignsButton v-if="isVisible" />
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { useDark } from "@vueuse/core";
import SearchInput from "./SearchInput.vue";
import RentButton from "./Auth/RentButton.vue";
import { mapState } from "pinia";
import { useUserStore } from "../store/user";
import { useProductStore } from "../store/product";
import axios from "axios";
import SettignsButton from "./SettignsButton.vue";
export default {
    name: "ThemeToggle",
    data() {
        return {
            isDark: false,
            userStore: useUserStore(),
            productStore: useProductStore(),
            isVisible: false,
        };
    },
    components: { SearchInput, RentButton, SettignsButton },
    created() {
        this.isDark = useDark();
    },
    methods: {
        toggleTheme() {
            this.isDark = !this.isDark;
        },
        async logout() {
            await this.userStore.logout();
        },

        async testReq() {
            // await axios.get('')
            // await axios.post('http://localhost:8000/api/products/2',null,{
            await axios
                .get("http://localhost:8000/api/products", null,{
                    headers: {
                        'Accept': "application/json",
                        "Content-Type": "application/json",
                        "Authorization": `Bearer ${localStorage.getItem('token')}`
                    },
                })
                .then((response) => {
                    console.log(response.data);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
    computed: {
        ...mapState(useUserStore, ["token"]),
    },
};
</script>
