<template>
    <div class="row ml-0 mr-0">
        <div class="col-md-8 kd-orders custom-border-light-right">

            <div class="d-flex flex-nowrap pt-3 pb-3">
                <div class="mr-auto">
                    <span class="text-title"><span class="text-muted">{{ $t("Kitchen Display") }}: </span>{{ kitchen_display.kitchen_display_code }} - {{ kitchen_display.label }}</span>
                </div>
                <div class="d-flex flex-row">
                    <div class="" v-if="processing == false">
                        <input type="text" name="filter_order_no" v-model="filter_order_no" class="form-control form-control" :placeholder="$t('Search by Order No./Table')"  autocomplete="off">
                    </div>
                    <button class="btn btn-outline-dark ml-2" v-on:click="load_kot_list">{{ $t("Refresh") }}</button>
                </div>
            </div> 
            
            <div class="row">
                <div class="col-md-12" v-if="kot_list_filtered.length>0">
                    <div class="d-flex align-items-start flex-row flex-wrap" v-if="processing == false">
                        <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3" v-for="(kot_list_item, kot_list_key, index) in kot_list_filtered" v-bind:key="index" v-on:click="show_order_details(kot_list_item.slack)">
                            
                            <div class="col-12 p-3 kitchen-card cursor" :class="{
                                    'text-muted custom-border-light': kot_list_item.done == true,
                                    'bg-light': kot_list_item.done == false && ((kitchen_display.orange_timer == null && kitchen_display.red_timer == null) || (kitchen_display.orange_timer != null && kitchen_display.red_timer == null && calculate_duration(kot_list_item.updated_at_utc) < kitchen_display.orange_timer) || (kitchen_display.red_timer != null && kitchen_display.orange_timer == null && calculate_duration(kot_list_item.updated_at_utc) < kitchen_display.red_timer) || (kitchen_display.red_timer != null && kitchen_display.orange_timer != null && calculate_duration(kot_list_item.updated_at_utc) < kitchen_display.orange_timer && calculate_duration(kot_list_item.updated_at_utc) < kitchen_display.red_timer)),
                                    'bg-warning': kot_list_item.done == false && ((kitchen_display.orange_timer != null && kitchen_display.red_timer == null && calculate_duration(kot_list_item.updated_at_utc) >= kitchen_display.orange_timer) || (kitchen_display.orange_timer != null && kitchen_display.red_timer != null && calculate_duration(kot_list_item.updated_at_utc) >= kitchen_display.orange_timer && calculate_duration(kot_list_item.updated_at_utc) <= kitchen_display.red_timer)),
                                    'bg-danger text-white': kot_list_item.done == false && (kitchen_display.red_timer != null && calculate_duration(kot_list_item.updated_at_utc) >= kitchen_display.red_timer)
                                }">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="text-subhead-bold">#{{ kot_list_item.order_number }}</span>
                                    <span class="" v-if="kot_list_item.done == false">{{ humanize_duration(calculate_duration(kot_list_item.updated_at_utc)) }}</span>
                                    <span v-else class="text-success kitchen-order-complete"><i class="fas fa-check-circle"></i></span>
                                </div>
                                <div class="d-flex justify-content-between mb-3">
                                    <span class="" v-if="kot_list_item.order_type_data != null">{{ kot_list_item.order_type_data.label }}</span>
                                    <span class="" v-if="kot_list_item.table != null">{{ kot_list_item.table }}</span>
                                </div>
                                <div>
                                    <span>
                                        <span class="text-bold">{{ kot_list_item.product_count }}</span> Item(s)
                                        ({{ kot_list_item.quantity }} Quantity)
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div v-else><span><i class='fa fa-circle-notch fa-spin'></i> Loading..</span></div>
                </div>
                <div class="col-md-12" v-else><span>{{ $t("No orders available") }}</span></div>
            </div>

        </div>

        <div class="col-md-4 pt-3 pb-3 kd-items" v-if="order_details != ''">
            <div v-if="kot_processing == false">
                <div class="d-flex flex-wrap mb-2">
                    <div class="mr-auto">
                        <div class="d-flex">
                            <div>
                                <span class="text-title">Order #{{ order_details.order_number }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div>
                            <span v-if="mark_all_prepared_processing == true"><i class='fa fa-circle-notch fa-spin'></i></span>
                            <span class="text-primary text-bold cursor" v-else v-on:click="mark_all_prepared()">{{ $t("Mark as Prepared") }}</span>
                        </div>
                    </div>
                </div> 
                <small class="text-muted">Click the item to mark it as prepared</small>
                <div class="d-flex justify-content-between align-items-center text-muted">
                    <div class="mr-auto">{{ $t("Item") }}</div>
                    <div class="">{{ $t("Quantity") }}</div>
                </div>
                <div class="d-flex flex-column pt-2 pb-2 mb-2 kd-item-section" v-for="(products, datetime) in kot_items_sorted" v-bind:key="datetime">
                    <div class="d-flex justify-content-end">
                        <span class="small">{{ humanize_duration(calculate_duration(datetime.trim())) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 cursor kd-item" v-for="(product, key) in products" v-on:click="mark_prepared(product.slack, datetime, key)">
                        <div class="mr-auto">
                            <span v-if="product.item_status_loading == true"><i class='fa fa-circle-notch fa-spin'></i></span>
                            <span class="mr-1 text-success" v-if="product.is_ready_to_serve == 1 && (typeof product.item_status_loading == 'undefined' || product.item_status_loading == false)"><i class="fas fa-check-circle"></i></span>
                            {{ product.name }}
                        </div>
                        <div class="text-right w-25">{{ product.quantity }}</div>
                    </div>
                </div>
            </div>
            <div v-else><span><i class='fa fa-circle-notch fa-spin'></i> Loading..</span></div>
        </div>
        <div class="col-md-4 pt-3 pb-3" v-else>
            <p v-html="server_errors" v-bind:class="[error_class]"></p>
        </div>
        
        <modalcomponent v-if="show_modal" v-on:close="show_modal = false">
            <template v-slot:modal-header>
                {{ $t("Confirm") }}
            </template>
            <template v-slot:modal-body>
                Are you sure you want to dismiss this order from kitchen?
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
    
    import moment from "moment";

    export default {
        data(){
            return{
                server_errors : '',
                error_class : '',
                
                processing : false,
                kot_processing : false,
                mark_all_prepared_processing : false,

                auto_refresh : true,
                show_modal : false,

                kot_list : [],
                kot_item_slack_list : [],

                order_details : '',
                filter_order_no : '',

                kitchen_display : this.kitchen_display_data,

                kot_list_link : '/api/get_in_kitchen_order_list',
            }
        },
        props: {
            kitchen_statuses: [Array, Object],
            change_kitchen_order_status: Boolean,
            store_slack: String,
            kitchen_display_slack: String,
            kitchen_display_data: [Array, Object],
            order_link: String
        },
        computed: {
            kot_list_filtered(){
                if(this.filter_order_no){
                    return this.kot_list.filter((kot_list_item)=>{
                        return this.filter_order_no.toLowerCase().split(' ').every(v => kot_list_item.order_number.toLowerCase().includes(v) || kot_list_item.table.toLowerCase().includes(v))
                    })
                }else{
                    return this.kot_list;
                }
            },
            kot_items_sorted(){
                return Object.keys(this.order_details.product_edits.items_grouped_by_edit_time).sort((a,b) => b-a).reduce((acc,key)=>{
                    acc[key+' ']=this.order_details.product_edits.items_grouped_by_edit_time[key];
                    return acc;
                },{});
            }
        },
        mounted() {
            console.log('Kitchen display loaded');
            this.tick_update_kot_list();
        },
        created(){
            this.load_kot_list();
            console.log(`new-order.${this.store_slack}`);
        },
        methods: {
            load_kot_list(){
                this.processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("kitchen_display_slack", this.kitchen_display_slack);

                axios.post(this.kot_list_link, formData).then((response) => {
                    if(response.data.status_code == 200) {
                        this.kot_list = response.data.data;
                        this.processing = false;
                        this.total_orders = this.kot_list.length;
                    }else{
                        this.processing = false;
                        try{
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        }catch(err){
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    };
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            update_kitchen_status(order_slack, kitchen_status, item_key){
            
                this.$set(this.kot_list[item_key], 'kitchen_status_processing', true);

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("order_slack", order_slack);
                formData.append("kitchen_status", kitchen_status);

                axios.post('/api/update_kitchen_order_status', formData).then((response) => {
                    if(response.data.status_code == 200) {
                        this.$set(this.kot_list[item_key], 'kitchen_status_processing', false);
                        this.$set(this.kot_list, item_key, response.data.data.order_data);
                    }else{
                        this.$set(this.kot_list[item_key], 'kitchen_status_processing', false);
                        try{
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        }catch(err){
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    };
                })
                .catch((error) => {
                    console.log(error);
                });

            },

            mark_prepared(slack, datetime, index){
                this.$set(this.kot_items_sorted[datetime][index], 'item_status_loading', true);

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("kitchen_display_slack", this.kitchen_display_slack);
                formData.append("item_slack", slack);

                axios.post('/api/update_kitchen_item_status', formData).then((response) => {
                    if(response.data.status_code == 200) {
                        this.order_details = response.data.data.order_data;
                        this.$set(this.kot_items_sorted[datetime][index], 'item_status_loading', false);
                    }else{
                        this.$set(this.kot_items_sorted[datetime][index], 'item_status_loading', false);
                        try{
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        }catch(err){
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    };
                })
                .catch((error) => {
                    console.log(error);
                });
            },

            mark_all_prepared(){
                for (const property in this.order_details.product_edits.products) {
                    this.kot_item_slack_list.push(this.order_details.product_edits.products[property]['slack']);
                }
                if(this.kot_item_slack_list.length>0){
                    this.mark_all_prepared_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);
                    formData.append("order_slack", this.order_details.slack);
                    formData.append("items_slack", this.kot_item_slack_list);

                    axios.post('/api/update_all_kitchen_item_as_prepared', formData).then((response) => {
                        if(response.data.status_code == 200) {
                            this.show_order_details(this.order_details.slack);
                            this.mark_all_prepared_processing = false;
                        }else{
                            this.mark_all_prepared_processing = false;
                            try{
                                var error_json = JSON.parse(response.data.msg);
                                this.loop_api_errors(error_json);
                            }catch(err){
                                this.server_errors = response.data.msg;
                            }
                            this.error_class = 'error';
                        };
                    })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },

            dismiss_order(slack){

                this.$off("submit");
                this.$off("close");

                this.show_modal = true;
                this.$on("submit",function () {
                    
                    this.processing = true;
                    var formData = new FormData();

                    formData.append("access_token", window.settings.access_token);
                    formData.append("order_slack", slack);
                    formData.append("screen", 'KITCHEN_SCREEN');

                    axios.post(this.dismiss_order_api_link, formData).then((response) => {
                        if(response.data.status_code == 200) {
                            this.show_response_message(response.data.msg, 'Success');
                        
                            this.load_kot_list();

                            this.show_modal = false;
                            this.processing = false;
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
            },

            show_order_details(order_slack){
                this.kot_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("kitchen_display_slack", this.kitchen_display_slack);
                formData.append("skip_products", true);

                axios.post(`${this.order_link}/${order_slack}`, formData).then((response) => {
                    if(response.data.status_code == 200) {
                        this.order_details = response.data.data;
                        this.kot_processing = false;
                    }else{
                        this.kot_processing = false;
                        try{
                            var error_json = JSON.parse(response.data.msg);
                            this.loop_api_errors(error_json);
                        }catch(err){
                            this.server_errors = response.data.msg;
                        }
                        this.error_class = 'error';
                    };
                })
                .catch((error) => {
                    console.log(error);
                });

            },

            tick_update_kot_list(){
                setInterval(() => {
                    if(this.auto_refresh == true){
                        this.load_kot_list();
                    }
                }, 60000);
            },
        }
    }
</script>