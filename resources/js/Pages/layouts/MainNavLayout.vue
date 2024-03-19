<script setup>
    import { Link } from '@inertiajs/vue3';
    import Button from 'primevue/button';
</script>

<template>
    <main>
        <header
            id="MainNav"
            class="nfixed z-50 w-full flex items-center justify-between h-[56px] bg-white shadow-sm border-b"
        >
            <div
                id="NavLeft"
                class="flex items-center justify-starts"
            >
                <Link
                    href="/"
                    class="pl-3 min-w-[55px]"
                >
                    <img
                        src="@public/images/icon/gym_logo.jpg"
                        alt="fb logo"
                        class="w-[50px]"
                    />
                </Link>
                <h1 class="mx-2 text-black">Gym Master</h1>
            </div>
            <div
                id="NavCenter"
                class="hidden lg:flex items-center ml-5 justify-center w-8/12 max-w-[600px]"
            >
                <Link
                    href="/"
                    class="flex items-center justify-center h-[48px] p-1 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer"
                    >Home</Link
                >
                <Link
                    href="/about"
                    class="flex items-center justify-center h-[48px] p-1 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer"
                    >About</Link
                >
                <Link
                    href="/contact"
                    class="flex items-center justify-center h-[48px] p-1 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer"
                    >Contact</Link
                >
                <Link
                    href="/contact"
                    class="flex items-center justify-center h-[48px] p-1 hover:bg-[#f2f2f2] w-full rounded-lg mx-1 cursor-pointer"
                    >Pricing</Link
                >
            </div>
            <div
                id="NavRight"
                class="flex justify-end w-2/12 mr-4"
            >
                <Link
                    href="/"
                    class="flex-1"
                    ><Button
                        label="Register"
                        severity="success"
                /></Link>

                <Link
                    href="/"
                    class="flex-1"
                    ><Button
                        label="Login"
                        severity="info"
                /></Link>
            </div>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>
