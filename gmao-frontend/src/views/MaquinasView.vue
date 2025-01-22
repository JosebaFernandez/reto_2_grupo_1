<template>
    <div class="container main-container">
      <div class="row">
        <div class="col-sm-8">
          <MaquinaList :campuses="campuses" ref="machineList" />
        </div>
            <div class="col-sm-4 fixed-right">
                <MaquinaForm @machine-added="handleNewMachine" />
            </div>
        </div>
      </div>
  </template>


<script>
  
import MaquinaForm from "@/components/MaquinaForm.vue";
import MaquinaList from "@/components/MaquinaList.vue";
import axios from "axios";

export default {
  name: "Maquinas",
  components: {
    MaquinaList,
    MaquinaForm,
  },
  data() {
    return {
      campuses: [],
    };
  },
  async created() {
    try {
      const response = await axios.get("http://127.0.0.1:8000/api/campuses");
      this.campuses = response.data;
    } catch (error) {
      console.error("Error al obtener los campuses:", error);
    }
  },
  methods: {
    handleNewMachine(newMachine) {
      this.$refs.machineList.updateList(newMachine);
    }
  }
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
}
.fixed-right {
  position: fixed;
  right: 20px;
}
</style>