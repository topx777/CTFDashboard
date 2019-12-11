import Echo from 'laravel-echo'

window.Axios = require('axios');
window.Vue = require('vue');
window.Pusher = require('pusher-js');

window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token=document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  window.Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

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
      teams: []
    },
    created(){
      this.fetchScore();
      
    },
    mounted()
    {
      window.Echo.channel('Copetition.ScoreBoard.1')
      .listen('ECompetitionScoreUpdate', (e)=>{

        if (this.teams.length==e.competition.scoreboard.length) {
          var equal=true;
          for (let i = 0; i < this.teams.length; i++) {
            if (this.teams[i].id!=e.competition.scoreboard[i].id) {
              equal=false;
            }
          }
          if (equal==false) {
            console.log(e)
            this.teams=e.competition.scoreboard
          }
        }
        else{
          this.teams=e.competition.scoreboard
        }
      });
    },
    methods: {
      fetchScore(){
        Axios.get('competitions/positions').then(response =>{
            console.log(response)
            this.teams=response.data.scoreboard

        })
      }
    }
  })