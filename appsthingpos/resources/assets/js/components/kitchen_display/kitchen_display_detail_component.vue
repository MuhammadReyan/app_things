<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Kitchen Display") }}</span> {{ kitchen_display.label }} ({{ kitchen_display.kitchen_display_code }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="kitchen_display.status.color">{{ kitchen_display.status.label }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_kitchen_display()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Kitchen Display") }}</button>
                </div>

            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="kitchen_display_code">{{ $t("Kitchen Display Code") }}</label>
                    <p>{{ kitchen_display.kitchen_display_code  }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Name") }}</label>
                    <p>{{ kitchen_display.label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>
                    <p>{{ (kitchen_display.created_by == null)?'-':kitchen_display.created_by['fullname']+' ('+kitchen_display.created_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (kitchen_display.updated_by == null)?'-':kitchen_display.updated_by['fullname']+' ('+kitchen_display.updated_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ kitchen_display.created_at_label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ kitchen_display.updated_at_label }}</p>
                </div>
            </div>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Categories") }}</span>
            </div>
            <div class="mb-2">
                <div class="" v-for="(category, index) in all_categories" v-bind:key="index">
                    <label class="" v-bind:for="category.slack">
                        <span v-if="kitchen_display.category_array.includes(category.slack)"><i class="fas fa-check-square text-success"></i></span><span v-else><i class="far fa-square"></i></span> {{ $t(category.label) }}
                    </label>
                </div>
            </div>
        </div>

        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                {{ $t("Are you sure you want to proceed?") }}
            </template>
            <template v-slot:modal-footer>
                <button type="button" class="btn btn-light" @click="$emit('close')">Cancel</button>
                <button type="button" class="btn btn-primary" @click="$emit('submit')" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> Continue</button>
            </template>
        </modalcomponent>

    </div>
</template>  

<script>
    'use strict';
    
    export default {
        data(){
            return{
                kitchen_display : this.kitchen_display_data,

                processing : false,
                delete_processing: false,
                show_modal: false,

                delete_kitchen_display_api_link: '/api/delete_kitchen_display/'+this.kitchen_display_data.slack,
            }
        },
        props: {
            kitchen_display_data: [Array, Object],
            all_categories: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Kitchen Display detail page loaded');
        },
        methods: {
            delete_kitchen_display(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_kitchen_display_api_link, formData).then((response) => {

                        if(response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                            if(response.data.link != ""){
                                window.location.href = response.data.link;
                            }else{
                                location.reload();
                            }
                        }else{
                            this.show_modal = false;
                            this.processing = false;
                            try{
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            }catch(err){
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        }
                        this.delete_processing = false;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                });

                this.$on("close",function () {
                    this.show_modal = false;
                });
            }
        }
    }
</script>