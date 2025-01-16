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
          <small>{{ incidencia.fechaReporte }}</small>
        </p>
        <p class="card-text">{{ incidencia.idMaquina }}</p>
        <p class="card-text">{{ incidencia.descripcion }}</p>
        <span :class="['badge', incidencia.estadoIncidencia]">{{ incidencia.estadoIncidencia }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "IncidentList",
  data() {
    return {
      incidencias: [], // Inicializamos como array vacío
    };
  },
  created() {
    this.fetchIncidents();
  },
  methods: {
    async fetchIncidents() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/incidences'); // Ajusta la URL según tu API
        this.incidencias = response.data;
      } catch (error) {
        console.error('Error al obtener las incidencias:', error);
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

.badge {
  font-size: 0.9rem;
  padding: 5px 10px;
  border-radius: 5px;
}
</style>
