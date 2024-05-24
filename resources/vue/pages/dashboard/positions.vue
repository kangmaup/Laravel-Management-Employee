<script>
  import apiClient from '../../services/api-client';
  import TopBar from "../../components/dashboard/topbar.vue";

  export default {
    name: 'Positions',
    components: {
      TopBar,
    },
    data() {
      return {
        positions: [],
        error: null,
      };
    },
    created() {
      this.fetchPositions();
    },
    methods: {
      async fetchPositions() {
        try {
          const response = await apiClient.get('/position');
          this.positions = response.data.data.positions;
          console.log(this.positions)
        } catch (error) {
          this.error = 'Gagal memuat data jabatan.';
        }
      }
    }
  };
  </script>
<template>
    <TopBar />
    <div class="container">
      <h1 class="uk-heading-divider">Data Jabatan</h1>
      <table class="uk-table uk-table-divider uk-table-hover">
        <thead>
          <tr>
            <th>Nama</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="position in positions" :key="position.id">
            <td>{{ position.name }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>


<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  padding-left: 15px;
  padding-right: 15px;
  text-align: center;
}

.uk-table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

.uk-table th,
.uk-table td {
  padding: 12px;
  text-align: left;
  border-bottom: 1px solid #e5e5e5;
}

.uk-table th {
  background-color: #f5f5f5;
  font-weight: bold;
}

.uk-table-hover tbody tr:hover {
  background-color: #f1f1f1;
}

.uk-table-middle tbody tr td {
  vertical-align: middle;
}

.uk-alert-danger {
  margin-top: 20px;
  padding: 15px;
  border: 1px solid #e5e5e5;
  background-color: #f8d7da;
  color: #721c24;
}
</style>
