<!DOCTYPE html>
<html>
<head>
    <title>My first Vue app</title>
    <script src="https://unpkg.com/vue"></script>

</head>
<body>

<div id="appSlot">
    <h1>Slot</h1>
    <my-slot pname="koma">your video is not good</my-slot>
    <my-slot pname="sam"> du sollst nicht so machen wie koma</my-slot>
    <my-slot pname="wenjun">Zeigen die, wie man macht</my-slot>

</div>

<script>
    Vue.component('my-slot', {
        props:['pname'],
        template: '<div><strong>Hello {{pname}}, </strong>' +
        '<slot />'+
        '</div>',

    });
    var appSlot = new Vue({
        el: '#appSlot',
    })
</script>




<div id="appAddEvent">
    <h1>Add</h1>
    <my-add :a="6" :b="12" v-on:a_event="getAddResult"></my-add>
    <h2>Result : {{result}}</h2>
</div>

<script>
    Vue.component('my-add', {
        props:['a','b'],
        template: '<div><button v-on:click="add">add something</button></div>',
        methods: {
            add: function () {
                var value=0
                value=this.a+this.b;
                this.$emit('a_event',{
                    pResult:value
                })

            }
        }
    });
    var appAddEvent = new Vue({
        el: '#appAddEvent',
        data:{
            result:0
        },
        methods: {
            getAddResult: function (pVal) {
                this.result = pVal.pResult
            }
        }

    })
</script>


<div id="appMemberInfo">
    <h1>Member Info:</h1>
    <member-info myname="sam" :age="51" :detail="{address:'japan', language:'japanisch'}"></member-info>
</div>

<script>
    Vue.component('member-info', {
        props:{
            myname:{
                type:String,
                required:true
            },
            age:{
                type:Number,
                validator:function(value){
                    return value>0 && value<130
                }
            },
            detail: {
                type: Object,
                default: function () {
                    return {
                        address:"china",
                        language:'chinese'
                    }
                }
            }
        },
        template: '<div><strong>Name: {{this.myname}}<br />Age: {{this.age}}<br />Address {{this.detail.address}}<br />Language {{this.detail.language}}</strong></div>',
    });
    var appMemberInfo = new Vue({
        el: '#appMemberInfo',
        data:{
        }

    })
</script>


<div id="appCompVar">
    <p>say hello</p>
    <div>bitte geben sie den Namen ein: <input id="name" type="text" v-model.trim="myname"></div>
    <say-hello :pname="myname"></say-hello>
</div>

<script>
    Vue.component('say-hello', {
        props:['pname'],
        template: '<div><strong>Hllo, {{pname}}!</strong></div>',

    });
    var appCompVar = new Vue({
        el: '#appCompVar',
        data:{
            myname:'wli'
        }

    })
</script>


<div id="appCompScore">
    <p>Comp mit Score</p>
    <test-result :score="50"></test-result>
    <test-result :score="65"></test-result>
    <test-result :score="80"></test-result>
    <test-result :score="100"></test-result>
</div>

<script>
    Vue.component('test-result', {
        props:['score'],
        template: '<div><strong>{{score}} =>{{testResult}}</strong></div>',
        computed: {
           testResult: function(){
               var strResult
               if(this.score<60) strResult='nicht ausreichend'
               else if(this.score<80) strResult='befriedigend'
               else if(this.score<90) strResult='gut'
               else if(this.score<=100) strResult='excelent'

               return strResult
            }
        }

    });
    var appCompScore = new Vue({
        el: '#appCompScore'

    })
</script>



<div id="appCompData">
    <p>Comp mit Data</p>
    <wetter-comp/>
</div>

<script>
    Vue.component('wetter-comp', {
        template: '<div><strong>{{todaywetter}}</strong></div>',
        data:function(){
             return { todaywetter:'es schneit'}
        }
    });
    var appCompData = new Vue({
        el: '#appCompData'

    })
</script>


<div id="appTableComp">
    <table border ="1">
        <tr><td>Num.</td><td>Name</td></tr>
        <tr is="t-row1"></tr>
        <tr is="t-row2"></tr>
        <tr is="t-row3"></tr>
    </table>
