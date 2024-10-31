<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Página não encontrada" />
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="text-center p-8 bg-white rounded-lg shadow-md">
            <p class="mt-4 text-2xl font-semibold text-gray-900">Página Não Encontrada</p>
            <p class="mt-2 text-gray-500">A página que você está procurando não existe ou foi movida.</p>
            <Link href="/" class="mt-6 inline-block px-6 py-3 bg-orange-500 text-white font-medium rounded hover:bg-orange-600">
                Voltar ao Início
            </Link>
        </div>
    </div>
</template>
