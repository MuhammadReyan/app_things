<template>
    <div class="row ml-0 mr-0">
        <div class="col-md-8 kd-orders custom-border-light-right">

            <div class="d-flex flex-nowrap pt-3 pb-3">
                <div class="mr-auto">
                    <span class="text-title"><span class="text-muted">{{ $t("Waiter Display") }} </span></span>
                </div>
                <div class="d-flex flex-row">
                    <div class="" v-if="processing == false">
                        <input type="text" name="filter_order_no" v-model="filter_order_no" class="form-control form-control" :placeholder="$t('Search by Order No./Table')"  autocomplete="off">
                    </div>
                    <button class="btn btn-outline-dark ml-2" v-on:click="load_kot_list">{{ $t("Refresh") }}</button>
                </div>
            </div> 
            
            <div class="col-md-12 p-0" v-if="is_waiter == false">
                <label for="payment_method d-block">{{ $t("Choose Waiter") }}</label>
                <div class="d-flex flex-wrap">
                    <div class="row flex-fill" v-if="typeof users != 'undefined' && users.length>0">
                        <div class="col-md-3" v-for="(user, index) in users" v-bind:key="index">
                            <input type="radio" class="check d-none" name="waiter" v-model="waiter" v-bind:value="user.slack" v-bind:id="'waiter'+index" v-on:click="load_waiter_kot_list(user.slack)">
                            <label class="check-buttons w-100 text-truncate" v-bind:for="'waiter'+index" >{{ user.user_code }} - {{ user.fullname }}</label>
                        </div>
                    </div>
                    <div v-else class="text-muted">Waiters are not available!</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12" v-if="kot_list_filtered.length>0">
                    <div class="d-flex align-items-start flex-row flex-wrap" v-if="processing == false">
                        <div class="d-flex align-items-start flex-column p-1 mb-1 col-md-3" v-for="(kot_list_item, kot_list_key, index) in kot_list_filtered" v-bind:key="index" v-on:click="show_order_details(kot_list_item.slack)">
                            
                            <div class="col-12 p-3 kitchen-card cursor bg-light">
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
                </div> 
                <div class="d-flex justify-content-between align-items-center text-muted">
                    <div class="mr-auto">{{ $t("Item") }}</div>
                    <div class="">{{ $t("Quantity") }}</div>
                </div>
                <div class="d-flex flex-column pt-2 pb-2 mb-2 kd-item-section" v-for="(products, datetime) in kot_items_sorted" v-bind:key="datetime">
                    <div class="d-flex justify-content-end">
                        <span class="small">{{ humanize_duration(calculate_duration(datetime.trim())) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-1 kd-item" v-for="(product, key) in products">
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
                server_errors   : '',
                error_class     : '',
                processing : false,
                kot_processing : false,

                kot_list : [],

                total_orders : 0,
                list_populated : false,

                order_details : '',
                filter_order_no : '',

                auto_refresh : true,
                show_modal : false,

                dismiss_order_api_link: '/api/toggle_order_dismissed_from_screen_status',

                waiter : '',
            }
        },
        props: {
            is_waiter: Boolean,
            users: [Array, Object],
            store_slack: String,
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
            console.log('Waiter order page loaded');
            this.tick_update_kot_list();
        },
        created(){
            if(this.is_waiter == true){
                this.load_kot_list();
            }
        },
        methods: {
            load_kot_list(){
                this.processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
                formData.append("waiter_slack", this.waiter);

                axios.post('/api/get_waiter_order_list', formData).then((response) => {
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

            load_waiter_kot_list(user_slack = ''){
                this.waiter = user_slack;
                this.load_kot_list();
            },

            show_order_details(order_slack){
                this.kot_processing = true;

                var formData = new FormData();
                formData.append("access_token", window.settings.access_token);
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