<template>
  <v-card class="mx-auto mt-10" max-width="344">
    <v-img
      src="https://cdn.vuetifyjs.com/images/cards/sunshine.jpg"
      height="200px"
      cover
    ></v-img>

    <v-card-title> Register </v-card-title>

    <v-container grid-list-xs>
      <v-form>
        <v-text-field
          type="text"
          label="Username"
          v-model="this.register.username"
        ></v-text-field>
        <v-text-field
          type="password"
          label="Password"
          v-model="this.register.password"
        ></v-text-field>
        <div class="d-flex justify-space-between">
          <v-btn color="error" rounded @click="this.$router.push('/login')">
            cancle
          </v-btn>
          <v-btn color="success" rounded @click="Register()"> register </v-btn>
        </div>
      </v-form>
    </v-container>
  </v-card>
</template>

<script>
import axios from "axios";

export default {
  name: "RegisTer",
  data() {
    return {
      register: {
        username: "",
        password: "",
      },
    };
  },
  methods: {
    Register() {
        if(this.register.username != "" && this.register.password !=""){
            axios.post('http://localhost/api_authen.php',{
            action:"register",
            username: this.register.username,
            password: this.register.password
        }).then(res => {
            if(res.data == "duplicate")
            {
                alert("Username or password duplicate")
            }else{
                alert("Successful registration")
                this.register.username =""
                this.register.password=""
                this.$router.push('/login')
            }
        })
        }else{
            alert("Please insert data")
        }
        
    },
  },
};
</script>

<style></style>
