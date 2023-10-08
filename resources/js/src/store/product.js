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
                await axios.get(`/api/products?page=${pageId}`)
                .then(response =>{
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
            }
            else
            {
                await axios.get(`/api/products/category/${categoryId}`)
                .then(response =>{
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
            await axios.get(`/api/products/${productId}`)
            .then(response =>{
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
            await axios.post('/api/addproduct',formData)
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
            await axios.post('/api/addfavorite',{'product_id':productId})
                .then(response=>{
                    console.log("succes");
                })
                .catch(error=>{
                    console.log(error);
                })
        },
        async getFavoriteProducts() {
            let favProducts = [];
            await axios.get('/api/getfavorite')
                .then(response=>{
                    favProducts = response.data.map(f => f.product_id) 
                })
                .catch(error=>{
                    favProducts = [];
                })
                console.log(favProducts);
            return favProducts;
        },
        async deleteFavoriteProduct(productId) {
            await axios.post('/api/deletefavorite',{'product_id':productId})
                .then(response=>{
                    console.log("Deleted",response.data);
                })
                .catch(error=>{
                    console.log(error);
                })
        },
        
    }
});