<template>
    <div
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4"
    >
        <!-- убрали ограничение по высоте -->
        <div class="bg-white p-6 rounded-xl w-full sm:w-1/2 max-w-md relative">
            <h2 class="text-2xl font-bold mb-3">{{ task.title }}</h2>
            <p class="mb-4 text-gray-700 break-words">
                {{ task.description }}
            </p>
            <p class="text-sm text-gray-500 mb-6">
                Created at: {{ task.createdAt }}
            </p>
            <div class="flex justify-end gap-3">
                <button
                    class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600"
                    @click="$emit('delete')"
                >
                    Delete
                </button>
                <button
                    class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
                    @click="$emit('close')"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true,
        },
    },
};
</script>
