<script setup>
import routesName from "@/constans/routesName.js";
</script>

<template>
    <section class="flex flex-col flex-grow w-[700px] h-[500px]">
        <!--Toolbar-->
        <header class="fixed z-20 w-full">
            <div class="flex-col items-center m-auto bg-blue-500 text-white font-semibold gap-2">
                <router-link
                    :to="{name: routesName.home}"
                    class="hover:underline"
                >
                    Snippets
                </router-link>
                <span class="text-gray-900 font-bold">|</span>
                <router-link
                    :to="{name: routesName.apps_meta}"
                    class="hover:underline"
                >
                    Apps Meta
                </router-link>
                <span class="text-gray-900 font-bold">|</span>
                <router-link
                    :to="{name: routesName.test}"
                    class="hover:underline"
                >
                    Test
                </router-link>
            </div>
        </header>

        <main class="flex-1 flex flex-col p-1 mt-5">
            <div class="flex flex-col flex-grow">
                <router-view></router-view>
            </div>
        </main>
    </section>
</template>

<style scoped>

</style>