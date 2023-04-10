import {ref} from "vue";
import axios from "axios";

export default function useCustomers() {

    const customers = ref([]);
    const errors = ref('');
    const getCustomers = async () => {
        let response = await axios.get('/api/customers');
        customers.value = response.data.data;
    };
    const createCustomer = async (data) => {
        try {
            await axios.post('/api/customers', data);
        } catch (error) {
            const createCustomersErrors = error.response.data.errors;

            for (const key in createCustomersErrors) {
                errors.value += createCustomersErrors[key][0] + ' ';
            }
        }
    };
    return {
        customers,
        getCustomers,
        createCustomer,
        errors
    };
}
