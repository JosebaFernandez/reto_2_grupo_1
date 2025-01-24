import { createRouter, createWebHistory } from "vue-router";
import Home from "../views/Home.vue";
import IncidenciaView from "@/views/IncidenciaView.vue";
import MaquinasView from "@/views/MaquinasView.vue";
import UsuariosView from "@/views/UsuariosView.vue";
import OtrosView from "@/views/OtrosView.vue";
import TareasView from "@/views/TareasView.vue";
import LoginView from "@/views/LoginView.vue";

const routes = [
  {
    path: "/", // Ruta raíz
    name: "Login",
    component: LoginView,
  },
  {
    path: "/home",
    name: "Home",
    component: Home,
    meta: { requiresAuth: true, roles: ["admin", "tecnico", "operario"] },
  },
  {
    path: "/incident/:id",
    name: "IncidenciaView",
    component: IncidenciaView,
    props: true,
    meta: { requiresAuth: true, roles: ["admin", "tecnico"] },
  },
  {
    path: "/maquinas",
    name: "MaquinasView",
    component: MaquinasView,
    props: true,
    meta: { requiresAuth: true, roles: ["admin"] },
  },
  {
    path: "/usuarios",
    name: "UsuariosView",
    component: UsuariosView,
    props: true,
    meta: { requiresAuth: true, roles: ["admin"] },
  },
  {
    path: "/tareas",
    name: "TareasView",
    component: TareasView,
    props: true,
    meta: { requiresAuth: true, roles: ["admin", "tecnico"] },
  },
  {
    path: "/otros",
    name: "OtrosView",
    component: OtrosView,
    props: true,
    meta: { requiresAuth: true, roles: ["admin"] },
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
});

// Middleware para proteger las rutas
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem("token");
  const rol = localStorage.getItem("rol");

  // Verifica si la ruta requiere autenticación
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!token) {
      // Si no hay token, redirige al login
      return next({ name: "Login" });
    }

    // Verifica si el rol del usuario tiene permiso para acceder a la ruta
    if (to.meta.roles && !to.meta.roles.includes(rol)) {
      return next({ name: "Home" }); // Redirige a "Home" si no tiene permiso
    }
  }

  next(); // Permite el acceso
});

export default router;
