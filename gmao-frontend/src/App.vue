<template>
  <div :class="{'login-page': isLoginPage}">
    <Header v-if="!isLoginPage" />
    <router-view />
  </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
  name: "App",
  components: {
    Header,
  },
  computed: {
    isLoginPage() {
      return this.$route.name === "Login"; // Verifica si la ruta es la página de login
    },
  },
};
</script>

<style>
/* Estilos globales por defecto */
body {
  font-family: Arial, sans-serif;
  background-color: #ffffff;
  color: #000000;
  margin: 0;
  padding: 0;
}

/* Estilo específico para la página de login */
.login-page {
  height: 100vh;
  overflow: hidden; /* Evita el scroll */
}

.login-page body {
  height: 100%;
}
</style>
