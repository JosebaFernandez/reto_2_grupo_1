<template>
    <div>
        <h2 class="section-title">Registrar Maquina</h2>
        <form class="register-form">
            <div class="mb-3">
                <label for="machineName" class="form-label">Introduce el nombre de la maquina:</label>
                <input type="text" id="machineName" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="machineId" class="form-label">Introduce el codigo de la maquina:</label>
                <input type="text" id="machineId" class="form-control"></input>
            </div>
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
                <label for="machinePriority" class="form-label">Selecciona la prioridad:</label>
                <select id="machinePriority" class="form-select">
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
      campuses: [], // Lista de campus obtenida de la API
      secciones: [], // Lista de todas las secciones obtenida de la API
      selectedCampus: "", // Campus seleccionado por el usuario
      selectedSeccion: "", // Sección seleccionada por el usuario
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
  created() {
    this.fetchCampuses();
    this.fetchSecciones();
  },
  methods: {
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