<template>
<div>
	
	<div class="container panel panel-default" style="background-color: #fff;padding:10px; border:1px solid #ccc; margin-top: 10px;">
		<div align="center"><h4>Nice things others have said about me...</h4><hr></div>
		<div align="center" name="slide" id="slide" > </div>
		<div class="row">
			<div class="col-md-12 col-md-offset-2" align="center">
				<button @click="changeText()" class="btn btn-secondary btn-sm ffwd" >...next</button>
			</div>
		</div>
	</div>
</div>
</template>

<script>

export default {
  data () {
    return {
     bu: this.$route.params.bu,
     i : 0,
	 text:['<h1 class="greenies">Testimonials</h1><i class="fa fa-handshake-o bigger greenies" aria-hidden="true"></i>']	

    }
  },

	mounted: function(){

		console.log('fetching data');
		this.getData();
		this.changeText();	
	},
  methods: {
  	
  	changeText(){

		//assign new image
		document.getElementById('slide').innerHTML = this.text[this.i];
  		//document.slide.src = this.images[this.i];

  		//keep sliding if there are images left, if not roll back to first img
		if(this.i < this.text.length - 1){
			this.i++;
		} else {
			this.i = 0;
		} 
		
		setTimeout(this.changeText, 10000);
	
	
  	},
  	getData () {
  		this.images = [];
  		axios.get('./testimonials')
			.then((response) => {
				//console.log('in then');
				console.log('data 0: '+response.data);
				let row;

				for(row in response.data)
				{
					//console.log("in loop: "+response.data[row]['body'])
					this.text.push(response.data[row]['body']);
					
				}
					// console.log("images: "+this.images);
					});
	
  	
  	}
  }
}

</script>

<style>
.ffwd{
	margin-top:10px;
	font-size:20px;
	font-weight:bold;
	padding-right: 50px;
	padding-left: 50px;
	height:20px;
	line-height: 3px;
	font-size: 12px;
}

#slide{
	display:block;
    width:100%;
    min-height:15em;
    overflow:scroll;
}

.bigger{
	font-size: 10em;
}


</style>