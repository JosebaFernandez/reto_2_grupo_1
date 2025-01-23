<template>
  <div class="login-container">
    <div class="login-box">
      <h1>Entrar a GMAO</h1>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <input
            type="email"
            placeholder="Email"
            v-model="email"
            required
          />
        </div>
        <div class="form-group">
          <input
            type="password"
            placeholder="Contraseña"
            v-model="password"
            required
          />
        </div>
        <button type="submit" class="login-button">Acceder</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios"; // Importa Axios

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    async handleLogin() {
      try {
        // Solicitud POST usando Axios
        const response = await axios.post("http://127.0.0.1:8000/api/auth/login", {
          email: this.email,
          password: this.password,
        });

        // Guarda el token en localStorage
        localStorage.setItem("token", response.data.access_token);
        localStorage.setItem("user", JSON.stringify(response.data.user));
        
        // Redirige a la página de inicio
        this.$router.push({ name: "Home" });
        
      } catch (error) {
        // Manejo de errores
        if (error.response) {
          alert(error.response.data.error || "Error en el inicio de sesión");
        } else {
          alert("Error al conectarse con el servidor");
        }
      }
    },
  },
};
</script>

<style scoped>
/* Evitar scroll en la página */
html, body {
  margin: 0;
  padding: 0;
  height: 100%;
  overflow: hidden; /* Deshabilita el scroll */
}

.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Asegura que ocupe toda la altura de la ventana */
  background-color: white;
}

.login-box {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  text-align: center;
  width: 100%;
  max-width: 400px;
}

h1 {
  margin-bottom: 1.5rem;
  font-size: 1.5rem;
  color: #333;
}

.form-group {
  margin-bottom: 1rem;
}

input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

.login-button {
  width: 100%;
  padding: 0.75rem;
  background-color: #800080;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
}

.login-button:hover {
  background-color: #5e005e;
}

.forgot-password {
  display: block;
  margin-top: 1rem;
  color: #800080;
  text-decoration: none;
  font-size: 0.9rem;
}

.guest-access {
  margin-top: 1.5rem;
}

.guest-button {
  padding: 0.75rem;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
}

.guest-button:hover {
  background-color: #e0e0e0;
}
</style>
