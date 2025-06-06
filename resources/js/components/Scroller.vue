<template>
  <div class="scroller w-full p-4 bg-slate-50 overflow-y-auto scrollbar-thin scrollbar-thumb-purple-800 scrollbar-track-transparent">
    <slot></slot>
  </div>
</template>

<script>
export default {
    name: 'Scroller'
}
</script>