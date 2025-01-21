<template>
    <div>
        <h2 class="section-title">Nueva Máquina</h2>
        <form class="register-form" @submit.prevent="submitMaquina">
            <div class="mb-3">
                <label for="machineCampus" class="form-label">Selecciona el campus:</label>
                <select id="machineCampus" class="form-select" v-model="selectedCampus" required>
                    <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
                        {{ campus.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machineSection" class="form-label">Selecciona la sección:</label>
                <select id="machineSection" class="form-select" v-model="selectedSeccion" :disabled="!filteredSecciones.length" required>
                    <option v-for="seccion in filteredSecciones" :key="seccion.idSeccion" :value="seccion.idSeccion">
                        {{ seccion.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machineName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="machineName" class="form-control" v-model="nombre" required></input>
            </div>
            <div class="mb-3">
                <label for="machinePriority" class="form-label">Selecciona la prioridad:</label>
                <select id="machinePriority" class="form-select" v-model="prioridad" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MaquinaForm",
  data() {
    return {
      campuses: [], 
      secciones: [],
      selectedCampus: "",
      selectedSeccion: "",
      nombre: "",
      prioridad: null,
    };
  },
  computed: {
    filteredSecciones() {
      if (!this.selectedCampus) return [];
      return this.secciones.filter(seccion =>
        seccion.idSeccion.toString().startsWith(this.selectedCampus.toString())
      );
    },
  },
  watch: {
    selectedCampus(newValue) {
      this.selectedSeccion = "";
    },
  },
  created() {
    this.fetchCampuses();
    this.fetchSecciones();
  },
  methods: {
    async fetchCampuses() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/campuses");
        this.campuses = response.data;
      } catch (error) {
        console.error("Error al obtener los campus:", error);
      }
    },
    async fetchSecciones() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/sections");
        this.secciones = response.data;
      } catch (error) {
        console.error("Error al obtener las secciones:", error);
      }
    },
    async submitMaquina() {
      try {
        const maquinaData = {
          nombre: this.nombre,
          idCampus: this.selectedCampus,
          idSeccion: this.selectedSeccion,
          prioridad: this.prioridad
        };

        const response = await axios.post("http://127.0.0.1:8000/api/machines/store", maquinaData);
        this.$emit('machine-added', response.data);

        this.nombre = "";
        this.selectedCampus = "";
        this.selectedSeccion = "";
        this.prioridad = null;
      } catch (error) {
        console.error("Error al registrar la máquina:", error);
        alert("Hubo un error al registrar la máquina");
      }
    },
  },
};
</script>


<style scoped>
.register-form {
    max-width: none;
    background-color: white;
    border: 1px solid #ccc;
    padding: 20px;
}

.btn-registrar {
    background-color: #84005d;
    color: white;
}
</style>