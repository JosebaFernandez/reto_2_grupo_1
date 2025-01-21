<template>
  <div>
    <h2 class="section-title">Tareas de Mantenimiento</h2>
    <div v-for="tarea in tareas" :key="tarea.idTarea" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ tarea.nombre }}</h5>
        <p class="card-text">{{ tarea.descripcion }}</p>
        <button @click="openModal(tarea)" class="btn btn-registrar">Asignar a una máquina</button>
      </div>
    </div>

    <AssignTask v-if="selectedTask" :visible="showModal" :task="selectedTask" @close="showModal = false" />
  </div>
</template>

<script>
import axios from "axios";
import AssignTask from "./AssignTask.vue";

export default {
  name: "TareaList",
  components: { AssignTask },
  data() {
    return {
      tareas: [],
      showModal: false,
      selectedTask: null,
    };
  },
  created() {
    this.fetchTareas();
  },
  methods: {
    async fetchTareas() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/tasks");
        this.tareas = response.data;
      } catch (error) {
        console.error("Error al obtener las tareas:", error);
      }
    },
    openModal(tarea) {
      this.selectedTask = tarea;
      this.showModal = true;
    },
    updateList(newTask) {
      this.tareas.push(newTask);
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

.btn-registrar {
  background-color: #84005d;
  color: white;
}
</style>