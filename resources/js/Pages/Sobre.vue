<template>
  <section class="max-w-4xl mx-4 p-8 bg-white rounded-lg shadow-md my-12">
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8">Sobre Nós</h1>

    <div class="flex gap-2">
      <div class="flex-1">
        <p class="mb-6 text-lg text-gray-700 leading-relaxed text-justify">
          Nosso site nasceu com um propósito simples e essencial:
          <strong class="font-semibold text-purple-800">dar mais visibilidade e apoio às ONGs de Bento
            Gonçalves</strong>.
        </p>

        <p class="mb-6 text-gray-700 leading-relaxed text-justify">
          Sabemos que muitas organizações incríveis trabalham todos os dias para transformar vidas e melhorar nossa
          comunidade,
          mas muitas vezes elas enfrentam o desafio de alcançar mais pessoas e doadores.
        </p>

        <p class="mb-10 text-gray-700 leading-relaxed text-justify">
          Aqui, criamos um espaço onde essas ONGs podem se conectar com a comunidade, mostrar seus projetos, suas
          necessidades e resultados.
          Queremos que cada ONG tenha a chance de crescer, receber apoio e fazer a diferença que já faz – só que em uma
          escala ainda maior.
        </p>
      </div>
      <div class="flex-1 flex flex-col items-center">
        <img src="@/assets/team.jpeg" alt="" class="rounded-md w-2/3">
        <p class="text-xl font-bold text-purple-800 mb-4">Time do Causa em Foco</p>
      </div>
    </div>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Nossa missão</h2>
    <ul class="list-disc list-inside mb-10 text-gray-700 space-y-2">
      <li>Fortalecer o trabalho das ONGs locais através da divulgação;</li>
      <li>Facilitar a conexão entre quem quer ajudar e quem precisa de ajuda;</li>
      <li>Incentivar a cultura de doação e solidariedade em Bento Gonçalves.</li>
    </ul>

    <h2 class="text-2xl font-bold text-gray-800 mb-4">Por que Bento Gonçalves?</h2>
    <p class="text-gray-700 leading-relaxed">
      Bento Gonçalves é uma cidade cheia de potencial e gente de coração grande. Acreditamos que, juntando forças,
      podemos fazer com que as ONGs locais sejam mais conhecidas e reconhecidas, gerando impacto social positivo e
      duradouro.
    </p>
  </section>
</template>

<script>
export default {
  name: "AboutPage",
};
</script>
