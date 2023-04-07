<template>
    <form class="space-y-6">
        <div>
            <label for="id" class="block">Non du client</label>
            <input type="text" id="name" v-model="form.name">
        </div>
        <div>
            <label for="tel"  class="block">Non du client</label>
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

export default {

}
</script>
