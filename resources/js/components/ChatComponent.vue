<template>
    <div class="row">
        <div class="col-8">
            <div class="card card-default">
                <div class="card-header text-center bg-dark text-white"> Сообщения</div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                        <li class="p-2 mt-1 mr-1 ml-1" v-for="(message, index) in messages" :key="index" :class="bgcolor(message.user.id)">
                            {{ message.message }}
                            <small class="badge float-right" :class="badgecolor(message.user.id)">{{  message.user.name }}</small>  
                        </li>
                    </ul>
                </div>


                <input
                    @keydown="typing"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    placeholder="Написать сообщение..."
                    class="form-control">
            </div>
            <span v-if="activePeer" v-text="activePeer.name + ' пишет...'"></span>
        </div>

         <div class="col-4">
            <div class="card card-default">
                <div class="card-header text-center bg-dark text-white">Пользователи в чате: <span class="badge badge-pill badge-danger">{{numberOfUsers}}</span></div>
                <div class="card-body">
                    <ul>
                        <li v-for="(participant, index) in participants" :key="index">
                            {{participant.name}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>


        <div class="col-md-12 mt-4">
            <div class="text-center"><h1>Все Предложения</h1></div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th v-for="index in table.header" :key="index">{{index}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(body,index) in table.body" :key="index">
                        <td>{{body.name}}</td>
                        <td v-show="index<table.body.length" v-for="(value, index) in body" :key="index">{{value}} тг.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
    export default {
        props:[
            'order',
            'user',
        ],
        data() {
            return {
                messages: [],
                newMessage: '',
                users:[],
                activePeer: false,
                numberOfUsers: '',
                participants:[],
                table:{
                    header: [],
                    body: [],
                }
            }
        },
        methods: {
            sendMessage() {
                this.messages.push({
                    user: this.user,
                    message: this.newMessage
                });
                axios.post('../chat/send', {
                    message: this.newMessage,
                    order: this.order,
                });
                this.newMessage = '';
            },
            fetchMessages() {
                axios.post('../chat/messages', {
                    order: this.order
                }).then(response => {
                    this.messages = response.data;
                });
            },
            typing(){
                this.channel
                .whisper('typing', {
                    name: this.user.name
                });
            },
            flashTyping(e){
                this.activePeer = e;

                setTimeout(()=>{
                    this.activePeer = false;
                }, 3000);
            },
            // Методы для таблицы
            fetchHeader(){
                axios.get('../chat/header/'+this.order).then((response) => {
                    this.table.header=response.data;                 
                })
            },
            fetchBody(){
                axios.get('../chat/bid/'+this.order).then((response) => {
                    this.table.body=response.data;     
                    console.log(response.data);           
                })
            },
            badgecolor: function(id){
                if(id == this.user.id){
                    return 'badge-success';
                }else{
                    return 'badge-danger';
                }
            },
            bgcolor: function(id){
                if(id == this.user.id){
                    return 'list-group-item-success';
                }else{
                    return 'list-group-item-warning';
                }
            }
        },
        created(){
            this.fetchMessages();
            this.fetchHeader();
            this.fetchBody();
            this.channel
            .here(user => {
                this.users = user;
                this.participants = user;
                this.numberOfUsers = user.length;
            })
            .joining(user => {
                this.users.push(user);
                this.numberOfUsers += 1;
                this.$toaster.success(user.name + ' вошел в чат');
                this.participants.push(user);
            })
            .leaving(user => {
                this.users = this.users.filter(u => u.id != user.id);
                this.numberOfUsers -= 1;
                this.$toaster.error(user.name + ' покинул чат');
                this.participants.splice(this.participants.indexOf(user), 1);
            })
            .listen('ChatEvent',(e) => {
                this.messages.push(e.message);
                this.fetchBody();
            })
            .listenForWhisper('typing', this.flashTyping)
        },
        computed:{
            channel(){
                return Echo.join('chat.'+this.order)
            },
        }
    }
</script>