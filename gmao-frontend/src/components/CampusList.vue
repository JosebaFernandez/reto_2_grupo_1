<template>
    <div>

      <div v-for="campus in campuses" :key="campus.idCampus" class="card">
        <div class="card-body">
          <h5 class="card-title">
              {{ campus.nombre }}
        </h5>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "CampusList",
    data() {
      return {
        campuses: [], // Inicializamos como array vacío
      };
    },
    created() {
      this.fetchCampus();
    },
    methods: {
      async fetchCampus() {
        try {
          const response = await axios.get(
            "http://127.0.0.1:8000/api/campuses"
          ); // Ajusta la URL según tu API
          this.campuses = response.data;
        } catch (error) {
          console.error("Error al obtener los campuses:", error);
        }
      },
      updateList(newCampus) {
        this.campuses.push(newCampus);
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
  }
  
  
  </style>
  