<template>
    <Notification />
    <TaskTable :statuses="statuses" />
</template>

<script>
import TaskTable from "./components/TaskTable.vue";
import Notification from "./components/Notification.vue";

export default {
    name: "App",

    props: {
        statuses: {
            type: Object,
            required: true,
        },
    },

    components: {
        TaskTable,
        Notification,
    },
};
</script>
