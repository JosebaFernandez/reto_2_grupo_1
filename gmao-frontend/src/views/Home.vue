<template>
  <div class="container main-container">
    <div class="row">
      <!-- Lista de incidencias (columna de 8 unidades) -->
      <div class="col-sm-8">
        <IncidentList />
      </div>

      <!-- Formulario de reporte (columna de 4 unidades) -->
      <div class="col-sm-4 fixed-right">
        <ReportForm />
      </div>
    </div>
  </div>
</template>

<script>
import IncidentList from "../components/IncidentList.vue";
import ReportForm from "../components/ReportForm.vue";

export default {
  name: "Home",
  components: {
    IncidentList,
    ReportForm,
  },
};
</script>

<style scoped>
.main-container {
  padding-top: 80px; /* Espacio para la cabecera fija */
}

.fixed-right {
  position: fixed;
  right: 20px;
}
</style>
