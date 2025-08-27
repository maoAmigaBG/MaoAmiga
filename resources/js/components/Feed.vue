<template>
  <div class="feed relative w-full p-5 font-poppins bg-slate-50 border-b-2 border-[#E5E4E2]">
    <div class="head flex justify-between p-2.5">
      <Link :href="`/ong/profile/${post.ong.id}`" class="user flex items-center gap-2.5 no-underline">
      <div class="profile-img">
        <img :src="'/storage/' + post.ong.foto" alt=""
          class="h-[70px] w-[70px] object-cover object-center rounded-full" />
      </div>
      <div class="info w-3/4">
        <h3 class="font-semibold">{{ post.ong.nome }}</h3>
        <small class="truncate w-full block">{{ post.ong.endereco }}</small>
        <small v-if="post.created_at">{{ formattedTime }}</small>
      </div>
      </Link>
      <span class="edit flex items-center text-[28px]">
        <i class="fa-solid fa-ellipsis"></i>
      </span>
    </div>

    <template v-if="post.foto">
      <div class="photo my-4 rounded-[7px_40px_7px_92px] overflow-hidden cursor-pointer" @click="openModal">
        <img :src="'/storage/' + post.foto" alt="" class="w-full h-[400px] object-cover object-center" />
      </div>

      <div class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-2 mb-4">
        <i @click="toggleLike" :class="[
          'cursor-pointer',
          animating ? 'pop-animation' : '',
          isLiked ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
        ]"></i>
        <i class="fa-regular fa-comments cursor-pointer" @click="openModal"></i>
        <i class="fa-regular fa-share-from-square"></i>
      </div>
    </template>

    <div class="caption mb-2" @click="openModal">
      <b>{{ post.ong.nome }}</b> {{ post.descricao }}
    </div>
    <template v-if="!post.foto">
      <div class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-4">
        <i @click="toggleLike" :class="[
          'cursor-pointer',
          animating ? 'pop-animation' : '',
          isLiked ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
        ]"></i>
        <i class="fa-regular fa-comments" @click="openModal"></i>
        <i class="fa-regular fa-share-from-square"></i>
      </div>
    </template>
  </div>

  <template v-if="isModalOpen">
    <div class="fixed top-[91px] flex items-center justify-center inset-0 bg-[rgba(0,0,0,0.7)] backdrop-blur z-10 p-6"
      @click="closeModal">
      <div class="post-modal w-1/2 h-[95%] flex bg-slate-50 rounded-lg" @click.stop>
        <div class="w-1/2 h-full flex items-center justify-center bg-black rounded-tl-lg rounded-bl-lg">
          <img v-if="post.foto" :src="'/storage/' + post.foto" alt=""
            class="w-full h-auto max-h-full object-contain bg-black" />
        </div>
        <div class="relative w-1/2 flex-col justify-end">
          <div
            class="header absolute top-0 w-full h-20 flex items-center justify-between px-6 border-b-2 border-[#E5E4E2]">
            <div class="profile-wrapper flex items-center gap-4">
              <div class="profile-img-wrapper w-14 h-14 p-[2px] border-2 border-purple-800 rounded-full">
                <img :src="'/storage/' + post.ong.foto" :alt="'Perfil da Ong ' + post.ong.nome"
                  class="aspect-square object-cover w-full rounded-full">
              </div>
              <div class="profile-info py-2" :class="post.descricao ? '' : 'shadow-md'">
                <span class="profile-name block text-purple-800 font-poppins font-bold">{{ post.ong.nome }}</span>
                <div class="location-hour text-xs text-gray-600 flex items-center">
                  <span class="inline-block max-w-[120px] truncate">{{ post.ong.endereco }}</span>
                  <span class="ml-1">- {{ formattedTime }}</span>
                </div>
              </div>
            </div>
            <div class="actions">
              <i class="fa-solid fa-ellipsis-vertical text-purple-800 text-xl cursor-pointer"></i>
            </div>
          </div>
          <div class="comments mt-20 pt-2 pb-4 flex-col flex-grow overflow-y-auto">
            <template v-if="post.comments">
              <div v-if="post.descricao" class="post-content px-4 py-2 border-b-2 border-[#E5E4E2] shadow-md">
                <p class="text-sm indent-4">
                  {{ post.descricao }}
                </p>
              </div>
              <div v-for="comment in post.comments" :key="comment.id"
                class="comment flex pl-4 pr-6 py-2 border-b-2 border-[#E5E4E2] items-center">
                <div class="left flex-start flex-grow flex-col">
                  <div class="header w-full flex justify-start items-center gap-2">
                    <div class="profile-img-wrapper inline-block w-8 h-8 border-4 border-[#E5E4E2] rounded-full">
                      <img :src="'storage/' + comment.user.foto" :alt="'Perfil da Ong ' + post.ong.nome"
                        class="aspect-square object-cover w-full mx-auto my-auto rounded-full">
                    </div>
                    <span class="username inline-block text-purple-800 font-bold">{{ comment.user.name }}</span>
                  </div>
                  <p class="content text-gray-600 text-sm indent-4">
                    {{ comment.comment_content }}
                  </p>
                </div>
                <div class="right">
                  <i v-if="auth.user?.name !== comment.user?.name || auth.user?.name === null"
                    @click="toggleCommentLike(comment.id)" :class="[
                      'cursor-pointer',
                      'text-base',
                      isCommentLiked(comment) ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
                    ]"></i>

                  <i v-else @click="deleteComment(comment.id)"
                    class="fa-solid fa-trash-can text-base text-red-800 cursor-pointer"></i>
                </div>
              </div>
            </template>
          </div>
          <div
            class="footer absolute bottom-0 h-28 w-full px-4 border-t-2 border-[#E5E4E2] shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
            <div class="action-buttons w-full flex items-center gap-4 text-3xl mt-2 mb-4">
              <i @click="toggleLike" :class="[
                'cursor-pointer',
                animating ? 'pop-animation' : '',
                isLiked ? 'fa-solid fa-heart text-red-800' : 'fa-regular fa-heart'
              ]"></i>
              <i class="fa-regular fa-comments cursor-pointer" @click="() => { commentInput.focus(); }"></i>
              <i class="fa-regular fa-share-from-square ml-auto"></i>
            </div>
            <div class="comment-input-wrapper flex items-center gap-2">
              <div class="profile-img-wrapper inline-block w-10 border-4 border-[#E5E4E2] rounded-full">
                <img :src="(auth.user?.foto ? ('/storage/' + auth.user.foto) : defaultUserImg)"
                  :alt="'Perfil da Ong ' + post.ong.nome" class="aspect-square object-cover rounded-full">
              </div>
              <input type="text" placeholder="Adicionar um comentário..."
                class="w-full h-10 p-4 text-sm border-2 border-[#E5E4E2] rounded-full" v-model="newComment"
                ref="commentInput" @keydown.enter="addComment">
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import defaultUserImg from '@/assets/default_user.jpg'

