import {defineStore} from 'pinia'
import {useProductStore} from './product'
import axios from 'axios';
// axios.defaults.headers.common['Authorization'] = `Bearer ${acces_token}`;
export const useUserStore = defineStore({
    id: 'userStoreId',
    state: () => ({
        user: JSON.parse(localStorage.getItem('user_data')) || '',
        token:localStorage.getItem('token') || '',
        showAlert:false,
        alertType:'',
        alertTitle:'',
    }),
    actions: {
        async login(email,password) {
                let formErrors ='';
                await axios.get('/sanctum/csrf-cookie')
                await axios.post('/api/login', {'email':email,'password':password})
                .then(async response => {
                    window.location.reload();                    
                    this.token = response.data.token;
                    this.user = response.data.userData;
                    localStorage.setItem('user_data',JSON.stringify(this.user));
                    localStorage.setItem('token',this.token);
                })
                .catch(error => {
                    formErrors = error.response.data.errors;
                });
                
                return formErrors;    
        },
        async register(formData) {
            let formErrors = {};
            await axios.post('/api/register',formData)
            .then((response)=>{
                console.log(response);
            })
            .catch((error)=>{
                console.log(error.response.data.errors);
            })
            return formErrors;
        },
        async logout() {
            await axios.post('/api/logout')
            .then(response => {
                window.location.reload();
                this.token = '';
                this.user = null;
                localStorage.removeItem('token');
                localStorage.removeItem('user_data');
            })
            .catch(error => {
                console.log(error);
            });
        },
        async userData(){
            let user = null;
            await axios.get('/api/user')
            .then(response => {
                user = response.data;
            })
            .catch(error => {
                console.log(error);
            });
            return user;
        },
        async updateUser(formData){
            let formErrors = null;
            await axios.post('/api/user',{'name':formData?.name,'contact':formData?.contact,'avatar':formData?.avatar},{
                headers:{
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then(response => {
                this.user = response.data[0];
                localStorage.setItem('user_data',JSON.stringify(this.user));
            })
            .catch(error => {
                formErrors = error.response.data.errors;
            });
            return formErrors;
        }
    }
});