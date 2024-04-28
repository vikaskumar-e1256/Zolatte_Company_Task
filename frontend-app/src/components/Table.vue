<script setup>
defineProps({
    jobs: {
        required: true,
        type: Object
    }
});

const emit = defineEmits(['deleteJob']);

const jobDelete = (id) => {
    emit('deleteJob', id);
}
</script>
<template>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Frequency</th>
          <th scope="col">Url</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(job, index) in jobs" :key="index">
          <th scope="row">{{ job.id }}</th>
          <td>{{ job.name }}</td>
          <td>{{ job.frequency }}</td>
          <td>{{ job.url }}</td>
          <td @click="jobDelete(job.id)">Delete</td>
        </tr>

      </tbody>
    </table>
</template>
