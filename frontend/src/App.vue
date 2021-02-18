<template>
  <div id="app">
    <div class="hello">
      <h1>{{ msg }}</h1>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <router-link to="/"  class="btn btn-dark ml-auto" style="align-items: center">
                <i class="fa fa-plus-circle"></i> Home
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="carros"  class="btn btn-success ml-auto" style="align-items: center">
                <i class="fa fa-plus-circle"></i> Carros
              </router-link>
            </li>
          </ul>

        </div>
      </nav>
    </div>
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  data () {
    return {
      msg: ''
    }
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 5px;
}
</style>
