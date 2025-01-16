<template>
  <div>
    <h2 class="section-title">Incidencias</h2>
    <div v-for="(incident, index) in incidents" :key="index" class="card">
      <div class="card-body">
        <!-- Convertimos el título en un enlace -->
        <h5 class="card-title">
          <router-link :to="{ name: 'IncidenciaView', params: { id: incident.id } }">
            {{ incident.title }}
          </router-link>
        </h5>
        <p class="card-text text-muted">
          <small>{{ incident.date }}</small>
        </p>
        <p class="card-text">{{ incident.machine }}</p>
        <p class="card-text">{{ incident.description }}</p>
        <span :class="['badge', incident.statusClass]">{{ incident.status }}</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "IncidentList",
  data() {
    return {
      incidents: [
        {
          id: 1,
          title: "Título 1",
          date: "01/01/2025",
          machine: "Máquina25",
          description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          status: "Pendiente",
          statusClass: "bg-danger text-white",
        },
        {
          id: 2,
          title: "Título 2",
          date: "01/01/2025",
          machine: "Máquina25",
          description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          status: "Resuelta",
          statusClass: "bg-success text-white",
        },
        {
          id: 3,
          title: "Título 3",
          date: "01/01/2025",
          machine: "Máquina25",
          description: "Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
          status: "En curso",
          statusClass: "bg-warning text-dark",
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

.card-body {
  padding: 20px;
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
}

.card-title a {
  text-decoration: none;
  color: #007bff;
}

.card-title a:hover {
  text-decoration: underline;
}

.badge {
  font-size: 0.9rem;
  padding: 5px 10px;
  border-radius: 5px;
}
</style>
