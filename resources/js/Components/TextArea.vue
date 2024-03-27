<template>
  <textarea
    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
    v-model="modelValue"
    ref="input"
  ></textarea>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const modelValue = ref('');
const inputRef = ref(null);

onMounted(() => {
    if (inputRef.value && inputRef.value.hasAttribute('autofocus')) {
    inputRef.value.focus();
  }
});
</script>