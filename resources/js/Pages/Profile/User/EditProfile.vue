<template>
  <form class="max-w-3xl w-full mx-auto p-8 bg-white rounded-xl shadow-lg border border-gray-200" method="POST"
    action="/user/update/" enctype="multipart/form-data" @submit.prevent="salvarPerfil">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Editar Perfil</h2>

    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 mb-6">
      <input type="hidden" name="id" :value="form.id" />
      <img class="w-28 h-28 rounded-lg object-cover border"
        :src="form.foto && !fotoIsFile ? (fotoIsUrl ? form.foto : '/storage/' + form.foto) : 'https://i.pinimg.com/736x/b7/a7/7b/b7a77b0fdac3256310750c2217230edc.jpg'"
        alt="Foto do usuário" />
      <div class="w-full">
        <label class="block text-sm font-medium mb-1 text-gray-700">URL da Foto</label>
        <input type="text" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
          placeholder="Cole aqui a URL da imagem ou o caminho no storage" v-model="form.foto" :disabled="fotoIsFile" />
        <div class="mt-2 flex items-center gap-2">
          <span class="text-xs text-gray-400">ou</span>
          <label class="text-xs bg-gray-100 border px-2 py-1 rounded cursor-pointer hover:bg-gray-200">
            <input type="file" class="hidden" @change="onFileChange" accept="image/*" />
            Fazer upload
          </label>
          <button v-if="fotoIsFile" type="button" @click="clearFile" class="ml-2 text-xs text-red-500 hover:underline">
            Remover arquivo
          </button>
        </div>
      </div>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Nome completo</label>
      <input type="text" name="nome"
        class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" v-model="form.nome"
        required />
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">E-mail</label>
      <input type="email" name="email"
        class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500" v-model="form.email"
        required />
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Data de nascimento</label>
      <input type="date" name="data_nasc"
        class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.dataNascimento" />
      <p class="text-sm text-gray-500 mt-1">Idade: {{ idade }} anos</p>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Descrição</label>
      <textarea rows="4" name="descricao"
        class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.descricao"></textarea>
    </div>

    <div class="mb-6 flex items-center gap-2">
      <input type="checkbox" id="anonimo" name="anonimo" v-model="form.anonimo" class="h-4 w-4 text-purple-600" />
      <label for="anonimo" class="text-sm text-gray-700">🐱‍👤 Exibir como anônimo</label>
    </div>

    <button type="submit"
      class="bg-purple-600 text-white px-5 py-2 rounded-md hover:bg-purple-700 transition w-full sm:w-auto">
      Salvar perfil
    </button>
  </form>
</template>

<script setup>
import { ref, computed } from 'vue'

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')

const props = defineProps({
  user: Object
});

const form = ref({
  id: props.user.id || "",
  foto: props.user.foto || "",
  nome: props.user.name || "",
  email: props.user.email || "",
  dataNascimento: props.user.data_nasc || "",
  descricao: props.user.descricao || "",
  anonimo: !!props.user.anonimo
})

const idade = computed(() => {
  if (!form.value.dataNascimento) return 0
  const nascimento = new Date(form.value.dataNascimento)
  const hoje = new Date()
  let anos = hoje.getFullYear() - nascimento.getFullYear()
  const m = hoje.getMonth() - nascimento.getMonth()
  if (m < 0 || (m === 0 && hoje.getDate() < nascimento.getDate())) {
    anos--
  }
  return anos
})

const fotoIsUrl = computed(() =>
  typeof form.value.foto === 'string' && /^(https?:)?\/\//.test(form.value.foto)
)

const fotoIsFile = computed(() => form.value.foto instanceof File)

function onFileChange(e) {
  const file = e.target.files[0]
  if (!file) return
  form.value.foto = file
}

function clearFile() {
  form.value.foto = ""
}

function salvarPerfil() {
  const data = new FormData()
  data.append('id', form.value.id)
  data.append('name', form.value.nome)
  data.append('email', form.value.email)
  data.append('data_nasc', form.value.dataNascimento)
  data.append('descricao', form.value.descricao)
  data.append('anonimo', form.value.anonimo ? 1 : 0)
  if (form.value.foto instanceof File) {
    data.append('foto', form.value.foto)
  } else {
    data.append('foto', form.value.foto)
  }

  fetch('/user/update/', {
    method: 'POST',
    body: data,
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': csrfToken
    },
    credentials: 'same-origin'
  }).then(async response => {
    if (response.ok) {
      alert('Perfil atualizado com sucesso!')
    } else {
      let msg = 'Erro ao atualizar perfil.'
      try {
        const err = await response.json()
        msg = err.message || msg
      } catch (e) { }
      alert('Erro: ' + msg)
    }
  }).catch((err) => {
    alert('Erro: ' + err.message)
  })
}
</script>