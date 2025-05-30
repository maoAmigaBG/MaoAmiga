<template>
    <header class="header">
      <div class="logo" @click="toggleMenu" ref="logo">
        <div class="menu-icon-wrapper">
          <i class="fas fa-bars"></i>
        </div>
        <span class="logo-name">Logo</span>
      </div>
  
      <div class="sidebar" ref="navBar">
  
        <div class="sidebar-content">
          <ul class="lists">
            <li class="list"><a href="/" class="nav-link"><i class="fas fa-home"></i><span class="link">Home</span></a></li>
            <li class="list"><a href="/ong" class="nav-link"><i class="fas fa-hand-holding-heart"></i><span class="link">ONGs</span></a></li>
            <li class="list"><a href="/mapa" class="nav-link"><i class="fas fa-map-marked-alt"></i><span class="link">Mapa</span></a></li>
            <li class="list"><a href="/sobre" class="nav-link"><i class="fas fa-info-circle"></i><span class="link">Sobre Nós</span></a></li>
            <li class="list"><a href="#" class="nav-link"><i class="fas fa-envelope"></i><span class="link">Contato</span></a></li>
          </ul>
  
          <div class="bottom-content">
            <ul class="lists">
              <li class="list"><a href="#" class="nav-link"><i class="fa-solid fa-gear"></i><span class="link">Preferências</span></a></li>
              <li class="list"><a href="/auth/logout" class="nav-link"><i class="fas fa-sign-out-alt"></i><span class="link">Log-out</span></a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'DefaultHeader',
    methods: {
      toggleMenu() {
        this.$refs.navBar.classList.toggle("open");
        this.$refs.logo.classList.toggle("open");
      }
    }
  }
  </script>
  