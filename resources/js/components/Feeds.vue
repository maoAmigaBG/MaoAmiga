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
const STORAGE_KEY = 'cachedPosts'

watch(
  () => props.posts,
  (newVal) => {
    const existingIds = new Set(allPosts.value.map(p => p.id))
    const newPosts = newVal.filter(p => !existingIds.has(p.id))

    if (newPosts.length > 0) {
      allPosts.value.push(...newPosts)
      localStorage.setItem(STORAGE_KEY, JSON.stringify({
        posts: allPosts.value,
        timestamp: Date.now()
      }))
    }
  }
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
  const cached = localStorage.getItem(STORAGE_KEY)
  if (cached) {
    try {
      const { posts, timestamp } = JSON.parse(cached)
      const now = Date.now()

      if (now - timestamp < 3600000) {
        allPosts.value = posts
      } else {
        localStorage.removeItem(STORAGE_KEY)
      }
    } catch (e) {
      console.error('Erro ao parsear cache:', e)
      localStorage.removeItem(STORAGE_KEY)
    }
  }

  const observer = new IntersectionObserver(
    ([entry]) => { if (entry.isIntersecting) loadMore() },
    { threshold: 1 }
  )
  if (flag.value) observer.observe(flag.value)
})

</script>
