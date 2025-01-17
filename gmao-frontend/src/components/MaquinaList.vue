<template>
    <div>
      <h2 class="section-title">Maquinas</h2>
      <div v-for="maquina in maquinas" :key="maquina.idMaquina" class="card">
        <div class="card-body">
          <h5 class="card-title">
              {{ maquina.nombre }}
          </h5>
          <p class="card-text text-muted">
            <small>{{ maquina.idMaquina }}</small>
          </p>
          <p class="card-text"><b>Prioridad: </b>{{ maquina.prioridad }}</p>
          <p class="card-text"><b>Campus: </b>{{ getCampusName(maquina.idCampus) }}</p>
          <p class="card-text"> <b>Seccion: </b> {{ maquina.idSeccion }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from "axios";
  
  export default {
    name: "MaquinaList",
    props: {
    campuses: {
      type: Array,
      required: true,
    },
  },
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
          this.maquinas = response.data; // Asignamos los datos a this.maquinas
        } catch (error) {
          console.error("Error al obtener las maquinas:", error);
        }
      },
    getCampusName(id) {
      const campus = this.campuses.find((campus) => campus.idCampus === id);
      return campus ? campus.nombre : "Desconocido";
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
  
  </style>