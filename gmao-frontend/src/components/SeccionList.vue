<template>
  <div>
    <!-- Mensaje si no hay secciones -->
    <p v-if="filteredSecciones.length === 0" class="text-muted">
      No hay secciones en este campus.
    </p>

    <!-- Listado de secciones -->
    <div v-for="seccion in filteredSecciones" :key="seccion.idSeccion" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ seccion.nombre }}</h5>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "SeccionList",
  props: {
    selectedCampus: {
      type: String,
      default: "",
    },
  },
  data() {
    return {
      secciones: [], // Array inicializado vacío
    };
  },
  created() {
    this.fetchSections();
  },
  computed: {
    filteredSecciones() {
      if (!this.selectedCampus) return this.secciones;
      // Filtrar las secciones por el ID del campus
      return this.secciones.filter(seccion =>
        seccion.idSeccion.toString().startsWith(this.selectedCampus.toString())
      );
    },
  },
  methods: {
    async fetchSections() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/sections");
        this.secciones = response.data;
      } catch (error) {
        console.error("Error al obtener las secciones:", error);
      }
    },
    updateList(newSeccion) {
      this.secciones.push(newSeccion);
    },
  },
};
</script>

<style scoped>
.card {
  background-color: white;
  border: none;
  border-top: 1px solid #414d5b;
  margin-bottom: 1em;
  border-radius: 0;
}
.card-body {
  padding: 20px;
}
.card-title {
  font-size: 1.25rem;
}
</style>
