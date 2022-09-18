<template>
    <div class="bg-white p-8 rounded-2xl">
        <div class="flex justify-between">
            <h2 class="font-bold text-xl">{{ monthName }} {{ year }}</h2>
            <div class="inline-flex">
                <button @click="subMonth" class="hover:bg-gray-200" type="button"><ChevronLeftIcon class="w-6 h-6"></ChevronLeftIcon></button>
                <button @click="addMonth" class="hover:bg-gray-200" type="button"><ChevronRightIcon class="w-6 h-6"></ChevronRightIcon></button>
            </div>
        </div>

        <div class="mt-5 grid grid-cols-7 font-lato font-bold text-sm">
            <div class="text-center">Lunes</div>
            <div class="text-center">Martes</div>
            <div class="text-center">Miércoles</div>
            <div class="text-center">Jueves</div>
            <div class="text-center">Viernes</div>
            <div class="text-center">Sábado</div>
            <div class="text-center">Domingo</div>
        </div>
        <div v-if="calendarData">
            <div v-for="(week, i) in calendar" :key="i" class="grid grid-cols-7 font-lato space-y-4">
                <div v-for="(date, j) in week" :key="j" class="flex justify-center">
                    <div
                        class="w-16 h-16 flex items-center justify-center hover:bg-gray-100 hover:text-black rounded-2xl"
                        :class="{
                            'bg-red-500 text-white': isOffFrequencyDate(`${year}-${fillZero(month+1)}-${fillZero(date)}`),
                            'bg-yellow-100': isDisabledDate(`${year}-${fillZero(month+1)}-${fillZero(date)}`),
                            'bg-green-500': isReservedDate(`${year}-${fillZero(month+1)}-${fillZero(date)}`),
                        }"
                    >
                        {{ date }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
import { computed, onMounted, defineProps, ref, watch } from 'vue';

const props = defineProps({
    route: Number,
});
watch(() => props.route, (newValue, oldValue) => {
    getSchedule();
});

let year = ref('');
let month = ref('');
let day = ref('01');
// let initDate = ref()
let calendarData = ref(null);

onMounted(() => {
    let today = new Date();
    month.value = today.getMonth();
    year.value = today.getFullYear();

    getSchedule();
});

const firstMonthDay = computed(() => {
    return (new Date(year.value, month.value)).getDay();
});

const lastMonthDay = computed(() => {
    return (new Date(year.value, month.value + 1, 0)).getDate();
});

const daysInMonth = computed(() => {
    return 32 - new Date(year.value, month.value, 32).getDate();
});

const monthName = computed(() => {
    const date = new Date(year.value, month.value, 1);
    let name = date.toLocaleString('default', { month: 'long' });
    return name.charAt(0).toUpperCase() + name.slice(1);
});


const calendar = computed(() => {
    let date = 1;
    let calendar = [];
    for (let i = 0; i < 6; i++) {
        calendar[i] = [];

        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstMonthDay.value - 1) {
                calendar[i][j] = null;
            }
            else if (date > daysInMonth.value) {
                break;
            }
            else {
                calendar[i][j] = date;
                date++;
            }
        }
    }

    return calendar;
});

const getSchedule = () => {
    axios.get(`api/v1/route-schedule?date_init=${year.value}-${(month.value + 1)}-${day.value}&date_finish=${year.value}-${(month.value + 1)}-${lastMonthDay.value}&route_id=${props.route}`)
        .then(response => {
            calendarData.value = response.data;
        })
        .catch(error => {
            console.log(error.response.data);
        });
};

const isDisabledDate = (date) => {
    return calendarData.value.disabled_dates.find((disabledDate) => disabledDate == date);
};

const isOffFrequencyDate = (date) => {
    return calendarData.value.off_frequency_dates.find((offFrequencyDate) => offFrequencyDate == date);
};

const isReservedDate = (date) => {
    return calendarData.value.reserved_dates.find((reservedDate) => reservedDate == date);
};

const fillZero = (day) => {
    return String(day).padStart(2, '0');
};

const addMonth = () => {
    if (month.value >= 11) {
        year.value++;
        month.value = 0
    }
    else {
        month.value++;
    }

    getSchedule();
};

const subMonth = () => {
    if (month.value <= 0) {
        year.value--;
        month.value = 11
        return;
    }
    else {
        month.value--;
    }

    getSchedule();
}
</script>

<style>

</style>
