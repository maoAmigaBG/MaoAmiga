<template>
  <div
    class="campaign-card flex flex-col items-center p-2.5 mb-4 bg-[#F6F6FA] rounded-[7px] shadow-md transition-transform duration-500 hover:scale-105 overflow-hidden">
    <div class="head w-full flex items-center gap-4 mb-2.5">
      <div class="profile-image">
        <img src="@/assets/puppy.jpg" alt="Profile Picture"
          class="w-[50px] h-[50px] object-cover object-center rounded-full" />
      </div>
      <h3 class="campaign-title font-semibold font-poppins">Vista o Winston Churchill</h3>
    </div>
    <div class="body relative w-full">
      <img src="@/assets/puppy.jpg" alt="Campaign Image"
        class="w-full object-cover object-center rounded-[7px_30px_7px_7px]" />
      <div
        class="progress-bar absolute bottom-4 left-1/2 w-[90%] h-[25px] flex items-center bg-[#E5E4E2] border-4 border-[#F6F6FA] rounded-[7px] transform -translate-x-1/2 overflow-hidden">
        <span class="progress min-h-full px-1.5 bg-purple-800 text-[#F6F6FA] align-middle font-poppins"
          style="width: 90%">90%</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'CampaignCard'
}
</script>