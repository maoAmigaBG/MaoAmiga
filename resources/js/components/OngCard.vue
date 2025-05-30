<template>
  <div class="ong-card h-[250px] flex items-center gap-2.5 bg-[#F6F6FA] rounded-[10px] shadow-md overflow-hidden">
    <div class="profile-image min-w-[250px]">
      <img src="@/assets/puppy.jpg" alt="Perfil da ONG" class="h-[250px] w-[250px] object-cover rounded-[0_25px_0_0]" />
    </div>
    <div class="body relative min-h-full max-w-full flex flex-col">
      <h3 class="ong-title p-2.5 text-2xl font-semibold font-sans text-[#BF3BF7]">Por + Empatia</h3>
      <span class="ong-info p-[5px_10px] font-sans">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</span>
      <span class="contributions p-[5px_10px] text-sm text-[#696969] font-sans">Mais de 3000 contribuíntes</span>
      <a href="#" class="donate-now absolute bottom-0 left-0 w-[95%] p-2.5 m-2.5 bg-[#BF3BF7] text-2xl font-semibold font-sans text-[#F6F6FA] text-center rounded-[10px] transition-all duration-300 hover:bg-[#620f80] hover:scale-105">Doar Agora</a>
    </div>
  </div>
</template>

<script>
    export default {
        name: 'OngCard'
    }
</script>