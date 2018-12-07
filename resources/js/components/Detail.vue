<template>
<div>
	<div class="big">
		<div class="x">
			<div class="close">
			<router-link :to="{ name: '/detail',  params: { bu: 'junk' } }">
			<button type="button" class="close" aria-label="Close">
			<span aria-hidden="true" class="colorit">&times;</span>
			</button>
			</router-link>
		</div>
		</div>
		
		<slider ref="slider"></slider>
		<div class="details">
			<div class="row">
				<div class="col-md-10">
					<span class="detailTitle" v-html="this.detail.title"></span>
					<br>
					<span class="detailDesc" v-html="this.detail.description"></span>
					
				</div>
				<div class="col-md-2">
					<span class="detailTitle">Skills Used:</span><br>
					<ul class="list-group">
						<li v-for="skill in this.skills" class="list-group-item">{{skill}}</li>
					</ul>
					
				</div>
			</div>
			
		</div>
		
	</div>
</div>
</template>


<script>
import slider from './Slider.vue';
	export default {
		data: function(){ 
			return {
				bu: this.$route.params.bu,
				detail: '',
				skills:'',

			}
	},
	mounted: function(){
		console.log("here: "+ JSON.stringify(this.$data));
		console.log("here2: "+ this.$refs.slider);
		console.log('details loading');
		this.getPosts();
	},

		methods: {
			getPosts () {
				//alert(this.bu);
  			axios.get('./profile/' + this.bu)
			.then((response) => {
				console.log('in then');
				this.detail = response.data[0];
				this.skills = this.detail.skills.split(',');
			});
  	},
		}
	}
</script>

<style>
.big{
	position:fixed;
    padding:0;
    margin:0;

    top:0;
    left:0;
    z-index: 100;

    width: 100%;
    height: 100%;
    background:rgba(0,0,0,1);

    overflow: auto;
}

.details{
	margin: 65px;
}

.detailTitle{
 color:#ccc;
 font-size: 22px;
 font-weight: bolder;
}

.detailDesc{
 color:#ccc;
 font-size: 16px;
}

.detailSkills{
 color:#ccc;
 font-size: 12px;
 font-weight: bold;
}

.colorit{
	color:#fff;
	font-size: 30px;
}

.close{
	float:right;margin:5px;border:1px solid #ccc;padding:3px;
}

.x{
	margin-top:100px;
}

</style>