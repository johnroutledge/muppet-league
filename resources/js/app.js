import './bootstrap';

import { createApp } from 'vue';

window.Vue = import('vue');

const app = createApp({});

import TeamSelector from './components/TeamSelector.vue';

app.component('team-selector', TeamSelector);

app.mount('#app');