<script>
import RegisterForm from './Register.vue'
import axios from 'axios';
import {useUserStore} from '../../store/user.js';

export default {
    data() {
        return {
            formData:{
                email: '',
                password: '',
            },
            formErrors: '',
            userStore: useUserStore(),
        };
    },
    components:{RegisterForm},
    methods:{
        async postFormData (){      
            this.formErrors = await this.userStore.login(this.formData.email, this.formData.password);
            if(!this.formErrors)
            {
                this.$emit('closeLogin')
                this.formErrors = {};
                
            }
        }
    },
};
</script>

<template>
        <div
            class="first-letter:z-[9999] justify-center items-center flex overflow-x-hidden overflow-y-auto fixed inset-0 outline-none focus:outline-none bg-neutral-800/70"
        >
            <div
            :class=" 'fade-in-up' "
            class="relative w-full md:w-4/6 lg:w-3/6 xl:w-2/5 my-6 mx-auto h-full lg:h-auto md:h-auto"
            >
            <div class="h-full">
                <div
                        class="h-full lg:h-auto md:h-auto border-0 rounded-lg shadow-lg relative flex flex-col w-full dark:bg-gray-950 bg-white outline-none focus:outline-none"
                    >
                        <div
                            class="flex items-center p-6 rounded-t justify-center relative border-b-[1px]"
                        >
                            <button
                                @click="$emit('closeLogin')"
                                class="p-1 border-0 hover:opacity-70 transition absolute left-9"
                            >
                                <svg
                                    stroke="currentColor"
                                    fill="currentColor"
                                    stroke-width="0"
                                    viewBox="0 0 512 512"
                                    height="18"
                                    width="18"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        d="M405 136.798L375.202 107 256 226.202 136.798 107 107 136.798 226.202 256 107 375.202 136.798 405 256 285.798 375.202 405 405 375.202 285.798 256z"
                                    ></path>
                                </svg>
                            </button>
                            <div class="text-lg font-semibold">Login</div>
                        </div>
                        <div class="relative p-6 flex-auto">
                            <div class="flex flex-col gap-4">
                                <div class="text-start">
                                    <div class="text-2xl font-bold">
                                        Welcome back
                                    </div>
                                    <div
                                        class="font-light text-neutral-500 mt-2"
                                    >
                                        Login to your account!
                                    </div>
                                </div>
                                <div class="w-full relative">
                                    <input
                                        id="email"
                                        v-model="formData.email"
                                        type="text"
                                        class="peer w-full p-4 pt-6 font-light dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                    /><label
                                        class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                        >Email</label
                                    >
                                    <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.hasOwnProperty('email')">{{ formErrors.email[0] }}</div>
                                </div>
                                <div class="w-full relative">
                                    <input
                                    
                                        id="password"
                                        v-model="formData.password"
                                        type="password"
                                        class="peer w-full p-4 pt-6 font-light dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                    /><label
                                        class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                        >Password</label
                                    >
                                    <div class="text-xs font-bold -mb-4 text-red-600" v-if="formErrors.hasOwnProperty('password')">{{ formErrors.password[0] }}</div>
                                    <!-- Wrong username Or Password -->
                                    <div class="text-xs font-bold -mb-4 text-red-600" v-else-if="(typeof formErrors == 'string')">{{ formErrors }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 p-6">
                            <div
                                class="flex flex-row items-center gap-4 w-full"
                            >
                                <button @click="postFormData"
                                    class="focus:ring-4 focus:ring-rose-300 focus:outline-none dark:focus:ring-rose-700 relative disabled:opacity-70 disabled:cursor-not-allowed rounded-lg hover:opacity-80 transition w-full bg-rose-500 border-white text-white text-md py-3 font-semibold border"
                                >
                                    Continue
                                </button>
                            </div>
                            <div class="flex flex-col gap-4 mt-3">
                                <hr />
                                <div
                                    class="text-neutral-500 text-center mt-4 font-light"
                                >
                                    <p>
                                        First time using Rentlots?
                                        <span @click="$emit('closeLogin'),$emit('openRegister')"
                                            class="text-neutral-900 dark:text-zinc-100  cursor-pointer hover:underline"
                                        >
                                            Create an account</span>
                                        
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</template>
