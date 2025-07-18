<template>
    <div
        class="auth-background relative min-w-full min-h-[calc(100vh-91px)] flex justify-center items-center bg-right bg-cover overflow-y-auto py-10">
        <div class="login-wrapper max-w-2xl w-full flex flex-col bg-transparent px-4">
            <div class="header flex justify-start justify-self-start mb-6">
                <span class="logo text-3xl text-purple-900 font-bold">Editar {{ ong.nome }}</span>
            </div>
            <div class="body flex grow justify-center items-center px-4 py-0">
                <div class="w-4/5 h-fit">
                    <span class="lead font-bold font-poppins text-gray-500">Atualize aqui suas informações</span>
                    <h1 class="main-title font-bold font-poppins text-purple-800 text-3xl pb-8">Informações Principais
                    </h1>
                    <form class="login-form w-full" enctype="multipart/form-data" @submit.prevent="submit">
                        <div class="flex flex-col items-center w-full space-y-5">
                            <div class="form-group relative w-full pt-4">
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
                                    v-model="form.subtitulo" type="text" id="subtitulo" name="subtitulo">
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                                    for="subtitulo">Subtítulo</label>
                            </div>
                            <div class="form-group relative w-full">
                                <textarea
                                    class="h-[100px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.descricao" type="descricao" id="descricao" name="descricao"></textarea>
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                                    for="descricao">Descrição</label>
                            </div>

                            <div class="form-group relative w-full">
                                <input
                                    class="h-[50px] p-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    v-model="form.endereco" type="text" id="endereco" name="endereco">
                                <label
                                    class="absolute top-0 left-4 max-h-fit transform -translate-y-1/2 text-purple-800 text-lg px-2 py-0 bg-slate-50 pointer-events-none"
                                    for="endereco">Endereço</label>
                            </div>

                            <div class="separator flex items-center w-full gap-4 my-1">
                                <hr class="flex-grow border-t-2 border-gray-500">
                                <span class="text-sm text-gray-500 whitespace-nowrap">Informações Adicionais</span>
                                <hr class="flex-grow border-t-2 border-gray-500">
                            </div>

                            <div class="form-group relative w-full">
                                <label for="ong_type"
                                    class="block mb-2 text-purple-800 font-semibold text-lg pointer-events-none">
                                    Tipo
                                </label>
                                <select v-model="form.ong_type"
                                    class="h-[50px] px-2 font-md text-purple-800 bg-slate-50 border-2 border-purple-800 outline-none rounded-md w-full"
                                    name="ong_type" id="ong_type">
                                    <option v-for="type in props.ong_types" :key="type.id" :value="type.id">
                                        {{ type.nome }}
                                    </option>
                                </select>

                            </div>

                            <div class="form-group relative w-full">
                                <input hidden ref="realBannerBtn" @change="updateBannerSpan" type="file" accept="image/*"
                                    id="banner" name="banner">
                                <button type="button" id="custom-banner-btn" @click="bannerSelect"
                                    class="inline-flex items-center gap-4 justify-center min-w-2/5 h-[50px] p-2 font-lg font-bold text-purple-50 bg-purple-800 rounded-md cursor-pointer hover:bg-purple-700 transition">
                                    <i class="fa-solid fa-images text-lg"></i>
                                    Escolher Banner
                                </button>
                                <span class="custom-banner-txt ml-4 font-poppins text-purple-800">{{ customBannerTxt
                                }}</span>
                                <span class="clear-btn ml-2 text-purple-800 cursor-pointer" v-show="isBannerSelected"
                                    @click="clearBanner">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                            </div>

                            <div class="form-group relative w-full">
                                <input hidden ref="realPhotoBtn" @change="updatePhotoSpan" type="file" accept="image/*"
                                    id="foto" name="foto">
                                <button type="button" id="custom-photo-btn" @click="photoSelect"
                                    class="inline-flex items-center gap-4 justify-center min-w-2/5 h-[50px] p-2 font-lg font-bold text-purple-50 bg-purple-800 rounded-md cursor-pointer hover:bg-purple-700 transition">
                                    <i class="fa-solid fa-user text-lg"></i>
                                    Escolher Perfil
                                </button>
                                <span class="custom-photo-txt ml-4 font-poppins text-purple-800">{{ customPhotoTxt
                                }}</span>
                                <span class="clear-btn ml-2 text-purple-800 cursor-pointer" v-show="isPhotoSelected"
                                    @click="clearPhoto">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
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
import { useForm } from '@inertiajs/vue3'
import { ref, onMounted } from 'vue'

const props = defineProps({
    "ong": Object,
    "ong_types": Array,
    errors: Object,
})

const form = useForm({
    nome: props.ong.nome,
    subtitulo: props.ong.subtitulo,
    descricao: props.ong.descricao,
    endereco: props.ong.endereco,
    banner: null,
    foto: null,
    ong_type: props.ong.ong_type_id,
})

const realBannerBtn = ref(null)
const customBannerTxt = ref('Nenhum arquivo selecionado.')
const isBannerSelected = ref(false)

const realPhotoBtn = ref(null)
const customPhotoTxt = ref('Nenhum arquivo selecionado.')
const isPhotoSelected = ref(false)

function bannerSelect() {
    if (realBannerBtn.value) realBannerBtn.value.click()
}

function updateBannerSpan() {
    customBannerTxt.value = realBannerBtn.value?.files?.[0].name
    form.banner = realBannerBtn.value?.files?.[0]
    isBannerSelected.value = true
}

function clearBanner() {
    if (realBannerBtn.value) {
        customBannerTxt.value = 'Nenhum arquivo selecionado.'
        realBannerBtn.value.value = null
        form.banner = null
        isBannerSelected.value = false
    }
}

function photoSelect() {
    if (realPhotoBtn.value) realPhotoBtn.value.click()
}

function updatePhotoSpan() {
    customPhotoTxt.value = realPhotoBtn.value?.files[0].name
    form.foto = realPhotoBtn.value?.files?.[0]
    isPhotoSelected.value = true
}

function clearPhoto() {
    if (realPhotoBtn.value) {
        customPhotoTxt.value = 'Nenhum arquivo selecionado.'
        realPhotoBtn.value.value = null
        form.foto = null
        isPhotoSelected.value = false
    }
}

function submit() {
    form.transform(d => ({ ...d, _method: 'put' }))
        .post(`/ong/update/${props.ong.id}`, {
            forceFormData: true,
        })
}
</script>