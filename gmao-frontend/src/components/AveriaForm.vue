<template>
    <div>
        <h2 class="section-title">Nuevo Tipo de Avería</h2>
        <form class="register-form" @submit.prevent="submitAveria">
            <div class="mb-3">
                <label for="nombre" class="form-label">Introduce el nombre:</label>
                <input type="text" id="nombre" class="form-control" v-model="nombre" required>
            </div>
            
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: "AveriaForm",
    data() {
        return {
            nombre: "",
        };
    },
    methods: {
        async submitAveria() {
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/breakdowns/store", {
                    nombre: this.nombre,
                });
                
                this.$emit('averia-added', response.data);
                
                this.nombre = "";
            } catch (error) {
                console.error("Error al enviar la avería:", error);
                alert("Error al registrar la avería");
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
</style>