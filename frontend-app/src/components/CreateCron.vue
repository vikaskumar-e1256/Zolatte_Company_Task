<script setup>
import { ref } from "vue";

const emit = defineEmits(['createJob']);

const formData = ref({
    name: '',
    frequency: '',
    params: ''
});

const onSubmit = async () => {
    emit('createJob', formData.value);
    formData.value = {}
}

</script>

<template>
    <div class="cron-job-form">
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" v-model="formData.name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="frequency">Frequency:</label>
                <select id="frequency" v-model="formData.frequency" class="form-control" required>
                    <option value="everySecond">EverySecond</option>
                    <option value="everyFiveSeconds">EveryFiveSecond</option>
                    <option value="everyTenSeconds">EveryTenSecond</option>
                </select>
            </div>
            <div class="form-group">
                <label for="url">Url:</label>
                <input type="url" id="url" v-model="formData.params" class="form-control" required>
            </div>
            <button type="submit">Create Job</button>
        </form>
    </div>
</template>

<style scoped>
</style>
