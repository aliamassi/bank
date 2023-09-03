<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard"/>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">Your Account lists</div>
                    <div class="container-fluid">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>AccountNumber</th>
                            <th>Currency</th>
                            <th>Balance</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="account in accounts">
                            <td>{{account.account_number}}</td>
                            <td>{{account.currency.name}}</td>
                            <td>{{account.balance}}</td>
                            <td><a  class="btn btn-success" href="javascript:;">Transactions</a></td>
                        </tr>
                        </tbody>

                    </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.css';
export default {
    name: "dashboard",
    props: {
        accounts: Array,
    },
    data() {
        return {

        }
    },
    created() {

    },
    methods: {},
    mounted() {
        // let $this = this;
        // let url = "/accounts";
        // axios.get(url).then(function (response) {
        //     $this.accounts = response.data.accounts;
        //
        // });
    }
}

</script>

