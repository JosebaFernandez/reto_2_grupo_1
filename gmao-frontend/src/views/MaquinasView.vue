<template>
    <div class="container main-container">
      <div class="row">
        <!-- Lista de incidencias (columna de 8 unidades) -->
        <div class="col-sm-8">
          <MaquinaList :campuses="campuses" />
        </div>
            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4 fixed-right">
                <MaquinaForm />
            </div>
        </div>
      </div>
  </template>


<script>
  
import MaquinaForm from "@/components/MaquinaForm.vue";
import MaquinaList from "@/components/MaquinaList.vue";
import axios from "axios";

export default {
  name: "Maquinas",
  components: {
    MaquinaList,
    MaquinaForm,
  },
  data() {
    return {
      campuses: [], // Almacenamos los campuses aquí
    };
  },
  async created() {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/campuses"); // Ajusta la URL según tu API
      this.campuses = response.data; // Guardamos los campuses obtenidos
    } catch (error) {
      console.error("Error al obtener los campuses:", error);
    }
  },
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
}
.fixed-right {
  position: fixed;
  right: 20px;
}
</style>