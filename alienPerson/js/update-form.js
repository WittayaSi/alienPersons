var vm = new Vue({
    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },
    el: '#vueApp',
    data: {
        q11Data: q11Data,
        q12Data: q12Data,
        q13Data: q13Data,
        q14Data: q14Data,
        q15Data: q15Data,

        q21Data: q21Data,
        q22Data: q22Data,
        q23Data: q23Data,
        q24Data: q24Data,
        q25Data: q25Data,
        q26Data: q26Data,

        sTambon: homeData,

        allCode:{
            preName: {},
            mStatus: {},
            education: {},
            occupation: {},
            religion: {},
            fstatus: {},
            typearea: {},
            hospital: {},
            nation: {}
        },
        updateHome: {
            /////
            hospital: '',
            vstatus: '',
            osm: '',
            ost: '',
            address: '',
            moo: '',
            village: '',
            tambon: '',
            amphor: '',
            changwat: '',
        },
        updatePerson:{
            sAddresses: '',
            preName: '',
            fName: '',
            lName: '',
            dob: '',
            sex: '',
            mStatus: '',
            education: '',
            occupation: '',
            religion: '',
            race: '',
            nation: '',
            fStatus: '',
            typearea: '',

            //////
            hosp: '',
            anamia: '',
            clinic: '',
            self: '',
            othersHos: '',
            othersTextHos: q1OthersText,

            //////
            ss: '',
            sh: '',
            selfCost: '',
            free: '',
            half: '',
            othersCost:'',
            othersTextCost: q2OthersText
        },
        updateBtn: false,
        pid: {},
        hosHid: {},
        txtSex: 'เลือกเพศ',
        success: false,
    },
    mounted() {

        this.$http.get('/alienPerson/api/codes').then((res) =>{
            this.allCode.preName = res.data.preName
            this.allCode.mStatus = res.data.mStatus
            this.allCode.education = res.data.education
            this.allCode.occupation = res.data.occupation
            this.allCode.religion = res.data.religion
            this.allCode.fstatus = res.data.fstatus
            this.allCode.typearea = res.data.typearea
            this.allCode.nation = res.data.nation
            this.allCode.hospital = res.data.hospital
        })

        console.log(this.sTambon)
        var self = this
        this.$http.post('/alienPerson/api/getAddresses', this.sTambon).then((res) =>{
            self.hosHid = res.data
            console.log(self.hosHid)
        })

        if(this.$refs.sex.value == 1) {
            this.txtSex = 'ชาย'
        }else{
            this.txtSex = 'หญิง'
        }

        this.updatePerson.hosp = this.q11Data
        this.updatePerson.anamia = this.q12Data
        this.updatePerson.clinic = this.q13Data
        this.updatePerson.self = this.q14Data
        this.updatePerson.othersHos = this.q15Data

        this.updatePerson.ss = this.q21Data
        this.updatePerson.sh = this.q22Data
        this.updatePerson.selfCost = this.q23Data
        this.updatePerson.free = this.q24Data
        this.updatePerson.half = this.q25Data
        this.updatePerson.othersCost = this.q26Data
    },
    methods:{
      updateHomes(id){
        console.log(id)
        this.updateHome.hospital = this.$refs.hospital.value
        this.updateHome.vstatus = this.$refs.vstatus.value
        this.updateHome.osm = this.$refs.osm.value
        this.updateHome.ost = this.$refs.ost.value
        this.updateHome.address = this.$refs.address.value
        this.updateHome.moo = this.$refs.moo.value
        this.updateHome.village = this.$refs.village.value
        this.updateHome.tambon = this.$refs.tambon.value
        this.updateHome.amphor = this.$refs.amphor.value
        this.updateHome.changwat = this.$refs.changwat.value

        var home = this.updateHome

        this.$http.post("/alienPerson/data/updateHome/" + id, home).then((res) =>{
            console.log(res.data)
            if(res.data == 1){
                console.log("An update is Successfully")
                var self = this
                self.success = true
                setTimeout(() => {
                    location.href = '/alienPerson/data/allPerson';
                }, 1000)
            }else{
               console.log("An update is Error")
               setTimeout(() => {
                   document.location.reload(true)
               }, 1000)
            }
        })

      },
      updatePersons(id){
          this.updatePerson.preName = this.$refs.preName.value
          this.updatePerson.fName = this.$refs.fName.value
          this.updatePerson.lName = this.$refs.lName.value
          this.updatePerson.dob = this.$refs.dob.value
          this.updatePerson.sex = this.$refs.sex.value
          this.updatePerson.mStatus = this.$refs.mStatus.value
          this.updatePerson.education = this.$refs.education.value
          this.updatePerson.occupation = this.$refs.occupation.value
          this.updatePerson.religion = this.$refs.religion.value
          this.updatePerson.race = this.$refs.race.value
          this.updatePerson.nation = this.$refs.nation.value
          this.updatePerson.fStatus = this.$refs.fStatus.value
          this.updatePerson.typearea = this.$refs.typearea.value

          this.updatePerson.sAddresses = this.$refs.hosHid.value

          if(this.updatePerson.othersHos){
            this.updatePerson.othersTextHos = this.$refs.othersTextHos.value
          }
          if(this.updatePerson.othersCost){
            this.updatePerson.othersTextCost = this.$refs.othersTextCost.value
          }

          var person = this.updatePerson

          this.$http.put("/alienPerson/data/" + id, person).then((res) =>{
              console.log(res.data)
              this.updateBt = true
              if(res.data == 1){
                  console.log("An update is Successfully")
                  var self = this
                  self.success = true
                  setTimeout(() => {
                      location.href = '/alienPerson/data/allPerson';
                  }, 1000)
              }else{
                 console.log("An update is Error")
                 setTimeout(() => {
                     document.location.reload(true)
                 }, 1000)
              }
          })
      },
      changeGender(){
          var check = this.$refs.preName.value
          if(check == '001' || check == '003'){
              this.updatePerson.sex = 1
              this.txtSex = 'ชาย'
          }else{
              this.updatePerson.sex = 2
              this.txtSex = 'หญิง'
          }
      },
      changeTambon(){
        //console.log(this.sTambon)
        //var stambon = this.$refs.sTambon.value
        console.log(this.sTambon)
        var self = this
        this.$http.post('/alienPerson/api/getAddresses', this.sTambon).then((res) =>{
            self.hosHid = res.data
            console.log(self.hosHid)
        })
      }
    }
})
