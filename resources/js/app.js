import './bootstrap';

import {createApp} from 'vue';
import { createRouter, createWebHistory, RouterLink, RouterView  } from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import App from './components/App.vue';
import Demo from './components/Demo.vue';
import Home from './components/Home.vue';
import Add from './components/category/Add.vue';
import Edit from './components/category/Edit.vue';
import List from './components/category/List.vue';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css'

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
    {
      path: "/demo",
      name: "Demo",
      component: Demo,
    },
    {
      path: "/category/add",
      name: "Add",
      component: Add,
    },
    {
      path: "/category/edit/:id",
      name: "Edit",
      component: Edit,
    },
    {
      path: "/category/list",
      name: "List",
      component: List,
    },
  ];


const router = createRouter({
  history: createWebHistory(),
  routes,
});

const app = createApp(App);
app.use(router);
app.use(PrimeVue);
app.mount('#app');


 
 
