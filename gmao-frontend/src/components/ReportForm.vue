<template>
  <div>
    <h2 class="section-title">Reportar</h2>
    <form class="report-form" @submit.prevent="submitReport">
      <div class="mb-3">
        <label for="machine" class="form-label">Selecciona la máquina:</label>
        <select id="maquina" class="form-select" v-model="selectedMaquina">
          <option v-for="maquina in maquinas" :key="maquina.idMaquina" :value="maquina.idMaquina">
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
      <button type="submit" class="btn btn-reportar w-100">Reportar</button>
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
    };
  },
  created() {
    this.fetchMaquinas();
    this.fetchAverias();
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

        this.selectedMaquina = "";
        this.title = "";
        this.description = "";
        this.selectedSeverity = "";
        this.selectedAveria = "";

        alert("Incidencia registrada correctamente");
      } catch (error) {
        console.error("Error al enviar la incidencia:", error);
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