<template>
    <div class="container">
        <button class="btn allBtn ms-3" @click="followUser" v-text="buttonText"></button>
    </div>
</template>

<script>
export default {
    props: ['userId', 'follows'],

    data() {
        return {
            status: this.follows,
        };
    },

    methods: {
        followUser() {
            axios.post('/follow/' + this.userId)
                .then(response => {
                    this.status = !this.status;
                    this.$emit('update-follow-status', { userId: this.userId, follows: this.status });
                })
                .catch(errors => {
                    if (errors.response.status === 401) {
                        window.location = '/login';
                    }
                });
        }
    },

    computed: {
        buttonText() {
            return this.status ? 'Unfollow' : 'Follow';
        }
    },

    watch: {
        follows(newVal) {
            this.status = newVal;
        }
    }
};
</script>
