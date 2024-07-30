<script setup>
    import { ref } from 'vue';
    import { Link } from '@inertiajs/vue3';
    import { Alert, Form, FormInput, Input, Modal, Col, Row } from 'ant-design-vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    const props = defineProps({
        totalItemsProp: {
            type: Number
        },
        unitsProp: {
            type: Object
        }
    });
    const units = ref(props.unitsProp);
</script>
<template>
    <AuthenticatedLayout>
        <Row>
            <Col :span="20" :offset="2">
                <h1 class="font-bold text-center">
                    Create units
                    <Link href="/units/create">
                        <i class="fas fa-plus w-10 h-10 rounded-full bg-green-500 text-white"></i>
                    </Link>
                </h1>
                <table class="">
                    <thead>
                        <tr>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Folio</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white"></th>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Fecha de recepcion</th>
                            <th class="border py-2 px-4 bg-slate-600 text-white">Hora de recepcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="unit in units">
                            <td class="border py-2 px-4 bg-slate-100">
                                {{  }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </Col>
        </Row>
    </AuthenticatedLayout>
</template>