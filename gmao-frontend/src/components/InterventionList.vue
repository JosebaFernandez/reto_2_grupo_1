<template>
    <div>
      <h2 class="section-title">Intervenciones</h2>
      <div v-for="(intervention, index) in interventions" :key="index" class="card">
        <div class="intervenciones">
          <p class="card-text">{{ intervention.startDate }}-{{ intervention.endDate }}</p>
          <p class="card-text">{{ intervention.notes }}</p>
        </div>
      </div>
    </div>

  </template>
  
  
  <script>
  export default {
    name: "InterventionList",
    data() {
      return {
        interventions: [
          {
            startDate: "01/01/2025",
            endDate: "01/01/2025",
            notes: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          },
          {
            startDate: "01/01/2025",
            endDate: "01/01/2025",
            notes: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          },
          {
            startDate: "01/01/2025",
            endDate: "01/01/2025",
            notes: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          },
        ],
      };
    },
  };
  </script>
  
  <style scoped>
  .card {
    background-color: white;
    border: none;
    border-top: 1px solid #414d5b;
    margin-bottom: 1em;
    border-radius: 0;
  }
  .card-text {
      font-size: 1rem;
    }
  .intervenciones {
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: white;
      padding: 20px;
      height: 100%;
    }
  </style>
  