<template>
  <div class="container main-container">
    <div class="row">
      <div class="col-sm-8 ">
        <IncidentList ref="incidentList" />
      </div>

      <div class="col-sm-4 scrollable">
        <ReportForm @report-added="handleNewReport" />
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

  methods: {
    handleNewReport(newReport) {
      this.$refs.incidentList.updateList(newReport);
    }
  }
};
</script>

<style scoped>
.main-container {
  padding-top: 80px;
  /* Espacio para la cabecera fija */
}

.scrollable {
  position: fixed;
  max-height: 80vh;
  /* Ajusta la altura máxima según tus necesidades */
  overflow-y: auto;
  /* Habilita el scroll vertical */
  /* Opcional: añade un poco de espacio interior */
  right: 5px;
}
</style>
