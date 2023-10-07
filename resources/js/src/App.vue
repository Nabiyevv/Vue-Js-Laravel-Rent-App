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
            alertType:'',
            alertTitle:'',
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
        },
        "userStore.alertType"(newValue) {
            console.log("🚀 ~ file: App.vue:34 ~ newValue:", newValue)
            this.alertType = newValue;
        },
        "userStore.alertTitle"(newValue) {
            console.log("🚀 ~ file: App.vue:38 ~ newValue:", newValue)
            this.alertTitile = newValue;
        }
    },
};
</script>

<template>

    <NavBarVue />
    <Transition name="fade">
            <AlertBar v-if="userStore.showAlert" :title="userStore.alertTitle" :type="userStore.alertType" />
    </Transition>
    <RouterView />

</template>