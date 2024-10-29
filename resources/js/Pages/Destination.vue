<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import DestinationsLayout from '@/Components/DestinationsLayout.vue';
</script>

<template>
    <Head title="Destinos" />
    <AuthenticatedLayout>
        <DestinationsLayout />
    </AuthenticatedLayout>
</template>
