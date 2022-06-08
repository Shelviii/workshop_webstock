<template>
  <v-toolbar color="surface">
    <v-spacer></v-spacer>

    <v-btn class="text-none" stacked @click="$router.push('/stock')">
        <v-icon @click="$router.push('/stock')">mdi-home-outline</v-icon>
    </v-btn>

    <v-btn class="text-none" stacked @click="$router.push('/report')">
        <v-icon @click="$router.push('/report')">mdi-chart-areaspline</v-icon>
    </v-btn>

      <v-avatar color="info" size="small">
      <v-icon icon="mdi-account-circle"></v-icon>
    </v-avatar>
      <span class="ml-3">Hello : {{this.username}}</span>
    <v-btn class="text-none" stacked @click="Logout()">
      <v-icon @click="Logout()">mdi-logout</v-icon>
    </v-btn>
    <v-spacer></v-spacer>
  </v-toolbar>
</template>

<script>
export default {
  name: "MenuBar",
  data() {
    return {
      username:""
    }
  },
  methods: {
    Logout() {
      localStorage.clear('username')
      this.$store.dispatch("doLogout");
      this.$router.push("/login");
      localStorage.clear('username')
    },
  },
  created() {
    let username = localStorage.getItem('username')
    this.username = username
  },
};
</script>

<style></style>
