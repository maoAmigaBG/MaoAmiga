<template>
  <!--
      <input type="hidden" name="id" :value="form.id" />

      <input type="text" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      placeholder="Cole aqui a URL da imagem ou o caminho no storage" v-model="form.foto" :disabled="fotoIsFile" />  

      <input type="email" name="email"
      class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" v-model="form.email"
      required />

      <input type="date" name="data_nasc"
      class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      v-model="form.dataNascimento" />

      <textarea rows="4" name="descricao"
      class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
      v-model="form.descricao"></textarea>

      checkbox usuario anonimo
      -->
  <div
    class="auth-background relative min-w-full min-h-[calc(100vh-91px)] flex justify-center items-center bg-right bg-cover overflow-y-auto py-10">
    <div class="login-wrapper max-w-2xl w-full flex flex-col bg-transparent px-4">
      <div class="header flex justify-start justify-self-start mb-6">
        <span class="logo text-3xl text-purple-900 font-bold">Editar Perfil de Usuário</span>
      </div>
      <div class="body flex grow justify-center items-center px-4 py-0">
        <div class="w-4/5 h-fit">
          <span class="lead font-bold font-poppins text-gray-500">Atualize aqui suas informações</span>
          <h1 class="main-title font-bold font-poppins text-purple-800 text-3xl pb-8">Informações Principais</h1>
          <form class="login-form w-full" enctype="multipart/form-data" @submit.prevent="salvarPerfil">
            <input type="hidden" name="id" v-model="form.id">
            <div class="flex flex-col items-center w-full gap-5">
              <div class="form-group relative w-full flex justify-center">
                <div class="relative w-1/3 h-1/3">
                  <img :src="previewFoto" alt="Perfil do Usuário"
                    class="w-full h-full object-cover aspect-square rounded-full border-4 border-purple-800">

                  <input type="file" class="hidden" ref="realPhotoInput" @change="updateFoto" accept="image/*" />

                  <button type="button" id="custom-profile-btn" @click="selecionarFoto"
                    class="absolute flex items-center bottom-1.5 right-1.5 bg-purple-800 text-white rounded-full p-4 cursor-pointer hover:bg-purple-700 transition">
                    <i class="fa-solid fa-pencil text-lg"></i>
                  </button>
                </div>
              </div>


              <div class="form-group relative w-full">
                <input
                  class="h-[50px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                  v-model="form.nome" type="text" id="nome" name="nome">
                <label
                  class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                  for="nome">Nome</label>
              </div>

              <div class="form-group relative w-full">
                <input
                  class="h-[50px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                  v-model="form.email" type="email" id="email" name="email">
                <label
                  class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                  for="email">E-mail</label>
              </div>

              <div class="form-group relative w-full">
                <input
                  class="h-[50px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                  v-model="form.password" type="password" id="password" name="password">
                <label
                  class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                  for="password">Senha</label>
              </div>
              <div class="form-group relative w-full">
                <input
                  class="h-[50px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                  v-model="form.password_confirmation" type="password" id="password_confirmation" name="password_confirmation">
                <label
                  class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                  for="password_confirmation">Confirmar Senha</label>
              </div>

              <div class="form-group relative w-full">
                <textarea
                  class="h-[100px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                  v-model="form.descricao" type="descricao" id="descricao" name="descricao"></textarea>
                <label
                  class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                  for="descricao">Descrição</label>
              </div>

              <button type="submit"
                class="w-full h-[50px] p-2 font-lg font-bold text-purple-50 bg-purple-800 rounded-md cursor-pointer hover:bg-purple-700 transition">Salvar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { usePage, router } from '@inertiajs/vue3'
import defaultProfile from '@/assets/default_user.jpg'

const props = defineProps({
  user: Object,
})

const realPhotoInput = ref(null)

const form = ref({
  id: props.user.id || "",
  foto: props.user.foto || "",
  nome: props.user.name || "",
  email: props.user.email || "",
  dataNascimento: props.user.data_nasc || "",
  descricao: props.user.descricao || "",
  anonimo: !!props.user.anonimo,
  password: '',
  password_confirmation: ''
})

const previewFoto = ref(
  typeof form.value.foto === 'string' && form.value.foto !== ''
    ? `/storage/${form.value.foto}`
    : defaultProfile
)

function selecionarFoto() {
  realPhotoInput.value.click()
}

function onFileChange(event) {
  const file = event.target.files[0]
  if (file) {
    form.value.foto = file
    previewFoto.value = URL.createObjectURL(file)
  }
}

function updateFoto(event) {
  const file = event.target.files[0];
  if (file) {
    form.value.foto = file;
    previewFoto.value = URL.createObjectURL(file);
  }
}


function salvarPerfil() {
  const data = new FormData()
  data.append('id', form.value.id)
  data.append('name', form.value.nome)
  data.append('email', form.value.email)
  data.append('password', form.value.password || '')
  data.append('password_confirmation', form.value.password_confirmation || '')

  data.append('data_nasc', form.value.dataNascimento)
  data.append('descricao', form.value.descricao)
  data.append('anonimo', form.value.anonimo ? 1 : 0)

  if (form.value.foto instanceof File) {
    data.append('foto', form.value.foto)
  }

  router.post('/user/update', data, {
    forceFormData: true,
    onSuccess: () => {
      router.visit(`/user/profile/${form.value.id}`)
    }
  })
}
</script>
