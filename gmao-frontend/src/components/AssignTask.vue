<template>
    <div class="modal fade" :class="{ show: visible }" id="assignTaskModal" tabindex="-1" :style="{ display: visible ? 'block' : 'none' }">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asignar Tarea</h5>
                    <button type="button" class="btn-close" @click="close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">
                        <strong>Tarea:</strong> {{ task.nombre }}
                    </p>
                    <div class="mb-3">
                        <label for="machineCampus" class="form-label"><strong>Selecciona el campus:</strong></label>
                        <select id="machineCampus" class="form-select" v-model="selectedCampus">
                            <option v-for="campus in campuses" :key="campus.idCampus" :value="campus.idCampus">
                                {{ campus.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="machineSection" class="form-label">Selecciona la sección:</label>
                        <select id="machineSection" class="form-select" v-model="selectedSeccion" :disabled="!filteredSecciones.length">
                            <option v-for="seccion in filteredSecciones" :key="seccion.idSeccion" :value="seccion.idSeccion">
                                {{ seccion.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="machine" class="form-label">Selecciona la máquina:</label>
                        <select id="machine" class="form-select" v-model="selectedMaquina" :disabled="!filteredMaquinas.length">
                            <option v-for="maquina in filteredMaquinas" :key="maquina.idMaquina" :value="maquina.idMaquina">
                                {{ maquina.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="taskPeriod" class="form-label"><strong>Introduce cada cuantos días hay que hacerlo:</strong></label>
                        <input type="number" id="taskPeriod" class="form-control" v-model="frecuencia">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="close">Cancelar</button>
                    <button type="button" class="btn btn-registrar" @click="assignTask">Asignar</button>
                </div>
            </div>
        </div>
    </div>
    <div v-if="visible" class="modal-backdrop fade" :class="{ show: visible }"></div>
</template>

<script>
import axios from "axios";

export default {
    name: "AssignTask",
    props: {
        visible: {
            type: Boolean,
            required: true,
        },
        task: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            maquinas: [],
            selectedMaquina: "",
            campuses: [],
            secciones: [],
            selectedCampus: "",
            selectedSeccion: "",
            frecuencia: "", // Añadido para el campo frecuencia
        };
    },
    computed: {
        filteredSecciones() {
            if (!this.selectedCampus) return [];
            return this.secciones.filter(seccion =>
                seccion.idSeccion.toString().startsWith(this.selectedCampus.toString())
            );
        },
        filteredMaquinas() {
            if (this.filteredSecciones === 0) return [];
            if (!this.selectedSeccion) return [];
            return this.maquinas.filter(
                (maquina) => maquina.idSeccion === this.selectedSeccion
            );
        },
    },
    created() {
        this.fetchMaquinas();
        this.fetchCampuses();
        this.fetchSecciones();
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
        async fetchCampuses() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/campuses");
                this.campuses = response.data;
            } catch (error) {
                console.error("Error al obtener los campus:", error);
            }
        },
        async fetchSecciones() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/sections");
                this.secciones = response.data;
            } catch (error) {
                console.error("Error al obtener las secciones:", error);
            }
        },
        close() {
            this.$emit("close");
        },
        async assignTask() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/assign-task", {
                    taskId: this.task.idTarea,
                    machineId: this.selectedMaquina,
                    frecuencia: this.frecuencia,  // Se pasa la frecuencia aquí
                });
                alert("Tarea asignada correctamente");
                this.close(); // Cerrar modal después de asignar
            } catch (error) {
                console.error("Error al asignar la tarea:", error);
                alert("Error al asignar la tarea");
            }
        },
    },
};
</script>

<style scoped>
.modal {
    background-color: rgba(0, 0, 0, 0.5);
}

.modal.fade.show {
    display: block;
}

.btn-registrar {
    background-color: #84005d;
    color: white;
}

.btn-registrar:hover {
    background-color: #6d004d;
    color: white;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}
</style>