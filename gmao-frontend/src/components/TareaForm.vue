<template>
    <div>
        <h2 class="section-title">Registrar Tarea</h2>
        <form class="register-form" @submit.prevent="submitTarea">
            <div class="mb-3">
                <label for="taskName" class="form-label">Introduce el nombre:</label>
                <input 
                    type="text" 
                    id="taskName" 
                    class="form-control" 
                    v-model="form.nombre" 
                    required 
                />
            </div>
            <div class="mb-3">
                <label for="taskDescription" class="form-label">Introduce la descripción:</label>
                <textarea 
                    id="taskDescription" 
                    class="form-control" 
                    v-model="form.descripcion" 
                    required 
                ></textarea>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "TareaForm",
    data() {
        return {
            form: {
                nombre: "",
                descripcion: "",
            },
        };
    },
    methods: {
        async submitTarea() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/tasks/store", this.form);
                this.$emit('task-added', response.data);
                this.form.nombre = "";
                this.form.descripcion = "";

            } catch (error) {
                console.error("Error al enviar la tarea:", error.response);
                alert("Error al registrar la tarea");
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
.btn-registrar:hover {
  background-color: #6d004d;
}
</style>
