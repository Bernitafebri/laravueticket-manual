// import "./bootstrap";
// import { createApp } from "vue";
// // import "../css/app.css";
// import router from "./router.js";

// import App from "./App.vue";

// // createApp(App).mount("#app");
// createApp(App).use(router).mount("#app");

// import "./assets/main.css";
// // Import Swiper styles
// import "swiper/css";
// import "swiper/css/navigation";
// import "swiper/css/pagination";
// import "jsvectormap/dist/jsvectormap.css";
// import "flatpickr/dist/flatpickr.css";

import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
// import VueApexCharts from "vue3-apexcharts";

const app = createApp(App);

app.use(router);
// app.use(VueApexCharts);

app.mount("#app");
