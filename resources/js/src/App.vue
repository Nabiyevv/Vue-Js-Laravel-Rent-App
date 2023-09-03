<script >
import { RouterLink, RouterView } from 'vue-router'
import Home from './views/Home.vue';
import { useUserStore } from "./store/user.js";
import NavBarVue from './components/NavBar.vue';
import AlertBar from './components/Alert.vue';
export default {
    data(){
        return {
            userStore: useUserStore(),
        }
    },
    components:{
        NavBarVue,
        AlertBar,
    }
}
</script>

<template>

    <NavBarVue />
    
    <div class="relative z-50 mr-10 " v-if="userStore.showAlert">
{{        console.log("🚀 ~ file: App.vue:24 ~ userStore.showAlert:", userStore.showAlert)}}
        <AlertBar title="Please login to add to favorites!" type="danger" />
    </div>

    <RouterView />

</template>


