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

            <section v-if="data != null">
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
                  <tr v-for="phone in data" :key="phone.id">
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
            <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item">
                  <a class="page-link" href="#">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      data: null,
      countries: null,
      countryChoosed: "",
      state: "",
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  created() {
    this.fetchCountries();
    this.fetchData();
  },
  methods: {
    fetchData(params = null) {
      axios
        .get("/api/v1/phone-numbers", {
          params,
        })
        .then((res) => {
          this.data = res.data.data.data;
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
      };

      this.fetchData(params);
    },

    resetData() {
      this.countryChoosed = "";
      this.state = "";

      this.fetchData();
    },
  },
};
</script>
