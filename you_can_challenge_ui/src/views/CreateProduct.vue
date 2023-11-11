<script setup lang="ts">
import type { Category } from '@/types/Category'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { onMounted, ref, type Ref } from 'vue'
import * as z from "zod"
let Product_name = ref('')
let Product_desc = ref('')
let Product_price = ref('')
let selectedCategory = ref('')
let IsProductAddedSuccessfully = ref(false)
let selectedFile = ref(null)




const categories: Ref<Category[]> = ref([])
const router = useRouter()
let errors = ref(null);

async function getData() {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/categories')
    categories.value = response.data
  } catch (error) {
    console.error(error)
  }
}

onMounted(() => {
  getData()
})
const handleFileProductChange = (event) => {
  const file = event.target.files[0]
  selectedFile.value = file
}
const submitProduct = () => {


  const data = new FormData()
  data.append('name', Product_name.value)
  data.append('description', Product_desc.value)
  data.append('price', Product_price.value)

  if (selectedFile.value) {
    data.append('image', selectedFile.value, (selectedFile.value as File).name)
  }
  data.append('categorie', selectedCategory.value)
  let config = {
    method: 'post',
    maxBodyLength: Infinity,
    url: 'http://127.0.0.1:8000/api/product',
    headers: {
      Accept: 'application/json',
      'content-type': 'multipart/form-data' // Use multipart/form-data for file uploads
    },
    data: data
  }


  axios
    .request(config)
    .then((response) => {
      IsProductAddedSuccessfully.value = true
      setTimeout(() => {
        // Navigate to the root link
        router.push('/')
      }, 2000)
    })
    .catch((error) => {
        errors.value = error.response.data.errors
      console.log(error.response.data.errors)
    })
}
</script>

<template>
  <!-- Card Section -->
  <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <form @submit.prevent="submitProduct()" enctype="multipart/form-data">
      <!-- Card -->
      <div class="bg-white rounded-xl shadow dark:bg-slate-900 my-10">
        <div class="pt-0 p-4 sm:pt-0 sm:p-7">
          <div
            v-if="IsProductAddedSuccessfully"
            class="bg-teal-500 text-sm text-white rounded-lg p-4"
            role="alert"
          >
            <span class="font-bold">Success : </span> product has been added successfully
          </div>
          <!-- Grid -->
          <div class="space-y-4 sm:space-y-6">
            <div class="space-y-2">
              <label
                for="af-submit-app-Product-name"
                class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200"
              >
                Product name
              </label>

              <input
                v-model="Product_name"
                id="af-submit-app-Product-name"
                type="text"
                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                placeholder="Enter Product name"
              />
              <p v-if="errors?.name" class="text-red-700">
                {{ errors.name.join(" ") }}
              </p>
         
          
            </div>
            <div class="space-y-2">
              <label
                for="af-submit-app-Product-name"
                class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200"
              >
                Product description
              </label>

              <input
                v-model="Product_desc"
                id="af-submit-app-Product-name"
                type="text"
                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                placeholder="Enter Product name"
              />
              <p v-if="errors?.description" class="text-red-700">
                {{ errors.description.join(" ") }}
              </p>
           
            </div>
            <div class="space-y-2">
              <label
                for="af-submit-app-Product-name"
                class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200"
              >
                Product price
              </label>

              <input
                v-model="Product_price"
                id="af-submit-app-Product-name"
                type="text"
                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                placeholder="Enter Product name"
              />
              <p v-if="errors?.price" class="text-red-700">
                {{ errors.price.join(" ") }}
              </p>
           
            </div>

            <div class="space-y-2">
              <label
                for=""
                class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200"
              >
                Product File
              </label>

              <input
                id="af-submit-Product-url"
                ref="file_product"
                @change="handleFileProductChange($event)"
                type="file"
                class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                placeholder="https://example.so"
              />
              <p v-if="errors?.image" class="text-red-700">
                {{ errors.image.join(" ") }}
              </p>
            </div>

            <div class="space-y-2">
              <label
                for="af-submit-app-category"
                class="inline-block text-sm font-medium text-gray-800 mt-2.5 dark:text-gray-200"
              >
                Category
              </label>

              <select
                v-model="selectedCategory"
                id="af-submit-app-category"
                class="py-2 px-3 pe-9 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
              >
                <option v-for="c in categories" :key="c.categorie_id" :value="c.categorie_id">
                  {{ c.categorie_name }}
                </option>
              </select>
              <p v-if="errors?.categorie" class="text-red-700">
                {{ errors.categorie.join(" ") }}
              </p>
            </div>
          </div>
          <!-- End Grid -->

          <div class="mt-5 flex justify-center gap-x-2">
            <button
              type="submit"
              class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
            >
              Submit your Product
            </button>
          </div>
        </div>
      </div>
      <!-- End Card -->
    </form>
  </div>
  <!-- End Card Section -->
</template>
