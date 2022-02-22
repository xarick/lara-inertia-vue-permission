<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    setup(props) {
        const form = useForm({
            title: props.nw.title,
            body: props.nw.body,
            section_id: props.nw.section_id,
        });

        return { form };
    },
    props: {
        nw: Object,
        sections: Object,
    },
    methods: {
        submit() {
            this.form.put(route("news.update", this.nw.id));
        },
    },
};
</script>

<template>
    <Head title="News" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                News Update
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div>
                                <label for="section_id">Section</label>
                                <select
                                    id="section_id"
                                    v-model="form.section_id"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    ">
                                    <option
                                        v-for="section in sections" :key="section.id" 
                                        :value="section.id"
                                    >
                                    {{ section.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <label for="title">Title</label>
                                <input
                                    type="text"
                                    v-model="form.title"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                />
                            </div>
                            <div class="mt-4">
                                <label for="title">Body</label>
                                <textarea
                                    name="body"
                                    type="text"
                                    v-model="form.body"
                                    class="
                                        w-full
                                        px-4
                                        py-2
                                        mt-2
                                        border
                                        rounded-md
                                        focus:outline-none
                                        focus:ring-1
                                        focus:ring-blue-600
                                    "
                                >
                                </textarea>
                            </div>

                            <!-- submit -->
                            <div class="flex items-center mt-4">
                                <button
                                    class="
                                        px-6
                                        py-2
                                        text-white
                                        bg-gray-900
                                        rounded
                                    "
                                >
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
