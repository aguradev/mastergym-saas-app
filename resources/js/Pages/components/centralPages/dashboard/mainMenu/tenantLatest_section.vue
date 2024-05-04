<script setup>
import Card from '@/components/elements/card/DefaultCard.vue';
import { ref, defineAsyncComponent, toRefs } from "vue";

const props = defineProps(["dataTenants"])
const { dataTenants } = toRefs(props)

const tenantLatestColumns = ref([{
    "field": "vendor",
    "header": "Vendor"
}, {
    "field": "domain",
    "header": "Domain"
}])

const asyncTables = defineAsyncComponent({
    loader: () => import("@/components/elements/tables/index.vue"),
})

</script>

<template>
    <Card>
        <template #card__title>
            <h3 class="mb-6">Tenant Latest</h3>
        </template>

        <template #card__content>

            <Suspense>
                <template #default>
                    <asyncTables :dataLists="dataTenants" :dataColumns="tenantLatestColumns">
                        <template #empty_content>
                            <p>Tenant is empty</p>
                        </template>
                    </asyncTables>
                </template>

                <template #fallback>
                    <div>
                        Loading...
                    </div>
                </template>
            </Suspense>

        </template>
    </Card>
</template>
