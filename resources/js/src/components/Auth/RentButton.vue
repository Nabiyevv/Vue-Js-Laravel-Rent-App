<script>
import RegisterForm from "./Register.vue";
import LoginForm from "./Login.vue";
import RentItem from "../RentItem.vue";
import {mapState} from 'pinia';
import {useUserStore} from '../../store/user'
export default {
    data() {
        return {
            isMenuActive : false,
            isRegisterActive: false,
        };
    },
    methods:{
        toggleModal(){
            this.isMenuActive  = true;
        }
    },
    computed:{
        ...mapState(useUserStore,['token']),
    },
    components: { RegisterForm, LoginForm, RentItem },
};
</script>

<template>
    <button
        @click="toggleModal"
        type="button"
        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 rounded-full text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
    >
        Rent Stuff
    </button>
    <LoginForm v-if="isMenuActive" @closeLogin="isMenuActive  = false" @openRegister="isRegisterActive = true"/>
    <RegisterForm v-if="isRegisterActive " @closeRegister="isRegisterActive = false" @openLogin="isMenuActive  = true" />
    <RentItem v-if="isMenuActive && token" @closeLogin="isMenuActive = false"/>
    <!-- {{console.log("🚀 ~ file: RentButton.vue:35 ~ isMenuActive:", isMenuActive)}} -->

</template>

<style>
/* @keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translate3d(0, 1000px, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.fade-in-up {
    animation: fade-in-up 0.5s ease;
}
@keyframes fade-in-down {
    from {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
    to {
        opacity: 0;
        transform: translate3d(0, 2000px, 0);
    }
}

.fade-in-down {
    animation: fade-in-up 0.5s ease;
} */
</style>