</div>

<script>
    Vue.component('t-row1',{
        template:'<tr><td>1</td><td>game 1</td></tr>'
        })
    Vue.component('t-row2',{
        template:'<tr><td>2</td><td>game 2</td></tr>'
        })
    Vue.component('t-row3',{
        template:'<tr><td>3</td><td>game 3</td></tr>'
    })

    var appTableComp = new Vue({
        el: '#appTableComp',
        data: {

        }
    })
</script>



<div id="appLocalComp">
    <my-wetter></my-wetter>
</div>

<script>
    var WetterComponent={
        template: '<div>heute regnet es wieder, es ist egal</div>'
    };

    var appComp = new Vue({
        el: '#appLocalComp',
        data: {

        },
        components: {
            'my-wetter':WetterComponent
        }
    })
</script>





<div id="appComp">
    <today-wetter></today-wetter>
</div>

<script>
    Vue.component("today-wetter",{
    template: '<div>heute regnet es wieder, deshalb bleibe zuhause</div>'
    })

    var appComp = new Vue({
        el: '#appComp'


    })
</script>




<div id="appShowFullname">
    <p>Name</p>
    <label for="vorname">Vorname</label>
    <input type="text" v-model.trim="vorname" id="vorname">
    <br />
    <label for="nachname">Nachname</label>
    <input type="text" v-model.trim="nachname" id="nachname">
    <br />

    fullname: {{fullname}}
    <hr>
</div>

<script>
    var appShowFullname = new Vue({
        el: '#appShowFullname',
        data: {
            vorname: "",
            nachname: "",

        },
        computed: {
            fullname: function () {
                return this.vorname + ' ' + this.nachname
            }
        }

    })
</script>



<div id="appRegister">
    <p>Register</p>

    <label for="username">Username</label>
    <input type="text" id="username" v-model.lazy="username" @change="checkUsername">
    <span v-if="usernameOK">kann registeriert werden</span>
    <br />
    <label for="age">Age</label>
    <input type="number" id="age" v-model.number="age">
    <br />
    <label for="content">Content</label>
    <textarea id="content" cols="55" rows="8" v-model.trim="content"></textarea>
    <br />



    username: {{username}}
    <br />
    age: {{age}}
    <br />
    content: {{content}}
    <hr>
</div>

<script>
    var appRegister = new Vue({
        el: '#appRegister',
        data: {
            username: "",
            usernameOK: false,
            age:"",
            content:"",
        },
        methods:{
            checkUsername: function () {
                this.usernameOK = (this.username.length>0) ? true: false
            }}

    })
</script>



<div id="appSelects">
    <p>Selects</p>

    <label for="select1"> games</label>

    <select id="select1" v-model="selectgames">
    <option>game1</option>
        <option>game2</option>
        <option>game3</option>
        <option>game4</option>
        <option>game5</option>
    </select>
    <br />

    <label for="select2"> names</label>

    <select id="select2" multiple v-model="selectnames">
        <option>name1</option>
        <option>name2</option>
        <option>name3</option>
        <option>name4</option>
        <option>name5</option>
    </select>
    <br />


    your selections is {{selectgames}}
    <br />
     your selections is {{selectnames}}

    <hr>
</div>

<script>
    var appSelects = new Vue({
        el: '#appSelects',
        data: {
            selectgames: "",
            selectnames: [],

        }
    })
</script>



<div id="appRadio">
    <p>radios</p>

    <input id="radio1" type="radio" value="game 1" v-model="radiogames">
    <label for="radio1"> game 1</label>
    <input id="radio2" type="radio" value="game 2" v-model="radiogames">
    <label for="radio2"> game 2</label>
    <br />

    <input id="radio3" type="radio" value="man" v-model="gender">
    <label for="radio3"> man</label>
    <input id="radio4" type="radio" value="frau" v-model="gender">
    <label for="radio4"> frau</label>
    <br />

    your selections is {{radiogames}}
    <br />
    your selections is {{gender}}

    <hr>
</div>

<script>
    var appRadio = new Vue({
        el: '#appRadio',
        data: {
            radiogames: "",
            gender:""

        }
    })
