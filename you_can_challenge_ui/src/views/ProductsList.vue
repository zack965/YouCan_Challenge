<script setup lang="ts">
import type { Product } from '@/types/Product'
import { ref, type Ref, onMounted } from 'vue'
import axios from 'axios'
let textSearch = ref('')
let SortMethod = ref('CheapeToExpensive')
const prodcuts: Ref<Product[]> = ref([])
const filteredProducts: Ref<Product[]> = ref(prodcuts.value)
async function getData() {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/product')
    prodcuts.value = response.data
    filteredProducts.value = response.data
    console.log(prodcuts.value)
  } catch (error) {
    console.error(error)
    //   this.error = 'Error fetching data from the API';
  }
}

onMounted(() => {
  getData()
})

function orderByPrice() {
  // reverse Sort order
  if (SortMethod.value == 'CheapeToExpensive') {
    SortMethod.value = 'ExpensiveToCheape'
  } else {
    SortMethod.value = 'CheapeToExpensive'
  }
  //  CheapeToExpensive => Cheape To Expensive
  if (SortMethod.value == 'CheapeToExpensive') {
    filteredProducts.value.sort((a, b) => a.price - b.price)
  } else if (SortMethod.value == 'ExpensiveToCheape') {
    //  ExpensiveToCheape => Expensive To Cheape
    filteredProducts.value.sort((a, b) => b.price - a.price)
  }
}
function filterByCategory(): void {
  if (textSearch.value == '') {
    // Show all products if "All" is selected
    filteredProducts.value = prodcuts.value
    console.log(textSearch.value)
  } else {
    // Filter products based on the selected category
    filteredProducts.value = prodcuts.value.filter((product) =>
      product.categories[0].includes(textSearch.value)
    )
  }
}
</script>

<template>
  <div class="container mx-auto mt-10">
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <RouterLink
            to="/create-product"
            class="py-3 my-4 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
          >
            Create Product
          </RouterLink>
          <div
            class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700"
          >
            <div class="py-3 px-4 flex justify-between">
              <div class="relative max-w-xs">
                <label class="sr-only">Search</label>
                <input
                  type="text"
                  name="hs-table-with-pagination-search"
                  id="hs-table-with-pagination-search"
                  class="py-2 px-3 ps-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                  placeholder="Search for items"
                  v-model="textSearch"
                  v-on:keyup="filterByCategory()"
                />

                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-3">
                  <svg
                    class="h-4 w-4 text-gray-400"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                  >
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                  </svg>
                </div>
              </div>
              <div class="relative max-w-xs">
                <button
                  type="button"
                  v-on:click="orderByPrice()"
                  class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                >
                  Order Products
                </button>
              </div>
            </div>
            <div class="overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                  <tr>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                      Name
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                      Description
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                      Price
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                      Image
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                      Categories
                    </th>
                    <th
                      scope="col"
                      class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"
                    >
                     Parent Categories
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  <tr v-for="p in filteredProducts" :key="p.product_id">
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200"
                    >
                      {{ p.name }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"
                    >
                      {{ p.description }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"
                    >
                      {{ p.price }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"
                    >
                      <img class="w-20 h-auto" :src="p.image" alt="..." />
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"
                    >
                      {{ p.categories[0].join(' ') }}
                    </td>
                    <td
                      class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200"
                    >
                    {{ p.categories[1].join(' ') }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
