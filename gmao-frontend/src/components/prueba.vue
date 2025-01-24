<template>
    <div class="incident-detail">
      <div class="incident-header">
        <h2 class="incident-title">{{ incidencia.titulo }}</h2>
      </div>
      <ul class="incident-info">
        <li>
          <span class="info-label">Fecha:</span> {{ incidencia.fechaReporte }}
        </li>
        <li>
          <span class="info-label">Máquina:</span> {{ incidencia.machine.nombre }}
        </li>
        <li>
          <span class="info-label">Gravedad:</span> {{ incidencia.gravedad }}
        </li>
        <li>
          <span class="info-label">Tipo de avería:</span> {{ incidencia.breakdown.nombre }}
        </li>
        <li>
          <p class="incident-description">{{ incidencia.descripcion }}</p>
          <button type="button" class="btn btn-registrar w-100" @click="tomarIncidencia">Tomar incidencia</button>
          <button type="button" class="btn btn-registrar w-100" data-bs-toggle="modal" data-bs-target="#leaveIncidentModal">Dejar incidencia</button>
        </li>
      </ul>
    </div>
    
    <!-- Modal Dejar Incidencia -->
    <div class="modal" id="leaveIncidentModal" tabindex="-1" ref="leaveIncidentModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Dejar incidencia</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="reasonSelect" class="form-label">Motivo:</label>
              <select class="form-select" id="reasonSelect" v-model="leaveReason">
                <option value="">Selecciona un motivo</option>
                <option value="falta_herramientas">Falta de herramientas</option>
                <option value="falta_conocimiento">Falta de conocimiento técnico</option>
                <option value="falta_piezas">Falta de piezas</option>
                <option value="falta_tiempo">Falta de tiempo</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="leaveComment" class="form-label">Comentarios:</label>
              <textarea class="form-control" id="leaveComment" rows="3" v-model="leaveComment"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-dejar" @click="dejarIncidencia">Dejar incidencia</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  export default {
    props: ['idIncidencia', 'userId'], // Asegúrate de pasar el userId como prop
    name: "IncidentDetail",
    data() {
      return {
        incidencia: {
          breakdown: { nombre: '' },
          machine: { nombre: '' },
        },
        leaveReason: '',
        leaveComment: '',
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
      async tomarIncidencia() {
        try {
          const intervention = {
            userId: this.userId, // ID del usuario logueado
            incidenceId: this.idIncidencia, // ID de la incidencia
            timestamp: new Date().toISOString(), // Fecha y hora actual
          };
  
          // Realiza la llamada a la API para registrar la intervención
          const response = await axios.post('http://127.0.0.1:8000/api/interventions', intervention);
          console.log('Intervención registrada:', response.data);
          // Aquí puedes agregar lógica adicional, como mostrar un mensaje de éxito
        } catch (error) {
          console.error('Error al tomar la incidencia:', error);
        }
      },
      async dejarIncidencia() {
        try {
          // Aquí implementarías la lógica para dejar la incidencia
          console.log('Motivo:', this.leaveReason);
          console.log('Comentario:', this.leaveComment);
          // Cerrar el modal
          const modal = bootstrap.Modal.getInstance(this.$refs.leaveIncidentModal);
          modal.hide();
        } catch (error) {
          console.error('Error al dejar la incidencia:', error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos aquí */
  </style>