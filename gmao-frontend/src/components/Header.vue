<template>
  <div class="header">
    <img src="../assets/logo_egibide.png" alt="Logo" width="150px" />
    <div class="menu"> <router-link :to="{ name: 'Home' }">
        Home
      </router-link></div>
    <div class="menu"><router-link :to="{ name: 'MaquinasView' }">
      Maquinas
    </router-link></div>
    <div class="menu"><router-link :to="{ name: 'UsuariosView' }">
      Usuarios
    </router-link></div>
    <div class="menu"><router-link :to="{ name: 'OtrosView' }">
      Otros
    </router-link></div>
    
    <div class="user">Usuario</div>
  </div>
</template>

<script>
export default {
  name: "Header",
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
</style>