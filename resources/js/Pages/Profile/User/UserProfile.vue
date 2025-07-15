<template>
  <div class="profile-wrapper min-w-full flex flex-col justify-center">
    <div
      class="profile-box relative w-full h-50 flex flex-col bg-gradient-to-t from-violet-900 to-purple-500 text-center text-white p-10"
    >
      <img
        class="profile-pic absolute top-[50%] w-48 p-2 bg-purple-50 rounded-full shadow-lg"
        :src="props.user.foto ? '/storage/' + props.user.foto : defaultUserImg"
        alt="Foto do usuário"
      />
    </div>

    <div class="profile-info pt-30 px-10">
      <h3 class="font-poppins font-bold text-purple-800 text-4xl pb-2">{{ props.user.name }}</h3>
      <p class="font-poppins text-gray-600 text-xl pb-6">{{ props.user.email }}</p>

      <p class="user-date">
        <span class="inline-flex items-center gap-2 font-bold text-lg text-purple-800 pr-2">
          <i class="fa-solid fa-calendar"></i>
          Ativo desde:
        </span>
        {{ props.user.format_data }}
      </p>

      <p class="user-age">
        <span class="inline-flex items-center gap-2 font-bold text-lg text-purple-800 pr-2 pb-6">
          <i class="fa-solid fa-cake-candles"></i>
          Idade:
        </span>
        {{ props.user.age }} Anos
      </p>

      <h3 class="font-poppins font-bold text-2xl text-purple-800 pb-4">Descrição: </h3>
      <p class="font-poppins text-gray-600 text-xl indent-15 pb-6">{{ props.user.descricao }}</p>

      <SubNav class="-mx-10" :items="items" v-model:active="activeKey" />

      <main class="p-6">
        <div class="posted" v-if="activeKey === 'posts'">
          <Feeds :posts="posts" :nextPageUrl="postsNext" :key="posts.length" v-slot="{ post }">
            <Feed
              :key="post.id"
              :post="post"
              @update-likes="handleLikesUpdate"
            />
          </Feeds>
        </div>

        <div class="ong-relations" v-else-if="activeKey === 'relations'">
          <div class="ong-relations-wrapper min-w-full flex flex-col justify-center">
            <div class="relations-info py-3 px-10">
              <div class="ong-relations-header flex items-center justify-between">
                <h3 class="font-poppins font-bold text-2xl text-purple-800 pb-4">ONGs Relacionadas: </h3>
                <button
                  class="flex items-center gap-2 bg-purple-800 font-bold text-white px-4 py-3 rounded cursor-pointer hover:bg-purple-600"
                >
                  <i class="fa-solid fa-pen-to-square"></i>
                  Gerenciar ONGs
                </button>
              </div>
            </div>
            <div class="ong-relations flex flex-col gap-4 py-6 px-10">
              <div
                v-for="ong in ong_relations"
                :key="ong.id"
                class="bg-white rounded p-4 flex items-center gap-4 shadow-sm border-2 border-purple-800 hover:shadow-md transition"
              >
                <img
                  class="w-20 h-20 object-cover rounded border-2 border-purple-800"
                  :src="ong.foto ? `/storage/${ong.foto}` : defaultUserImg"
                  alt="Imagem da ONG"
                />
                <div class="flex-1 gap-2">
                  <h3 class="font-bold text-lg text-purple-800">{{ ong.nome }}</h3>
                  <p class="font-bold text-sm text-gray-600">{{ ong.type }}</p>
                  <p v-if="ong.created_at" class="text-gray-500 text-xs">
                    Ativo desde: {{ formatarData(ong.created_at) }}
                  </p>
                  <p v-else class="text-gray-400 text-xs mt-1 italic">Data indisponível</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="liked-posts" v-else-if="activeKey === 'likes'">
          <Feeds :posts="likes" :nextPageUrl="likesNext" :key="likes.length" v-slot="{ post }">
            <Feed
              :key="post.id"
              :post="post"
              @update-likes="handleLikesUpdate"
            />
          </Feeds>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import SubNav from '../../../components/SubNav.vue'
import Feeds from '../../../components/Feeds.vue'
import Feed from '../../../components/Feed.vue'
import defaultUserImg from '@/assets/default_user.jpg'

const { props } = usePage()

const likes = ref([... (props.likes?.data ?? [])])
const likesNext = computed(() => props.likes?.next_page_url ?? null)

const posts = ref([... (props.posts ?? [])])
const postsNext = ref(props.postsNext ?? null)

const ong_relations = ref(props.ong_relations || [])

const items = [
  { key: 'likes', label: 'Curtidas', to: '#' },
  { key: 'relations', label: 'ONGs Relacionadas', to: '#' },
]

if (props.isAdminOfOng === true) {
  items.unshift({
    key: 'posts', label: 'Posts', to: '#' ,
  })
}

const activeKey = ref(items[0].key)

function formatarData(dateStr) {
  if (!dateStr) return ''
  return new Date(dateStr).toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: 'long',
    year: 'numeric',
  })
}


function handleLikesUpdate(payload) {
  if (payload.action === 'remove' && payload.postId) {
    likes.value = likes.value.filter((p) => p.id !== payload.postId)
  } else if (payload.action === 'add' && payload.post) {
    if (!likes.value.find((p) => p.id === payload.post.id)) {
      likes.value.push(payload.post)
    }
  }
}
</script>
