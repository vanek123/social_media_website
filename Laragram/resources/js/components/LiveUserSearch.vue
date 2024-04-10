<template>
    <div class="container">
        <div class="form-group">
            <h4>Type by Username</h4>
            <input type="text" v-model="searchQuery" placeholder="Search the user..." class="form-control">
            <p id="search-message" class="search-message">Start typing to search for users.</p>
        </div>

        <div class="card p-3 searchResults" v-if="results.length > 0">
            <div class="search-result p-2" v-for="(result, index) in results">
                <a :href="'/profile/' + result.id"><img :src="result.media" class="rounded-circle w-100" style="max-width: 40px;"></a>
                <a :href="'/profile/' + result.id" class="ps-3 text-decoration-none">{{ result.username }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log("Component mounted.")
        },

        data() {
            return {
                searchQuery: null,
                results: [],
            }
        },

        methods: {
            getResults() {
                if (!this.searchQuery) {
                this.results = [];
                return;
            }

                axios.get('/search/' + this.searchQuery).then(response => {
                    this.results = response.data.map(user => ({
                        id: user.id,
                        username: user.username,
                        media: user.media
                    }));
                }).catch(error => {
                    console.log(error)
                })
            },
        },

        watch: {

            searchQuery(after, before) {
                this.getResults();
            }
        }

    }
</script>