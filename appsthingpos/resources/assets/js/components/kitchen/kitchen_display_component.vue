<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title">{{ $t("Choose Kitchen Display") }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-2" v-if="kitchen_display_data.length>0">
                <div class="col-md-3" v-for="(kitchen_display, index) in kitchen_display_data" v-bind:key="index">
                    <a :href="kitchen_link+'/'+kitchen_display.slack" class="btn btn-outline-primary btn-block" role="button" aria-pressed="true">{{ kitchen_display.kitchen_display_code }} - {{ kitchen_display.label }}</a>
                </div>
            </div>
            <div class="mb-2" v-else>
                <span>{{ $t("Kitchen displays are not added") }}</span>
            </div>
        </div>
    </div>
</template>  

<script>
    'use strict';

    export default {
        data(){
            return{
                kot_list_link: '/api/get_in_kitchen_order_list',
            }
        },
        props: {
            kitchen_display_data: [Array, Object],
            kitchen_link: String,
            store_slack: String
        },
        methods: {

        }
    }
</script>