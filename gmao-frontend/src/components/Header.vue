<template>
  <div class="header">
    <img src="../assets/logo_egibide.png" alt="Logo" width="150px" />
    
    <!-- Menú para todos los roles -->
    <div class="menu">
      <router-link :to="{ name: 'Home' }">Home</router-link>
    </div>

    <!-- Menú visible solo para administradores -->
    <div v-if="isAdmin" class="menu">
      <router-link :to="{ name: 'MaquinasView' }">Maquinas</router-link>
    </div>
    <div v-if="isAdmin" class="menu">
      <router-link :to="{ name: 'UsuariosView' }">Usuarios</router-link>
    </div>

    <!-- Menú visible para administradores y técnicos -->
    <div v-if="isAdmin || isTechnician" class="menu">
      <router-link :to="{ name: 'TareasView' }">Mantenimientos</router-link>
    </div>

    <!-- Menú visible solo para administradores -->
    <div v-if="isAdmin" class="menu">
      <router-link :to="{ name: 'OtrosView' }">Otros</router-link>
    </div>

    <!-- Información del usuario y logout -->
    <div class="user">
      {{ username }}
      <button @click="logout" class="logout-btn">Logout</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Header",
  data() {
    return {
      username: JSON.parse(localStorage.getItem("user"))?.nombre + " " +
        JSON.parse(localStorage.getItem("user"))?.apellido || "Usuario",
      role: localStorage.getItem("rol") || "", // Obtiene el rol del usuario desde localStorage
    };
  },
  computed: {
    isAdmin() {
      return this.role === "admin";
    },
    isTechnician() {
      return this.role === "tecnico";
    },
    isOperator() {
      return this.role === "operario";
    },
  },
  methods: {
    logout() {
      localStorage.clear(); // Limpia el almacenamiento local
      this.$router.push("/"); // Redirige al login
    },
  },
};
</script>

<style scoped>
.header {
  background-color: #343a40;
  color: white;
  padding: 15px 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
}
.user {
  font-size: 1rem;
}
.menu, a{
  font-size: 1.5rem;
  color: white;
  text-decoration: none;
}
.logout-btn {
  margin-left: 10px;
  padding: 5px 10px;
  background-color: #dc3545;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.logout-btn:hover {
  background-color: #c82333;
}
</style>