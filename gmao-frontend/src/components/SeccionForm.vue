<template>
    <div>
        <h2 class="section-title">Nueva Sección</h2>
        <form class="register-form">
            <div class="mb-3">
                <label for="machineCampus" class="form-label">Selecciona el campus:</label>
                <select id="machineCampus" class="form-select" v-model="selectedCampus">
                    <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
                        {{ campus.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="seccionName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="seccionName" class="form-control"></input>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SeccionForm",
  data() {
    return {
      campuses: [], 
      selectedCampus: "", // Almacena el id de la máquina seleccionada
    };
  },
  created() {
    this.fetchCampuses();
  },
  methods: {
    async fetchCampuses() {
      try {
        const response = await axios.get(
          "http://127.0.0.1:8000/api/campuses"
        ); // Ajusta la URL según tu API
        this.maquinas = response.data; 
      } catch (error) {
        console.error("Error al obtener los campuses:", error);
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