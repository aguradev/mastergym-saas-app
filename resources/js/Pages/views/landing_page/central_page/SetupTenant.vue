<script setup>
    import { ref } from 'vue';
    import { Head } from '@inertiajs/vue3';

    import MainNavLayout from '@layouts/MainNavLayout.vue';
    import UploadImage from './component/UploadImage.vue';

    import FileUpload from 'primevue/fileupload';
    import { useToast } from 'primevue/usetoast';

    const toast = useToast();

    const onUpload = () => {
        toast.add({ severity: 'info', summary: 'Success', detail: 'File Uploaded', life: 3000 });
    };
</script>

<template>
    <MainNavLayout>
        <Head title="Setting Up Your App" />
    </MainNavLayout>
    <!-- component -->
    <div class="h-screen md:flex w-full">
        <div class="relative overflow-hidden md:flex w-1/2 bg-gradient-to-tr from-blue-900 to-blue-500 i justify-around items-center hidden">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">Gym Master</h1>
                <p class="text-white mt-1">The most popular</p>
                <button
                    type="submit"
                    class="block w-28 bg-white text-indigo-800 mt-4 py-2 rounded-2xl font-bold mb-2"
                >
                    Read More
                </button>
            </div>
            <div class="absolute -bottom-32 -left-40 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -bottom-40 -left-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-40 -right-0 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
            <div class="absolute -top-20 -right-20 w-80 h-80 border-4 rounded-full border-opacity-30 border-t-8"></div>
        </div>
        <div class="flex w-1/2 overflow-scroll overflow-x-hidden justify-center py-5 h-full pt-[0px]items-center bg-white">
            <form
                @submit.prevent="submit"
                class="bg-white w-full h-min px-20"
            >
                <h1 class="text-gray-800 font-bold text-2xl mt-20 mb-1">Lets Setup Your Account!</h1>
                <p class="text-sm font-normal text-gray-600 mb-7">Setting Up Your Gym Configuration!</p>

                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3">
                        <div class="mb-5">
                            <label
                                for="gName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                Gym Name
                            </label>
                            <input
                                type="text"
                                name="gName"
                                id="gName"
                                placeholder="Insert your gym name here!"
                                class="w-full rounded-md border-2 -2-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                    <!-- <div class="w-full px-3 sm:w-1/5">
                        <div class="mb-5">
                            <label
                                for="lName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                Logo
                            </label>
                            <input type="file" />
                            <FileUpload
                                mode="basic"
                                name="demo[]"
                                url="/api/upload"
                                accept="image/*"
                                :maxFileSize="1000000"
                                @upload="onUpload"
                                :pt="{
                                    fileupload: {
                                        class: '!bg-red-500',
                                        uploadButton: {
                                            class: '!bg-blue-500',
                                        },
                                    },
                                }"
                                :ptOptions="{ mergeProps: true }"
                            /> 
                        </div>
                    </div> -->
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label
                                for="fName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                Phone Number
                            </label>
                            <input
                                type="text"
                                name="fName"
                                id="fName"
                                placeholder="XXX-XXX"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label
                                for="lName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                Gym Email
                            </label>
                            <input
                                type="texts"
                                name="lName"
                                id="lName"
                                placeholder="Your gym email"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label
                                for="fName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                Street Address
                            </label>
                            <input
                                type="text"
                                name="fName"
                                id="fName"
                                placeholder="Where your gym is located"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <label
                                for="lName"
                                class="mb-2 block text-base font-medium text-[#07074D]"
                            >
                                City
                            </label>
                            <input
                                type="texts"
                                name="lName"
                                id="lName"
                                placeholder="Ex. Kerobokan"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                </div>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/4">
                        <div class="mb-1">
                            <label
                                for="fName"
                                class="mb-1 block text-base font-medium text-[#07074D]"
                            >
                                Postal Code
                            </label>
                            <input
                                type="text"
                                name="fName"
                                id="fName"
                                placeholder="XXXXXX"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-1/4">
                        <div class="mb-1">
                            <label
                                for="lName"
                                class="mb-1 block text-base font-medium text-[#07074D]"
                            >
                                State
                            </label>
                            <input
                                type="texts"
                                name="lName"
                                id="lName"
                                placeholder="Kota"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                    <div class="w-full px-3 sm:w-2/4">
                        <div class="mb-1">
                            <label
                                for="lName"
                                class="mb-1 block text-base font-medium text-[#07074D]"
                            >
                                Country
                            </label>
                            <input
                                type="texts"
                                name="lName"
                                id="lName"
                                placeholder="Ex. Indonesia"
                                class="w-full rounded-md border-2 border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"
                            />
                        </div>
                    </div>
                </div>
                <!-- Upload Image Component -->
                <UploadImage />
                <div>
                    <button class="w-full mt-5 hover:shadow-form rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none tracking-wider">I'M READY TO START</button>
                </div>
            </form>
        </div>
    </div>
</template>
