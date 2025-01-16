<template>
    <div class="container main-container">
        <div class="row">
            <!-- Lista de incidencias (columna de 8 unidades) -->
            <div class="col-sm-8">
                <MaquinaList />
            </div>

            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4">
                <MaquinaForm />
            </div>
        </div>
    </div>
</template>

<script>

import MaquinaForm from "@/components/MaquinaForm.vue";
import MaquinaList from "@/components/MaquinaList.vue";

export default {
    name: "Maquinas",
    components: {
        MaquinaList,
        MaquinaForm,
    },
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
}
</style>