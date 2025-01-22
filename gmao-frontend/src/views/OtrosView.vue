<template>
  <div class="container main-container">
    <div class="row">
      <!-- Lista de averías -->
      <div class="col-sm-8">
        <h2 class="section-title">Tipos de Avería</h2>
        <div class="scrollable-list">
          <AveriaList ref="averiaList" />
        </div>
      </div>
      <!-- Formulario de reporte -->
      <div class="col-sm-4">
        <AveriaForm @averia-added="handleNewAveria" />
      </div>
    </div>
    <div class="row">
      <!-- Lista de secciones -->
      <div class="col-sm-8">
        <h2 class="section-title">
          Secciones
          <!-- Filtro por campus -->
          <select v-model="selectedCampus" class="form-select" style="margin-left: 10px;">
            <option value="">Seleccionar campus</option>
            <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
              {{ campus.nombre }}
            </option>
          </select>
        </h2>
        <div class="scrollable-list">
          <!-- Pasar el campus seleccionado al componente SeccionList -->
          <SeccionList ref="seccionList" :selectedCampus="selectedCampus" />
        </div>
      </div>
      <!-- Formulario de reporte -->
      <div class="col-sm-4">
        <SeccionForm @seccion-added="handleNewSeccion" />
      </div>
    </div>
    <div class="row">
      <!-- Lista de campus -->
      <div class="col-sm-8">
        <h2 class="section-title">Campuses</h2>
        <div class="scrollable-list">
          <CampusList ref="campusList" />
        </div>
      </div>
      <!-- Formulario de reporte -->
      <div class="col-sm-4">
        <CampusForm @campus-added="handleNewCampus" />
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import AveriaForm from "@/components/AveriaForm.vue";
import AveriaList from "@/components/AveriaList.vue";
import SeccionForm from "@/components/SeccionForm.vue";
import SeccionList from "@/components/SeccionList.vue";
import CampusForm from "@/components/CampusForm.vue";
import CampusList from "@/components/CampusList.vue";

export default {
  name: "Otros",
  components: {
    AveriaList,
    AveriaForm,
    SeccionList,
    SeccionForm,
    CampusList,
    CampusForm,
  },
  data() {
    return {
      campuses: [], // Lista de campuses
      selectedCampus: "", // Campus seleccionado para el filtro
    };
  },
  created() {
    this.fetchCampuses();
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
    handleNewAveria(newAveria) {
      this.$refs.averiaList.updateList(newAveria);
    },
    handleNewSeccion(newSeccion) {
      this.$refs.seccionList.updateList(newSeccion);
    },
    handleNewCampus(newCampus) {
      this.$refs.campusList.updateList(newCampus);
    },
  },
};
</script>

<style scoped>
.main-container {
  padding-top: 80px;
}

.scrollable-list {
  margin: 2em;
  max-height: 300px;
  min-height: 300px;
  overflow-y: auto;
  padding: 10px;
}

.form-select {
  display: inline-block;
  width: auto;
}
</style>
