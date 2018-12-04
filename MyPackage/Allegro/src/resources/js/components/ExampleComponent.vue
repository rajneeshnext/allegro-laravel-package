<script>
var store = {_token:'',category_id:'',auction_name:''};
vm = new Vue({
  el : "#step-1",
  data : {store : store},
  methods : {
    submit : function(data){
	  console.log(store);
	  let currentObj = this;
		axios.post('/allegro/public/admin/auction/add', this.data)
		.then(function (response) {
			currentObj.output = response.data;
		})
		.catch(function (error) {
			currentObj.output = error;
		});
            //this.$refs.form.submit();
    }
  }
});
</script>