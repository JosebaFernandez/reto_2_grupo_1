<template>
    <div class="container main-container">
        <div class="row">
            <!-- Lista de incidencias (columna de 8 unidades) -->
            <div class="col-sm-8">
                <UsuarioList />
            </div>

            <!-- Formulario de reporte (columna de 4 unidades) -->
            <div class="col-sm-4 fixed-right">
                <UsuarioForm />
            </div>
        </div>
    </div>
</template>

<script>

import UsuarioForm from "@/components/UsuarioForm.vue";
import UsuarioList from "@/components/UsuarioList.vue";

export default {
    name: "Usuarios",
    components: {
        UsuarioList,
        UsuarioForm,
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