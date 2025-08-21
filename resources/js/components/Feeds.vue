<template>
  <div class="feeds flex flex-col self-center gap-2.5 min-h-screen w-full">
    <template v-for="p in allPosts" :key="p.id">
      <slot :post="p" @update-likes="handleLikeUpdate" />
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
const nextPageUrl = ref(props.nextPageUrl)
const STORAGE_KEY = 'cachedPosts'

watch(
  () => props.posts,
  (newVal) => {
    // This is the main change. We'll now merge the new posts with the old ones.
    // This ensures that updates to existing posts (like the 'liked' status) are reflected.
    const newPosts = newVal.reduce((acc, currentPost) => {
      // Find if the post already exists in the accumulator
      const existingPostIndex = acc.findIndex(p => p.id === currentPost.id);
      if (existingPostIndex > -1) {
        // If it exists, replace it with the updated post
        acc[existingPostIndex] = currentPost;
      } else {
        // If it's a new post, add it to the list
        acc.push(currentPost);
      }
      return acc;
    }, [...allPosts.value]);

    allPosts.value = newPosts;

    localStorage.setItem(STORAGE_KEY, JSON.stringify({
      posts: allPosts.value,
      timestamp: Date.now()
    }));
  }
)

watch(
  () => props.nextPageUrl,
  (newUrl) => {
    nextPageUrl.value = newUrl
  }
)

const loading = ref(false)

function loadMore() {
  if (!nextPageUrl.value || loading.value) return
  loading.value = true

  router.get(nextPageUrl.value, {}, {
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