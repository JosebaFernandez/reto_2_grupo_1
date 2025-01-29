<template>
  <div>
    <h2 class="section-title">
      Maquinas
      <select v-model="selectedCampus" class="form-select" style="margin-left: 10px;">
        <option value="">Seleccionar campus</option>
        <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">{{ campus.nombre }}</option>
      </select>
    </h2>

    <!-- Mostrar mensaje si no hay máquinas filtradas -->
    <p v-if="filteredMaquinas.length === 0" class="text-muted">
      No hay máquinas en este campus.
    </p>

    <!-- Renderizar máquinas si hay resultados -->
    <div v-for="maquina in filteredMaquinas" :key="maquina.idMaquina" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ maquina.nombre }}
          <button @click="abrirModalDeshabilitar(maquina)" class="btn btn-deshabilitar">
            Deshabilitar
          </button>
        </h5>
        <p class="card-text text-muted">
          <small>{{ maquina.idMaquina }}</small>
        </p>
        <p class="card-text"><b>Prioridad: </b>{{ maquina.prioridad }}</p>
        <p class="card-text"><b>Campus: </b>{{ getCampusName(maquina.idCampus) }}</p>
        <p class="card-text"><b>Sección: </b> {{ maquina.idSeccion }}</p>
      </div>
    </div>
    <div class="modal" id="disableModal" tabindex="-1" ref="disableModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deshabilitar maquina</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">
              <strong>Maquina:</strong> {{ maquinaSeleccionada ? `${maquinaSeleccionada.nombre} ` : '' }}
            </p> 
            <p class="mb-3">
              <strong>¿Estás seguro de que deseas deshabilitar esta maquina?</strong>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-registrar" @click="deshabilitarMaquina">Deshabilitar</button>
          </div>
        </div>
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
      maquinas: [],
      selectedCampus: "", // Campus seleccionado para el filtro
      maquinaSeleccionada: null, // Maquina seleccionada para deshabilitar
    };
  },
  created() {
    this.fetchMaquinas();
  },
  computed: {
    filteredMaquinas() {
      if (!this.selectedCampus) return this.maquinas;
      return this.maquinas.filter(maquina => maquina.idCampus.toString() === this.selectedCampus.toString());
    },
  },
  methods: {
    async fetchMaquinas() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/machines");
        this.maquinas = response.data;
      } catch (error) {
        console.error("Error al obtener las máquinas:", error);
      }
    },
    getCampusName(id) {
      const campus = this.campuses.find(campus => campus.idCampus === id);
      return campus ? campus.nombre : "Desconocido";
    },
    updateList(newMachine) {
      this.maquinas.push(newMachine);
    },
    abrirModalDeshabilitar(maquina) {
      this.maquinaSeleccionada = maquina;
      this.modalDeshabilitar.show();
    },
    async deshabilitarMaquina() {
      try {
        await axios.post(`http://127.0.0.1:8000/api/machines/deshabilitar/${this.maquinaSeleccionada.idMaquina}`);
        this.maquinas = this.maquinas.filter(maquina => maquina.idMaquina !== this.maquinaSeleccionada.idMaquina);
        this.modalDeshabilitar.hide();
      } catch (error) {
        console.error("Error al deshabilitar la maquina:", error);
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
}

.form-select {
  display: inline-block;
  width: auto;
}
.btn-deshabilitar {
  background-color: #dc3545;
  color: white;
  margin-right: 10px;
  margin-left: 1em;
}
.btn-deshabilitar:hover {
  background-color: #c82333;
}
.btn-registrar {
background-color: #84005d;
color: white;
margin-right: 10px;
}
.btn-registrar:hover {
  background-color: #6d004d;
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
