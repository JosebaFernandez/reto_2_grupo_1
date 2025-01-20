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
            <h2 class="section-title">Secciones</h2>
          <div class="scrollable-list">
            <SeccionList ref="seccionList" />
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
            <CampusList />
          </div>
        </div>
        <!-- Formulario de reporte -->
        <div class="col-sm-4">
          <CampusForm />
        </div>
      </div>
    </div>
  </template>
  
  <script>
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
    methods: {
      handleNewAveria(newAveria) {
        // Llamar al método updateList del componente hijo AveriaList
        this.$refs.averiaList.updateList(newAveria);
      },
      handleNewSeccion(newSeccion) {
        this.$refs.seccionList.updateList(newSeccion);
      }
    }
  };
  </script>
  
  <style scoped>
  .main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
  }
  
  .scrollable-list {
    margin: 2em;
    max-height: 300px; /* Ajusta la altura máxima según tus necesidades */
    overflow-y: auto; /* Habilita el scroll vertical */
    
    padding: 10px; /* Opcional: añade un poco de espacio interior */


  }
  
  .fixed-right {
    position: fixed;
    right: 20px;
  }
  </style>
  