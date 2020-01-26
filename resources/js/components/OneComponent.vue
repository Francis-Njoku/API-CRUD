<template>
    <div>
        <button class="my-button" :type="type" v-text="test.title">My Button</button>
    <button class="my-button" :type="type" v-text="test.name">My Button</button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')

            axios.post('api/vue', {})
            .then(response => {
            this.test = response.data;
            });
        },

        data: function (){
        return {
        test: null,
        }
        },
        props: [
        'text',
        'type'
        ]
    }
</script>
<style>
.my-button{
background-color: black;
color: white;
padding: 10px 15px;
font-weight: bold;
}
</style>