</script>


<div id="appCheckbox">
    <p>Checkbox</p>

    <input id="check1" type="checkbox" value="game 1" v-model="checkedgames">
    <label for="check1"> game 1</label>
    <input id="check2" type="checkbox" value="game 2" v-model="checkedgames">
    <label for="check2"> game 2</label>
    <input id="check3" type="checkbox" value="game 3" v-model="checkedgames">
    <label for="check3"> game 3</label>

    your selections is {{checkedgames}}
    <hr>
</div>

<script>
    var appCheckbox = new Vue({
        el: '#appCheckbox',
        data: {
            checkedgames: []
        }
    })
</script>


<div id="appModel1">
    <p>Model</p>
    <input id="txtName" v-model="message" placeholder="schreib was">
    <p>Message is: {{message}}</p>
    <hr>
</div>

<script>
    var appModel = new Vue({
        el: '#appModel1',
        data: {
            message: 'das bin ich'
        }
    })
</script>


<div id="appEvent">
    <p>show Events</p>
    <input id="txtName" @keyup="txtKeyUp($event)">
    <button id="btnOk" @click="btnClick($event)">OK</button>
    <p>
</div>

<script>
    var appEvent = new Vue({
        el: '#appEvent',
        data: {},
        methods: {
            txtKeyUp: function (e) {
                this.debugLog(e)
            },
            btnClick: function (e) {
                this.debugLog(e)
            },
            debugLog: function (e) {
                console.log(
                    e.srcElement.tagName,
                    e.srcElement.id,
                    e.srcElement.innerHTML,
                    e.key ? e.key : ""
                )
            }
        }
    })
</script>


<div id="app">
    <input type="text" name="" value="" placeholder="Vue wurde geschrieben von ..." v-model="message">
    <hr>
    {{ message }}
</div>
<div id="app2" v-bind:title="messagetooltip">
    hier kommt tooltip
</div>

<div id="appSeeMe">
    <p v-if="seeMe">hast du mich gesehen?</p>
</div>

<div id="appFor">
    <ol>
        <li v-for="todo in todos">{{todo.aufgabe}}</li>
    </ol>
</div>

<div id="appButton">
    <p>{{message}}</p>
    <button v-on:click="reverseMessage">reverse Message</button>
</div>

<div id="appModel">
    <p>{{message}}</p>
    <input v-model="message">
</div>


<div id="app7">
    <ol>
        <!--
          现在我们为每个 todo-item 提供 todo 对象
          todo 对象是变量，即其内容可以是动态的。
          我们也需要为每个组件提供一个“key”，晚些时候我们会做个解释。
        -->
        <todo-item
                v-for="element in groceryList"
                v-bind:todo_p="element"
                v-bind:key="'gemuese_'+element.id">
        </todo-item>
    </ol>
</div>

<div id="app8">
    <button v-bind:disabled="isButtonDisabled">Button is not disabled</button>
</div>

<div id="AppExample">
    <p>Original message: "{{ message }}"</p>
    <p>Computed reversed message: "{{ reversedMessage }}"</p>
    <p>function reversed message: "{{ reversedMessage_1() }}"</p>
    <button @click="reverseM">click to reverse the message</button>
</div>


<div id="component-example">
    <my-component></my-component>
    <my-component></my-component>
    <my-component></my-component>
</div>

<div id="component-example2">
    <my-component2 mymessage='hello oooo component'></my-component2>
    <my-component2 mymessage='hello wenjun 22222'></my-component2>

</div>

<div id="filterApp">
    <p>{{message}}</p>
    <p>{{message | toupper }}</p>
    <p>{{message | tolower }}</p>
    <p>Ich habe bis jetzt nur {{num}} -> {{num | topercentage }} von Vue gelernt.</p>
</div>

<div id="appComputed">
    <p>Netto: {{pricenetto}}</p>
    <p>MwSt %: {{mwstInProzent}}</p>
    <p>{{priceMwSt}}</p>
    <p>Brutto: {{pricebrutto}}</p>
</div>


<div id="appFor2">
    <ul>
        <li v-for="(value, key) in mygame">{{key}}: {{value}}</li>
    </ul>
