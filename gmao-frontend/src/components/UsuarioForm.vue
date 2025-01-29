<template>
    <div>
        <h2 class="section-title">Registrar Usuario</h2>
        <form @submit.prevent="registerUser" class="card">
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
                <input type="text" id="userEmail" class="form-control" v-model="email" required :class="{'is-invalid': emailError}" />
            </div>
            <p v-if="emailError" class="text-danger">
                {{ emailErrorMessage }}
            </p>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Introduce la contraseña:</label>
                <input type="password" id="userPassword" class="form-control" v-model="password" required :class="{'is-invalid': passwordError}" />           
            </div>
            <p v-if="passwordError" class="text-danger">
                La contraseña debe tener al menos 8 caracteres.
            </p>
            <div class="mb-3">
                <label for="userRol" class="form-label">Selecciona el rol:</label>
                <select id="userRol" class="form-select" v-model="rol" required>
                    <option value="operario">Operario</option>
                    <option value="tecnico">Técnico</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
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
            emailError: false,
            emailErrorMessage: "",
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

        validateEmail() {
            if (!this.email.includes('@')) {
                this.emailError = true;
                this.emailErrorMessage = "La dirección es incorrecta.";
                return false;
            }
            
            const [, domain] = this.email.split('@');
            if (!domain || domain.trim() === '') {
                this.emailError = true;
                this.emailErrorMessage = "La dirección está incompleta.";
                return false;
            }

            this.emailError = false;
            this.emailErrorMessage = "";
            return true;
        },

        async registerUser() {
            if (!this.validatePassword() || !this.validateEmail()) {
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

.btn-registrar:hover {
    background-color: #6d004d;
}

.is-invalid {
    border-color: #dc3545;
}

.text-danger {
    color: #dc3545;
}
</style>
