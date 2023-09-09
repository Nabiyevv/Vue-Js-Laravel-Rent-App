<template>
    <div class="flex justify-center absolute ease-custom">
        <div class="relative inline-block mb-20">
            <!-- Dropdown toggle button -->

            <!-- Dropdown menu -->
            <div
                class=" absolute right-0 z-20 w-56 pt-2 mt-2 overflow-hidden bg-gray-100 rounded-md shadow-[0_3px_10px_rgb(0,0,0,0.4)] dark:bg-gray-800"
            >
                <a
                    href="#"
                    class="flex items-center p-3 -mt-2 text-sm text-gray-600 transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    <img
                        class="flex-shrink-0 object-cover mx-1 rounded-full w-9 h-9 dark:invert"
                        src="/storage/avatar/defaultProfile.svg"
                        alt="Avatar"
                    />
                    <div class="mx-1">
                        <h1
                            class="text-sm font-semibold text-gray-700 dark:text-gray-200"
                        >
                           {{ userStore.user.name }}
                        </h1>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ userStore.user.email }}
                        </p>
                    </div>
                </a>

                <hr class="border-gray-200 dark:border-gray-700" />

                <RouterLink
                    to="/profile"
                    class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    view profile
                </RouterLink>

                <button
                    class="cursor-pointer text-left inline-block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    @click="toggleTheme"
                >
                    {{ isDark ? "Dark" : "Light" }}
                </button>

                <button
                    class="cursor-pointer text-left inline-block w-full px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-200 transform dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-white"
                    @click="logout"
                >
                    Sign Out
                </button>
            </div>
        </div>
    </div>
</template>



<script>
import { useDark, useToggle } from "@vueuse/core";
import { useUserStore } from "../store/user";
export default {
    name: "ThemeToggle",
    data() {
        return {
            isDark: false,
            userStore: useUserStore(),
            isVisible: false,
        };
    },
    created() {
        this.isDark = useDark();
    },
    methods: {
        toggleTheme() {
            console.log(this.userStore.user);
            this.isDark = !this.isDark;
        },
        async logout() {
            await this.userStore.logout();
        },
    },
};
</script>
