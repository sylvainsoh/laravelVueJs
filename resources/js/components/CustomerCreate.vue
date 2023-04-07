<template>
    <form class="space-y-6" @submit.prevent="storeCustomer">
        <div>
            <label for="id" class="block">Non du client</label>
            <input type="text" id="name" v-model="form.name">
        </div>
        <div>
            <label for="tel"  class="block">Téléphone</label>
            <input type="text" id="tel"  v-model="form.tel">
        </div>
        <div>
            <label for="is_favourite"  class="block">Favoris ? </label>
            <input type="checkbox" id="is_favouritetel"  v-model="form.is_favourite">
        </div>
        <button type="submit" class="bg-gray-800 px-2 py-1 text-white rounded">
            Enrégister un client
        </button>
    </form>
</template>


<script>

import {reactive} from "vue";
import useCustomers from "../services/cutomerservices.js";
import router from "../router";

export default {
    setup(){
        const form = reactive(
            {
                name : '',
                tel : '',
                is_favourite : '',
            });

        const {createCustomer} = useCustomers();
        const storeCustomer = async () => {
            await createCustomer({...form});
            await router.push({name: 'customer.index'})
        };

        return {
            form,
            storeCustomer
        }
    }
}
</script>
