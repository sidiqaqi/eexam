<template>
    <inertia-link
        class="px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150"
        :href="href"
    ><slot/>
    </inertia-link>
</template>

<script>
    export default {
        props: {
            href: {
                type: String,
                default: '/',
            },
        }
    }
</script>
