<template>
    <div>
        <h2>Tasks</h2>
        <ul>
            <li v-for="task in tasks" :key="task.id">{{ task.title }} - {{ task.status }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tasks: [],
        };
    },
    mounted() {
        axios.get('/api/tasks').then(response => {
            this.tasks = response.data;
        });

        Echo.channel('tasks')
            .listen('TaskCreated', (event) => {
                this.tasks.push(event.task);
            });
    }
}
</script>
