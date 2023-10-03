<template>
<div >
    <button @click="showPopup">Open Popup</button>
    <div v-if="isPopupVisible" class="popup">
        <div class="popup-content">
            <h2>Popup Form</h2>
            <label for="selectOption">Select Option:</label>
            <select id="selectOption" v-model="selectedOption">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
            <label for="textarea">Textarea:</label>
            <textarea id="textarea" v-model="textareaValue"></textarea>
            <button @click="submitForm">Submit</button>
            <button @click="closePopup">Close</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            isPopupVisible: false,
            selectedOption: 'option1',
            textareaValue: ''
        };
    },
    methods: {
        showPopup() {
            this.isPopupVisible = true;
        },
        closePopup() {
            this.isPopupVisible = false;
        },
        submitForm() {
          
            console.log('Selected Option:', this.selectedOption);
            console.log('Textarea Value:', this.textareaValue);
            this.closePopup();
        }
    }
};
</script>

<style>
.popup {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(204, 113, 113, 0.5);
  display: flex;
  justify-content: center;
  align-items: center
}
</style>