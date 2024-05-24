<script>
export default {
  methods: {
    logout() {

      localStorage.removeItem('token');
      localStorage.removeItem('user');
      this.$router.push('/login');
    }
  }
};
</script>

<template>
    <nav class="uk-navbar-container">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#">Admin HR</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li>
                                        <a href="/employees">Data Karyawan</a>
                                    </li>
                                    <li>
                                        <a href="/positions">Data Jabatan</a>
                                    </li>
                                    <li><a href="/workplace">Data Tempat Kerja</a></li>
                                    <li><a href="/roles">Data Roles</a></li>
                                    <li><a href="/permissions">Data Permission</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">Karyawan</a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <button class="uk-button uk-button-danger" @click="logout">Logout</button>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>


<style scoped>
.uk-navbar-container {
    background-color: #1e87f0; /* Warna biru */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan */
}
</style>
