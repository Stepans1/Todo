<template>
    <div class="flex flex-col h-screen p-5">
        <header
            class="flex flex-col sm:flex-row justify-center sm:justify-between items-center mb-5"
        >
            <h1
                class="text-4xl font-bold text-center text-gray-800 mb-3 sm:mb-0 sm:text-left flex-1"
            >
                Cool TODO app
            </h1>
            <select
                v-model="taskStore.selectedStatus"
                class="px-3 py-2 mr-5 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500"
            >
                <option
                    v-for="(status, key) in statuses"
                    :key="key"
                    :value="key"
                >
                    {{ status }}
                </option>
            </select>
            <button
                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-indigo-600 transition-transform transform hover:scale-105"
                @click="taskStore.openCreateModal"
            >
                Add new task
            </button>
        </header>
        <div
            v-if="taskStore.tasks.length"
            class="grid grid-cols-1 sm:grid-cols-3 gap-5"
        >
            <Task
                v-for="(task, index) in taskStore.tasks"
                :key="index"
                :title="task.title"
                :description="task.description"
                :createdAt="task.formatted_created_at"
                :isActive="task.isActive"
                @open="taskStore.openViewModal(task)"
            />
        </div>

        <div
            v-else
            class="text-center text-gray-500 text-lg mt-10 animate-fade-in"
        >
            No tasks yet. Time to get productive!
        </div>
        <ViewTaskModal
            v-if="taskStore.selectedTask"
            :task="taskStore.selectedTask"
            @close="taskStore.closeViewModal"
            @delete="taskStore.deleteTask"
            @statusChange="taskStore.changeTaskStatus"
        />
        <CreateTaskModal
            v-if="taskStore.showCreateModal"
            @close="taskStore.closeCreateModal"
            @create="taskStore.createTask"
        />
    </div>
</template>

<script setup>
import { onMounted, watch, defineProps } from "vue";
import Task from "./Task.vue";
import ViewTaskModal from "./Modals/ViewTaskModal.vue";
import CreateTaskModal from "./Modals/CreateTaskModal.vue";
import { useTaskStore } from "../stores/taskStore";

const props = defineProps({
    statuses: {
        type: Object,
        required: true,
    },
});

const taskStore = useTaskStore();

onMounted(() => {
    taskStore.loadTasks();
});

watch(() => taskStore.selectedStatus, taskStore.loadTasks);
</script>
