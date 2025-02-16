<template>
    <div class="flex justify-between items-center" @click="onToggle">
      <div class="w-16 h-10 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-400': toggleActive}">
        <div class="bg-white w-8 h-8 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-6': toggleActive,}"></div>
      </div>
    </div>
</template>
  
<script setup>

import { ref, defineEmits } from 'vue';

const emit = defineEmits(["toggle"]);

const toggleActive = ref(false);

const onToggle = () => {
  toggleActive.value = !toggleActive.value;
  emit("toggle", toggleActive.value);

}

</script>