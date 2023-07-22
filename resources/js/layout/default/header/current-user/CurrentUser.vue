<script setup>
    import {computed} from "vue";
    import {useStore} from "vuex";
    const store = useStore();
    const user = computed(() => store.state.auth.user);
</script>

<template>
    <div class="flex items-center cursor-pointer gap-1">
        <div class="flex items-center p-1 shrink-0 rounded-full bg-gray-50">
            <img :src="user.avatar" alt="current user avatar"  width="42" height="42"/>
        </div>
        <div>
            <h2 class="text-md font-semibold">{{user.name}}</h2>
            <h3 class="text-sm text-gray-500">{{user.title}}</h3>
        </div>
    </div>
</template>

<style scoped>

</style>
