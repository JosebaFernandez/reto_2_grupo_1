<template>
  <div>
    <h2 class="section-title">Intervenciones</h2>
    <div v-if="intervenciones.length === 0">
      <p>No hay intervenciones disponibles.</p>
    </div>
    <div v-else>
      <div v-for="intervencion in intervenciones" :key="intervencion.idIntervencion" class="card">
        <div class="intervenciones">
          <p class="card-text">{{ intervencion.tecnico.nombre + " " + intervencion.tecnico.apellido }}</p>
          <p class="card-text">{{ formatDate(intervencion.fechaInicio) }} - {{ formatDate(intervencion.fechaFin) }}</p>
          <p v-if="intervencion.motivo != null" class="card-text">Motivo abandono: {{ intervencion.motivo }}</p>
          <p class="card-text">{{ intervencion.notas }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
    
  
  <script>
  import axios from 'axios';
  export default {
    props: ['idIncidencia'],
    name: "InterventionList",
    data() {
    return {
      intervenciones: [],
    };
    },
    created() {
      this.fetchInterventions();
    },
    methods: {
      formatDate(dateString) {
      if (!dateString) return 'En curso';
      const date = new Date(dateString);
      return date.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit', 
        minute: '2-digit' 
      });
    },
      async fetchInterventions() {
        try {
          const response = await axios.get('http://127.0.0.1:8000/api/interventions/' + this.idIncidencia);
          this.intervenciones = response.data;
        } catch (error) {
          console.error('Error al obtener las intervenciones:', error);
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
  .card-text {
      font-size: 1rem;
    }
  .intervenciones {
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: white;
      padding: 20px;
      height: 100%;
    }
  </style>
  