<template>
    <div>
        <h2 class="section-title">Registrar Usuario</h2>
        <form class="register-form" @submit.prevent="submitForm">
            <div class="mb-3">
                <label for="userName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="userName" class="form-control" v-model="form.nombre" required />
            </div>
            <div class="mb-3">
                <label for="userApellido" class="form-label">Introduce el apellido:</label>
                <input type="text" id="userApellido" class="form-control" v-model="form.apellido" required />
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Introduce el email:</label>
                <input type="email" id="userEmail" class="form-control" v-model="form.email" required />
            </div>
            <div class="mb-3">
                <label for="userPassword" class="form-label">Introduce la contraseña:</label>
                <input type="password" id="userPassword" class="form-control" v-model="form.password" required :class="{'is-invalid': passwordError}"
                />           
            </div>
            <div v-if="passwordError" class="text-danger">
                La contraseña debe tener al menos 8 caracteres.
            </div>
            <div class="mb-3">
                <label for="userRol" class="form-label">Selecciona el rol:</label>
                <select id="userRol" class="form-select" v-model="form.rol" required>
                    <option value="operario">Operario</option>
                    <option value="tecnico">Técnico</option>
                    <option value="administrador">Administrador</option>
                </select>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "UserForm",
    data() {
        return {
            form: {
                nombre: "",
                apellido: "",
                email: "",
                password: "",
                rol: "",
            },
            passwordError: false, // Para manejar el error de la contraseña
        };
    },
    methods: {

        validatePassword() {
            if (this.form.password.length < 8) {
                this.passwordError = true;
                return false;
            } else {
                this.passwordError = false;
                return true;
            }
        },

        async submitForm() {
            // Validamos que la contraseña tenga al menos 8 caracteres
            if (!this.validatePassword()) {
                return; // Si la contraseña no es válida, no enviamos el formulario
            }
            
            try {
                const response = await axios.post("http://127.0.0.1:8000/api/users/store", this.form);
                alert("Usuario registrado exitosamente");
                this.resetForm(); // Reseteamos el formulario
            } catch (error) {
                console.error("Error al registrar el usuario:", error.response.data);
                alert("Hubo un error al registrar el usuario");
            }
        },
        resetForm() {
            this.form.nombre = "";
            this.form.apellido = "";
            this.form.email = "";
            this.form.password = "";
            this.form.rol = "";
        }
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
.is-invalid {
  border-color: red;
}

.text-danger {
  color: red;
}
</style>
