<template>
<Menubar/>
  <v-container>
    <v-row>
      <v-col>
        <div class="d-flex justify-end align-center mb-3">
          <v-btn color="success" @click="ToggleAdd()"> + add </v-btn>
        </div>

        <v-form v-if="addToggle">
          <v-text-field
            label="Name of product"
            v-model.trim="this.data_field.product_name"
          ></v-text-field>
          <v-text-field
            label="Price of product"
            v-model.number="this.data_field.product_price"
            type="number"
          ></v-text-field>
          <v-text-field
            label="Stock of product"
            v-model.number="this.data_field.product_stock"
            type="number"
          ></v-text-field>
          <v-btn
            color="success"
            @click="submit()"
            v-model="this.data_field.statusBtn"
            >Save</v-btn
          >
          <v-btn @click="Cancle()" class="ma-4" color="error">Cancle</v-btn>
        </v-form>

        <v-table>
          <thead>
            <tr>
              <th class="text-left">ID</th>
              <th class="text-left">Name</th>
              <th class="text-left">Price</th>
              <th class="text-left">Stock</th>
              <th class="text-left">Edit bar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="item in data_field" :key="item.id">
              <td>{{ item.id }}</td>
              <td>{{ item.name_item }}</td>
              <td>{{ item.price_item }} <span style="color: green">฿</span></td>
              <td>
                {{ item.stock_item }} <span style="color: brown">pcs.</span>
              </td>
              <td class="">
                <v-icon class="icon edit" @click="EditItem(item.id)"
                  >mdi-pencil</v-icon
                >
                <v-icon class="icon del" @click="DelItem(item.id)"
                  >mdi-delete</v-icon
                >
              </td>
            </tr>
          </tbody>
        </v-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";
import Menubar from '../components/Menubar.vue'

export default {
  name: "HomePage",
  components:{
    Menubar
  },
  data() {
    return {
      addToggle: false,
      data_field: {
        id: "",
        product_name: "",
        product_price: "",
        product_stock: "",
        statusBtn: "Insert",
        serach: "",
        showuser:""
      },
    };
  },
  created() {
    this.ShowData();
  },
  methods: {
    ToggleAdd() {
      this.addToggle = !this.addToggle;
      this.data_field.statusBtn = "Insert";
      this.data_field.product_name = "";
      this.data_field.product_price = "";
      this.data_field.product_stock = "";
    },
    Cancle() {
      this.addToggle = !this.addToggle;
      this.data_field.product_name = "";
      this.data_field.product_price = "";
      this.data_field.product_stock = "";
    },
    ShowData() {
      axios
        .post("http://localhost/api.php", {
          action: "getdata",
        })
        .then((res) => {
          this.data_field = res.data;
        });
    },
    submit() {
      if (
        this.data_field.product_name != "" &&
        this.data_field.product_price != "" &&
        this.data_field.product_stock != ""
      ) {
        if (this.data_field.statusBtn == "Insert") {
          axios
            .post("http://localhost/api.php", {
              action: "insertdata",
              product_name: this.data_field.product_name,
              product_price: this.data_field.product_price,
              product_stock: this.data_field.product_stock,
            })
            .then((res) => {
              alert("Add item successful");
              window.location.reload();
            });
        }
        if (this.data_field.statusBtn == "Update") {
          axios
            .post("http://localhost/api.php", {
              action: "updatedata",
              product_name: this.data_field.product_name,
              product_price: this.data_field.product_price,
              product_stock: this.data_field.product_stock,
              id: this.data_field.id,
            })
            .then((res) => {
              alert("This item updated");
              window.location.reload();
            });
        }
      } else {
        alert("Please input data on text fields");
      }
    },
    EditItem(id) {
      axios
        .post("http://localhost/api.php", {
          action: "edit",
          id: id,
        })
        .then((res) => {
          this.data_field.product_name = res.data.product_name;
          this.data_field.product_price = res.data.product_price;
          this.data_field.product_stock = res.data.product_stock;
          this.data_field.id = res.data.id;
          this.addToggle = true;
          window.scrollTo(0, 0);
          this.data_field.statusBtn = "Update";
        });
    },
    DelItem(id) {
      if (confirm("Are you sure delete this data ?")) {
        axios
          .post("http://localhost/api.php", {
            action: "deldata",
            id: id,
          })
          .then((res) => {
            this.ShowData();
            alert(res.data.message);
          });
      }
    },
  },
};
</script>

<style>
.icon {
  cursor: pointer;
  margin: 2px;
}
.icon.edit:hover {
  color: green;
}
.icon.del:hover {
  color: red;
}
</style>
