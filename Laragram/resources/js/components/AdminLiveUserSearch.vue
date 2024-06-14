<template>
    <div>
        <div class="search-box">
            <i class="uil uil-search"></i>
            <input type="text" placeholder="Search here...">
        </div>

        <div class="dash-content">
            <div class="activity">
                <div class="title">
                    <i class="uil uil-users-alt"></i>
                    <span class="text">Users</span>
                </div>
                <div class="activity-data" v-if="results.length > 0">
                    <div class="data names">
                        <span class="data-title">Name</span>
                        <span v-for="(result, index) in results" :key="index" class="data-list">{{ result.name }}</span>
                    </div>
                    <div class="data email">
                        <span class="data-title">Username</span>
                        <span v-for="(result, index) in results" :key="index" class="data-list">{{ result.username }}</span>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Email</span>
                        <span v-for="(result, index) in results" :key="index" class="data-list">{{ result.email }}</span>
                    </div>
                    <div class="data type">
                        <span class="data-title">Joined</span>
                        <span v-for="(result, index) in results" :key="index" class="data-list">{{ result.created_at }}</span>
                    </div>
                    <div class="data status">
                        <span class="data-title">Status</span>
                        <span v-for="(result, index) in results" :key="index" class="data-list">
                            <div class="buttons">
                                <a v-if="result.status == 1" :href="`/admin/users/status/update/${result.id}/0`" class="btn btn-danger">Block</a>
                                <a v-else :href="`/admin/users/status/update/${result.id}/1`" class="btn btn-success">Unblock</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="col-12 text-light" v-else>
                    <p>No Results Found</p>
                </div>
            </div>
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
                let url = this.searchQuery ? `users/search/${this.searchQuery}` : '/users';
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