<script>
export default {
    mounted() {
        const token = localStorage.getItem('token');
        console.log(token)
        if (!token) {
            this.$router.replace("/login");
        } else {
            this.$router.replace("/dashboard");
        }

    },
};
</script>
