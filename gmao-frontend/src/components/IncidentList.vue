<template>
  <div>
    <h2 class="section-title">Incidencias</h2>
    <div v-for="incidencia in incidencias" :key="incidencia.idIncidencia" class="card">
      <div class="card-body">
        <h5 class="card-title">
          <router-link :to="{ name: 'IncidenciaView', params: { id: incidencia.idIncidencia } }">
            {{ incidencia.titulo }}
          </router-link>
        </h5>
        <p class="card-text text-muted">
          <small>{{ formatDate(incidencia.fechaReporte) }}</small>
        </p>
        <p class="card-text"><b>Maquina: </b>{{ incidencia.machine.nombre }}</p>
        <p class="card-text"><b>Gravedad: </b>{{ getGravedad(incidencia.gravedad) }}</p>
        <p class="card-text"><b>Descripcion: </b>{{ incidencia.descripcion }}</p>
        <p class="card-text"><b>Averia: </b>{{ averias.find(averia => averia.idAveria === incidencia.idAveria)?.nombre || 'No especificada' }}</p>
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
      gravedades: {
        1: 'Maquina parada',
        2: 'Maquina funcionando',
        3: 'Aviso',
        4: 'Mantenimiento'
      },
    };
  },
  created() {
    this.fetchIncidences();
    this.fetchAverias();
  },
  methods: {
    async fetchIncidences() {
      try {
        const response = await axios.get(
          "http://127.0.0.1:8000/api/incidences"
        ); // Ajusta la URL según tu API
        this.incidencias = response.data;
      } catch (error) {
        console.error("Error al obtener las incidencias:", error);
      }
    },
    async fetchAverias() {
      const response = await axios.get("http://127.0.0.1:8000/api/breakdowns");
      this.averias = response.data;
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
