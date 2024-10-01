<template>
    <section class="d-flex flex-column justify-content-center text-center" v-if="show_indicator" :class="{'bg-danger p-2': show_indicator}">
        <span class="app-indicator"><a :href="installation_helper_link" class='text-decoration-none text-white text-bold'>Click Here To Activate The Product <i class="fas fa-arrow-alt-circle-right"></i></a></span>
    </section>
</template>

<script>
    'use strict';
    
    export default {
        data(){
            return{
                show_indicator: false,
                installation_helper_link: '',

                activated: ($cookies.get('activated') != null)?$cookies.get('activated'):0
            }
        },
        mounted(){
            if(this.activated == 0){
                this.ca();
            }
        },
        methods: {
            ca(){
                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);

                axios.post('/api/ca', formData)
                .then((response) => {
                    if(response.data.status_code == 200) {
                        this.show_indicator = (response.data.data.active == true)?false:true;
                        this.installation_helper_link = response.data.data.installation_helper_link;
                        if(response.data.data.active == true){
                            $cookies.set('activated', 1);
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>