<script>
import axios from "axios";
import { getCategories } from "./Categories.vue";
import {useUserStore} from '../store/user'
import {useProductStore} from '../store/product'

export default {
    data() {
        return {
            categories: getCategories(),
            formData: {
                title: "",
                description: "",
                price: "",
                city: "Baku",
                count: 1,
                category: 0,
                image: '',
                location:"Xirdalan",
                user_id:1

            },
            formErrors:'',
            userStore:useUserStore(),
            productStore:useProductStore(),
        };
     },
    methods: {
        async postProduct(){
            this.formErrors = await this.productStore.addProduct(this.formData);
            if(typeof this.formErrors === 'undefined')
            {
                this.formErrors = {};
            }
            this.formData = {};
        },    
        onFileChange(e) {
            this.formData.image = e.target.files[0];
            // console.log(e.target.files[0]);
        },
    },
};
</script>

<template>
    <div
        class="reg z-[9999] justify-center items-center flex overflow-x-hidden overflow-y-auto fixed inset-0 outline-none focus:outline-none bg-neutral-800/70"
    >
        <div
            class="relative w-full md:w-4/6 lg:w-3/6 xl:w-2/5 my-6 mx-auto h-full lg:h-auto md:h-auto"
            >
            <!-- :class="'fade-in-up'" -->
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
                        <div class="text-lg font-semibold">Rent Stuff</div>
                    </div>
                    <div class="relative p-6 flex-auto">
                        <div class="flex flex-col gap-4 ">
                            <div class="text-start">
                                <div class="text-2xl font-bold">
                                    Add Rent Item
                                </div>
                            </div>
                            <div class="w-full relative">
                                <input
                                    id="title"
                                    name="title"
                                    placeholder=" "
                                    v-model="formData.title"
                                    type="text"
                                    class="peer w-full p-4 pt-6  dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                /><label
                                    class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                    >Title</label
                                >
                                <!-- Error Message -->
                                <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.title">{{ formErrors.title[0] }}</div>
                            </div>
                            <div class="w-full relative">
                                <select
                                    v-model="formData.category"
                                    class="peer w-full p-4 pt-6 text-zinc-400 dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                >
                                    <option
                                        v-for="(category, index) in categories"
                                        :value="index"
                                        :selected="index == 0"
                                    >
                                        {{ category.label }}
                                    </option>
                                </select>
                                <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.category">{{ formErrors.category[0] }}</div>
                            </div>
                            <div class="w-full relative">
                                <textarea
                                    id="description"
                                    name="description"
                                    v-model="formData.description"
                                    placeholder=" "
                                    type="text"
                                    class="peer w-full p-4 pt-6  dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                /><label
                                    class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                    >Description</label
                                >
                                <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.description">{{ formErrors.description[0] }}</div>
                                
                            </div>
                            <div class="w-full relative">
                                <input
                                    id="price"
                                    name="price"
                                    placeholder=" "
                                    v-model="formData.price"
                                    type="number"
                                    class="peer w-full p-4 pt-6  dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                /><label
                                    class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                    >Price</label
                                >
                                <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.price">{{ formErrors.price[0] }}</div>

                            </div>
                            <div class="w-full relative">
                                <input
                                    id="count"
                                    name="count"
                                    placeholder=" "
                                    v-model="formData.count"
                                    type="number"
                                    class="peer w-full p-4 pt-6  dark:bg-gray-800 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                                /><label
                                    class="absolute text-md duration-150 transform -translate-y-3 top-5 z-10 origin-[0] left-4 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 text-zinc-400"
                                    >Count</label
                                >
                                <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.count">{{ formErrors.count[0] }}</div>

                            </div>
                            <div class="w-full relative ">
                        
                                <label for="image" class="sr-only">Choose file</label>
                                <input
                                @change="onFileChange"
                                    id="image"
                                    name="image"
                                    placeholder=" "
                                    type="file"
                                    accept="image/*" 
                                  class="block w-full border-2 dark:bg-gray-800 shadow-sm rounded-md text-sm font-bold focus:z-10 focus:border-blue-500 focus:ring-blue-500  border-neutral-300 text-gray-400
                                  file:bg-transparent file:border-0
                                  file:bg-gray-200 file:mr-4
                                  file:p-4 file:font-medium
                                  dark:file:bg-gray-950 file:text-gray-600 dark:file:text-gray-400">
                                  <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.image">{{ formErrors.image[0] }}</div>

                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2 p-6">
                        <div class="flex flex-row items-center gap-4 w-full">
                            <button
                                @click="postProduct"
                                class="focus:ring-4 focus:ring-rose-300 focus:outline-none dark:focus:ring-rose-700 relative disabled:opacity-70 disabled:cursor-not-allowed rounded-lg hover:opacity-80 transition w-full bg-rose-500 border-white text-white text-md py-3 font-semibold border"
                            >
                                Continue
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
