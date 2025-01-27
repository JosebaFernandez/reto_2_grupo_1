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
        <!-- Mostrar "Tomar incidencia" solo si no hay intervención activa -->
        <button v-if="!interventionActive && !thisInterventionActive" type="button" class="btn btn-registrar w-100"
          @click="tomarIncidencia(incidencia.idIncidencia)">
          Tomar incidencia
        </button>

        <!-- Botón "Dejar incidencia" solo si hay intervención activa -->
        <button v-if="thisInterventionActive" type="button" class="btn btn-registrar w-100"
          data-bs-toggle="modal" data-bs-target="#leaveIncidentModal">
          Dejar incidencia
        </button>

        <p v-if="interventionActive && !thisInterventionActive" class="text-muted">
          Ya estás trabajando en la incidencia "
          <router-link :to="{ name: 'IncidenciaView', params: { id: activeInterventionId } }">
            {{ activeIncidentTitle }}
          </router-link>
          "
        </p>
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
              <option value="Incidencia resuelta">Incidencia resuelta</option>
              <option value="Falta de herramientas">Falta de herramientas</option>
              <option value="Falta de conocimiento">Falta de conocimiento técnico</option>
              <option value="Falta de piezas">Falta de piezas</option>
              <option value="Falta de tiempo">Falta de tiempo</option>
              <option value="Otro">Otro</option>
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
      thisInterventionActive: false,
      activeInterventionId: null,
    };
  },
  created() {
    this.fetchIncidence();
    this.checkActiveIntervention(); // Comprobar intervención activa al cargar el componente
    console.log("Comprobando intervención activa...");
  },

  methods: {
    async fetchIncidence() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/incidences/${this.idIncidencia}`
        );
        this.incidencia = response.data;

        // Verifica el estado de intervención para esta incidencia
        this.checkActiveIntervention(this.idIncidencia);
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

        const intervention = activeInterventionResponse.data.intervention; // Access the 'intervention' object here
        console.log("Intervención activa:", intervention);

        // Verificamos si la intervención está activa
        if (!intervention || intervention.fechaFin !== null) {
          alert("No hay una intervención activa para esta incidencia.");
          return;
        }

        // Convertir la fecha de finalización a un formato compatible con MySQL
        const fechaFin = new Date(); // Fecha y hora actuales
        const formattedFechaFin = fechaFin.toISOString().slice(0, 19).replace('T', ' '); // Formato MySQL: "YYYY-MM-DD HH:MM:SS"

        // Actualizamos los datos de la intervención
        const updatedIntervention = {
          fechaFin: formattedFechaFin,
          motivo: this.leaveReason,
          notas: `Comentarios: ${this.leaveComment}`,
        };

        // Actualizar la intervención usando la URL correcta
        const response = await axios.put(
          `http://127.0.0.1:8000/api/interventions/${intervention.idIntervencion}/leave`,
          updatedIntervention
        );

        console.log("Intervención cerrada:", response.data);
        alert("La intervención ha sido cerrada correctamente.");
        console.log(this.incidencia.idIncidencia);
        if(this.leaveReason=="Incidencia resuelta"){
          const response = await axios.put(
            `http://127.0.0.1:8000/api/incidences/${this.incidencia.idIncidencia}`,
        );
        }
        // Cerrar el modal
        const modal = bootstrap.Modal.getInstance(this.$refs.leaveIncidentModal);
        modal.hide();

        // Actualizar el estado de intervención activa
        this.interventionActive = false;
        this.thisInterventionActive = false;
      } catch (error) {
        console.error("Error al dejar la incidencia:", error);
        alert("Ocurrió un error al cerrar la intervención.");
      }
    },
    async checkActiveIntervention() {
      try {
        const response = await axios.get(
          `http://127.0.0.1:8000/api/interventions?userId=${this.idUsuario}&incidentId=${this.idIncidencia}`
        );

        console.log("Respuesta completa de intervención activa:", response.data);  // Ver respuesta completa
        if (this.incidencia.idIncidencia == response.data.intervention.idIncidencia && response.data && response.data.active) {
          this.thisInterventionActive = true;
        } else {
          this.thisInterventionActive = false;
          if (response.data && response.data.active) {
            this.interventionActive = true;

            // Obtener el título de la incidencia activa
            const incidentId = response.data.intervention.idIncidencia;
            const incidentResponse = await axios.get(
              `http://127.0.0.1:8000/api/incidences/${incidentId}`
            );

            if (incidentResponse.data) {
              this.activeIncidentTitle = incidentResponse.data.titulo || "Título desconocido"; // Almacenar el título de la incidencia
            }

            this.activeInterventionId = incidentId;
            console.log(this.activeInterventionId);
          } else {
            this.interventionActive = false;  // No hay intervención activa
            console.log("Estado de intervención activa:", this.interventionActive);
          }
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

.text-muted {
  color: #6c757d;
}
</style>