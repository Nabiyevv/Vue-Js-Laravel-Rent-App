import {defineStore} from 'pinia'
import axios from 'axios';
// axios.defaults.headers.common['Authorization'] = `Bearer ${acces_token}`;
export const useProductStore = defineStore({
    id: 'productStoreId',
    state: () => ({
        products:null,
        productsByCategory:null,
        productById:null,
        cache:{},
        totalPages:1,
        curretPage:1,
    }),
    actions: {
        async getProducts(pageId = 1){
            const url = `api/products`;
            if(this.cache[url])
            {
                this.products = this.cache[url];
            }
            else
            {
                await axios.get(`http://localhost:8000/api/products?page=${pageId}`,{
                // await axios.get(`http://localhost:8000/api/products/category/${categoryId}/?page=${pageId}`,{
                    headers:{
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        // "Authorization": `Bearer ${localStorage.getItem('token')}`
                    }
                })
                .then(response =>{
                    // console.log("Products",response.data);
                    // localStorage.setItem('all_products',JSON.stringify(response.data.products));
                    this.products = response.data.products.data;
                    this.totalPages = response.data.products.last_page;
                    this.curretPage = response.data.products.current_page;
                    this.cache[url] = this.products;
                })
                .catch(err=>{
                    console.log(err);
                })
            }
        },
        async getProductsByCategory(categoryId){
            const url = `api/category/${categoryId}`;
            if(this.cache[url])
            {
                this.products = this.cache[url];
                console.log("HAve");
            }
            else
            {
                await axios.get(`http://localhost:8000/api/products/category/${categoryId}`,{
                    headers:{
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response =>{
                    console.log("ProductByCategoryId",response.data);
                    this.products = response.data.data;
                    this.cache[url] = this.products;
                    this.totalPages = response.data.last_page;
                    this.curretPage = response.data.current_page;
                })
                .catch(err=>{
                    console.log("getProductByCategory");
                })
            }
        },
        async getProductsById(productId){
            var resData = {};
            const url = `/item/${productId}`;
            if(this.cache[url])
            {
                return this.cache[url];
            }
            await axios.get(`http://localhost:8000/api/products/${productId}`,{
                headers:{
                    'Accept' : 'application/json',
                    'Content-Type': 'application/json',
                }
            })
            .then(response =>{
                console.log("ProductById",response.data);
                resData = response.data;
                this.cache[url] = resData;
                return resData;
            })
            .catch(err=>{
                console.log(err);
                resData = null;
            })
            return resData;
        },
        async addProduct(formData) {
            console.log(formData);
            let formErrors={};
            await axios.post('http://localhost:8000/api/addproduct',formData,{
                headers: {
                    'Accept' : 'application/json',
                    'Content-Type': 'multipart/form-data',
                    "Authorization": `Bearer ${localStorage.getItem('token')}`
                },
            })
            .then(response=>{
                console.log(response.data);
                this.cache = {};
            })
            .catch(error=>{
                console.log(error);
                formErrors = error.response.data.errors;
            })
            return formErrors;
        },
        async addFavoriteProduct(productId) {
            console.log(productId);
            await axios.post('http://localhost:8000/api/addfavorite',{'product_id':productId},{
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        "Authorization": `Bearer ${localStorage.getItem('token')}`
                    },
                })
                .then(response=>{
                    console.log(response);
                    console.log("succes");
                })
                .catch(error=>{
                    console.log(error);
                    // formErrors = error.response.data.errors;
                })
        },
        async getFavoriteProducts() {
            let favProducts = [];
            await axios.get('http://localhost:8000/api/getfavorite',{
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        "Authorization": `Bearer ${localStorage.getItem('token')}`
                    },
                })
                .then(response=>{
                    console.log("RES",response.data);
                    // favProducts = response.data;
                    favProducts = response.data.map(f => f.product_id) 
                    // return response.data;
                })
                .catch(error=>{
                    console.log(error);
                    favProducts = [];
                })
                console.log(favProducts);
                // favorites.includes(this.index)
            return favProducts;
        },
        async deleteFavoriteProduct(productId) {
            await axios.post('http://localhost:8000/api/deletefavorite',{'product_id':productId},{
                    headers: {
                        'Accept' : 'application/json',
                        'Content-Type': 'application/json',
                        "Authorization": `Bearer ${localStorage.getItem('token')}`
                    },
                })
                .then(response=>{
                    console.log("Deleted",response.data);
                })
                .catch(error=>{
                    console.log(error);
                })
        },
        
    }
});