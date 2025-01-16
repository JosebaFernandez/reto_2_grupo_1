<template>
    <div class="incident-detail">
      <div class="incident-header">
        <h2 class="incident-title">{{ incident.title }}</h2>
        <span :class="['badge', incident.statusClass]">{{ incident.status }}</span>
      </div>
      <ul class="incident-info">
        <li>
          <span class="info-label">Fecha:</span> {{ incident.date }}
        </li>
        <li>
          <span class="info-label">Máquina:</span> {{ incident.machine }}
        </li>
        <li>
          <span class="info-label">Gravedad:</span> {{ incident.severity }}
        </li>
        <li>
          <p class="incident-description">{{ incident.description }}</p>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: "IncidentDetail",
    data() {
      return {
        incident: {
          title: "Título",
          date: "01/01/2025",
          machine: "Máquina25",
          severity: "Aviso",
          description:
            "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
          status: "Resuelta",
          statusClass: "bg-success text-white",
        },
      };
    },
  };
  </script>
  
  <style scoped>
  .incident-detail {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  
  .incident-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1em;
  }
  
  .incident-title {
    font-size: 1.5rem;
    font-weight: bold;
  }
  
  .incident-info {
    list-style: none;
    padding: 0;
  }
  
  .info-label {
    font-weight: bold;
  }
  
  .incident-description {
    margin-top: 0.5em;
    font-style: italic;
  }
  
  .badge {
    font-size: 0.85rem;
    padding: 5px 10px;
    border-radius: 5px;
  }
    
  .text-white {
    color: white;
  }
  </style>
  