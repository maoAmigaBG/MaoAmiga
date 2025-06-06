<template>
  <header
    class="header fixed top-0 left-0 w-full flex items-center justify-between px-[75px] py-[15px] bg-gradient-to-t from-purple-800 to-purple-600 border-b-4 border-purple-800 shadow-[0_0_10px_7px_rgba(0,0,0,0.2)] z-[999] h-[91px]"
  >
    <div
      :class="['logo flex items-center gap-[20px] transition-all duration-300', { 'header-open': sidebarOpen }]"
      @click="toggleMenu"
    >
      <div class="menu-icon-wrapper">
        <i class="fas fa-bars inline-block relative h-8 w-8 text-[#F6F6FA] text-[32px] cursor-pointer"></i>
      </div>
      <span class="logo-name text-[#F6F6FA] text-[38px] font-bold font-poppins cursor-pointer select-none">Logo</span>
    </div>
    <aside
      :class="['sidebar fixed top-[91px] left-0 max-h-[90vh] h-full w-[calc(25%-10px)] p-[10px_20px] bg-[#F6F6FA] border-none border-r-4 border-[#E5E4E2] shadow-[10px_0_10px_-4px_rgba(0,0,0,0.2)] transition-all duration-300 z-[1]', { 'sidebar-open': sidebarOpen }]"
      style="box-sizing: border-box"
    >
      <div class="sidebar-content h-full flex flex-col justify-between py-5">
        <ul class="lists">
          <li class="list list-none">
            <a href="/" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
              <i class="fas fa-home mr-[15px] text-[25px]"></i>
              <span class="link font-poppins text-[18px] font-semibold">Home</span>
            </a>
          </li>
          <li class="list list-none">
            <a href="/ong/list" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
              <i class="fas fa-hand-holding-heart mr-[15px] text-[25px]"></i>
              <span class="link font-poppins text-[18px] font-semibold">ONGs</span>
            </a>
          </li>
          <li class="list list-none">
            <a href="/ong/map" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
              <i class="fas fa-map-marked-alt mr-[15px] text-[25px]"></i>
              <span class="link font-poppins text-[18px] font-semibold">Mapa</span>
            </a>
          </li>
          <li class="list list-none">
            <a href="/sobre" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
              <i class="fas fa-info-circle mr-[15px] text-[25px]"></i>
              <span class="link font-poppins text-[18px] font-semibold">Sobre Nós</span>
            </a>
          </li>
          <li class="list list-none">
            <a href="#" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
              <i class="fas fa-envelope mr-[15px] text-[25px]"></i>
              <span class="link font-poppins text-[18px] font-semibold">Contato</span>
            </a>
          </li>
        </ul>
        <div class="bottom-content">
          <ul class="lists">
            <li class="list list-none">
              <a href="#" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
                <i class="fa-solid fa-gear mr-[15px] text-[25px]"></i>
                <span class="link font-poppins text-[18px] font-semibold">Preferências</span>
              </a>
            </li>
            <li class="list list-none">
              <a href="/auth/logout" class="nav-link flex items-center p-[10px] mb-[10px] rounded-[7px] no-underline transition-all duration-300 hover:bg-purple-800 text-gray-600 hover:text-purple-50">
                <i class="fas fa-sign-out-alt mr-[15px] text-[25px]"></i>
                <span class="link font-poppins text-[18px] font-semibold">Log-out</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </aside>
  </header>
</template>

<script>
export default {
  name: 'DefaultHeader',
  data() {
    return {
      sidebarOpen: false,
    };
  },
  methods: {
    toggleMenu() {
      this.sidebarOpen = !this.sidebarOpen;
    }
  }
}
</script>

<style scoped>
.logo {
  transition: all .3s ease;
}
.logo.header-open {
  transform: translateX(-50px);
}
.sidebar {
  transform: translateX(-100%);
  transition: all .3s cubic-bezier(.4,0,.2,1);
}
.sidebar.sidebar-open {
  transform: translateX(0);
}
</style>