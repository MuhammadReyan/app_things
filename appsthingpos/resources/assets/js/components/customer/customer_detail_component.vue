<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Customer") }}</span> {{ customer.name }} </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="customer.status.color">{{ customer.status.label }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                
                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_customer()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Customer") }}</button>
                </div>

            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="fullname">{{ $t("Fullname") }}</label>
                    <p>{{ (customer.name == '' || customer.name == null)?'-':customer.name }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="email">{{ $t("Email") }}</label>
                    <p>{{ (customer.email == '' || customer.email == null)?'-':customer.email }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="phone">{{ $t("Phone") }}</label>
                    <p>{{ (customer.phone == '' || customer.phone == null)?'-':customer.phone }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="dob">{{ $t("Date of Birth") }}</label>
                    <p>{{ (customer.dob == '' || customer.dob == null)?'-':customer.dob }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="address">{{ $t("Address") }}</label>
                    <p>{{ (customer.address == '' || customer.address == null)?'-':customer.address }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>
                    <p>{{ (customer.created_by == null)?'-':customer.created_by['fullname']+' ('+customer.created_by['customer_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (customer.updated_by == null)?'-':customer.updated_by['fullname']+' ('+customer.updated_by['customer_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ customer.created_at_label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ customer.updated_at_label }}</p>
                </div>
            </div>

            <hr>

            <div class="d-flex flex-wrap mb-4">
                <div class="col-md-6 pl-0">
                    <div class="mb-2">
                        <span class="text-subhead">{{ $t("Recent Orders") }}</span>
                    </div>
                    <div class="col-md-12 pl-0">
                        <div v-if="processing == false">
                            <div class="table-responsive" v-if="recent_orders_list != null && recent_orders_list.length>0">
                                <table class="table display nowrap text-nowrap w-100">
                                    <thead>
                                        <tr>
                                        <th scope="col">{{ $t("Order Number") }}</th>
                                        <th scope="col" class="text-right">{{ $t("Amount") }}</th>
                                        <th scope="col">{{ $t("Currency") }}</th>
                                        <th scope="col">{{ $t("Created On") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(recent_order_list, key, index) in recent_orders_list" v-bind:key="index">
                                            <td>{{ recent_order_list.order_number }}</td>
                                            <td class=" text-right">{{ recent_order_list.total_order_amount }}</td>
                                            <td>{{ recent_order_list.currency_code }}</td>
                                            <td>{{ recent_order_list.created_at_label }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    <span class="text-centered btn-label mt-2" v-show="has_more_items" v-on:click="load_recent_orders(next_page)">
                                        <span class="" v-if="processing == true"><i class='fa fa-circle-notch fa-spin'></i></span>
                                        {{ $t("Load More") }}
                                    </span>
                                </div>
                            </div>
                            <span class="mb-2" v-else>No recent orders</span>
                        </div>
                        <span class="mb-2"><span class="" v-if="processing == true"><i class='fa fa-circle-notch fa-spin'></i> Loading</span></span>
                    </div>
                </div>

                 <div class="col-md-6 pl-0 pr-0">
                    <div class="mb-2">
                        <span class="text-subhead">{{ $t("Favourite Products") }}</span>
                    </div>
                    <div class="col-md-12 pl-0">
                        <div v-if="favourite_processing == false">
                            <div class="table-responsive" v-if="favourite_product_list != null && favourite_product_list.length>0">
                                <table class="table display nowrap text-nowrap w-100">
                                    <thead>
                                        <tr>
                                        <th scope="col">{{ $t("Product Code") }}</th>
                                        <th scope="col">{{ $t("Product Description") }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(favourite_product_item, key, index) in favourite_product_list" v-bind:key="index">
                                            <td>{{ favourite_product_item.product_code }}</td>
                                            <td>{{ favourite_product_item.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <span class="mb-2" v-else>No orders till now</span>
                        </div>
                        <span class="mb-2"><span class="" v-if="favourite_processing == true"><i class='fa fa-circle-notch fa-spin'></i> Loading</span></span>
                    </div>
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
                customer : this.customer_data,
                recent_orders_list : [],
                has_more_items: false,
                current_page: '',
                next_page: 1,

                server_errors   : '',
                error_class     : '',
                processing      : false,

                favourite_product_list : [],
                favourite_processing : false,

                delete_processing: false,
                show_modal: false,

                delete_customer_api_link: '/api/delete_customer/'+this.customer_data.slack,
            }
        },
        props: {
            customer_data: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Customer detail page loaded');

            this.load_recent_orders();
            this.load_favourite_products();
        },
        methods: {
            load_recent_orders(page){

                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("customer_slack", this.customer.slack);
                
                axios.post('/api/order_list?page='+page, formData)
                .then((response) => {
                    this.processing = false;
                    if(response.data.status_code === 200) {
                        var recent_order_list = response.data.data.data;
                        if(page == 1){
                            this.recent_orders_list = [];
                        }
                        recent_order_list.forEach((item) => {
                            this.recent_orders_list.push(item);
                        });

                        this.has_more_items = response.data.data.links.has_more_items;
                        this.current_page = response.data.data.links.current_page;
                        this.next_page = (response.data.data.links.has_more_items == true)?response.data.data.links.current_page+1:1;
                    }else{
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
            },

            load_favourite_products(){

                this.favourite_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("customer_slack", this.customer.slack);
                
                axios.post('/api/get_product', formData)
                .then((response) => {
                    this.favourite_processing = false;
                    if(response.data.status_code === 200) {
                        let favourite_product = response.data.data;
                        this.favourite_product_list = favourite_product;
                    }else{
                        this.favourite_processing = false;
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
            },

            delete_customer(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_customer_api_link, formData).then((response) => {

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