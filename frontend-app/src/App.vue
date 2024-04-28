<script setup>
import { onMounted, ref } from "vue";
import CreateCron from './components/CreateCron.vue'
import Table from './components/Table.vue';

const API_URL = 'http://localhost:8001/api/cron-jobs';
const jobs = ref({});

const fetchJobs = async () => {
    const requestOptions = {
        method: "GET",
        headers: { "Content-Type": "application/json" },
    };
    try
    {
        const response = await fetch(API_URL, requestOptions);
        if (response.ok)
        {
            const data = await response.json();
            jobs.value = data.data;
        } else
        {
            console.error("Failed to fetch data::", response.statusText);
        }
    } catch (error)
    {
        console.error("Error fetching data::", error);
    }
}

const createJob = async (formData) => {
    const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData)
    };
    const response = await fetch(API_URL, requestOptions);
    if (response.status == 201) {
        fetchJobs();
    } else {
        console.error("Saving the data::", response.statusText);
    }
}

const deleteJob = async (id) => {
    const requestOptions = {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
    };
    const response = await fetch(`${API_URL}/${id}`, requestOptions);
    if (response.ok)
    {
        fetchJobs();
    } else
    {
        console.error("Deleting the data::", response.statusText);
    }
}

onMounted(() => {
    fetchJobs();
});
</script>

<template>
    <div class="container">
        <div class="card text-center">
            <div class="card-header">
                Create New Cron
            </div>
            <div class="card-body">
                <CreateCron @createJob="createJob"/>
            </div>
        </div>

        <div class="card text-center">
            <div class="card-header">
                Cron List
            </div>
            <div class="card-body">
                <Table :jobs="jobs" @deleteJob="deleteJob" />
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    display: flex;
    flex-wrap: wrap;
}

.card {
    flex: 1 0 50%;
    margin: 10px;
}
</style>
