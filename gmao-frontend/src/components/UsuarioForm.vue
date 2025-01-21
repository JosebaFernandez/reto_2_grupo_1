<template>
    <div>
        <h2 class="section-title">Registrar Usuario</h2>
        <div class="card">
            <div class="mb-3">
                <label for="userName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="userName" class="form-control" v-model="nombre" required />
            </div>
            <div class="mb-3">
                <label for="userApellido" class="form-label">Introduce el apellido:</label>
                <input type="text" id="userApellido" class="form-control" v-model="apellido" required />
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Introduce el email:</label>
                <input type="email" id="userEmail" class="form-control" v-model="email" required />
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Introduce la contraseña:</label>
                <input type="password" id="userPassword" class="form-control" v-model="password" required :class="{'is-invalid': passwordError}" />           
            </div>
            <div v-if="passwordError" class="text-danger">
                La contraseña debe tener al menos 8 caracteres.
            </div>
            <div class="mb-3">
                <label for="userRol" class="form-label">Selecciona el rol:</label>
                <select id="userRol" class="form-select" v-model="rol" required>
                    <option value="operario">Operario</option>
                    <option value="tecnico">Técnico</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <button @click="registerUser" class="btn btn-registrar w-100">Registrar</button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "UsuarioForm",
    data() {
        return {
            nombre: "",
            apellido: "",
            email: "",
            password: "",
            rol: "",
            passwordError: false,
        };
    },
    methods: {
        async storeUser() {
            try {
                const userData = {
                    nombre: this.nombre,
                    apellido: this.apellido,
                    email: this.email,
                    password: this.password,
                    rol: this.rol
                };
                const response = await axios.post("http://127.0.0.1:8000/api/users/store", userData);
                this.$emit('user-added', response.data);
            } catch (error) {
                console.error("Error al registrar el usuario:", error);
                throw error;
            }
        },

        validatePassword() {
            if (this.password.length < 8) {
                this.passwordError = true;
                return false;
            }
            this.passwordError = false;
            return true;
        },

        async registerUser() {
            if (!this.validatePassword()) {
                return;
            }
            
            try {
                await this.storeUser();
                this.resetForm();
            } catch (error) {
                alert("Hubo un error al registrar el usuario");
            }
        },

        resetForm() {
            this.nombre = "";
            this.apellido = "";
            this.email = "";
            this.password = "";
            this.rol = "";
        }
    },
};
</script>

<style scoped>
.card {
    background-color: white;
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 1em;
}

.btn-registrar {
    background-color: #84005d;
    color: white;
}

.is-invalid {
    border-color: red;
}

.text-danger {
    color: red;
}
</style>
