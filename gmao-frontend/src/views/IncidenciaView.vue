<template>
    <div class="container main-container">
        <div class="row">
            <!-- Lista de incidencias (columna de 8 unidades) -->
            <div class="col-sm-8">
                <IncidentDetail :idIncidencia="idIncidencia" @new-intervention="handleNewIntervention" />
            </div>            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4">
                <InterventionList :idIncidencia="idIncidencia" ref="interventionList"/>
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
    methods: {
        handleNewIntervention(newIntervention) {
            this.$refs.interventionList.updateList(newIntervention);
        },
    }
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
}

</style>