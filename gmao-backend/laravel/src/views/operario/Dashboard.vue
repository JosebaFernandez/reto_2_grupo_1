<template>
  <div class="dashboard">
    <h1>{{ dashboardData.title }}</h1>
    <div class="orders-summary">
      <div class="order-stat">
        <h3>Órdenes Pendientes</h3>
        <p>{{ dashboardData.orders.pending }}</p>
      </div>
      <!-- Más contenido -->
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'OperarioDashboard',
  data() {
    return {
      dashboardData: {}
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/operario/dashboard')
      this.dashboardData = response.data
    } catch (error) {
      console.error('Error loading dashboard data:', error)
    }
  }
}
</script> 