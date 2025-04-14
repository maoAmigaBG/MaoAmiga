<template>
    <div class="campaign-card">
        <div class="head">
            <div class="profile-image">
                <img src="@/assets/puppy.jpg" alt="Profile Picture">
            </div>
            <h3 class="campaign-title">Vista o Winston Churchill</h3>
        </div>
        <div class="body">
            <img src="@/assets/puppy.jpg" alt="Campaign Image">
            <div class="progress-bar"><span class="progress" style="width: 90%">90%</span></div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CampaignCard'
}
</script>