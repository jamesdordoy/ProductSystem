<template>
    <div class="flex justify-between items-center" @click="onToggle">
      <div class="w-16 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-400': toggled}">
        <div class="bg-white w-8 h-8 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': toggled,}"></div>
      </div>
    </div>
</template>
  
<script setup>

import { defineEmits } from 'vue';

const emit = defineEmits(["toggle"]);

const props = defineProps({
  toggled: {
    type: Boolean,
    required: true,
  },
});

const onToggle = (value) => {
  emit("toggle", !props.toggled);

}

</script>