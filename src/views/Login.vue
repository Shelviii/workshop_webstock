<template>
  <v-card class="mx-auto mt-10" max-width="344">
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
      cover
    ></v-img>

    <v-card-title> Login </v-card-title>

    <v-container grid-list-xs>
      <v-form>
        <v-text-field
          type="text"
          label="Username"
          v-model.trim="this.account.username"
        ></v-text-field>
        <v-text-field
          type="password"
          label="Password"
          v-model.trim="this.account.password"
          @keyup.enter="Login()"
        ></v-text-field>
        <div class="d-flex justify-space-between">
          <v-btn color="info" rounded @click="this.$router.push('/register')">
            register
          </v-btn>
          <v-btn color="success" rounded @click="Login()"> login </v-btn>
        </div>
      </v-form>
    </v-container>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  name: "Login",
  data() {
    return {
      account: {
        username: "",
        password: "",
      },
    };
  },
  methods: {
    Login() {
      if (this.account.username != "" && this.account.password != "") {
        axios
          .post("http://localhost/api_authen.php", {
            action: "login",
            username: this.account.username,
            password: this.account.password,
          })
          .then((res) => {
            if (res.data != "Fail") {
              this.$router.push("/stock");
             localStorage.setItem('username', res.data)
            } else {
              alert("Username or password incorrect")
            }
          });
      } else {
        alert("Please insert username and password");
      }
    },
  },
};
</script>

<style></style>
