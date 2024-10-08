<script setup>
import DynamicSectionContent from "@components/ui/dynamicDetailContent/Index.vue";
import { ref } from "vue";
import { route } from "ziggy-js";
import axiosHttp from "../../../../Lib/axios";
import FormatCurrency from "../../../../Lib/Currency";
import Badge from "primevue/badge";
import PrimaryButton from "@components/elements/button/PrimaryButton.vue";

const props = defineProps({
    id: String,
    route: {
        type: String,
        default: "central-dashboard.transaction.json.detail",
    },
});

const transactionDetail = ref(null);

const fetchTransactionDetail = async () => {
    try {
        const res = await axiosHttp(
            route(props.route, {
                transaction: props.id,
            }),
        );

        if (res.status == 200) {
            transactionDetail.value = await res.data;
        }
    } catch (err) {
        console.log(err);
    }
};

const openPreviewPDF = (id) => {
    window.open(
        route("central-dashboard.transactions.invoice-pdf", {
            transaction: id,
        }),
        "MsgWindow",
        "width=800 height=1200",
    );
};

await fetchTransactionDetail();
</script>

<template>
    <div class="grid lg:grid-cols-2 mb-8 gap-4">
        <DynamicSectionContent
            label="Full name"
            :caption="transactionDetail.full_name"
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Email"
            :caption="transactionDetail.email"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Payment Type"
            :caption="transactionDetail.payment_type"
            class="!mb-0"
        />

        <div>
            <h4 class="mb-3 text-base font-semibold capitalize">Status</h4>
            <Badge
                :value="transactionDetail.status"
                class="px-4 !text-white"
                :severity="[
                    transactionDetail.status === 'PENDING'
                        ? 'info'
                        : transactionDetail.status === 'PAID'
                          ? 'success'
                          : 'danger',
                ]"
            />
        </div>
    </div>
    <div class="mb-8">
        <DynamicSectionContent
            label="Payment Gateway Url"
            :caption="transactionDetail.payment_gateway_url"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Tax"
            :caption="FormatCurrency(transactionDetail.tax)"
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Total + Tax"
            :caption="FormatCurrency(transactionDetail.total)"
            class="!mb-0"
        />
    </div>
    <div class="grid lg:grid-cols-2 mb-8">
        <DynamicSectionContent
            label="Transaction expired countdown"
            :caption="transactionDetail.expired_countdown ?? '-'"
            class="!mb-0"
        />
        <DynamicSectionContent
            label="Transaction expired date"
            :caption="
                transactionDetail.transaction_expired_at
                    ? new Date(
                          transactionDetail.transaction_expired_at,
                      ).toDateString()
                    : '-'
            "
            class="!mb-0"
        />
    </div>
    <div>
        <PrimaryButton
            label="Download Invoice"
            @click-event="() => openPreviewPDF(transactionDetail.id)"
        />
    </div>
</template>
