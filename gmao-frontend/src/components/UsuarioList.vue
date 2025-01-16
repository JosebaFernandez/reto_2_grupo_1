<template>
    <div>
      <h2 class="section-title">Usuarios</h2>
      <div v-for="usuario in usuarios" :key="usuario.idUsuario" class="card">
        <div class="card-body">
          <h5 class="card-title">
            {{ usuario.nombre }} {{ usuario.apellido }}
          </h5>
          <p class="card-text text-muted">
            <small>{{ usuario.email }}</small>
          </p>
          <p class="card-text">{{ usuario.rol }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "UsuarioList",
    data() {
      return {
        usuarios: [], // Inicializamos como array vacío
      };
    },
    created() {
      this.fetchUsuarios();
    },
    methods: {
      async fetchUsuarios() {
        try {
          const response = await axios.get(
            "http://127.0.0.1:8000/api/users"
          ); // Ajusta la URL según tu API
          this.incidencias = response.data;
        } catch (error) {
          console.error("Error al obtener los usuarios:", error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .card {
    background-color: white;
    border: none;
    border-top: 1px solid #414d5b;
    margin-bottom: 1em;
    border-radius: 0;
  }
  
  .card-body {
    padding: 20px;
  }
  
  .card-title {
    font-size: 1.25rem;
    font-weight: bold;
  }
  
  .card-title a {
    text-decoration: none;
    color: #007bff;
  }
  
  .card-title a:hover {
    text-decoration: underline;
  }
  </style>
  