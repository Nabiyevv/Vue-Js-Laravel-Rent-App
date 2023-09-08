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
            // console.log("🚀 ~ file: Login.vue:22 ~ postFormData ~ this.formErrors:", this.formErrors)
            if(!this.formErrors)
            {
                // console.log("🚀 ~ file: Login.vue:23 ~ postFormData ~ this.formErrors:", this.formErrors)
                this.formErrors = {};
                this.$emit('closeLogin');
            }
        }
    },
};
</script>

<template>
        <div
            class="log first-letter:z-[9999] justify-center items-center flex overflow-x-hidden overflow-y-auto fixed inset-0 outline-none focus:outline-none bg-neutral-800/70"
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
                                <!-- <button
                                    class="relative disabled:opacity-70 disabled:cursor-not-allowed rounded-lg hover:opacity-80 transition w-full bg-white border-black text-black text-md py-3 font-semibold border-2"
                                >
                                    <svg
                                        stroke="currentColor"
                                        fill="currentColor"
                                        stroke-width="0"
                                        version="1.1"
                                        x="0px"
                                        y="0px"
                                        viewBox="0 0 48 48"
                                        enable-background="new 0 0 48 48"
                                        class="absolute left-4 top-3"
                                        height="24"
                                        width="24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill="#FFC107"
                                            d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
	                                                        c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
	                                                                                    c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"
                                        ></path>
                                        <path
                                            fill="#FF3D00"
                                            d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
	                                                        C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"
                                        ></path>
                                        <path
                                            fill="#4CAF50"
                                            d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
	                        c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"
                                        ></path>
                                        <path
                                            fill="#1976D2"
                                            d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
	                        c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"
                                        ></path></svg
                                    >Continue with Google</button
                                ><button
                                    class="relative disabled:opacity-70 disabled:cursor-not-allowed rounded-lg hover:opacity-80 transition w-full bg-white border-black text-black text-md py-3 font-semibold border-2"
                                >
                                    <svg
                                        stroke="currentColor"
                                        fill="currentColor"
                                        stroke-width="0"
                                        viewBox="0 0 1024 1024"
                                        class="absolute left-4 top-3"
                                        height="24"
                                        width="24"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M511.6 76.3C264.3 76.2 64 276.4 64 523.5 64 718.9 189.3 885 363.8 946c23.5 5.9 19.9-10.8 19.9-22.2v-77.5c-135.7 15.9-141.2-73.9-150.3-88.9C215 726 171.5 718 184.5 703c30.9-15.9 62.4 4 98.9 57.9 26.4 39.1 77.9 32.5 104 26 5.7-23.5 17.9-44.5 34.7-60.8-140.6-25.2-199.2-111-199.2-213 0-49.5 16.3-95 48.3-131.7-20.4-60.5 1.9-112.3 4.9-120 58.1-5.2 118.5 41.6 123.2 45.3 33-8.9 70.7-13.6 112.9-13.6 42.4 0 80.2 4.9 113.5 13.9 11.3-8.6 67.3-48.8 121.3-43.9 2.9 7.7 24.7 58.3 5.5 118 32.4 36.8 48.9 82.7 48.9 132.3 0 102.2-59 188.1-200 212.9a127.5 127.5 0 0 1 38.1 91v112.5c.8 9 0 17.9 15 17.9 177.1-59.7 304.6-227 304.6-424.1 0-247.2-200.4-447.3-447.5-447.3z"
                                        ></path></svg
                                    >Continue with Github
                                </button> -->
                                <div
                                    class="text-neutral-500 text-center mt-4 font-light"
                                >
                                    <p>
                                        First time using Rentpal?
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
