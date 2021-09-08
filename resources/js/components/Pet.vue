<template>
    <div>
        <h1 class="text-center">Lista de Pets</h1>
        <hr>
        <!-- Button trigger modal -->
        <button @click="update=false; openModal();" type="button" class="btn btn-primary">
            Cadastrar Pet
        </button>
        <br>
        <br>
        <!-- Modal -->
        <div class="modal" :class="{show:modal}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ titleModal }}</h5>
                    <button @click="closeModal();" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="name">Nome do Pet</label>
                        <input v-model="pet.name" type="text" class="form-control" id="name" placeholder="Insira o nome do Pet">
                    </div>
                    <div>
                        <label for="age">Idade do Pet</label>
                        <input v-model="pet.age" type="text" class="form-control" id="age" placeholder="Insira a idade do Pet">
                    </div>
                    <div>
                        <label for="category">Categoria</label>
                        <select v-model="pet.category" class="form-control" id="category" >
                            <option disabled selected>Selecione a categoria</option>
                            <option value="Gato">Gato</option>
                            <option value="Cachorro">Cachorro</option>
                        </select>
                    </div>
                    <div>
                        <label for="breed">Raça do Pet</label>
                        <input v-model="pet.breed" type="text" class="form-control" id="breed" placeholder="Insira a raça do Pet">
                    </div>
                    <div>
                        <label for="owner_name">Nome do Dono</label>
                        <input v-model="pet.owner_name" type="text" class="form-control" id="owner_name" placeholder="Insira o nome do Dono">
                    </div>
                    <div>
                        <label for="owner_phone">Telefone</label>
                        <input v-model="pet.owner_phone" type="text" class="form-control" id="owner_phone" placeholder="Insira o telefone do Dono">
                    </div>
                </div>
                <div class="modal-footer">
                    <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button @click="salvar();" type="button" class="btn btn-success">Salvar</button>
                </div>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                <th scope="col">Id</th>
                <th scope="col">Nome</th>
                <th scope="col">Idade</th>
                <th scope="col">Categoria</th>
                <th scope="col">Raça</th>
                <th scope="col">Nome do Dono</th>
                <th scope="col">Telefone</th>
                <th scope="col" colspan="2" class="text-center">Ações</th>
                </tr>
            </thead>
        <tbody>
            <tr v-for="pet in pets" :key="pet.id">
                <th scope="row">{{ pet.id }}</th>
                <td>{{ pet.name }}</td>
                <td>{{ pet.age }}</td>
                <td>{{ pet.category }}</td>
                <td>{{ pet.breed }}</td>
                <td>{{ pet.owner_name }}</td>
                <td>{{ pet.owner_phone }}</td>
                <td>
                    <button @click="update=true; openModal(pet);" class="btn btn-warning">Editar</button>
                </td>
                <td>
                    <button @click="excluir(pet.id)" class="btn btn-danger">Excluir</button>
                </td>
            </tr>
        </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data () {
        return {
            pet: {
                name:'',
                age:'',
                category:'',
                breed:'',
                owner_name:'',
                owner_phone:'',
            },

            id:0,
            update: true,
            modal: 0,
            titleModal: ' ',
            pets: [],
        }
    },
    methods: {
        async listar() {
            const res = await axios.get('pets');

            this.pets = res.data;
        },
        async excluir(id) {
            const res = await axios.delete('/pets/' +id);

            this.listar();
        },
        async salvar() {
            if (this.update) {
                const res = await axios.put('/pets/' + this.id, this.pet);
            }else{
                const res = await axios.post('/pets', this.pet);
            }
            this.closeModal();
            this.listar();
        },
        async openModal(data={}) {
            this.modal=1;
            if (this.update) {
                this.id = data.id;
                this.titleModal ="Atualizar Pet";
                this.pet.name = data.name;
                this.pet.age = data.age;
                this.pet.category = data.category;
                this.pet.breed = data.breed;
                this.pet.owner_name = data.owner_name;
                this.pet.owner_phone = data.owner_phone;
            }else{
                this.titleModal = "Cadastrar Pet";
                this.id = 0;
                this.pet.name = '';
                this.pet.age = '';
                this.pet.category = 'Selecione a categoria';
                this.pet.breed = '';
                this.pet.owner_name = '';
                this.pet.owner_phone = '';
            }
        },
        async closeModal() {
            this.modal=0;
        },
    },
    created() {
        this.listar ();
    },
}
</script>

<style>
.show {
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
}
</style>