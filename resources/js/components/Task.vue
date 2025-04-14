<template>
    <div
        class="p-5 bg-white rounded-lg shadow-md cursor-pointer hover:shadow-lg transition"
        @click="emit('open')"
    >
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-xl font-bold">{{ title }}</h2>
            <span
                :class="[
                    'text-xs font-semibold px-2 py-1 rounded',
                    isActive
                        ? 'bg-red-100 text-red-700'
                        : 'bg-green-100 text-green-700',
                ]"
            >
                {{ isActive ? "Incomplete" : "Complete" }}
            </span>
        </div>
        <p class="text-gray-600 text-sm mb-2 truncate">{{ description }}</p>
        <span class="text-xs text-gray-400">{{ createdAt }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    description: {
        type: String,
        required: false,
    },
    createdAt: {
        type: String,
        required: true,
    },
    isActive: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(["open"]);
</script>