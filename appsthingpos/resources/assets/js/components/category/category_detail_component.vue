<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Category") }}</span> {{ category.label }} ({{ category.category_code }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="category.status.color">{{ category.status.label }}</span>
                </div>
            </div>
            
            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                
                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_category()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Category") }}</button>
                </div>

            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="category_code">{{ $t("Category Code") }}</label>
                    <p>{{ category.category_code  }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Name") }}</label>
                    <p>{{ category.label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Show on POS Screen") }}</label>
                    <p>{{ display_on_pos_screen}}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Show on QR Menu") }}</label>
                    <p>{{ display_on_qr_menu }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>
                    <p>{{ (category.created_by == null)?'-':category.created_by['fullname']+' ('+category.created_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (category.updated_by == null)?'-':category.updated_by['fullname']+' ('+category.updated_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ category.created_at_label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ category.updated_at_label }}</p>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label for="description">{{ $t("Description") }}</label>
                    <p>{{ (category.description)?category.description:'-' }}</p>
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
                category : this.category_data,
                display_on_pos_screen : (this.category_data.display_on_pos_screen == 1)?'Yes':'No',
                display_on_qr_menu : (this.category_data.display_on_qr_menu == 1)?'Yes':'No',

                processing: false,
                delete_processing: false,
                show_modal: false,

                delete_category_api_link: '/api/delete_category/'+this.category_data.slack,
            }
        },
        props: {
            category_data: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Category detail page loaded');
        },
        methods: {
            delete_category(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_category_api_link, formData).then((response) => {

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