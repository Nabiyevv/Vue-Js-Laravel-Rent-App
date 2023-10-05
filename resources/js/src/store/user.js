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
                await axios.get('http://localhost:8000/sanctum/csrf-cookie')
                await axios.post('http://localhost:8000/api/login', {'email':email,'password':password},
                {
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                    },
                    // withCredentials:true,
                    credentials: 'include',
                })
                .then(async response => {                    
                    this.token = response.data.token;
                    this.user = response.data.userData;
                    localStorage.setItem('user_data',JSON.stringify(this.user));
                    localStorage.setItem('token',this.token);
                })
                .catch(error => {
                    console.log('user',error.response.data.errors);
                    formErrors = error.response.data.errors;
                });
                
                return formErrors;    
        },
        async register(formData) {
            let formErrors ={};
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
            // axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
            await axios.post('http://localhost:8000/api/logout',{},{
                headers:{
                    "Authorization":`Bearer ${this.token}`
                }
            })
            .then(response => {
                console.log(response.data);
                this.token = '';
                this.user = null;
                localStorage.removeItem('token');
                localStorage.removeItem('user_data');
                window.location.reload();
            })
            .catch(error => {
                console.log(error);
            });
        },
        async userData(){
            let user = null;
            await axios.get('http://localhost:8000/api/user',{
                headers:{
                    "Authorization":`Bearer ${this.token}`
                }
            })
            .then(response => {
                user = response.data;
                // console.log(response.data);
             
            })
            .catch(error => {
                console.log(error);
            });
            return user;
        },
        async updateUser(formData){
            // console.log("🚀 ~ file: user.js:87 ~ updateUser ~ formData:", formData);
            let formErrors ={};
            await axios.post('http://localhost:8000/api/user',{'name':formData?.name,'contact':formData?.contact,'avatar':formData?.avatar},{
                headers:{
                    'Accept' : 'application/json',
                    'Content-Type': 'multipart/form-data',
                    "Authorization":`Bearer ${this.token}`
                }
            })
            .then(response => {
                console.log("🚀 ~ file: user.js:95 ~ updateUser ~ response:", response)
                this.user = response.data[0];
                localStorage.setItem('user_data',JSON.stringify(this.user));
            })
            .catch(error => {
                // console.log(error.response.data.errors);
                formErrors = error.response.data.errors;
            });
            return formErrors;
        }
    }
});