const props = defineProps({
  auth: Object,
  post: Object,
  login_checked: Boolean
})



const isLiked = computed(() => {
  return props.post.liked;
})

const animating = ref(false)

const formattedTime = computed(() => {
  if (!props.post.created_at) return '';
  const date = new Date(props.post.created_at);
  const now = new Date();
  const diffInHours = Math.floor((now - date) / (1000 * 60 * 60));
  const diffInDays = Math.floor(diffInHours / 24);

  if (diffInHours < 24) {
    return `${diffInHours}h atrás`;
  } else if (diffInDays < 7) {
    return `${diffInDays}d atrás`;
  } else {
    return date.toLocaleDateString();
  }
});

const isModalOpen = ref(false)

function openModal() {
  isModalOpen.value = true
}

function closeModal() {
  isModalOpen.value = false
}

const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function toggleLike() {
  if (!props.login_checked) {
    router.get('/user/login');
    return;
  }

  if (props.post.liked) {
    const likeId = props.post.likes?.[0]?.id;
    await fetch(`/post/deslike/${likeId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });

    router.reload({ only: ['posts'] });

  } else {
    await fetch(`/post/like/${props.post.id}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });

    router.reload({ only: ['posts'] });

    animating.value = false;
    setTimeout(() => {
      animating.value = true;
      setTimeout(() => animating.value = false, 500);
    }, 10);
  }
}

const commentInput = ref(null);
const newComment = ref('');

async function addComment() {
  if (!props.login_checked) {
    router.get('/user/login');
    return;
  }

  if (!newComment.value.trim()) return;

  try {
    const response = await fetch('/comment/store', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        post_id: props.post.id,
        comment_content: newComment.value
      })
    });

    if (response.ok) {
      router.reload({ only: ['posts'] });
      newComment.value = ''
    }
  } catch (err) {
    console.log("Erro adicionando comentário: " + err);
  }
}

async function toggleCommentLike(commentId) {
  if (!props.login_checked) {
    router.get('/user/login');
    return;
  }

  const commentLike = commentId.likes?.find(like => like.user_id === props.auth.user.id);

  if (commentLike) {
    await fetch(`/comment/toggle_like/${commentId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });
  } else {
    await fetch(`/comment/toggle_like/${commentId}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });
  }

  router.reload({ only: ['posts'] });
}

function isCommentLiked(comment) {
  if (props.auth?.user) {
    return comment.likes?.some(like => like.user_id === props.auth?.user.id);
  } else {
    return false;
  }
}

async function deleteComment(commentId) {
  try {
    const response = await fetch(`/comment/delete/${commentId}`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': token,
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    });

    if (response.ok) {
      router.reload({ only: ['posts'] });
    }
  } catch(err) {
      console.log('Error reading post' + err);
  }
}  

</script>

<style scoped>
@keyframes pop {
  0% {
    transform: scale(0) rotate(0deg);
    opacity: 0;
  }

  50% {
    transform: scale(1.4) rotate(180deg);
    opacity: 1;
  }

  100% {
    transform: scale(1) rotate(360deg);
    opacity: 1;
  }
}

.pop-animation {
  animation: pop 0.5s ease-out forwards;
}

.backdrop-blur-sm {
  backdrop-filter: blur(4px);
}
</style>