<script setup>
import ProjectForm from "@/views/project/components/ProjectForm.vue";
import {useRoute} from "vue-router";
const route = useRoute();
</script>

<template>
    <project-form :is-edit="true" :project-id="+route.params.id"></project-form>
</template>

<style scoped>

</style>
