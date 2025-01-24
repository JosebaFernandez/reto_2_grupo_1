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

        <!-- Si no hay intervención activa, mostrar "Tomar incidencia" -->
        <button v-if="!interventionActive" type="button" class="btn btn-registrar w-100" @click="tomarIncidencia">
          Tomar incidencia
        </button>

        <!-- Si hay intervención activa, mostrar "Dejar incidencia" -->
        <button v-if="interventionActive" type="button" class="btn btn-registrar w-100" data-bs-toggle="modal"
          data-bs-target="#leaveIncidentModal">
          Dejar incidencia
        </button>
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="button" class="btn btn-dejar" @click="dejarIncidencia">
            Dejar incidencia
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  props: ["idIncidencia", "userId"], // Recibimos userId como prop
  name: "IncidentDetail",
  data() {
    return {
      incidencia: {
        breakdown: { nombre: "" },
        machine: { nombre: "" },
      },
      leaveReason: "",
      leaveComment: "",
      idUsuario: JSON.parse(localStorage.getItem('user')).idUsuario || null,
      interventionActive: false, // Nueva propiedad para verificar intervención activa
    };
  },
  created() {
    this.fetchIncidence();
    this.checkActiveIntervention(); // Comprobar intervención activa al cargar el componente
  },

  methods: {
    async fetchIncidence() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/incidences/${this.idIncidencia}`
        );
        this.incidencia = response.data;
      } catch (error) {
        console.error("Error al obtener la incidencia:", error);
      }
    },
    async tomarIncidencia() {
      if (this.idUsuario === null) {
        console.error("Error: userId no está definido");
        return;
      }

      try {
        const intervention = {
          idTecnico: this.idUsuario, // Usar idUsuario definido en el estado
          idIncidencia: parseInt(this.idIncidencia),
          fechaInicio: new Date().toISOString(),
          fechaFin: null,
          notas: "",
        };
        console.log("Intervención:", intervention);
        const response = await axios.post(
          "http://127.0.0.1:8000/api/interventions",
          intervention
        );
        console.log("Intervención registrada:", response.data);

        // Mostrar mensaje de éxito
        alert("La intervención fue registrada exitosamente.");
      } catch (error) {
        console.error("Error al tomar la incidencia:", error);
        alert("Ocurrió un error al registrar la intervención.");
      }
    },
    async dejarIncidencia() {
      if (!this.leaveReason || !this.leaveComment) {
        alert("Por favor, selecciona un motivo y agrega un comentario.");
        return;
      }

      try {
        const activeInterventionResponse = await axios.get(
          `http://127.0.0.1:8000/api/interventions?userId=${this.idUsuario}&incidentId=${this.idIncidencia}`
        );

        const intervention = activeInterventionResponse.data;
        console.log("Intervención activa:", intervention);

        // Verificamos si la intervención está activa
        if (!intervention || !intervention.active) {
          alert("No hay una intervención activa para esta incidencia.");
          return;
        }
        console.log("Intervención ID:", intervention.idIntervencion);
        // Aseguramos que la intervención tiene el idIntervencion
        if (!intervention.idIntervencion) {
          alert("No se encontró el ID de la intervención.");
          return;
        }

        // Actualizamos los datos de la intervención
        const updatedIntervention = {
          ...intervention,
          fechaFin: new Date().toISOString(),
          motivo: this.leaveReason,
          notas: `Comentarios: ${this.leaveComment}`,
        };

        const response = await axios.put(
          `http://127.0.0.1:8000/api/interventions/${intervention.idIntervencion}`,
          updatedIntervention
        );

        console.log("Intervención cerrada:", response.data);
        alert("La intervención ha sido cerrada correctamente.");

        // Cerrar el modal
        const modal = bootstrap.Modal.getInstance(this.$refs.leaveIncidentModal);
        modal.hide();

        // Actualizar el estado de intervención activa
        this.interventionActive = false;
      } catch (error) {
        console.error("Error al dejar la incidencia:", error);
        alert("Ocurrió un error al cerrar la intervención.");
      }
    },
    async checkActiveIntervention() {
      try {
        // Comprobar si existe una intervención activa (fechaFin es null) para el usuario y la incidencia
        const response = await axios.get(
          `http://127.0.0.1:8000/api/interventions?userId=${this.idUsuario}&incidentId=${this.idIncidencia}`
        );

        console.log("Respuesta de intervención activa:", response.data);  // Verifica los datos de la respuesta

        if (response.data && response.data.active) {
          this.interventionActive = true; // Existe una intervención activa
        } else {
          this.interventionActive = false;  // Si no tiene intervención activa, aseguramos que no esté bloqueado
        }
      } catch (error) {
        console.error("Error al comprobar la intervención activa:", error);
        this.interventionActive = false; // En caso de error, no bloqueamos el botón
      }
    }

  }

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

.btn-registrar,
.btn-dejar {
  background-color: #84005d;
  margin-top: 10px;
  color: white;
}

.modal.fade .modal-dialog {
  transition: transform 0.1s ease-out;
  transform: scale(0.8);
}

.modal.show .modal-dialog {
  transform: scale(1);
}
</style>
