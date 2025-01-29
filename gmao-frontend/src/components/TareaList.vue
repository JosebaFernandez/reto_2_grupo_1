<template>
  <div>
    <h2 class="section-title">Tareas de Mantenimiento</h2>
    <div v-for="tarea in tareas" :key="tarea.idTarea" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ tarea.nombre }}
          
        </h5>
        <p class="card-text">{{ tarea.descripcion }}</p>
        <button @click="openModal(tarea)" class="btn btn-registrar">Asignar a una máquina</button>
        <button @click="abrirModalDeshabilitar(tarea)" class="btn btn-deshabilitar">
            Deshabilitar
        </button>
      </div>
    </div>

    <!-- Mostrar el modal para asignar tarea -->
    <AssignTask v-if="tareaSeleccionada" :visible="showModal" :task="tareaSeleccionada" @close="showModal = false" />


    <!-- Modal para deshabilitar tarea -->
    <div class="modal" id="disableModal" tabindex="-1" ref="disableModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deshabilitar tarea</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">
              <strong>Tarea:</strong> {{ tareaSeleccionada ? `${tareaSeleccionada.nombre} ` : '' }}
            </p>
            <p class="mb-3">
              <strong>¿Estás seguro de que deseas deshabilitar esta tarea?</strong>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-registrar" @click="deshabilitarTarea">Deshabilitar</button>
          </div>
        </div>
      </div>
    </div>
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
      tareaSeleccionada: null,
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
      this.tareaSeleccionada = tarea;
      this.showModal = true;
    },
    updateList(newTask) {
      this.tareas.push(newTask);
    },
    abrirModalDeshabilitar(tarea) {
      this.tareaSeleccionada = tarea;
      this.modalDeshabilitar.show();
    },
    async deshabilitarTarea() {
      try {
        await axios.post(`http://127.0.0.1:8000/api/tasks/deshabilitar/${this.tareaSeleccionada.idTarea}`);
        this.tareas = this.tareas.filter(tarea => tarea.idTarea !== this.tareaSeleccionada.idTarea);
        this.modalDeshabilitar.hide();
      } catch (error) {
        console.error("Error al deshabilitar la tarea:", error);
      }
    },
  },
  mounted() {
    this.modalDeshabilitar = new bootstrap.Modal(this.$refs.disableModal);
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

.btn-deshabilitar {
  background-color: #dc3545;
  color: white;
  margin-right: 10px;
}

.btn-registrar {
  background-color: #84005d;
  color: white;
  margin-right: 10px;
}

.modal-dialog {
  max-width: 400px;
}

:deep(.modal-backdrop.show) {
  opacity: 0.5;
}

:deep(.modal.fade .modal-dialog) {
  transform: translate(0, 0);
}
</style>