</div>

<script>
    var appFor2 = new Vue({
        el: '#appFor2',
        data: {
            mygame: {
                name: 'spiele 1',
                price: 200,
                publicday: '2017-11-25',
                kategorie: 'spass'

            }
        }
    })
</script>


<div id="appFor1">
    <ul>
        <li v-for="(game, index) in games">{{index+1}}: {{game.title}} kostet {{game.price}} Euro</li>
    </ul>
</div>

<script>
    var appFor1 = new Vue({
        el: '#appFor1',
        data: {
            games: [
                {title: 'spiele 1', price: 200},
                {title: 'spiele 2', price: 300},
                {title: 'spiele 3', price: 500},
            ]
        }
    })
</script>


<script>
    var appComputed = new Vue({
        el: '#appComputed',
        data: {
            pricenetto: 25698,
            mwstInProzent: 0.19
        },
        computed: {
            pricebrutto: function () {
                return this.pricenetto * (this.mwstInProzent + 1)
            },

            priceMwSt: function () {
                return this.pricenetto * this.mwstInProzent
            }
        }
    })
</script>


<script>
    var appfilterApp = new Vue({
        el: '#filterApp',
        data: {
            message: 'Hello Vue',
            num: 0.4
        },
        filters: {
            toupper: function (val) {
                return val.toUpperCase()
            },
            tolower: function (val) {
                return val.toLowerCase()
            },
            topercentage: function (val) {
                return val * 100 + '%'
            }
        }
    })
</script>

<script>
    Vue.component('my-component2', {
            props: ["mymessage"],
            template: "<div><button>{{ mymessage }}</button></div>"
        }
    )
    var app11 = new Vue({
        el: '#component-example2'


    })
</script>


<script>
    var data = {counter: 0}
    Vue.component('my-component', {
            template: '<button v-on:click="counter += 1">{{ counter }}</button>',
            data: function () {
                return data
            }
        }
    )
    var app10 = new Vue({
        el: '#component-example'


    })
</script>


<script>
    var app9 = new Vue({
        el: '#AppExample',
        data: {
            message: 'Vue wurde geschrieben von ...'
        },
        computed: {
            reversedMessage: function () {
                return this.message.split('').reverse().join('')
            }
        },
        methods: {
            reverseM: function () {
                this.message = this.message.split('').reverse().join('')
                //return this.message;
            },
            reversedMessage_1: function () {
                return this.message.split('').reverse().join('')
            }
        }
    })
</script>

<script>
    var app8 = new Vue({
        el: '#app8',
        data: {
            message: 'Vue wurde geschrieben von ...',
            isButtonDisabled: true
        }
    })
</script>

<script>
    Vue.component('todo-item', {
        props: ['todo_p'],
        template: '<li>{{ todo_p.name }}</li>'
    })
    var app7 = new Vue({
        el: '#app7',
        data: {
            groceryList: [
                {id: 0, name: '蔬菜'},
                {id: 1, name: '奶酪'},
                {id: 2, name: '随便其他什么人吃的东西'},
                {id: 3, name: 'gemüse'}]
        }
    })
</script>

<script>
    var app1 = new Vue({
        el: '#app',
        data: {
            message: 'Vue wurde geschrieben von ...'
        }
    })
    var app2 = new Vue({
        el: '#app2',
        data: {
            messagetooltip: 'geladen ' + new Date().toLocaleString()
        }
    })
    var app3 = new Vue({
        el: '#appSeeMe',
        data: {
            seeMe: true
        }
    })

    var app4 = new Vue({
        el: '#appFor',
        data: {
            todos: [
                {'aufgabe': 'lerne vue'},
                {'aufgabe': 'lerne laravel'},
                {'aufgabe': 'lerne html5'},
                {'aufgabe': 'lerne css3'}
            ]
        }
    })
    var app5 = new Vue({
        el: '#appButton',
        data: {
            message: 'hello vue!'
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')

            }
        }
    })

    var app6 = new Vue({
        el: '#appModel',
        data: {
            message: 'hello vue!'
        }
    })

</script>

</body>
</html>