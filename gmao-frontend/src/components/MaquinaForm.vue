<template>
    <div>
        <h2 class="section-title">Registrar Maquina</h2>
        <form class="register-form">
            <div class="mb-3">
                <label for="machineName" class="form-label">Introduce el nombre de la maquina:</label>
                <input type="text" id="machineName" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="machineId" class="form-label">Introduce el codigo de la maquina:</label>
                <input type="text" id="machineId" class="form-control"></input>
            </div>
            <div class="mb-3">
                <label for="machineCampus" class="form-label">Selecciona el campus:</label>
                <select id="machineCampus" class="form-select">
                    <option value="1">Arriaga</option>
                    <option value="2">Mendizorroza</option>
                    <option value="3">Molinuevo</option>
                    <option value="4">Nieves Cano</option>
                    <option value="5">Jesús Obrero</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machineSection" class="form-label">Selecciona la seccion:</label>
                <select id="machineSection" class="form-select">
                    <option value="5010">Taller Mecánico 1 010</option>
                    <option value="5011">Taller Aurrera XXI</option>
                    <option value="5012">Taller Mecánico 2 012</option>
                    <option value="5014">Taller Control Numérico 014</option>
                    <option value="5017">Taller Mecánico 3 017</option>
                    <option value="5018">Taller Mecánico 4 018</option>
                    <option value="5019">Taller Metrologia</option>
                    <option value="5024">Taller Neumática</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="machinePriority" class="form-label">Selecciona la prioridad:</label>
                <select id="machinePriority" class="form-select">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <button type="submit" class="btn btn-registrar w-100">Registrar</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "MaquinaForm",
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