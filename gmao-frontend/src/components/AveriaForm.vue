<template>
    <div>
        <h2 class="section-title">Nuevo Tipo de Avería</h2>
        <form class="register-form">
            <div class="mb-3">
                <label for="averiaName" class="form-label">Introduce el nombre:</label>
                <input type="text" id="averiaName" class="form-control"></input>
            </div>
            
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "AveriaForm",
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