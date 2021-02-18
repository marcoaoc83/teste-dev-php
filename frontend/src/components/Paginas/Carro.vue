<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12">

          <div class="card card-block card-blue clearfix">
            <div class="card-header">
              <h3 class="card-title">Carros</h3>
              <div class="card-tools float-right">
                <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                  <i class="fa fa-plus-square"></i>Adicionar
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">

              <table class="table table-hover">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Marca</th>
                  <th>Modelo</th>
                  <th>Ano</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="carro in items.data" :key="carro.id">

                  <td>{{carro.id}}</td>
                  <td>{{carro.marca.descricao}}</td>
                  <td>{{carro.modelo}}</td>
                  <td>{{carro.ano}}</td>
                  <td>

                    <a href="#" @click="editModal(carro)">
                      <i class="btn btn-primary">Editar</i>
                    </a>
                    /
                    <a href="#" @click="deleteCarro(carro.id)">
                      <i class="btn btn-danger">Excluir</i>
                    </a>
                  </td>
                </tr>
                </tbody>
              </table>
            </div>

          </div>
          <!-- /.card -->
        </div>
      </div>

      <div>
        <b-modal ref="addNew" hide-footer :title="!editmode ? 'Novo Carro':'Editar Carro'">
            <form @submit.prevent="editmode ? updateCarro() : createCarro()">
              <div class="modal-body">
                <div class="form-group">

                  <label>Marca</label>
                  <select class="form-control" v-model="form.marca_id"  name="marca_id">
                    <option
                      v-for="(campo,index) in marcas" :key="index"
                      :value="campo.id"
                      :selected="campo.id == form.marca.id">{{ campo.descricao }}</option>
                  </select>
                  <has-error :form="form" field="marca_id"></has-error>
                </div>
                <div class="form-group">
                  <label>Modelo</label>
                  <input v-model="form.modelo" type="text" name="modelo"
                         class="form-control" :class="{ 'is-invalid': form.errors.has('modelo') }">
                  <has-error :form="form" field="modelo"></has-error>
                </div>
                <div class="form-group">
                  <label>Ano</label>
                  <input v-model="form.ano" type="text" name="ano"
                         class="form-control" :class="{ 'is-invalid': form.errors.has('ano') }">
                  <has-error :form="form" field="ano"></has-error>
                </div>
              </div>
              <div class="modal-footer">
                <button v-show="editmode" type="submit" class="btn btn-success">Editar</button>
                <button v-show="!editmode" type="submit" class="btn btn-primary">Criar</button>
              </div>
            </form>
        </b-modal>
      </div>

    </div>
  </section>
</template>

<script>


export default {
  data () {
    return {
      editmode: false,
      form: new Form({
        id : '',
        marca : '',
        marca_id : '',
        modelo: '',
        ano: ''
      }),
      marcas: [],
      items: []
    }
  },
  methods: {


    getResults(page = 1) {

      this.$Progress.start();

      axios.get(this.$API_URL+'api/carros?page=' + page).then(({ data }) => (this.carros = data.data));

      this.$Progress.finish();
    },
    loadCarros(){

      // if(this.$gate.isAdmin()){
      axios.get(this.$API_URL+"api/carros").then(({ data }) => (this.items = data.data));
      // }
    },
    loadMarcas(){
      axios.get(this.$API_URL+"api/marcas").then(({ data }) => (this.marcas = data.data));
    },

    editModal(carro){
      this.editmode = true;
      this.form.reset();
      this.$refs['addNew'].show()
      this.form.fill(carro);
    },
    newModal(){
      this.editmode = false;
      this.form.reset();
      this.$refs['addNew'].show()
    },
    createCarro(){
      this.$Progress.start();

      this.form.post(this.$API_URL+'api/carros')
        .then((data)=>{

          if(data.data.success){
            this.$refs['addNew'].hide()

            Toast.fire({
              icon: 'success',
              title: data.data.message
            });
            this.$Progress.finish();
            this.loadCarros();

          } else {
            console.log(data.data);
            this.$error_reponse=data.data.response.message;
            Toast.fire({
              icon: 'error',
              title: data.data.response.message
            });

            this.$Progress.failed();
          }
        })
        .catch(()=>{

          Toast.fire({
            icon: 'error',
            title: this.$error_reponse
          });
        })
    },
    updateCarro(){
      this.$Progress.start();
      this.form.put(this.$API_URL+'api/carros/'+this.form.id)
        .then((response) => {
          // success
          this.$refs['addNew'].hide()
          Toast.fire({
            icon: 'success',
            title: response.data.message
          });
          this.$Progress.finish();
          //  Fire.$emit('AfterCreate');

          this.loadCarros();
        })
        .catch(() => {
          this.$Progress.fail();
        });

    },
    deleteCarro(id){
      Swal.fire({
        title: 'Você tem certeza?',
        text: "Não será possivel reverter!",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim!'
      }).then((result) => {

        // Send request to the server
        if (result.value) {
          this.form.delete(this.$API_URL+'api/carros/'+id).then(()=>{
            Swal.fire(
              'Delete!',
              'Deletado com sucesso.',
              'success'
            );
            // Fire.$emit('AfterCreate');
            this.loadCarros();
          }).catch((data)=> {
            Swal.fire("Failed!", data.message, "warning");
          });
        }
      })
    },

  },
  mounted() {

  },
  created() {
    this.$Progress.start();

    this.loadCarros();
    this.loadMarcas();

    this.$Progress.finish();
  },
  filters: {
    truncate: function (text, length, suffix) {
      return text.substring(0, length) + suffix;
    },
  },
  computed: {
    filteredItems() {
      return this.autocompleteItems.filter(i => {
        return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
      });
    },
  },
}
</script>
