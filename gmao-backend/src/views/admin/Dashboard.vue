<template>
  <div class="dashboard">
    <h1>{{ dashboardData.title }}</h1>
    <div class="stats-grid">
      <div class="stat-card">
        <h3>Total Usuarios</h3>
        <p>{{ dashboardData.stats.total_users }}</p>
      </div>
      <div class="stat-card">
        <h3>Órdenes Activas</h3>
        <p>{{ dashboardData.stats.active_orders }}</p>
      </div>
    </div>
    <!-- Más contenido del dashboard -->
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AdminDashboard',
  data() {
    return {
      dashboardData: {}
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/admin/dashboard')
      this.dashboardData = response.data
    } catch (error) {
      console.error('Error loading dashboard data:', error)
    }
  }
}
</script> 