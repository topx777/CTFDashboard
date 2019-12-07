import Echo from 'laravel-echo'

window.Vue = require('vue');
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true
});

// window.Echo.channel('scoreBoard')
//     .listen('TeamsPositions', (e) => {
//         setOrden(e.teams);
//     });

const app = new Vue({
    el: '#flip-list-demo',
    data: {
      items: [1,2,3,4,5,6,7,8,9]
    },
    methods: {
      shuffle: function () {
        this.items = _.shuffle(this.items)
      }
    }
  })