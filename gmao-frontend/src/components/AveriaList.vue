<template>
    <div>

        <div v-for="averia in averias" :key="averia.idAveria" class="card">
            <div class="card-body">
                <h5 class="card-title">
                    {{ averia.nombre }}
                </h5>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "AveriaList",
    data() {
        return {
            averias: [],
        };
    },
    created() {
        this.fetchAverias();
    },
    methods: {
        async fetchAverias() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/breakdowns"); 
                this.averias = response.data;
            } catch (error) {
                console.error("Error al obtener las averías:", error);
            }
        },
        updateList(newAveria) {
            this.averias.push(newAveria);
        }
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
}
</style>