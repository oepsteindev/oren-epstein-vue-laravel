<template>
<div>
	<div class="container panel panel-default" style="background-color: #fff;padding:10px; border:1px solid #ccc; margin-top: 10px;">
		
		This is a Vue contact form I built. It's got full CRUD capability. Please feel free to test it out and leave a message for me! You can even update your info after you submit it! Robots beware, Google Invisible Recaptcha is also installed. *Your email and phone will not be displayed after submit.<br><br>
		<h1><span class="greenies">Hello</span> Guests!</h1>
		<form action="#" @submit.prevent="edit ? updateContact(contact.id) : createContact()">
			<div class="form-group">
				<label>Name</label>
				<input  v-model="contact.name" type="text" name="name" class="form-control"></input>
			</div>
			
			<div class="form-group">
				<label>Email</label>
				<input  v-model="contact.email" type="text" name="email" class="form-control"></input>
			</div>
			
			<div class="form-group">
				<label>Phone</label>
				<input  v-model="contact.phone" type="text" name="phone" class="form-control"></input>
			</div>
			<div class="form-group">
				<form @submit.prevent="onSubmit">
					
					<vue-recaptcha
					@verify="onVerify"
					@expired="onExpired"
					:sitekey="sitekey"
					
					>
					<button v-show="!edit" type="submit" name="button" class="btn btn-primary">New Contact</button>
					</vue-recaptcha>
				</form>
				
				<button v-show="edit" type="submit" name="button" class="btn btn-primary">Update Contact</button>
			</div>
		</form>
		</div>
		<br>
		<div class="container panel panel-default" style="background-color: #fff;padding:10px; border:1px solid #ccc; margin-top: 10px;">
		<h4>Guests who have stopped by:</h4>
		<ul class="list-group">
			<li class="list-group-item" v-for="contact in list">
				Thanks for stopping by &nbsp;<strong>{{ contact.name }}</strong>!
				
				<button @click="deleteContact(contact.id)" class="btn btn-danger btn-xs" style="float:right;">Delete</button>
				<button @click="showContact(contact.id)" class="btn btn-primary btn-xs" style="float:right;margin-right:3px;">Edit</button>
			</li>
		</ul>
	</div>
	<hr>
</div>
</template>



<script>
import VueRecaptcha from 'vue-recaptcha';
export default {
	data: function(){
		return {
			edit: false,
			list: [],
			sitekey: "6LcuYngUAAAAAIJp9estJOpUG6mezaRmyJsQTjBI",
			contact: {
				id: '',
				name: '',
				email: '',
				phone: ''
			}
		}
	},
	mounted: function(){
		console.log('contacts loaded');
		this.fetchContactList();
	},
	components: { VueRecaptcha },
	methods:{
		fetchContactList: function(){
			console.log('Fetching Contacts...');
			axios.get('api/contacts/')
			.then((response) => {
				//console.log(response.data);
				this.list = response.data;
			})
			.catch((error) => {
				console.log(error);
			})
		},
		createContact: function(){
			console.log('creating');
			let self = this;
			let params = Object.assign({}, self.contact);
			axios.post('api/contact/store', params)
			.then(function(){
				self.contact.name = '';
				self.contact.email = '';
				self.contact.phone = '';
				self.edit = false;
				self.fetchContactList();
			})
			.catch(function(error){
				console.log(error);
			});


		},

		showContact: function(id){
			console.log('this is the id' + id);
			let self = this;
			axios.get('./api/contact/'+id)
			.then((response) => {
				console.log('this is the then: '+JSON.stringify(response));
				self.contact.id = response.data.id;
				self.contact.name = response.data.name;
				self.contact.email = response.data.email;
				self.contact.phone = response.data.phone;
			})

			self.edit = true;
		},

		deleteContact: function(id){

			axios.delete('./api/contact/delete/'+id)
			.then((response) => {
				this.fetchContactList();
			}).catch(function(error){
				console.log(error);
			});
		},

		updateContact: function(id){
			console.log('updating');
			axios.post('./api/contact/'+id,{ _method: 'PUT', foo: 'bar' })
			.then((response) => {
				//console.log('this is the then: '+JSON.stringify(response));
				self.contact.id = response.data.id;
				self.contact.name = response.data.name;
				self.contact.email = response.data.email;
				self.contact.phone = response.data.phone;
			})
			console.log('update complete');
			return;
		},
		onSubmit: function () {
		 	grecaptcha.reset();
      		this.$refs.invisibleRecaptcha.execute()
	    },
	    onVerify: function (response) {
	      console.log('Verify: ' + response)
	      this.edit ? this.updateContact(contact.id) : this.createContact()
	    },
	    onExpired: function () {
	      console.log('Expired')
	    },
	    resetRecaptcha () {
	    grecaptcha.reset();
	     this.$refs.recaptcha.reset() // Direct call reset method
	    }
	}
}

</script>

<style>

.grecaptcha-badge {
       z-index: 100;
    }
</style>