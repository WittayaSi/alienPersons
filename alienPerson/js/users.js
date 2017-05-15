new Vue({
    http: {
        root: '/root',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#token').getAttribute('value')
        }
    },
    el: '#vueApp',
    data: {
        pagination: {
            total: 0,
            per_page: 2,
            from: 1,
            to: 0,
            current_page: 1
        },
        users: [],
        idCard: '',
        txtName: '',
        txtLastName: '',
        fullName: {
            'fName': '',
            'lName': ''
        },
        idNo: {
            'idNo': ''
        },
        option: 'a'
    },
    filters: {
        getPrename(value) {
            switch (value) {
                case '001':
                    this.pName = "ด.ช."
                    break;
                case '002':
                    this.pName = "ด.ญ."
                    break;
                case '003':
                    this.pName = "นาย"
                    break;
                case '004':
                    this.pName = "นางสาว"
                    break;
                case '005':
                    this.pName = "นาง"
                    break;
                default:
                    this.pName = ""
                    break;
            }
            return `${this.pName}`
        },
        getDate(date) {
            const d = new Date(date)
            const m = [
                'มกราคม',
                'กุมภาพันธ์',
                'มีนาคม',
                'เมษายน',
                'พฤษภาคม',
                'มิถุนายน',
                'กรกฎาคม',
                'สิงหาคม',
                'กันยายน',
                'ตุลาคม',
                'พฤศจิกายน',
                'ธันวาคม'
            ]
            const month = m[(d.getMonth())]
            return `${d.getDate() < 10
                ? '0' + d.getDate()
                : d.getDate()} ${month} ${d.getFullYear()+543}`
        }
    },
    created() {
      this.getUsersItem(this.pagination.current_page)
      // this.$http.get("/alienPerson/api/allPerson").then((res) => {
      //     this.persons = res.data
      //     console.log(this.persons)
      // })
    },
    methods: {
      deleteRecord(id){
          console.log(id)
          var self = this
          swal({
              title: 'คุณแน่ใจว่าต้องการลบ ?',
              text: "ไม่ต้องการลบกด ยกเลิก !",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'ยืนยัน !',
              cancelButtonText: 'ยกเลิก',
              closeOnConfirm: true
          },
          function(isConfirm) {
              if (isConfirm) {
                self.$http.delete("/alienPerson/user/"+id).then((res) => {
                    console.log('Record Delete Successfully')
                    location.href = '/alienPerson/allUsers';
                })
                swal(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
                  return true;
              } else {
                  return false;
              }
          }.bind(self))
      },
      getUsersItem(page){
          this.$http.get('/alienPerson/api/allUsers?page=' + page).then((res) => {
            this.users = res.data.rawData.data
            console.log(this.users)
            this.pagination = res.data.pagination
            console.log(this.pagination)
            // this.$set('persons', res.data.data);
            // this.$set('pagination', res.data.pagination);
          });
      },
      changePage(page) {
          this.pagination.current_page = page;
          this.getVueItems(page);
      }
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            var to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            var pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
})
