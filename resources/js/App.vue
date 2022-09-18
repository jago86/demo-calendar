<template>
    <div class="w-full h-full flex py-8 px-8">
        <div class="w-1/5 max-w-xs bg-[#519BD0] pt-32 px-10 rounded-3xl">
            <nav class="flex flex-col text-white gap-y-8">
                <a href="" class="inline-flex">
                    <ChartPieIcon class="w-6 h-6 mr-2"></ChartPieIcon>
                    Dashboard
                </a>
                <a href="" class="inline-flex">
                    <TagIcon class="w-6 h-6 mr-2"></TagIcon>
                    Transactions
                </a>
                <a href="" class="inline-flex font-bold">
                    <CalendarDaysIcon class="w-6 h-6 mr-2"></CalendarDaysIcon>
                    Schedules
                </a>
                <a href="" class="inline-flex">
                    <UserCircleIcon class="w-6 h-6 mr-2"></UserCircleIcon>
                    Users
                </a>
                <a href="" class="inline-flex">
                    <Cog6ToothIcon class="w-6 h-6 mr-2"></Cog6ToothIcon>
                    Settings
                </a>
            </nav>
        </div>
        <div class="flex-1 px-10">
            <div class="flex items-start">
                <div class="w-3/4">
                    <h1 class="font-bold text-2xl">Schedules</h1>
                    <div class="mt-3 pl-5 font-lato">
                        <label for="range-picker" class="text-sm">Seleccione fecha</label>
                        <div class="relative w-[19rem] bg-white py-2 px-2 rounded-2xl">
                            <input type="date">
                            <input type="date">
                            <CalendarDaysIcon class="w-6 h-6 absolute top-2 right-2"></CalendarDaysIcon>
                        </div>
                    </div>
                </div>
                <div class="flex-1 flex justify-around items-center">
                    <div class="w-2/3 relative">
                        <input type="text" class="w-full px-3 py-1 rounded-lg" placeholder="Search...">
                        <MagnifyingGlassIcon class="w-5 h-5 absolute top-[0.35rem] right-2 text-gray-400"></MagnifyingGlassIcon>
                    </div>
                    <div>
                        <BellIcon class="w-6 h-6"></BellIcon>
                    </div>
                    <div>
                        <img class="w-7 rounded-full" src="https://xsgames.co/randomusers/assets/avatars/male/73.jpg" alt="User">
                    </div>
                </div>
            </div>
            <div class="mt-5 pl-5 flex">
                <div class="flex-1 mr-5">
                    <Calendar v-if="routes.length" :route="selectedRoute"></Calendar>
                </div>
                <div class="w-1/4 px-8 py-8 bg-white rounded-2xl">
                    <h3 class="font-bold">Rutas disponibles</h3>
                    <div class="mt-5 flex flex-col gap-y-2 font-lato text-sm">
                        <button
                            v-for="route in routes"
                            :key="route.id"
                            class="pl-2 border-l-4 border-l-green-400 hover:bg-gray-200 text-left"
                            :class="{
                                'bg-gray-100': route.id == selectedRoute
                            }"
                            type="button"
                            @click="selectedRoute = route.id"
                        >
                            {{ route.title }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { BellIcon, CalendarDaysIcon, ChartPieIcon, Cog6ToothIcon, TagIcon, UserCircleIcon } from '@heroicons/vue/24/outline';
import { MagnifyingGlassIcon } from '@heroicons/vue/20/solid';
import Calendar from '@/components/Calendar.vue';
import { onMounted, ref } from 'vue';

let routes = ref([])
let selectedRoute = ref(null);

onMounted(() => {

    axios.get(`api/v1/routes`)
        .then(response => {
            routes.value = response.data;
            selectedRoute.value = routes.value[0].id
        })
        .catch(error => {
            console.log(error.response.data);
        });

});



</script>

<style>

</style>
