import { createRouter, createWebHistory } from 'vue-router'
import store from '../store'

const routes = [
  {
    path: '/admin/dashboard',
    component: () => import('../views/admin/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'admin' }
  },
  {
    path: '/operario/dashboard',
    component: () => import('../views/operario/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'operario' }
  },
  {
    path: '/tecnico/dashboard',
    component: () => import('../views/tecnico/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'tecnico' }
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

// Navegación guard para verificar roles
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const userRole = store.state.auth.user?.role
    
    if (!userRole) {
      next('/login')
    } else if (to.meta.role && to.meta.role !== userRole) {
      next('/unauthorized')
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router 