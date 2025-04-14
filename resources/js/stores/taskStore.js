import { defineStore } from "pinia";
import { fetchTasks, saveTask, deleteTask, changeStatus } from "../api/taskApi";
import { useNotificationStore } from "../stores/notificationStore";

export const useTaskStore = defineStore("task", {
    state: () => ({
        tasks: [],
        selectedTask: null,
        selectedStatus: "-1",
        showCreateModal: false,
        notify: useNotificationStore(),
    }),

    actions: {
        showNotification(message, type = "error") {
            this.notify.show(message, type);
        },

        async loadTasks() {
            const response = await fetchTasks(this.selectedStatus);

            if (!response.isSuccess) {
                return this.showNotification(response.message);
            }

            this.tasks = response.data?.tasks || [];
        },

        async deleteTask() {
            if (!this.selectedTask) {
                return;
            }

            const response = await deleteTask(this.selectedTask.id);
            if (response.isSuccess) {
                this.tasks = this.tasks.filter(
                    (task) => task.id !== this.selectedTask.id
                );

                this.closeViewModal();
                this.showNotification("Successfully deleted", "success");

                return;
            }

            this.closeViewModal();
            this.showNotification(response.message);
        },

        async createTask(newTask) {
            const shouldAddImmediately =
                this.selectedStatus === "-1" || this.selectedStatus === "1";
            const response = await saveTask(
                newTask.title,
                newTask.description,
                shouldAddImmediately
            );

            this.closeCreateModal();

            if (response.isSuccess) {
                if (shouldAddImmediately && response.data.newTask) {
                    this.tasks.unshift(response.data.newTask);
                } 

                this.showNotification("Saved successfully", "success");

                return;
            }

            this.showNotification(response.message);
        },

        async changeTaskStatus() {
            const response = await changeStatus(this.selectedTask.id);

            if (response.isSuccess) {
                if (this.selectedStatus !== "-1") {
                    this.tasks = this.tasks.filter(
                        (task) => task.id !== this.selectedTask.id
                    );

                    this.closeViewModal();
                    this.showNotification("Status changed", "success");

                    return;
                }
                
                this.selectedTask.isActive = !this.selectedTask.isActive
        
                this.closeViewModal();
                this.showNotification("Status changed", "success");

                return;
            }

            this.closeViewModal();
            this.showNotification(response.message);
        },

        openViewModal(task) {
            this.selectedTask = task;
        },

        closeViewModal() {
            this.selectedTask = null;
        },

        openCreateModal() {
            this.showCreateModal = true;
        },

        closeCreateModal() {
            this.showCreateModal = false;
        },
    },
});
