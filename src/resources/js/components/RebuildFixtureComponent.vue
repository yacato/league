<template>
    <div class="col-lg-2 col-xs-12">
        <form v-on:submit.prevent="regenerateFixture">
            <div class="input-group mb-3">
                <select
                    v-model="form.clubCount"
                    class="form-control form-select"
                    aria-label="Team Count"
                    aria-describedby="button-rebuild"
                >
                    <option selected value="4">4</option>
                    <option value="8">8</option>
                    <option value="12">12</option>
                    <option value="18">18</option>
                    <option value="20">20</option>
                </select>
                <button
                    class="btn btn-outline-success"
                    id="button-rebuild"
                >
                    Rebuild
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "RebuildFixtureComponent",
    data() {
        return {
            form: {
                clubCount: 4,
            }
        }
    },
    methods: {
        regenerateFixture() {
            axios
                .post('/api/fixtures', this.form)
                .then((res) => {
                    this.$root.$emit('FixtureListComponent')
                    console.log('success')
                })
                .catch((error) => {
                    console.log('error')
                });
        },
    },
}
</script>
