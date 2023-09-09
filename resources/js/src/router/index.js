import { createRouter, createWebHistory, createWebHashHistory } from 'vue-router'
const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/Home.vue')
    },
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (About.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
    {
      path:'/items/:id',
      // beforeEnter: (to, from, next) => {
      //   if(localStorage.getItem('token') == null) {
      //     console.log("unauthorized");
      //     next({name:'home'});
      //   } 
      //   else 
      //   next();
      // },
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
    // {
    //   path:'/profile',
    //   component: () => import('../views/ProfileSetting.vue'),
    // },

  ]
})

export default router
