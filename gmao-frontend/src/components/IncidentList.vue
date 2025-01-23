<template>
  <div>
    <h2 class="section-title">
      Incidencias
      <select v-model="selectedCampus" class="form-select" style="margin-left: 10px;">
        <option value="">Seleccionar campus</option>
        <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">{{ campus.nombre }}</option>
      </select>
    </h2>

    <!-- Mostrar mensaje si no hay incidencias filtradas -->
    <p v-if="filteredIncidencias.length === 0" class="text-muted">
      No hay incidencias en este campus.
    </p>

    <!-- Renderizar incidencias si hay resultados -->
    <div v-for="incidencia in filteredIncidencias" :key="incidencia.idIncidencia" class="card">
      <div class="card-body">
        <h5 class="card-title">
          <router-link :to="{ name: 'IncidenciaView', params: { id: incidencia.idIncidencia } }">
            {{ incidencia.titulo }}
          </router-link>
          <button @click="abrirModalDeshabilitar(incidencia)" class="btn btn-deshabilitar">
            Deshabilitar
          </button>
        </h5>
        <p class="card-text text-muted">
          <small>{{ formatDate(incidencia.fechaReporte) }}</small>
        </p>
        <p class="card-text"><b>Maquina: </b>{{ incidencia.machine.nombre }}</p>
        <p class="card-text"><b>Gravedad: </b>{{ getGravedad(incidencia.gravedad) }}</p>
        <p class="card-text"><b>Descripcion: </b>{{ incidencia.descripcion }}</p>
        <p class="card-text"><b>Averia: </b>{{ averias.find(averia => averia.idAveria === incidencia.idAveria)?.nombre
          }}</p>
      </div>
    </div>

    <div class="modal" id="disableModal" tabindex="-1" ref="disableModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Deshabilitar incidencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <p class="mb-2">
              <strong>Incidencia:</strong> {{ incidenciaSeleccionada ? `${incidenciaSeleccionada.titulo} ` : '' }}
            </p> 
            <p class="mb-3">
              <strong>¿Estás seguro de que deseas deshabilitar esta incidencia?</strong>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-registrar" @click="deshabilitarIncidencia">Deshabilitar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "IncidentList",
  data() {
    return {
      incidencias: [],
      averias: [],
      selectedCampus: "",
      campuses: [],
      gravedades: {
        1: 'Maquina parada',
        2: 'Maquina funcionando',
        3: 'Aviso',
        4: 'Mantenimiento'
      },
      incidenciaSeleccionada: null,
    };
  },
  created() {
    this.fetchIncidences();
    this.fetchAverias();
    this.fetchCampuses();
  },
  computed: {
    filteredIncidencias() {
      if (!this.selectedCampus) return this.incidencias;
      return this.incidencias.filter(incidencia => {
        const campusId = this.selectedCampus.toString();
        const machineId = incidencia.machine.idMaquina.toString();
        return machineId.startsWith(campusId);
      });
    }
  },
  methods: {
    async fetchIncidences() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/incidences");
        this.incidencias = response.data;
      } catch (error) {
        console.error("Error al obtener las incidencias:", error);
      }
    },
    async fetchAverias() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/breakdowns");
        this.averias = response.data;
      } catch (error) {
        console.error("Error al obtener las averías:", error);
      }
    },
    async fetchCampuses() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/campuses");
        this.campuses = response.data;
      } catch (error) {
        console.error("Error al obtener los campus:", error);
      }
    },
    updateList(newReport) {
      this.incidencias.push(newReport);
    },
    formatDate(dateString) {
      if (!dateString) return '';
      const date = new Date(dateString);
      return date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      });
    },
    getGravedad(gravedadId) {
      return this.gravedades[gravedadId] || 'Desconocido';
    },
    abrirModalDeshabilitar(incidencia) {
      this.incidenciaSeleccionada = incidencia;
      this.modalDeshabilitar.show();
    },
    async deshabilitarIncidencia() {
      try {
        await axios.post(`http://127.0.0.1:8000/api/incidences/deshabilitar/${this.incidenciaSeleccionada.idIncidencia}`);
        this.incidencias = this.incidencias.filter(incidencia => incidencia.idIncidencia !== this.incidenciaSeleccionada.idIncidencia);
        this.modalDeshabilitar.hide();
      } catch (error) {
        console.error("Error al deshabilitar la incidencia:", error);
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
