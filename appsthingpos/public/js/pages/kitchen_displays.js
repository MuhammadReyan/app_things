class KitchenDisplays{
    load_listing_table(){
        "use strict";
        var listing_table = $('#listing-table').DataTable({
            ajax: {
                url  : '/api/kitchen_displays',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
            },
            columns: [
                { name: 'kitchen_displays.kitchen_display_code' },
                { name: 'kitchen_displays.label' },
                { name: 'master_status.label' },
                { name: 'kitchen_displays.created_at' },
                { name: 'kitchen_displays.updated_at' },
                { name: 'user_created.fullname' },
            ],
            order: [[ 3, "desc" ]],
            columnDefs: [
                { "orderable": false, "targets": [6] }
            ]
        });
    }
}