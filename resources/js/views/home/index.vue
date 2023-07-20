<script setup>
import Codemirror from "codemirror-editor-vue3";

// placeholder
import "codemirror/addon/display/placeholder.js";

// language
import "codemirror/mode/javascript/javascript.js";
// placeholder
import "codemirror/addon/display/placeholder.js";
// theme
import "codemirror/theme/dracula.css";

import { ref } from "vue";
const code = ref(``);

const cmOptions = ref({
    mode: "text/javascript", // Language mode
    // theme: "dracula", // Theme
})

const change = (e) => {
    console.log(e);
}

</script>

<template>
    <h1>Home12321</h1>
    <Codemirror
        v-model:value="code"
        :options="cmOptions"
        border
        placeholder="test placeholder"
        :height="200"
        @change="change"
    />
</template>

<style scoped>

</style>
