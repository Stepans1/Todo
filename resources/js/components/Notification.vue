<template>
    <transition name="fade">
        <div
            v-if="notification.visible"
            :class="[
                'fixed top-6 left-1/2 transform -translate-x-1/2',
                'px-6 py-4 rounded-lg shadow-lg text-white text-lg font-semibold z-50',
                notification.type === 'error' ? 'bg-red-600' : 'bg-green-600',
            ]"
        >
            {{ notification.message }}
        </div>
    </transition>
</template>

<script setup>
import { useNotificationStore } from "../stores/notificationStore";
const notification = useNotificationStore();
</script>
