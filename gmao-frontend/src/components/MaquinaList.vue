<template>
    <div>
      <h2 class="section-title">Maquinas</h2>
      <div v-for="maquina in maquinas" :key="maquina.idMaquina" class="card">
        <div class="card-body">
          <h5 class="card-title">
            <router-link :to="{ name: 'MaquinasView', params: { id: maquina.idMaquina } }">
              {{ maquina.nombre }}
            </router-link>
          </h5>
          <p class="card-text text-muted">
            <small>{{ maquina.idMaquina }}</small>
          </p>
          <p class="card-text">{{ maquina.prioridad }}</p>
          <p class="card-text">{{ maquina.idCampus }}</p>
          <p class="card-text">{{ maquina.idSeccion }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "MaquinaList",
    data() {
      return {
        maquinas: [], // Inicializamos como array vacío
      };
    },
    created() {
      this.fetchMaquinas();
    },
    methods: {
      async fetchMaquinas() {
        try {
          const response = await axios.get(
            "http://127.0.0.1:8000/api/machines"
          ); // Ajusta la URL según tu API
          this.incidencias = response.data;
        } catch (error) {
          console.error("Error al obtener las maquinas:", error);
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
  