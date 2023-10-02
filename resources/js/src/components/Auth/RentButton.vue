<script>
import RegisterForm from "./Register.vue";
import LoginForm from "./Login.vue";
import RentItem from "../RentItem.vue";
import {mapState} from 'pinia';
import {useUserStore} from '../../store/user'
export default {
    data() {
        return {
            isModalActive : false,
            isRegisterActive: false,
            isRentItemActive:false,
        };
    },
    methods:{
        toggleModal(){
            this.isModalActive = true;
            if (this.token) {
                this.isRentItemActive=true;
            }
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
    <transition name="fade" >
        <LoginForm v-if="isModalActive && !token" @closeLogin="()=>{isModalActive = false}" @openRegister="isRegisterActive = true"/>
    </transition>
    <transition name="fade">
        <RegisterForm v-if="isRegisterActive " @closeRegister="isRegisterActive = false" @openLogin="isModalActive = true" />
    </transition>
    <transition name="fade">
        <RentItem v-if="token && isRentItemActive" @closeRentModal="isRentItemActive = false"/>
    </transition>
</template>
