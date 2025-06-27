<template>
  <div class="w-60 bg-gray-200 p-2 rounded-md">
    <ul class="space-y-1">
      <li
        v-for="item in menu"
        :key="item.label"
        @click="selectItem(item.route)"
        :class="[
          'flex items-center gap-2 px-4 py-2 rounded cursor-pointer transition',
          selected === item.route ? 'bg-cyan-900 text-white' : 'hover:bg-gray-300'
        ]"
      >
        <span class="text-xl">{{ item.icon }}</span>
        <span class="text-sm">{{ item.label }}</span>
    </li>
    </ul>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const selected = ref('detalhes')

const menu = [
  { label: 'Detalhes da conta', route: 'user/profile/', icon: '🏠' },
  { label: 'Gerenciar conta', route: 'user/profile/{:id}/edit', icon: '👤' },
  { label: 'ONGs relacionada', route: 'user.relations', icon: '🌍' },
  { label: 'Sair da conta', route: 'user/logout', icon: '↩️' }
]

function selectItem(routeName) {
  selected.value = routeName
}

const props = defineProps({
  user: Object
});

</script>
