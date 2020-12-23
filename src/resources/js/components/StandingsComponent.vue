<template>
    <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
        <div class="col">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Team</th>
                    <th scope="col">Goals</th>
                    <th scope="col">Points</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="club in standings">
                    <td>{{ club.name }}</td>
                    <td>{{ club.goals_for + ' - ' + club.goals_against }}</td>
                    <td>{{ club.points }}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "StandingsComponent",
    data () {
        return {
            standings: [],
        }
    },
    mounted() {
        this.updateStandings(),
        this.$root.$on('StandingsComponent', () => {
            this.updateStandings()
        })
    },
    methods: {
        updateStandings() {
            axios
                .get('/api/standings')
                .then(response => {
                    this.standings = response.data
                })
        },
    },
}
</script>
