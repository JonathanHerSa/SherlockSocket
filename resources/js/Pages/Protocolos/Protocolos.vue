<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps(["cliente", "tarimas", "Value", "cv"]);

const form = useForm({
    id: "",
});

const submit = () => {
    form.transform((data) => ({
        ...data,
    })).post(route("protocol.showTar", form.id), {
        onSuccess: () => {
            form.reset();
        },
    });
};
</script>
<template>
    <div class="h-screen w-screen bg-slate-200 grid place-content-center gap-2">
        <div class="flex justify-around gap-2 p-4 bg-white shadow rounded-xl">
            <div class="grid place-content-center">
                <form class="grid gap-1" @submit.prevent="submit">
                    <label for="CV" class="text-sm font-light ml-2">CV</label>
                    <input
                        type="text"
                        id="CV"
                        class="border border-gray-400 rounded-2xl text-sm font-light"
                        v-model="form.id"
                    />
                    <input
                        type="submit"
                        value="Consultar CV"
                        class="text-sm font-light bg-cyan-400 px-3 py-1 w-fit rounded-3xl hover:cursor-pointer justify-self-center"
                    />
                </form>
            </div>
            <div class="grid place-content-center">
                <table>
                    <tr class="border-b-[1px] border-gray-400 text-md">
                        <th class="px-2 py-1">ID</th>
                        <th class="px-2 py-1">Codigo</th>
                        <th class="px-2 py-1">Direccion</th>
                        <th class="px-2 py-1">Status</th>
                    </tr>
                    <tr class="text-sm text-center" v-for="tar in tarimas">
                        <td>{{ tar.id }}</td>
                        <td>{{ tar.codigo }}</td>
                        <td>{{ tar.direccion }}</td>
                        <td>{{ tar.status }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <a :href="route('protocol.servidor')" class="justify-self-center">
            <button
                type="submit"
                class="bg-cyan-400 px-2 py-1 rounded-2xl text-sm"
            >
                Iniciar Servidor
            </button>
        </a>

        {{ value }}
    </div>
</template>
