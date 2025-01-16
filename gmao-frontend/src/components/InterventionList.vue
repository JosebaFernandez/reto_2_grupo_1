<template>
  <div>
    <h2 class="section-title">Intervenciones</h2>
    <div v-if="intervenciones.length === 0">
      <p>No hay intervenciones disponibles.</p>
    </div>
    <div v-else>
      <div v-for="intervencion in intervenciones" :key="intervencion.idIntervencion" class="card">
        <div class="intervenciones">
          <p class="card-text">{{ intervencion.idTecnico }} <b>FALTA NOMBRE DEL TECNICO</b></p>
          <p class="card-text">{{ intervencion.fechaInicio }}-{{ intervencion.fechaFin }}</p>
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
  