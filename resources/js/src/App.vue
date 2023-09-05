<script>
import { RouterLink, RouterView } from "vue-router";
import Home from "./views/Home.vue";
import { useUserStore } from "./store/user.js";
import NavBarVue from "./components/NavBar.vue";
import AlertBar from "./components/Alert.vue";
export default {
    data() {
        return {
            userStore: useUserStore(),
            timeOut: null,
        };
    },
    components: {
        NavBarVue,
        AlertBar,
    },
    watch: {
        "userStore.showAlert"(newValue) {
            if (newValue) {
                // Show alert
                this.timeOut = setTimeout(() => {
                    this.userStore.showAlert = false;
                }, 2000);
            } else {
                // Hide alert
                clearTimeout(this.timeOut);
                this.timeOut = null;
            }
        }
    },
};
</script>

<template>

    <NavBarVue />
    <div class="relative z-50 mr-10" v-if="userStore.showAlert">
        <AlertBar title="Please login to add to favorites!" type="danger" />
    </div>

    <RouterView />

</template>