<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Link } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
    },
    props: {
        sections: Object,
    },
    methods: {
        destroy(id) {
            this.$inertia.delete(route("section.destroy", id));
        },
    },
};
</script>

<template>
    <Head title="Sections" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Sections
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-4">
                            <Link
                                class="
                                    px-6
                                    py-2
                                    mb-2
                                    text-green-100
                                    bg-green-500
                                    rounded
                                "
                                :href="route('section.create')"
                                v-if="$can('write section')"
                            >
                                Posts Create
                            </Link>
                        </div>
                        <table>
                            <thead class="font-bold bg-gray-300 border-b-2">
                                <td class="px-4 py-2">ID</td>
                                <td class="px-4 py-2">Name</td>
                                <td class="px-4 py-2">Action</td>
                            </thead>
                            <tbody>
                                <tr v-for="section in sections" :key="section.id">
                                    <td class="px-4 py-2">{{ section.id }}</td>
                                    <td class="px-4 py-2">{{ section.name }}</td>
                                    <td class="px-4 py-2 font-extrabold">
                                        <Link
                                            v-if="$can('edit section')"
                                            class="text-green-700"
                                            :href="route('section.edit', section.id)"
                                        >
                                            Edit
                                        </Link>
                                        <Link
                                            v-if="$can('delete section')"
                                            @click="destroy(section.id)"
                                            class="text-red-700"
                                            >Delete</Link
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
