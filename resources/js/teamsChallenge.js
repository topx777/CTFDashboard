import Echo from 'laravel-echo'

// window.Axios = require('axios');
// window.Vue = require('vue');
window.Pusher = require('pusher-js');

// window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token) {
//     window.Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: window.location.hostname,
    wsPort: 6001,
    disableStats: true
});


window.Echo.channel(`TeamChallenge.Levels.${window.CompetitionId}.${window.TeamId}`)
    .listen('ChallengesTeamCompetition', (e) => {
        setLevelsChallenges(e.levels.level);
    });
