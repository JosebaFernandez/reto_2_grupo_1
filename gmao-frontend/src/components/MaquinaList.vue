<template>
  <div>
    <h2 class="section-title">
      Maquinas
      <select v-model="selectedCampus" class="form-select" style="margin-left: 10px;">
        <option value="">Seleccionar campus</option>
        <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">{{ campus.nombre }}</option>
      </select>
    </h2>

    <!-- Mostrar mensaje si no hay máquinas filtradas -->
    <p v-if="filteredMaquinas.length === 0" class="text-muted">
      No hay máquinas en este campus.
    </p>

    <!-- Renderizar máquinas si hay resultados -->
    <div v-for="maquina in filteredMaquinas" :key="maquina.idMaquina" class="card">
      <div class="card-body">
        <h5 class="card-title">{{ maquina.nombre }}</h5>
        <p class="card-text text-muted">
          <small>{{ maquina.idMaquina }}</small>
        </p>
        <p class="card-text"><b>Prioridad: </b>{{ maquina.prioridad }}</p>
        <p class="card-text"><b>Campus: </b>{{ getCampusName(maquina.idCampus) }}</p>
        <p class="card-text"><b>Sección: </b> {{ maquina.idSeccion }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MaquinaList",
  props: {
    campuses: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      maquinas: [],
      selectedCampus: "", // Campus seleccionado para el filtro
    };
  },
  created() {
    this.fetchMaquinas();
  },
  computed: {
    filteredMaquinas() {
      if (!this.selectedCampus) return this.maquinas;
      return this.maquinas.filter(maquina => maquina.idCampus.toString() === this.selectedCampus.toString());
    },
  },
  methods: {
    async fetchMaquinas() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/machines");
        this.maquinas = response.data;
      } catch (error) {
        console.error("Error al obtener las máquinas:", error);
      }
    },
    getCampusName(id) {
      const campus = this.campuses.find(campus => campus.idCampus === id);
      return campus ? campus.nombre : "Desconocido";
    },
    updateList(newMachine) {
      this.maquinas.push(newMachine);
    },
  },
};
</script>

<style scoped>
.card {
  background-color: white;
  border: none;
  border-top: 1px solid #414d5b;
  margin-bottom: 1em;
  border-radius: 0;
}

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 1.25rem;
}

.form-select {
  display: inline-block;
  width: auto;
}
</style>
