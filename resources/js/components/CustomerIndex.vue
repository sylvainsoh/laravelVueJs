<template>
    <div class="relative overflow-x-auto">
        <div class="flex mb-4">
            <router-link :to="{name : 'customer.create'}" class="bg-gray-800 px-2 py-1 text-white rounded">
                Créer un client
            </router-link>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="text-align: left">
            <tr>
                <th >
                    Nom
                </th>
                <th >
                    Tel
                </th>
                <th >
                    Is Favourite
                </th>
                <th >
                    Action
                </th>
            </tr>
            </thead>
            <tbody>
            <template v-for="customer in customers" :key="customer.id">
                <tr class=" dark:bg-gray-800" style="text-align: left">
                    <th scope="row" class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <span v-text="customer.name"></span>
                    </th>
                    <td>
                        <span v-text="customer.tel"></span>
                    </td>
                    <td class="px-6 py-4">
                           <span
                               v-text="customer.is_favourite"
                               v-bind:class="{' text-green-600' : customer.is_favourite}">
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <router-link :to="{name : 'customer.edit',params : {id : customer.id}}" class="px-2 py-1 dark:bg-gray-900 rounded mr-2">
                            Modifier
                        </router-link>
                        <button @click="deleteCustomer(customer.id)" class="px-2 py-1 dark:bg-gray-900 rounded text-red-600">
                            Supprimer
                        </button>
                    </td>
                </tr>
            </template>
            </tbody>
        </table>
    </div>

</template>


<script>
import useCustomers from "../services/cutomerservices.js";
import {onMounted} from "vue";

export default {
    setup() {
        const {customers, getCustomers, destroyCustomer} = useCustomers();

        const deleteCustomer=async (id) => {
            await destroyCustomer(id);
        };

        onMounted(getCustomers());
        return {
            customers,
            deleteCustomer,

        };
    }
}
</script>
