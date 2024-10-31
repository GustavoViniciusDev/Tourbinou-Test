<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DestinationsLayout from '@/Pages/Destinations/DestinationsLayout.vue';
import { Head } from '@inertiajs/vue3';

interface Ride {
    id: string;
    destino_id: string;
}


interface Destination {
    id: string;
    cidade: string;
    estado: string;
    rides: Ride[];
}

const props = defineProps<{ destinations: Destination[] }>();
</script>

<template>
    <Head title="Destinos" />
    <AuthenticatedLayout>
        <DestinationsLayout :destinations="props.destinations" />
    </AuthenticatedLayout>
</template>
