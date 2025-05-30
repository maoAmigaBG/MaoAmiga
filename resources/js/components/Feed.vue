<template>
  <div class="feed relative w-1/2 p-5 font-poppins bg-slate-50 border-b-2 border-[#E5E4E2]">
    <div class="head flex justify-between p-2.5">
      <div class="user flex items-center gap-2.5">
        <div class="profile-img">
          <img src="@/assets/puppy.jpg" alt="" class="h-[70px] w-[70px] object-cover object-center rounded-full" />
        </div>
        <div class="info">
          <h3 class="font-semibold">Profile Name</h3>
          <small>City, Time</small>
        </div>
      </div>
      <span class="edit flex items-center text-[28px]"><i class="fa-solid fa-ellipsis"></i></span>
    </div>
    <div class="photo my-4 rounded-[7px_40px_7px_92px] overflow-hidden">
      <img src="@/assets/puppy.jpg" alt="Africano caçando cachorro" />
    </div>
    <div class="action-buttons w-1/3 flex justify-between items-center text-[28px] my-2 mb-4">
      <i class="fa-regular fa-heart"></i>
      <i class="fa-regular fa-comments"></i>
      <i class="fa-regular fa-share-from-square"></i>
    </div>
    <div class="caption mb-2"><b>Person name</b> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime
      necessitatibus mollitia odit molestias unde provident aperiam reprehenderit repellat facere, maiores earum
      iusto dicta dolorem quae corrupti dolores neque alias pariatur!</div>
    <div class="comments text-lg text-[#696969]">View all 375 comments</div>
  </div>
</template>

<script>
export default {
    name: 'Feed'
}
</script>