<script setup>
import {ref} from "vue";
const contextMenu = ref(false);
</script>

<template>
    <div>
        <q-btn flat round dense>
            <q-icon name="more_vert"/>
        </q-btn>
        <q-menu v-model="contextMenu">
            <slot></slot>
        </q-menu>
    </div>
</template>

<style scoped>

</style>
