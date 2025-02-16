<template>
  <header class="bg-sky-900 p-2">    
    <div class="flex justify-between">
      <h1 class="text-4xl text-white">Tecco</h1>
      <div class="flex">
        <div class="flex text-white">
          <p class="mt-2 mx-2">Clubcard customer?</p>
          <Toggle :toggled="filters.clubcard" @toggle="onToggle" class="mr-4" />
        </div>
        <form>
          <input v-model="filters.search" type="text" name="search" class="bg-white rounded-xl block min-w-0 grow py-1.5 pr-3 pl-2 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6" placeholder="Search">
        </form>
      </div>
    </div>
  </header>

  <main class="p-6 flex flex-wrap justify-between">
    <div v-for="(product, i) in products" class="w-1/3 p-2">
      <div :href="`/products/${product.id}`" class="w-96 block">
        <div class="flex ">
          <span v-show="product.total_discount_percentage > 0" class="rounded bg-green-500 p-1 mb-1 mr-1">{{ product.total_discount_percentage }}% off!</span>
          <span class="rounded bg-blue-500 p-1 mb-1">{{ product.product_category.title }}</span>
        </div>
        <img class="w-96 rounded border" :src="placeholderImage" />
        <div class="flex justify-between">
          <h3>{{ product.title }}</h3>
          <div class="flex">
            <p class="text-red-500 mr-2 line-through" v-if="product.total_discount_percentage > 0">{{ product.formatted_price }}</p>
            <p v-show="filters.clubcard == false">{{ product.total }}</p>
            <p v-show="filters.clubcard == true">{{ product.total_discount_with_clubcard }}</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="bg-sky-900 flex justify-end p-2">
    <p class="text-white">James Dordoy - <a class="underline" href="https://jamesdordoy.co.uk">jamesdordoy.co.uk</a></p>
  </footer>
</template>

<script setup>
import Toggle from '../Components/Toggle.vue';
import placeholderImage from '../../assets/placeholder.png';
import {watch, ref} from "vue";
import { router } from '@inertiajs/vue3'

const props = defineProps({
  products: {
    type: Array,
    required: true,
  },
  filters: {
    type: Object,
    default: {
      'search': '',
      'clubcard': false,
    },
    required: true,
  }
});

const onToggle = (value) => {
  props.filters.clubcard = value;
}

watch(props.filters, () => {
  router.reload({
    only: ['products'],
    data: props.filters,
  })
})

</script>