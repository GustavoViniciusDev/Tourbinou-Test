<script setup lang="ts">
import { ref } from 'vue'
import { PencilIcon, TrashIcon } from 'lucide-vue-next'

const tours = ref([
  { name: 'Tour nas Praias', schedule: 'Manhã', destination: 'João Pessoa - PB' },
  { name: 'Buggy pelas dunas', schedule: 'Tarde', destination: 'Natal - RN' },
  { name: 'Excursão Recife antiga', schedule: 'Manhã', destination: 'Recife - PE' },
  { name: 'Tour Via costeira', schedule: 'Noite', destination: 'Natal - RN' },
  { name: 'Escuna beira-mar', schedule: 'Tarde', destination: 'Tibau do Sul - RN' },
  { name: 'Tour nas Praias', schedule: 'Manhã', destination: 'João Pessoa - PB' },
  { name: 'Escuna beira-mar', schedule: 'Tarde', destination: 'Tibau do Sul - RN' },
  { name: 'Beach Tour', schedule: 'Tarde', destination: 'João Pessoa - PB' },
  { name: 'Excursão Recife antiga', schedule: 'Manhã', destination: 'Recife - PE' },
  { name: 'Tour Via costeira', schedule: 'Noite', destination: 'Natal - RN' },
])
</script>

<template>
  <div class="min-h-screen bg-gray-100">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Passeios</h1>
        <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded">
          Cadastrar passeio
        </button>
      </div>

      <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nome
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Horário
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Destino
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Ações</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="tour in tours" :key="tour.name">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                {{ tour.name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ tour.schedule }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                {{ tour.destination }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <button class="text-gray-400 hover:text-gray-500 mr-2">
                  <PencilIcon class="h-5 w-5" />
                </button>
                <button class="text-gray-400 hover:text-gray-500">
                  <TrashIcon class="h-5 w-5" />
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
        <div class="flex-1 flex justify-between sm:hidden">
          <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Anterior
          </a>
          <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
            Próximo
          </a>
        </div>
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
          <div>
            <p class="text-sm text-gray-700">
              Mostrando passeios: <span class="font-medium">1</span> ao <span class="font-medium">10</span> de <span class="font-medium">123</span> (itens ao todo)
            </p>
          </div>
          <div>
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Anterior</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" aria-current="page" class="z-10 bg-orange-50 border-orange-500 text-orange-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                3
              </a>
              <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
                ...
              </span>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 hidden md:inline-flex relative items-center px-4 py-2 border text-sm font-medium">
                8
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                9
              </a>
              <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                10
              </a>
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Próximo</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
