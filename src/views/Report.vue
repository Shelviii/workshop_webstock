<template>
  <Menubar />
  <v-container grid-list-xs>
      <v-row>
          <v-col cols="12" class="d-flex justify-center">
             <Barchart/>  
          </v-col>
      </v-row>
     
  </v-container>
  
</template>

<script>
import Menubar from '../components/Menubar.vue'
import Barchart from '../components/Barchart.vue'

export default {
    name : "MenuBar",
    components:{
        Menubar,
        Barchart
        },
       
}
</script>

<style></style>
