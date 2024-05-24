<script>
  import apiClient from '../../services/api-client';
  import TopBar from "../../components/dashboard/topbar.vue";

  export default {
    name: 'Employees',
    components: {
        TopBar,
    },
    data() {
      return {
        employees: [],
        error: null,
      };
    },
    created() {
      this.fetchEmployees();
    },
    methods: {
      async fetchEmployees() {
        try {
          const response = await apiClient.get('/employees');
          this.employees = response.data.data.employees;
          console.log( this.employees.data.employees)
        } catch (error) {
          this.error = 'Gagal memuat data karyawan.';
        }
      }
    }
  };
  </script>

<template>
    <TopBar />
    <div class="container">
      <h1 class="uk-heading-divider">Data Karyawan</h1>
      <table class="uk-table uk-table-divider uk-table-hover">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jabatan</th>
            <th>Tempat Kerja</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="employee in employees" :key="employee.id">
            <td>{{ employee.name }}</td>
            <td>{{ employee.position }}</td>
            <td>{{ employee.workplace }}</td>
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
