<template>
    <div class="container main-container">
        <div class="row">
            <!-- Lista de incidencias (columna de 8 unidades) -->
            <div class="col-sm-8 fixed-left">
                <IncidentDetail :idIncidencia="idIncidencia" />
            </div>            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4 right">
                <InterventionList :idIncidencia="idIncidencia" />
            </div>
        </div>
    </div>
</template>

<script>
import IncidentDetail from "@/components/IncidentDetail.vue";
import InterventionList from "@/components/InterventionList.vue";

export default {
    name: "Incidencia",
    components: {
        IncidentDetail,
        InterventionList,
    },
    data() {
        return {
            idIncidencia: this.$route.params.id,
        };
    },
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
}
.fixed-left {
  position: fixed;
  left: 20px;
  top: 150px; /* Para que no se sobreponga con la cabecera */
}

.right {
  margin-left: 950px; 
}
</style>