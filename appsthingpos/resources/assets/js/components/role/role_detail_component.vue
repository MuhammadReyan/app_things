<template>
    <div class="row">
        <div class="col-md-12">

            <div class="d-flex flex-wrap mb-4">
                <div class="mr-auto">
                   <div class="d-flex">
                        <div>
                            <span class="text-title"> <span class='text-muted'>{{ $t("Role") }}</span> {{ role.label }} ({{ role.role_code }}) </span>
                        </div>
                    </div>
                </div>
                <div class="">
                    <span v-bind:class="role.status.color">{{ role.status.label }}</span>
                </div>
            </div>

            <div class="d-flex flex-wrap mb-4">

                <p v-html="server_errors" v-bind:class="[error_class]"></p>
                
                <div class="ml-auto">
                    <button type="submit" class="btn btn-danger mr-1" v-if="delete_access == true" v-on:click="delete_role()" v-bind:disabled="delete_processing == true"> <i class='fa fa-circle-notch fa-spin'  v-if="delete_processing == true"></i> {{ $t("Delete Role") }}</button>
                </div>

            </div>
            <hr>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Basic Information") }}</span>
            </div>
            <div class="form-row mb-2">
                <div class="form-group col-md-3">
                    <label for="role_code">{{ $t("Role Code") }}</label>
                    <p>{{ role.role_code  }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="label">{{ $t("Name") }}</label>
                    <p>{{ role.label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_by">{{ $t("Created By") }}</label>
                    <p>{{ (role.created_by == null)?'-':role.created_by['fullname']+' ('+role.created_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_by">{{ $t("Updated By") }}</label>
                    <p>{{ (role.updated_by == null)?'-':role.updated_by['fullname']+' ('+role.updated_by['user_code']+')' }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="created_on">{{ $t("Created On") }}</label>
                    <p>{{ role.created_at_label }}</p>
                </div>
                <div class="form-group col-md-3">
                    <label for="updated_on">{{ $t("Updated On") }}</label>
                    <p>{{ role.updated_at_label }}</p>
                </div>
            </div>

            <div class="mb-2">
                <span class="text-subhead">{{ $t("Access settings") }}</span>
            </div>
            <div class="mb-2">
                <div class="mb-3" v-for="(menu, index) in menus" v-bind:key="index">
                
                    <label class="" v-bind:for="menu.menu_key">
                        <span v-if="menu_selected.includes(menu.menu_key)"><i class="fas fa-check-square text-success"></i></span> {{ $t(menu.label) }}
                    </label>
                    <div class="mb-2 pl-4">
                        <div class="" v-for="(submenu_item, index) in menu.sub_menu" v-bind:key="index">
                            
                            <label class="" v-bind:for="submenu_item.menu_key">
                                <span v-if="menu_selected.includes(submenu_item.menu_key)"><i class="fas fa-check-square text-success"></i></span> {{ $t(submenu_item.label) }}
                            </label>

                            <div class="mb-2 pl-5">
                                <div class="" v-for="(action_item, index) in submenu_item.actions" v-bind:key="index">
                                    
                                    <label class="" v-bind:for="action_item.menu_key">
                                        <span v-if="menu_selected.includes(action_item.menu_key)"><i class="fas fa-check-square text-success"></i></span> {{ $t(action_item.label) }}
                                    </label>
                                </div>
                            </div>
                        </div>
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
                server_errors   : '',
                error_class     : '',
                processing      : false,
                
                role            : this.role_data,
                menu_selected   : this.role_data.menus,
                menus           : this.access_menus,

                delete_processing: false,
                show_modal: false,

                delete_role_api_link: '/api/delete_role/'+this.role_data.slack,
            }
        },
        props: {
            role_data: [Array, Object],
            access_menus: [Array, Object],
            delete_access: Boolean,
        },
        mounted() {
            console.log('Role detail page loaded');
        },
        methods: {
            delete_role(){
                this.$off("submit");
                this.$off("close");
                this.show_modal = true;

                this.$on("submit",function () {       
                    this.processing = true;
                    this.delete_processing = true;

                    var formData = new FormData();
                    formData.append("access_token", window.settings.access_token);

                    axios.post(this.delete_role_api_link, formData).then((response) => {

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