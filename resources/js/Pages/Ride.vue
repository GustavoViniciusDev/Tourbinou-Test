<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import RadeLayout from '@/Pages/Rides/RideLayout.vue';
</script>

<template>
    <Head title="Passeio" />
    <AuthenticatedLayout>
        <RadeLayout />
    </AuthenticatedLayout>
</template>
