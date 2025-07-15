<template>
  <div class="feeds flex flex-col self-center gap-2.5 min-h-screen w-full">
    <template v-for="p in allPosts" :key="p.id">
      <slot :post="p" />
    </template>

    <div class="end-flag h-2" ref="flag"></div>

    <div v-if="loading" class="loader-wrapper flex items-center justify-center py-4">
      <i class="fa-regular fa-heart text-4xl text-purple-800 animate-spin" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  posts: Array,
  nextPageUrl: String
})

const flag = ref(null)

const allPosts = ref([...props.posts])

watch(
  () => props.posts,
  newVal => { allPosts.value = [...newVal] }
)

const loading = ref(false)

function loadMore() {
  if (!props.nextPageUrl || loading.value) return
  loading.value = true

  router.get(props.nextPageUrl, {}, {
    preserveState: true,
    preserveScroll: true,
    only: ['posts', 'nextPageUrl'],
    onFinish: () => (loading.value = false)
  })
}

onMounted(() => {
  const observer = new IntersectionObserver(
    ([entry]) => { if (entry.isIntersecting) loadMore() },
    { threshold: 1 }
  )
  if (flag.value) observer.observe(flag.value)
})
</script>
