import "../css/app.css";

import { createApp } from "vue";
import { createPinia } from "pinia"; 
import App from "./App.vue";

const el = document.getElementById("app");

const statuses = JSON.parse(el.dataset.statuses);

const app = createApp(App, { statuses });

const pinia = createPinia();      
app.use(pinia);                  

app.mount("#app");
