<template>
    <div v-show="message" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-1 flex items-center justify-between bg-red-500 rounded-b max-w">
            <div class="flex items-center">
                <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="ml-4 mr-2 flex-shrink-0 w-4 h-4 fill-white"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"></path></svg>
                <div class="py-4 text-white text-sm font-medium">{{ message }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['message']
}
</script>


