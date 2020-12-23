<template>
    <div class="col-lg-2 col-xs-12">
        <form v-on:submit.prevent="regenerateFixture">
            <div class="mb-3">
                <button class="btn btn-outline-success" id="button-rebuild">
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
