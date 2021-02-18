<template>

    <form @submit.prevent="cadastrar">
        <div class="container ">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <br>
                    <!-- form imovel info -->
                    <div class="card card-outline-secondary">
                        <div class="card-header">
                            <h3 class="mb-0">Cadastro de Carro</h3>
                        </div>
                        <div class="card-body">
                          <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label">Marca</label>
                            <div class="col-lg-9">
                              <select v-model="form.marca" :class="{ 'is-invalid': form.errors.has('marca') }" name="marca" class="form-control" size="0">
                                <option v-for="(marca, index) in marcas"
                                        :key="index"
                                        :value="marca.id">{{marca.descricao}}
                                </option>
                              </select>
                              <has-error :form="form" field="marca"></has-error>
                            </div>
                          </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Modelo</label>
                                <div class="col-lg-9">
                                    <input v-model="form.modelo" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('modelo') }" name="marca">
                                    <has-error :form="form" field="modelo"></has-error>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Rua</label>
                                <div class="col-lg-9">
                                    <input v-model="form.ano" type="text" class="form-control" :class="{ 'is-invalid': form.errors.has('ano') }" name="ano">
                                    <has-error :form="form" field="ano"></has-error>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="submit" class="btn btn-primary" value="Salvar">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /form imovel info -->
                </div>
            </div>
            <!--/row-->
            <loading
                    :is-full-page="true"
                    :active.sync="isLoading">
            </loading>
        </div>
        <!--/container-->
    </form>
</template>

<script>
    import Loading from 'vue-loading-overlay';
    import 'vue-loading-overlay/dist/vue-loading.css';
    export default {

        data () {
            return {
                isLoading: false,
                fullPage: true,
                form: new Form({
                    remember: false
                })
            }
        },
        components: {
            Loading
        },
        methods: {
            async cadastrar() {
                this.isLoading=true,
                this.form.post('/api/imovel')
                    .then(( response ) => {
                        this.isLoading=false,
                        Swal.fire({
                            icon: 'success',
                            title: 'Salvo',
                            text: 'Imóvel cadastrado com sucesso!',
                        }).then((result) => {
                            this.loadImoveis();
                        });
                }).catch(resp => {
                    this.isLoading=false
                });
            },
            loadImoveis() {
                this.$router.push({name: 'imovel'});
            }
        }
    }
</script>

<style scoped>

</style>
