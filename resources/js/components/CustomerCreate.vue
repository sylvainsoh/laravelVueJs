<template>
    <div v-if="errors!=='' ">
        {{errors}}
    </div>
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

        <router-link :to="{name : 'customer.index'}" class="bg-gray-800 px-2 py-1 text-white rounded">
            Annuler
        </router-link>  &nbsp;

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

        const {createCustomer, errors} = useCustomers();
        const storeCustomer = async () => {
            await createCustomer({...form});
            if (!errors.value){
                await router.push({name: 'customer.index'})
            }
        };

        return {
            form,
            errors,
            storeCustomer
        }
    }
}
</script>
