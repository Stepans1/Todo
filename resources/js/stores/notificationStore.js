import { defineStore } from "pinia";

export const useNotificationStore = defineStore("notification", {
    state: () => ({
        message: "",
        type: "error",
        visible: false,
    }),

    actions: {
        show(message, type = "error") {
            this.message = message;
            this.type = type;
            this.visible = true;

            setTimeout(() => {
                this.visible = false;
            }, 5000);
        },
    },
});
