<template>
    <div>
        <h2 class="section-title">Nuevo Campus</h2>
        <form class="register-form" @submit.prevent="submitCampus">
            <div class="mb-3">
                <label for="campusName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="campusName" class="form-control" v-model="nombre" required></input>
            </div>
            
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "CampusForm",
    data() {
        return {
            nombre: "",
        };
    },
    methods: {
        async submitCampus() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/campuses/store", {
                    nombre: this.nombre,
                });
                this.$emit('campus-added', response.data);
                this.nombre = "";
            } catch (error) {
                console.error('Error al crear el campus:', error);
            }
        }
    }
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