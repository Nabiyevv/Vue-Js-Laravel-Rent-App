<template>
    <div class="text-center mt-10">
        <h3 class="uppercase font-bold text-3xl">Profile Setup</h3>
    </div>
    <div class="flex gap-16 justify-center my-12">
        <div>
            <img
                class="flex-shrink-0 object-cover mx-1 rounded-full w-48 h-48"
                :src="user?.avatar"
                v-if="user?.avatar && !previewImage"
                :alt="user?.name + ' avatar'"
            />
            <img
                v-else
                class="flex-shrink-0 object-cover mx-1 rounded-full w-48 h-48"
				:class=" {'dark:invert':!previewImage} "
				:src="previewImage || '/asset/defaultProfile.svg' "
                :alt="user?.name + ' avatar'"
            />
            <!-- <img
                v-else-if="previewImage"
                class="flex-shrink-0 object-cover mx-1 rounded-full w-48 h-48"
				:src="previewImage || '/asset/defaultProfile.svg' "
                :alt="user?.name + ' avatar'"
            /> -->

        </div>
        <div class="max-w-xl w-full mt-10">
            <div class="w-full relative mb-6">
                <label for="name" class="text-base text-gray-300"
                    >User Name</label
                >
                <input
                    id="name"
                    name="name"
                    placeholder=""
                    v-model="user.name"
                    type="text"
                    class="peer w-full mt-2 p-3 dark:bg-slate-700 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                />
                <!-- Error Message -->
                <div class="text-sm font-bold mb-0 text-red-400" v-if="formErrors?.name">{{ formErrors?.name[0] }}</div>
            </div>
            <div class="w-full relative mb-6">
                <label for="contact" class="text-base text-gray-300"
                    >Contact</label
                >
                <input
                    id="contact"
                    name="contact"
                    placeholder="+999-99-999-99-99"
                    v-model="user.contact"
                    type="text"
                    class="peer w-full mt-2 p-3 dark:bg-slate-700 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                />
                <!-- Error Message -->
                <div class="text-sm font-bold mb-0 text-red-400" v-if="formErrors?.contact">{{ formErrors.contact[0] }}</div>
            </div>
            <div class="w-full relative mb-6">
                <label for="email" class="text-base text-gray-300">Email</label>
                <input
                    disabled
                    id="email"
                    name="email"
                    placeholder=""
                    v-model="user.email"
                    type="text"
                    class="peer w-full mt-2 p-3 dark:bg-slate-700 bg-white border-2 rounded-md outline-none transition disabled:opacity-70 disabled:cursor-not-allowed pl-4 border-neutral-300 focus:border-black"
                />
                <!-- Error Message -->
                <!-- <div class="text-xs font-bold mb-0 text-red-600" v-if="formErrors.title">{{ formErrors.title[0] }}</div> -->
            </div>
            <div class="w-full relative mb-6">
                <label for="image" class="sr-only">Choose Avatar</label>
                <input
                    @change="onFileChange"
                    id="image"
                    name="image"
                    placeholder=" "
                    type="file"
                    accept="image/*"
                    class="block w-full border-2 dark:bg-gray-800 shadow-sm rounded-md 
                    text-sm font-bold focus:z-10 focus:border-blue-500 focus:ring-blue-500
                     border-neutral-300 text-gray-400 file:bg-transparent file:border-0 
                     file:bg-gray-200 file:mr-4 file:p-4 file:font-medium dark:file:bg-gray-950
                      file:text-gray-600 dark:file:text-gray-400"
                />
                <div
                    class="text-xs font-bold mb-0 text-red-600"
                    v-if="user?.avatar"
                >
                    <!-- {{ formErrors.image[0] }} -->
                </div>
            </div>
            <div class="flex items-center w-32">
                <button
                    @click="postFormData"
                    class="focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-700 relative disabled:opacity-70 disabled:cursor-not-allowed rounded-lg hover:opacity-80 transition w-full bg-blue-500 border-white text-white text-md py-3 font-semibold border"
                >
                    Continue
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { useUserStore } from "../store/user";
import Container from "../components/Container.vue";
export default {
    data() {
        return {
            user: {
                name: null,
                avatar: null,
                contact: null,
                email: null,
            },
			userAvatar:null,
            userStore: useUserStore(),
			previewImage:null,
            formErrors:null,
        };
    },
    components: {
        Container,
    },
    async created() {
        this.user = await this.userStore.userData();
    },
    methods: {
        onFileChange(e) {
			const file = e.target.files[0];
			this.userAvatar = file;
			const image = URL.createObjectURL(file);
			this.previewImage = image;
        },
		async postFormData(){
            if(this.userAvatar)
                this.user.avatar = this.userAvatar;
            this.formErrors =  await this.userStore.updateUser(this.user);

            if(!this.formErrors)
            {
                this.userStore.showAlert = true;
                this.userStore.alertTitle = 'User Updated Successfully !';
                this.userStore.alertType = 'success';
            }
		}
    },
};
</script>
