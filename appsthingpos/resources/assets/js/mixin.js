"use strict";

import moment from "moment";

export var mixin = {
    methods: {
        loop_api_errors(error_json) {
            this.server_errors = '';
            var error_string = '';
            $.each(error_json, (key, value) => {
                error_string += value[0] + '<br>';
            });
            this.server_errors = error_string;
            return this.server_errors;
        },

        show_response_message(message, title = '', duration = 90000){
            
            Vue.notify({
                group: 'notification_bar',
                title: title,
                text: message,
                duration: duration,
                closeOnClick: false
            });
            
        },

        play_beep(){
            if(typeof this.pos_order != 'undefined' && this.pos_order == true){
                var audio = new Audio('/audio/beep.mp3');
                audio.play();
            }
        },

        play_notification(){
            var audio = new Audio('/audio/notification.mp3');
            audio.play();
        },

        scroll_to(item){
            var element = this.$els[item];
            element.scrollIntoView();
        },

        calculate_duration(created_date){
            var moment = require('moment-timezone');
            var tz = moment.tz.guess();

            var today = moment();
            var date_obj = new Date(Number(created_date));
            var moment_obj = moment.unix(date_obj).tz(tz);

            var duration = moment.duration(today.diff(moment_obj));
            var minutes = Math.abs(Math.round(duration.as('minutes')));
            minutes = (isNaN(minutes))?'-':minutes;
            return minutes;
        },

        humanize_duration(minutes){
            return moment.duration(-1 * minutes, "minutes").humanize(true);
        },

    }
}