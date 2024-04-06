<template>
    <div>
        <h1>Telescope Dashboard</h1>

        <ul>
            <li v-for="entry in telescope" :key="entry.id">
                <a href="{{ entry.url }}">{{ entry.name }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: {
        telescope: {
            type: Array,
            required: true,
        },
    },
};
</script>
