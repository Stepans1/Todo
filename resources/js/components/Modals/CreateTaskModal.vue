<template>
    <div
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4"
    >
        <div class="bg-white p-6 rounded-xl w-full sm:w-1/2 max-w-md relative">
            <h2 class="text-2xl font-bold mb-3">Create New Task</h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">
                    Title
                </label>
                <input
                    type="text"
                    v-model="newTask.title"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    placeholder="Enter task title"
                />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">
                    Description
                </label>
                <textarea
                    v-model="newTask.description"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500  max-h-40 overflow-y-auto"
                    placeholder="Enter task description"
                ></textarea>
            </div>

            <div class="mb-2 text-red-500 text-sm" v-if="error">
                {{ error }}
            </div>

            <div class="flex justify-end gap-3">
                <button
                    class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600"
                    @click="createTask"
                >
                    Create Task
                </button>
                <button
                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
                    @click="emit('close')"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const newTask = ref({
    title: "",
    description: "",
});

const error = ref(null);

const emit = defineEmits(["create", "close"]);

function createTask() {
    if (!newTask.value.title.trim()) {
        error.value = "Title is required.";
        return;
    }

    emit("create", { ...newTask.value });
    resetForm();
    emit("close");
}

function resetForm() {
    newTask.value.title = "";
    newTask.value.description = "";
    error.value = null;
}
</script>
