var vm = new Vue({
    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },
    el: '#vueApp',
    data: {
        updateUser:{
            name: '',
            username: '',
            email: ''
        },
        updateBt: false,
        pid: {},
        txtSex: 'เลือกเพศ',
        success: false,
    },
    methods:{
      updateUser(id){
          this.updateUser.name = this.$refs.name.value
          this.updateUser.username = this.$refs.username.value
          this.updateUser.email = this.$refs.email.value

          var user = this.updateUser
          console.log(id)
          console.log(user)

          this.$http.put("/alienPerson/user/" + id, user).then((res) =>{
              console.log(res.data)
              this.updateBt = true
              if(res.data == 1){
                  console.log("An update is Successfully")
                  var self = this
                  self.success = true
                  setTimeout(() => {
                      location.href = '/alienPerson/user/allUsers';
                  }, 1000)
              }else{
                 console.log("An update is Error")
                 setTimeout(() => {
                     document.location.reload(true)
                 }, 1000)
              }
          })
      }
    }
})
