<template>
<div>
	<hr>
	<div align="center">
		<img name="slide" width="90%" height="575" style="display:none;" onerror="this.style.display='none'"/>
		<button @click="changeImg()" class="btn btn-primary ffwd" ><i class="fa fa-forward" aria-hidden="true"></i></button>
	</div>
	<hr>
</div>
</template>

<script>

export default {
  data () {
    return {
     bu: this.$route.params.bu,
     i : 0,
	 images:[]	

    }
  },

	mounted: function(){

		console.log('fetching data');
		console.log('fetching images: ' +this.images);
		this.getData();
		this.changeImg();	
		
	},
  methods: {
  	
  	changeImg(){
  		//show the img tag
		document.slide.style.display = 'block';

		//assign new image
  		document.slide.src = this.images[this.i];

  		//keep sliding if there are images left, if not roll back to first img
		if(this.i < this.images.length - 1){
			this.i++;
		} else {
			this.i = 0;
		} 
		
		setTimeout(this.changeImg, 3000);
	
	
  	},
  	getData () {
  		this.images = [];
  		axios.get('./thumb/'+ this.bu)
			.then((response) => {
				console.log('in then');
				console.log('data 0: '+JSON.stringify(response.data[0]));
				let row;

				for(row in response.data[0])
				{
					console.log("in loop: "+row)
					if(
					row == 'main' && response.data[0][row] != '' && response.data[0][row] != null
					|| row == 'slider1' && response.data[0][row] != '' && response.data[0][row] != null
					|| row == 'slider2' && response.data[0][row] != '' && response.data[0][row] != null
					|| row == 'slider3' && response.data[0][row] != '' && response.data[0][row] != null
					|| row == 'slider4' && response.data[0][row] != '' && response.data[0][row] != null
					|| row == 'slider5'&& response.data[0][row] != '' && response.data[0][row] != null)
					{
						this.images.push("./oe_img/main/" + response.data[0][row]);
						
					}
				}
				
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
	height: 40px;
}
</style>