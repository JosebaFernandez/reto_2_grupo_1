<template>
    <div class="container main-container">
        <div class="row">
            <div class="col-sm-8">
                <TareaList ref="taskList" />
            </div>
            <div class="col-sm-4 fixed-right">
                <TareaForm @task-added="handleNewTask" />
            </div>
        </div>
    </div>
</template>


<script>
import TareaForm from "@/components/TareaForm.vue";
import TareaList from "@/components/TareaList.vue";

export default {
    name: "Tareas",
    components: {
        TareaList,
        TareaForm,
    },
    methods: {
        handleNewTask(newTask) {
            this.$refs.taskList.updateList(newTask);
        }
    }
};
</script>

<style scoped>
.main-container {
    padding-top: 80px;
    /* Espacio para la cabecera fija */
}

.fixed-right {
    position: fixed;
    right: 20px;
}

.open-modal-button {
    background-color: #84005d;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.open-modal-button:hover {
  background-color: #6d004d;
}

.btn-cerrar {
    background-color: #ccc;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-cerrar:hover {
    background-color: #aaa;
}
</style>