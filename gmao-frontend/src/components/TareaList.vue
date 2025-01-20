<template>
  <div>
    <h2 class="section-title">Tareas de Mantenimiento</h2>
    <div v-for="tarea in tareas" :key="tarea.idTarea" class="card">
      <div class="card-body">
        <h5 class="card-title">
          {{ tarea.nombre }}
        </h5>
        <p class="card-text">{{ tarea.descripcion }}</p>
        <button type="submit" class="btn btn-registrar w-400">Asignar a una maquina</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "TareaList",
  data() {
    return {
      tareas: [], // Initialize as an empty array
    };
  },
  created() {
    this.fetchTareas();
  },
  methods: {
    async fetchTareas() {
      try {
        const response = await axios.get(
          "http://127.0.0.1:8000/api/tasks"
        ); // Adjust the URL according to your API
        this.tareas = response.data; // Assign the data to this.tareas
      } catch (error) {
        console.error("Error al obtener las tareas:", error);
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
.btn-registrar {
    background-color: #84005d;
    color: white;
}
</style>