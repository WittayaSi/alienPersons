new Vue({
    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },
    el: '#vueApp',
    data: {
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
        addBt: false,
        persons: {},
        pid: {},
        txtSex: 'เลือกเพศ',
        success: false,
        sTambon: '',
        sAddresses: {},
        newHome: {
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
        newPerson:{
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

            /////
            hosp: '',
            anamia: '',
            clinic: '',
            self: '',
            othersHos: '',
            othersTextHos: '',

            ////
            ss: '',
            sh: '',
            selfCost: '',
            free: '',
            half: '',
            othersCost:'',
            othersTextCost: ''
        }
    },
    created() {
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
        // this.$http.get("/data/getAllCode/").then((res) => {
        //     this.allCode.preName = res.data.preName
        //     this.allCode.mStatus = res.data.mstatus
        //     this.allCode.education = res.data.education
        //     this.allCode.occupation = res.data.occupation
        //     this.allCode.religion = res.data.religion
        //     this.allCode.fstatus = res.data.fstatus
        //     this.allCode.typearea = res.data.typearea
        //     this.allCode.nation = res.data.nation
        //     this.allCode.hospital = res.data.hospital
        // })
        // this.$http.get("/getMaxPid/").then((res) => {
        //     console.log(res.data)
        //     this.allCode.pid = res.data
        // })
    },
    methods:{
      addHome(){
          // person input
          var home = this.newHome
          console.log(home)
            this.$http.post("/alienPerson/data/addHome", home).then((res) =>{
                console.log(res.data)
                if(res.data == 1){
                    console.log("An insert is Successfully")
                    var self = this
                    self.success = true
                    setTimeout(() => {
                        document.location.reload(true)
                        self.success = false
                    }, 500)
                }
            })
      },
      addPerson(){
          // person input
          var person = this.newPerson
          console.log(person)
            this.$http.post("/alienPerson/data", person).then((res) =>{
                console.log(res.data)
                if(res.data == 1){
                    console.log("An insert is Successfully")
                    var self = this
                    self.success = true
                    setTimeout(() => {
                        document.location.reload(true)
                        self.success = false
                    }, 500)
                }
            })
      },
      changeGender(){
          if(this.newPerson.preName === '001' || this.newPerson.preName === '003'){
              this.newPerson.sex = 1
              this.txtSex = 'ชาย'
          }else{
              this.newPerson.sex = 2
              this.txtSex = 'หญิง'
          }
      },
      changeTambon(){
        //console.log(this.sTambon)
        this.$http.post('/alienPerson/api/getAddresses', this.sTambon).then((res) =>{
            this.sAddresses = res.data
            console.log(res.data)
        })
      }
    },
    computed: {
        validation(){
            return {
                preName: !!this.newPerson.preName,
                fName: !!this.newPerson.fName.trim(),
                lName: !!this.newPerson.lName.trim(),
                dob: !!this.newPerson.dob,
                sex: !!this.newPerson.sex,
                mStatus: !!this.newPerson.mStatus,
                education: !!this.newPerson.education,
                occupation: !!this.newPerson.occupation,
                religion: !!this.newPerson.religion,
                race: !!this.newPerson.race,
                nation: !!this.newPerson.nation,
                fStatus: !!this.newPerson.fStatus,
                typearea: !!this.newPerson.typearea,
            }
        },
        isValid(){
            var validation = this.validation
            return Object.keys(validation).every((key) => {
                return validation[key]
            })
        }
    },
})
