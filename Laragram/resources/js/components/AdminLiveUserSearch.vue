<template>
    <div class="container">
        <div class="form-group">
            <h4>Type by Username</h4>
            <input type="text" v-model="searchQuery" placeholder="Search the user..." class="form-control">
            <p id="search-message" class="search-message text-light">Start typing to search for users.</p>
        </div>

        <div v-if="results.length > 0 || !searchQuery">
            <div class="row">
                <div class="col-md-4" v-for="(result, index) in results" :key="index">
                    <div class="card mb-4" style="background-color: #1E1E24">
                        <div class="card-body text-center">
                            <a :href="'/profile/' + result.id">
                                <img :src="result.media" class="rounded-circle mb-3" style="max-width: 60px;">
                            </a>
                            <h5 class="card-title">
                                <a :href="'/profile/' + result.id" class="text-decoration-none text-light">
                                    {{ result.username }}
                                </a>
                            </h5>
                            <!--<follow-button :user-id="result.id" :follows="result.follows"></follow-button>-->
                            <a :href=" 'chat/' + result.id" class="btn allBtn">Message</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 text-light" v-else>
            <p>No Results Found</p>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log("Component mounted.");
            this.getResults();
        },
        data() {
            return {
                searchQuery: null,
                results: [],
            };
        },
        methods: {
            getResults() {
                let url = this.searchQuery ? `/search/${this.searchQuery}` : '/allUsers';
                axios.get(url)
                    .then(response => {
                        this.results = response.data.map(user => ({
                            id: user.id,
                            username: user.username,
                            media: user.media
                        }));
                    })
                    .catch(error => {
                        console.error('Error fetching users:', error);
                    });
            },
        },
        watch: {
            searchQuery(after, before) {
                this.getResults();
            }
        }
    }
</script>