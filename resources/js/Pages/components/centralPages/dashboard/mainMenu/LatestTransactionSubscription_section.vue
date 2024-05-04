<script setup>
import Card from '@/components/elements/card/DefaultCard.vue';
import Badge from 'primevue/badge';
import Button from 'primevue/button';
</script>

<template>
    <Card>
        <template #card__title>
            <div class="flex items-center justify-between mb-6">
                <h3>Latest Transactions</h3>
                <Button :pt="{ root: 'bg-primary-900 px-4 text-base py-2 rounded-lg text-white hover:bg-primary-700' }">
                    <a href="#" class="font-bold">View all</a>
                </Button>
            </div>
        </template>

        <template #card__content>
            <div class="flex flex-col gap-y-6">
                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                    <header class="flex flex-col gap-y-2">
                        <h6 class="text-base">Gold Feature</h6>
                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                    </header>

                    <figcaption>
                        <Badge value="Pending" severity="info" class="w-[16%]" />
                    </figcaption>
                </figure>
                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                    <header class="flex flex-col gap-y-2">
                        <h6 class="text-base">Silver Feature</h6>
                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                    </header>

                    <figcaption>
                        <Badge value="Pending" severity="info" class="w-[16%]" />
                    </figcaption>
                </figure>
                <figure class="flex flex-col p-5 rounded-lg gap-y-6 bg-primary-900">
                    <header class="flex flex-col gap-y-2">
                        <h6 class="text-base">Bronze Feature</h6>
                        <p class="text-sm text-white/50">Christian Hendorsen</p>
                    </header>

                    <figcaption>
                        <Badge value="Pending" severity="info" class="w-[16%]" />
                    </figcaption>
                </figure>
            </div>
        </template>
    </Card>
</template>
