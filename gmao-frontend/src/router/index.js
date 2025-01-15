import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';

const routes = [
  {
    path: '/', // Ruta raíz
    name: 'Home',
    component: Home,
  },
  // Puedes añadir más rutas aquí en el futuro
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

export default router;
