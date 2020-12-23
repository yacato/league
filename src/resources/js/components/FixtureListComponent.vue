<template>
    <div class="row row-cols-1 row-cols-md-12 mb-12 text-center">
        <div class="col">
            <div class="card mb-4 shadow-sm" v-for="(week, weekNumber) in fixture">
                <div class="card-header">
                    <h5 class="my-0 fw-normal">
                        Round {{ weekNumber }}
                        <button v-if="activeWeek == weekNumber" v-on:click="playAll()" type="button" class="btn btn-outline-primary float-right btn-sm ml-10">Play All</button>
                        <button v-if="activeWeek == weekNumber" v-on:click="playWeekly(weekNumber)" type="button" class="btn btn-outline-success float-right btn-sm">Play</button>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr v-for="(match, matchNumber) in week">
                            <th scope="row">{{ matchNumber + 1 }}</th>
                            <td :class="{ 'green' : match.result === 'home'}">{{ match.home_club.name }}</td>
                            <td v-if="match.result"> {{ match.home_club_goal }} - {{ match.away_club_goal }}</td>
                            <td v-else>-</td>
                            <td :class="{ 'green' : match.result === 'away'}">{{ match.away_club.name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FixtureListComponent",
    props: ['name'],
    data () {
        return {
            fixture: [],
            activeWeek: 0,
        }
    },
    mounted() {
        this.updateFixture(),
        this.$root.$on('FixtureListComponent', () => {
            this.updateFixture()
        })
    },
    methods: {
        updateFixture() {
            axios
                .get('/api/fixtures')
                .then(response => {
                    this.groupFixture(response.data)
                })
        },
        playWeekly(week) {
            axios
                .post('/api/play-matches/weekly', {'week': week})
                .then((res) => {
                    this.$root.$emit('FixtureListComponent')
                })
                .catch((error) => {

                });
        },
        playAll() {
            axios
                .post('/api/play-matches/all', {})
                .then((res) => {
                    this.$root.$emit('FixtureListComponent')
                })
                .catch((error) => {

                });
        },
        groupFixture(items) {
            var groupFixture = {}
            var firstWeek = 0;
            items.forEach(item => {
                if (!groupFixture[item['week']]){
                    groupFixture[item['week']] = []
                }
                groupFixture[item['week']].push(item)

                if(!item.result && firstWeek === 0) {
                    firstWeek = item.week
                }
            })
            this.fixture = groupFixture;
            this.activeWeek = firstWeek;
        }
    },
}
</script>
