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
                <select id="machineCampus" class="form-select" v-model="selectedMaquina">
            
                    <option v-for="campus in campuses" :key="campus.id" :value="campus.id">
                        {{ campus.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machineSection" class="form-label">Selecciona la seccion:</label>
                <select id="machineSection" class="form-select" v-model="selectedMaquina">

                    <option v-for="seccion in secciones" :key="seccion.id" :value="seccion.id">
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
      campuses: [], 
      secciones: [], 
      selectedCampus: "", 
      selectedSeccion: "",
    };
  },
  created() {
    this.fetchCampuses();
    this.fetchSecciones();
  },
  methods: {
    async fetchCampuses() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/campuses"); // Ajusta la URL según tu API
        this.campuses = response.data; // Guardamos los datos de las máquinas
      } catch (error) {
        console.error("Error al obtener los campus:", error);
      }
    },
    async fetchSecciones() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/sections"); // Ajusta la URL según tu API
        this.secciones = response.data; // Guardamos los datos de los tipos de avería
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