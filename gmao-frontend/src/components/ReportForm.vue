<template>
  <div>
    <h2 class="section-title">Reportar</h2>
    <form class="report-form" @submit.prevent="submitReport">
      <div class="mb-3">
        <label for="machineCampus" class="form-label">Selecciona el campus:</label>
        <select id="machineCampus" class="form-select" v-model="selectedCampus">
          <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
            {{ campus.nombre }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="machineSection" class="form-label">Selecciona la seccion:</label>
        <select id="machineSection" class="form-select" v-model="selectedSeccion" :disabled="!filteredSecciones.length">
          <option v-for="seccion in filteredSecciones" :key="seccion.idSeccion" :value="seccion.idSeccion">
            {{ seccion.nombre }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="machine" class="form-label">Selecciona la máquina:</label>
        <select id="machine" class="form-select" v-model="selectedMaquina" :disabled="!filteredMaquinas.length">
          <option v-for="maquina in filteredMaquinas" :key="maquina.idMaquina" :value="maquina.idMaquina">
            {{ maquina.nombre }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="severity" class="form-label">Selecciona la gravedad:</label>
        <select id="severity" class="form-select" v-model="selectedSeverity">
          <option value=""></option>
          <option value="Máquina parada">Máquina parada</option>
          <option value="Máquina en marcha">Máquina en marcha</option>
          <option value="Aviso">Aviso</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="averia" class="form-label">Selecciona el tipo de avería:</label>
        <select id="averia" class="form-select" v-model="selectedAveria">
          <option v-for="averia in averias" :key="averia.idAveria" :value="averia.idAveria">
            {{ averia.nombre }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <label for="title" class="form-label">Título:</label>
        <input type="text" id="title" class="form-control" v-model="title" required></input>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Describe la incidencia:</label>
        <textarea id="description" class="form-control" rows="5" v-model="description" required></textarea>
      </div>
      <input type="submit" class="btn btn-reportar w-100">
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "ReportForm",
  data() {
    return {
      maquinas: [],
      averias: [],
      selectedMaquina: "",
      selectedAveria: "",
      selectedSeverity: "",
      description: "",
      title: "",
      campuses: [],
      secciones: [],
      selectedCampus: "",
      selectedSeccion: "",
    };
  },
  computed: {
    filteredSecciones() {
      if (!this.selectedCampus) return [];
      return this.secciones.filter(seccion =>
        seccion.idSeccion.toString().startsWith(this.selectedCampus.toString())
      );
    },
    filteredMaquinas() {
      if (this.filteredSecciones === 0) return [];
      if (!this.selectedSeccion) return [];
      return this.maquinas.filter(
        (maquina) => maquina.idSeccion === this.selectedSeccion
      );
    },
  },

  created() {
    this.fetchMaquinas();
    this.fetchAverias();
    this.fetchCampuses();
    this.fetchSecciones();
  },
  methods: {
    async fetchMaquinas() {
      try {
        const response = await axios.get(
          "http://127.0.0.1:8000/api/machines"
        );
        this.maquinas = response.data;
      } catch (error) {
        console.error("Error al obtener las máquinas:", error);
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
        console.log("Campuses:", response.data); // Verifica los datos
        this.campuses = response.data;
      } catch (error) {
        console.error("Error al obtener los campus:", error);
      }
    },
    async fetchSecciones() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/sections");
        console.log("Secciones:", response.data); // Verifica los datos
        this.secciones = response.data;
      } catch (error) {
        console.error("Error al obtener las secciones:", error);
      }
    },
    async submitReport() {
      try {
        const reportData = {
          idMaquina: this.selectedMaquina,
          titulo: this.title,
          descripcion: this.description, 
          estadoMaquina: this.selectedSeverity,
          idAveria: this.selectedAveria,
        };

        const response = await axios.post(
          "http://127.0.0.1:8000/api/incidences/store",
          reportData
        );

        this.$emit('report-added', response.data);

        this.selectedMaquina = "";
        this.title = "";
        this.description = "";
        this.selectedSeverity = "";
        this.selectedAveria = "";

      } catch (error) {
        console.error("Error al registrar la incidencia:", error);
        alert("Hubo un error al registrar la incidencia. Por favor, inténtelo de nuevo.");
      }
    },
  },
};
</script>

<style scoped>
.report-form {
  max-width: none;
  background-color: white;
  border: 1px solid #ccc;
  padding: 20px;
}

.btn-reportar {
  background-color: #84005d;
  color: white;
}
</style>