<template>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          <div class="card-header">Phone Numbers</div>

          <div class="card-body">
            <section class="mb-4 row">
              <div class="col-md-3">
                <select
                  class="form-select"
                  aria-label="Default select example"
                  v-model="countryChoosed"
                  @change="applyFilter"
                >
                  <option disabled value>Select Country</option>
                  <option
                    v-for="(countryCode, countryName, index) in countries"
                    :key="index"
                    :value="countryName"
                  >
                    {{ countryName }}
                  </option>
                </select>
              </div>
              <div class="col-md-3">
                <select
                  class="form-select"
                  aria-label="Default select example"
                  v-model="state"
                  @change="applyFilter"
                >
                  <option disabled value>Valid Phone Numbers</option>
                  <option value="OK">Valid</option>
                  <option value="NOK">Not Valid</option>
                </select>
              </div>
              <div class="col-md-3">
                <button
                  type="reset"
                  class="btn btn-danger btn-sm"
                  @click="resetData"
                >
                  Reset
                </button>
              </div>
            </section>

            <section v-if="items != null">
              <table class="table table-striped table-hover table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">Country Code</th>
                    <th scope="col">Phone Number</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="phone in items" :key="phone.id">
                    <th>{{ phone.country }}</th>
                    <th>{{ phone.state }}</th>
                    <th>{{ phone.country_code }}</th>
                    <th>{{ phone.phone }}</th>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>

          <div class="card-footer">
            <pagination
              v-model="current_page"
              :records="total"
              :per-page="per_page"
              :options="options"
              @paginate="callbackPagination"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Pagination from "vue-pagination-2";
export default {
  components: {
    Pagination,
  },
  data() {
    return {
      items: null,
      countries: null,
      countryChoosed: "",
      state: "",
      current_page: 1,
      total: 0,
      per_page: 10,
      options: {
          theme: 'bootstrap4',
          edgeNavigation: true,
          texts: {
              count: "Showing page {page} out of {pages}"
          }
      }
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.fetchCountries();
    this.fetchData({perPage: this.per_page});
  },
  methods: {
    fetchData(params = null) {
      axios
        .get("/api/v1/phone-numbers", {
          params,
        })
        .then((res) => {
          this.items = res.data.data.data;
          this.total = res.data.data.total;
          this.per_page = Number(res.data.data.per_page);
          this.current_page = res.data.data.current_page;
          this.last_page = res.data.data.last_page;
        })
        .catch((err) => {
          alert("Error Happened");
        });
    },

    fetchCountries() {
      axios
        .get("/api/v1/countries-list")
        .then((res) => {
          this.countries = res.data.data;
        })
        .catch((err) => {
          alert("Error Happened");
        });
    },

    applyFilter() {
      const params = {
        country: this.countryChoosed,
        state: this.state,
        perPage: this.per_page
      };

      this.fetchData(params);
    },

    resetData() {
      this.countryChoosed = "";
      this.state = "";

      this.fetchData();
    },

    callbackPagination(page) {
      this.current_page = page;
      const params = {
        country: this.countryChoosed,
        state: this.state,
        page,
        perPage: this.per_page
      };

      this.fetchData(params);
    },
  },
};
</script>
