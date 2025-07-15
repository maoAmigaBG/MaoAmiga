<template>
  <div class="sub-nav-wrapper h-20 my-4 shadow-[inset_0_6px_6px_-6px_rgba(0,0,0,0.15),inset_0_-6px_6px_-6px_rgba(0,0,0,0.15)]">
    <nav class="navbar h-full w-full">
      <ul class="nav-links h-full flex justify-between items-center px-28 text-lg">
        <li
          v-for="item in items"
          :key="item.key"
          @click="$emit('update:active', item.key)"
          class="px-4 py-2 font-bold whitespace-nowrap transition"
          :class="isActive(item)
            ? 'bg-purple-800 text-slate-50 border-4 border-purple-600 rounded-full'
            : 'text-purple-800'"
        >
          <span>{{ item.label }}</span>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script setup>
const props = defineProps({
  items:  { type: Array,   required: true },
  active: { type: String,  required: true }
})

const isActive = item => item.key === props.active
</script>
