<template>
    <div>
        <h2 class="section-title">Nueva Sección</h2>
        <form class="register-form" @submit.prevent="submitSeccion">
            <div class="mb-3">
                <label for="seccionCampus" class="form-label">Selecciona el campus:</label>
                <select id="seccionxCampus" class="form-select" v-model="selectedCampus" required>
                    <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
                        {{ campus.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="seccionName" class="form-label">Introduce el nombre:</label >
                <input type="text" id="seccionName" class="form-control" v-model="nombre" required></input>
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
      selectedCampus: "",
      nombre: "",
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
        );
        this.campuses = response.data; 
      } catch (error) {
        console.error("Error al obtener los campuses:", error);
      }
    },
    async submitSeccion() {
      try {
        const seccionData = {
          nombre: this.nombre,
          idCampus: this.selectedCampus,
        };

        const response = await axios.post("http://127.0.0.1:8000/api/sections/store", seccionData);

        this.$emit('seccion-added', response.data);

        this.nombre = "";
        this.selectedCampus = "";
      } catch (error) {
        console.error("Error al enviar la sección:", error);
      }

      
    }
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