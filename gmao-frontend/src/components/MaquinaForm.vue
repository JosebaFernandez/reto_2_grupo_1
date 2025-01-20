<template>
    <div>
        <h2 class="section-title">Registrar Maquina</h2>
        <form class="register-form" @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="machineName" class="form-label">Introduce el nombre de la maquina:</label>
                <input type="text" id="machineName" class="form-control" v-model="form.nombre" required></input>
            </div>
            <div class="mb-3">
                <label for="machineId" class="form-label">Introduce el codigo de la maquina:</label>
                <input type="text" id="machineId" class="form-control" v-model="form.idMaquina" required></input>
            </div>
            <div class="mb-3">
                <label for="machineCampus" class="form-label">Selecciona el campus:</label>
                <select id="machineCampus" class="form-select" v-model="form.idCampus" required>
                    <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
                        {{ campus.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machineSection" class="form-label">Selecciona la seccion:</label>
                <select id="machineSection" class="form-select" v-model="form.idSeccion"   :disabled="!filteredSecciones.length" required>

                    <option v-for="seccion in secciones" :key="seccion.idSeccion" :value="seccion.idSeccion">
                        {{ seccion.nombre }}
                    </option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machinePriority" class="form-label">Selecciona la prioridad:</label>
                <select id="machinePriority" class="form-select" v-model="form.prioridad" required>

                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
  name: "MaquinaForm",
  data() {
    return {
      form: {
        nombre: "",      // Nombre de la máquina
        idMaquina: "",   // Código de la máquina como string
        idCampus: null,  // ID del campus seleccionado
        idSeccion: null, // ID de la sección seleccionada
        prioridad: null, // Prioridad seleccionada
      },
      campuses: [], 
      secciones: [],
    };
  },
  computed: {
    filteredSecciones() {
  if (!this.form.idCampus) return [];
  return this.secciones.filter(seccion => 
    seccion.idSeccion.toString().startsWith(this.form.idCampus.toString())
  );
},
  },
  created() {
    this.fetchCampuses();
    this.fetchSecciones();
  },
  methods: {
    async fetchCampuses() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/campuses"); // Ajusta la URL según tu API
        this.campuses = response.data; // Guardamos los datos de las máquinas
      } catch (error) {
        console.error("Error al obtener los campus:", error);
      }
    },
    async fetchSecciones() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/sections"); // Ajusta la URL según tu API
        this.secciones = response.data; // Guardamos los datos de los tipos de avería
      } catch (error) {
        console.error("Error al obtener las secciones:", error);
      }
    },
    async submitForm() {
      try {
        const response = await axios.post("http://127.0.0.1:8000/api/machines/store", this.form);
        alert("Máquina registrada exitosamente");
      } catch (error) {
        console.error("Error al registrar la máquina:", error);
        alert("Hubo un error al registrar la máquina");
      }
    },

  },
};
</script>


<style scoped>
.register-form {
    max-width: none;
    background-color: white;
    border: 1px solid #ccc;
    padding: 20px;
}

.btn-registrar {
    background-color: #84005d;
    color: white;
}
</style>