<template>
    <div>
        <h2 class="section-title">Registrar Usuario</h2>
        <form class="register-form">
            <div class="mb-3">
                <label for="userName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="userName" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="userApellido" class="form-label">Introduce el apellido:</label>
                <input type="text" id="userApellido" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="userEmail" class="form-label">Introduce el email:</label>
                <input type="email" id="userEmail" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="userRol" class="form-label">Selecciona el rol:</label>
                <select id="userRol" class="form-select">
                    <option value=""></option>
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
export default {
    name: "UserForm",
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