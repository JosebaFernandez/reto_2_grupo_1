<template>
  <div class="incident-detail">
    <div class="incident-header">
      <h2 class="incident-title">{{ incidencia.titulo }}</h2>
      <span :class="['badge', getBadgeClass(incidencia.estadoIncidencia)]">
        {{ incidencia.estadoIncidencia }}
      </span>
    </div>
    <ul class="incident-info">
      <li>
        <span class="info-label">Fecha:</span> {{ incidencia.fechaReporte }}
      </li>
      <li>
        <span class="info-label">Máquina:</span> {{ incidencia.idMaquina }}
      </li>
      <li>
        <span class="info-label">Gravedad:</span> {{ incidencia.gravedad }}
      </li>
      <li>
        <span class="info-label">Tipo de avería: FALTA IMPLEMENTAR</span>
      </li>
      <li>
        <p class="incident-description">{{ incidencia.descripcion }}</p>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  props: ['idIncidencia'],
  name: "IncidentDetail",
  data() {
    return {
      incidencia: [],
    };
  },
  created() {
    this.fetchIncidence();
  },
  methods: {
    async fetchIncidence() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/incidences/' + this.idIncidencia);
        this.incidencia = response.data;
      } catch (error) {
        console.error('Error al obtener la incidencia:', error);
      }
    },
    // Método para obtener la clase según el estado del incidente
    getBadgeClass(estado) {
      switch (estado) {
        case "Pendiente":
          return "bg-danger text-white";
        case "Resuelta":
          return "bg-success text-white";
        case "En Progreso":
          return "bg-warning text-dark";
        default:
          return "bg-secondary text-white"; // Clase por defecto
      }
    },
  },
};
</script>

<style scoped>
.incident-detail {
  background-color: white;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.incident-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1em;
}

.incident-title {
  font-size: 1.5rem;
  font-weight: bold;
}

.incident-info {
  list-style: none;
  padding: 0;
}

.info-label {
  font-weight: bold;
}

.incident-description {
  margin-top: 0.5em;
  font-style: italic;
}

.badge {
  font-size: 0.85rem;
  padding: 5px 10px;
  border-radius: 5px;
}

.text-white {
  color: white;
}
</style>