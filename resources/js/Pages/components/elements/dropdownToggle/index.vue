<script setup>
import { ref, onMounted } from "vue";
import Menu from 'primevue/menu';
const props = defineProps({
    dropdownLists: {
        type: Array,
        default: [
            {
                label: "Options",
                items: []
            }
        ]
    },
})

const menu = ref()

function dropdownClickToggle(event) {
    menu.value.toggle(event)
}

</script>

<template>
    <div>
        <button type="button" @click="dropdownClickToggle">
            <slot name="button_content" />
        </button>
        <Menu ref="menu" id="dropdown_profile" :model="props.dropdownLists" :popup="true">
            <template #item="{ item, props }">
                <div v-bind="props.action">
                    <slot name="item_template" />
                </div>
            </template>
        </Menu>
    </div>
</template>
