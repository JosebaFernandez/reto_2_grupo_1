<template>
  <div id="app">
    <Header />
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
};
</script>
<style>
/* Puedes mantener estilos globales aquí si es necesario */
body {
  font-family: Arial, sans-serif;
  background-color: #ffffff; /* Fondo blanco */
  color: #000000; /* Texto negro por defecto */
  margin: 0;
  padding: 0;
}
</style>
