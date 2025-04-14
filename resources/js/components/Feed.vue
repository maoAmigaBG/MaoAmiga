<template>
    <div class="feed">
        <div class="head">
            <div class="user">
                <div class="profile-img">
                    <img src="@/assets/puppy.jpg" alt="">
                </div>
                <div class="info">
                    <h3>Profile Name</h3>
                    <small>City, Time</small>
                </div>
            </div>

            <span class="edit">
                <i class="fa-solid fa-ellipsis"></i>
            </span>
        </div>
        <div class="photo">
            <img src="@/assets/puppy.jpg" alt="Africano caçando cachorro">
        </div>
        <div class="action-buttons">
            <i class="fa-regular fa-heart"></i>
            <i class="fa-regular fa-comments"></i>
            <i class="fa-regular fa-share-from-square"></i>
        </div>

        <div class="caption"><b>Person name</b> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime
            necessitatibus mollitia odit molestias unde provident aperiam reprehenderit repellat facere, maiores earum
            iusto dicta dolorem quae corrupti dolores neque alias pariatur!</div>
        <div class="comments">View all 375 comments</div>
    </div>
</template>

<script>
export default {
    name: 'Feed'
}
</script>