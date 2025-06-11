<template>
  <div class="max-w-3xl w-full mx-auto p-8 bg-white rounded-xl shadow-lg border border-gray-200">
    <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Editar Perfil</h2>

    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 mb-6">
      <img class="w-28 h-28 rounded-lg object-cover border" :src="form.foto ? '/storage/' + form.foto : 'https://i.pinimg.com/736x/b7/a7/7b/b7a77b0fdac3256310750c2217230edc.jpg'"
        alt="Foto do usuário" />
      <div class="w-full">
        <label class="block text-sm font-medium mb-1 text-gray-700">URL da Foto</label>
        <input type="text" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
          placeholder="Cole aqui a URL da imagem" v-model="form.foto" />
      </div>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Nome completo</label>
      <input type="text" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.nome" />
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">E-mail</label>
      <input type="email" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.email" />
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Data de nascimento</label>
      <input type="date" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.dataNascimento" />
      <p class="text-sm text-gray-500 mt-1">Idade: {{ idade }} anos</p>
    </div>

    <div class="mb-4">
      <label class="block font-medium mb-1 text-gray-700">Descrição</label>
      <textarea rows="4" class="border p-2 w-full rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
        v-model="form.descricao"></textarea>
    </div>

    <div class="mb-6 flex items-center gap-2">
      <input type="checkbox" id="anonimo" v-model="form.anonimo" class="h-4 w-4 text-purple-600" />
      <label for="anonimo" class="text-sm text-gray-700">🐱‍👤 Exibir como anônimo</label>
    </div>

    <button class="bg-purple-600 text-white px-5 py-2 rounded-md hover:bg-purple-700 transition w-full sm:w-auto"
      @click="salvarPerfil">
      Salvar perfil
    </button>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  user: Object
});

const form = ref({
  foto: props.user.foto,
  nome: props.user.name,
  email: props.user.email,
  dataNascimento: props.user.data_nasc,
  descricao: props.user.name,
  anonimo: false
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

const salvarPerfil = () => {
  console.log('Dados atualizados:', form.value)
  alert('Perfil atualizado com sucesso!')
}
</script>