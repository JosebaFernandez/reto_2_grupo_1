<!-- resources/js/components/CampusList.vue -->

<template>
  <div>
    <h1>Lista de Campus</h1>
    <ul>
      <li v-for="campus in campuses" :key="campus.idCampus">
        {{ campus.nombre }}  <!-- Mostrar el nombre de cada campus -->
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';  // Importar Axios para hacer solicitudes HTTP

export default {
  data() {
    return {
      campuses: [],  // Variable para almacenar los campus
    };
  },
  mounted() {
    this.fetchCampuses();  // Llamada al método para obtener los campus al montar el componente
  },
  methods: {
    // Método para obtener los campus desde la API de Laravel
    fetchCampuses() {
      axios.get('http://127.0.0.1:8000/campuses')  // URL de la API de Laravel
        .then(response => {
          this.campuses = response.data;  // Asignar los datos obtenidos al arreglo 'campuses'
        })
        .catch(error => {
          console.error('Error fetching campuses:', error);  // Manejo de errores
        });
    },
  },
};
</script>

<style scoped>
/* Puedes agregar estilos aquí si lo necesitas */
</style>
