<template>
  <div class="scroller fixed top-[87px] right-0 h-[calc(100vh-87px)] w-[calc(25%-10px)] p-4 bg-slate-50 border-l-[3px] border-[#E5E4E2] overflow-y-auto scrollbar-thin scrollbar-thumb-[#BF3BF7] scrollbar-track-transparent">
    <slot></slot>
  </div>
</template>

<script>
export default {
    name: 'Scroller'
}
</script>