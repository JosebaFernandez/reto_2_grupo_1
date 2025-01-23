import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import IncidenciaView from "@/views/IncidenciaView.vue";
import MaquinasView from "@/views/MaquinasView.vue";
import UsuariosView from "@/views/UsuariosView.vue";
import OtrosView from "@/views/OtrosView.vue";
import TareasView from "@/views/TareasView.vue";
import LoginView from '@/views/LoginView.vue';



const routes = [
  {
    path: '/', // Ruta raíz
    name: 'Login',
    component: LoginView,
  },  
  {
    path: "/home",
    name: "Home",
    component: Home,
  },
  {
    path: "/incident/:id",
    name: "IncidenciaView",
    component: IncidenciaView,
    props: true,
  },
  {
    path: "/maquinas",
    name: "MaquinasView",
    component: MaquinasView,
    props: true,
  },
  {
    path: "/usuarios",
    name: "UsuariosView",
    component: UsuariosView,
    props: true,
  },
  {
    path: "/tareas",
    name: "TareasView",
    component: TareasView,
    props: true,
  },
  {
    path: "/otros",
    name: "OtrosView",
    component: OtrosView,
    props: true,
  },
  // Puedes añadir más rutas aquí en el futuro
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Middleware para verificar token
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const token = localStorage.getItem('token');
    if (!token) {
      next({ name: 'Login' });
    } else {
      // Verificar token JWT
      fetch("http://127.0.0.1:8000/api/user", {
        method: "GET",
        headers: {
          "Authorization": `Bearer ${token}`
        }
      })
      .then(response => response.json())
      .then(data => {
        if (response.ok) {
          next();
        } else {
          next({ name: 'Login' });
        }
      })
      .catch(() => next({ name: 'Login' }));
    }
  } else {
    next();
  }
});

export default router;
