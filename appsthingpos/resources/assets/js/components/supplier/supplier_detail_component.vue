<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Supplier") }}</span> {{ supplier.name }} ({{ supplier.supplier_code }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="supplier.status.color">{{ supplier.status.label }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                
                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_supplier()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Supplier") }}</button>
                </div>

            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="supplier_code">{{ $t("supplier Code") }}</label>
                    <p>{{ supplier.supplier_code  }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="name">{{ $t("Name") }}</label>
                    <p>{{ supplier.name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">{{ $t("Email") }}</label>
                    <p>{{ supplier.email }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">{{ $t("Contact No") }}</label>
                    <p>{{ supplier.phone }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>
                    <p>{{ (supplier.created_by == null)?'-':supplier.created_by['fullname']+' ('+supplier.created_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (supplier.updated_by == null)?'-':supplier.updated_by['fullname']+' ('+supplier.updated_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ supplier.created_at_label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ supplier.updated_at_label }}</p>
                </div>
            </div>
            <hr>

            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="address">{{ $t("Address") }}</label>
                    <p>{{ supplier.address }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="pincode">{{ $t("Pincode") }}</label>
                    <p>{{ supplier.pincode }}</p>
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
                supplier : this.supplier_data,

                processing : false,
                delete_processing: false,
                show_modal: false,

                delete_supplier_api_link: '/api/delete_supplier/'+this.supplier_data.slack,
            }
        },
        props: {
            supplier_data: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Supplier detail page loaded');
        },
        methods: {
            delete_supplier(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_supplier_api_link, formData).then((response) => {

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