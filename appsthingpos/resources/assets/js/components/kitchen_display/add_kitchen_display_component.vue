<template>
    <div class="row">
        <div class="col-md-12">
            
            <form @submit.prevent="submit_form" class="mb-3">

                <div class="d-flex flex-wrap mb-4">
                    <div class="mr-auto">
                        <span class="text-title" v-if="kitchen_display_slack == ''">{{ $t("Add Kitchen Display") }}</span>
                        <span class="text-title" v-else>{{ $t("Edit Kitchen Display") }}</span>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-primary" v-bind:disabled="processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="processing == true"></i> {{ $t("Save") }}</button>
                    </div>
                </div>
                    
                <p v-html="server_errors" v-bind:class="[error_class]"></p>

                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="counter_code">{{ $t("Kitchen Display Code") }}</label>
                        <input type="text" name="kitchen_display_code" v-model="kitchen_display_code" v-validate="'required|alpha_dash|max:30'" class="form-control form-control-custom" :placeholder="$t('Please enter kitchen display code')"  autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('kitchen_display_code') }">{{ errors.first('kitchen_display_code') }}</span> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="name">{{ $t("Name") }}</label>
                        <input type="text" name="name" v-model="name" v-validate="'required|max:150'" class="form-control form-control-custom" :placeholder="$t('Please enter name')"  autocomplete="off">
                        <span v-bind:class="{ 'error' : errors.has('name') }">{{ errors.first('name') }}</span> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="status">{{ $t("Status") }}</label>
                        <select name="status" v-model="status" v-validate="'required|numeric'" class="form-control form-control-custom custom-select">
                            <option value="">Choose Status..</option>
                            <option v-for="(status, index) in statuses" v-bind:value="status.value" v-bind:key="index">
                                {{ status.label }}
                            </option>
                        </select>
                        <span v-bind:class="{ 'error' : errors.has('status') }">{{ errors.first('status') }}</span> 
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="form-group col-md-3">
                        <label for="orange_timer">{{ $t("Orange Timer (Mins)") }}</label>
                        <input type="number" name='orange_timer' v-model="orange_timer" v-validate="'decimal'" class="form-control form-control-custom" :placeholder="$t('Please enter value in minutes')"  autocomplete="off" step="0.01" min="0">
                        <span v-bind:class="{ 'error' : errors.has('orange_timer') }">{{ errors.first('orange_timer') }}</span> 
                    </div>
                    <div class="form-group col-md-3">
                        <label for="red_timer">{{ $t("Red Timer (Mins)") }}</label>
                        <input type="number" name='red_timer' v-model="red_timer" v-validate="'decimal'" class="form-control form-control-custom" :placeholder="$t('Please enter value in minutes')"  autocomplete="off" step="0.01" min="0">
                        <span v-bind:class="{ 'error' : errors.has('red_timer') }">{{ errors.first('red_timer') }}</span> 
                    </div>
                </div>

                <div class="mb-2">
                    <span class="text-subhead">{{ $t("Categories") }}</span>
                </div>
                <div class="mb-2">
                    <div class="custom-control custom-checkbox mb-3" v-for="(category, index) in available_categories" v-bind:key="index">
                        <input class="custom-control-input" type="checkbox" v-model="categories" v-bind:value="category.slack" v-bind:id="category.slack">
                        <label class="custom-control-label" v-bind:for="category.slack">
                            {{ $t(category.label) }}
                        </label>
                    </div>
                </div>

            </form>
                
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
                server_errors   : '',
                error_class     : '',
                processing      : false,
                modal           : false,
                show_modal      : false,
                api_link        : (this.kitchen_display_data == null)?'/api/add_kitchen_display':'/api/update_kitchen_display/'+this.kitchen_display_data.slack,

                kitchen_display_slack : (this.kitchen_display_data == null)?'':this.kitchen_display_data.slack,
                kitchen_display_code : (this.kitchen_display_data == null)?'':this.kitchen_display_data.kitchen_display_code,
                name : (this.kitchen_display_data == null)?'':this.kitchen_display_data.label,
                orange_timer : (this.kitchen_display_data == null)?'':this.kitchen_display_data.orange_timer,
                red_timer : (this.kitchen_display_data == null)?'':this.kitchen_display_data.red_timer,
                categories : (this.kitchen_display_data == null)?[]:this.kitchen_display_data.category_array,
                status : (this.kitchen_display_data == null)?'':(this.kitchen_display_data.status == null)?'':this.kitchen_display_data.status.value,
            }
        },
        props: {
            statuses: Array,
            available_categories: [Array, Object],
            kitchen_display_data: [Array, Object]
        },
        mounted() {
            console.log('Add kitchen display page loaded');
        },
        methods: {
            submit_form(){

                this.$off("submit");
                this.$off("close");

                this.$validator.validateAll().then((result) => {
                    if (result) {
                        this.show_modal = true;
                        this.$on("submit",function () {
                            
                            this.processing = true;
                            var formData = new FormData();

                            formData.append("access_token", window.settings.access_token);
                            formData.append("kitchen_display_code", (this.kitchen_display_code == null)?'':this.kitchen_display_code);
                            formData.append("label", (this.name == null)?'':this.name);
                            formData.append("categories", (this.categories == null)?'':this.categories);
                            formData.append("orange_timer", (this.orange_timer == null)?'':this.orange_timer);
                            formData.append("red_timer", (this.red_timer == null)?'':this.red_timer);
                            formData.append("status", (this.status == null)?'':this.status);

                            axios.post(this.api_link, formData).then((response) => {
                                if(response.data.status_code == 200) {
                                    this.show_response_message(response.data.msg, 'Success');
                                
                                    setTimeout(function(){
                                        location.reload();
                                    }, 1000);
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
                            })
                            .catch((error) => {
                                console.log(error);
                            });
                        });
                        
                        this.$on("close",function () {
                            this.show_modal = false;
                        });
                    }
                });
            }
        }
    }
</script>