import axios from 'axios';
import { createRouter, createWebHistory, createWebHashHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Home.vue')
    },
    {
      path:'/items/:id',
      name:'categoryItem',
      component:()=> import('../views/CartItem.vue')
    },
    {
      path:'/category/:categoryName',
      component: () => import('../views/Categories.vue'),
    },
    // {
    //   path:'/favorite',
    //   component: () => import('../views/FavoriteProducts.vue'),
    // },
    {
      path:'/profile',
      beforeEnter: async (to, from, next) => {
        try{
          const data = await axios.get('/api/user')
          next();
        }
        catch{
          next({name:'home'});
        }
       
      },
      component: () => import('../views/ProfileSetting.vue'),
    },

  ]
})

export default router
