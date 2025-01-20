<template>
    <div class="container main-container">
        <div class="row">
            <!-- Lista de incidencias (columna de 8 unidades) -->
            <div class="col-sm-8">
                <TareaList />
            </div>
            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4 fixed-right">
                <TareaForm />
            </div>
        </div>
    </div>
</template>


<script>

import TareaForm from "@/components/TareaForm.vue";
import TareaList from "@/components/TareaList.vue";

export default {
    name: "Tareas",
    components: {
        TareaList,
        TareaForm,
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