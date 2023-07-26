<template>
<div v-if="isVisible" class="popup">
    <div class="popup-content">
        <span>{{ message }}</span>
        <button @click="hidePopup">Close</button>
    </div>
</div>
</template>

<script>
export default {
    props: ['message'],
    watch: {
        message: function (val) {
            this.isVisible = true;
        },
    },
    data() {
        return {
            isVisible: false,
        };
    },
    methods: {
        hidePopup() {
            this.isVisible = false;
        },
    },
};
</script>

<style scoped>
.popup {
    position: fixed;
    top: 10;
    left: 10;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index:1000;
}

.popup-content {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.popup-content button {
    margin-top: 10px;
}
</style>
