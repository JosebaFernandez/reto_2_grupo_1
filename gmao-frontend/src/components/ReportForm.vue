<template>
    <div>
      <h2 class="section-title">Reportar</h2>
      <form class="report-form">
        <div class="mb-3">
          <label for="machine" class="form-label">Selecciona la máquina:</label>
          <select id="machine" class="form-select">
            <option value="Máquina25">Máquina25</option>
            <option value="Máquina26">Máquina26</option>
            <option value="Máquina27">Máquina27</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="severity" class="form-label">Selecciona la gravedad:</label>
          <select id="severity" class="form-select">
            <option value="Parada">Máquina parada</option>
            <option value="Marcha">Máquina en marcha</option>
            <option value="Aviso">Aviso</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="averia" class="form-label">Selecciona el tipo de avería:</label>
          <select id="averia" class="form-select">
            <option value="Mecanica">Mecánica</option>
            <option value="Electrica">Eléctrica</option>
            <option value="Neumatica">Neumática</option>
            <option value="Hidraulica">Hidráulica</option>
            <option value="Informatica">Informática</option>
            <option value="Generales">Instalaciones Generales</option>
            <option value="Otros">Otros</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Describe la incidencia:</label>
          <textarea id="description" class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-reportar w-100">Reportar</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: "ReportForm",
  };
  </script>
  
  <style scoped>
  .report-form {
    background-color: white;
    border: 1px solid #ccc;
    padding: 20px;
  }
  
  .btn-reportar {
    background-color: #84005d;
    color: white;
  }
  </style>
  