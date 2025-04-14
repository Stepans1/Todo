<template>
    <div
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 px-4"
    >
        <div class="bg-white p-6 rounded-xl w-full sm:w-1/2 max-w-md relative">
            <div class="flex justify-between items-center mb-3">
                <h2 class="text-2xl font-bold">{{ task.title }}</h2>
                <span
                    :class="[
                        'text-xs font-semibold px-3 py-1 rounded-full',
                        task.isActive
                            ? 'bg-red-100 text-red-700'
                            : 'bg-green-100 text-green-700',
                    ]"
                >
                    {{ task.isActive ? "Incomplete" : "Complete" }}
                </span>
            </div>
            <p class="mb-4 text-gray-700 break-words">
                {{ task.description }}
            </p>
            <p class="text-sm text-gray-500 mb-6">
                {{ task.formatted_created_at }}
            </p>
            <div class="flex justify-end gap-3">
                <button
                    class="px-4 py-2 rounded bg-green-500 text-white hover:bg-green-700"
                    @click="emit('statusChange', task.id)"
                >
                    {{
                        task.isActive
                            ? "Mark as complete"
                            : "Mark as incomplete"
                    }}
                </button>
                <button
                    class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600"
                    @click="emit('delete', task.id)"
                >
                    Delete
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
const props = defineProps({
    task: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["statusChange", "delete", "close"]);
</script>
