<template>
    <div>

      <div v-for="seccion in secciones" :key="seccion.idSeccion" class="card">
        <div class="card-body">
          <h5 class="card-title">
            {{ seccion.nombre }}
          </h5>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "SeccionList",
    data() {
      return {
        secciones: [], // Array initialized as empty
      };
    },
    created() {
      this.fetchSections();
    },
    methods: {
      async fetchSections() {
        try {
          const response = await axios.get(
            "http://127.0.0.1:8000/api/sections"
          ); // Adjust the URL to match your API
          this.secciones = response.data; // Correct assignment to 'secciones'
        } catch (error) {
          console.error("Error al obtener las secciones:", error);
        }
      },
      updateList(newSeccion) {
        this.secciones.push(newSeccion);
      }
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
  </style>
  