<script setup>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { toRefs } from 'vue';

const props = defineProps(["dataLists", "dataColumns"])

const getDataTable = async () => {
    await new Promise((res) => setTimeout(res, 1000))
    const { dataLists, dataColumns } = toRefs(props)
}

await getDataTable()

</script>
<template>

    <div v-if="dataLists.length > 0">
        <DataTable tableStyle="border-collapse:collapse;" :value="dataLists" :pt="{
        bodyrow: 'bg-transparent last:border-none border-b border-primary-700',
        column: {
            headercell: 'p-4',
            headercontent: 'text-left font-[300] tracking-wide text-white/50',
            bodycell: 'p-5',
        }
    }">
            <div v-for="(item, index) in dataColumns">
                <Column :field="item.field" :header="item.header" :key="index" />
            </div>
        </DataTable>
    </div>

    <div v-else>
        <slot name="empty_content"></slot>
    </div>

</template>
