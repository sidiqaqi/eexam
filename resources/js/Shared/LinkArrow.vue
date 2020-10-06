<template>
    <inertia-link :href="href">
        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
            <div>
                <slot />
            </div>
            <div class="ml-1 text-indigo-500">
                <icon name="arrow-right" />
            </div>
        </div>
    </inertia-link>
</template>

<script>
    import Icon from './Icon'

    export default {

        components: {
            Icon
        },

        props: {
            href: {
                type: String,
                default: '/',
            },
        }
    }
</script>
