import "./bootstrap";
import { createApp } from "vue";
// import "../css/app.css";
import router from "./router.js";

import App from "./App.vue";

// createApp(App).mount("#app");
createApp(App).use(router).mount("#app");
