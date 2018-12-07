<template>
<div>
	
	<hr>
	<div class="grid" >
		<h1>Archived <span class="greenies">Web Projects</span></h1>
		<p>What do you do when the web moves as fast as it does? You end up with an archive! Below are projects I happily had the opportunity to work on over the years. The gallery gets slmmier and slimmer each time I rewrite the site, but there's still plenty to see. All things below are my work from 5 years ago or more. If you click on them, you'll get some more information. Enjoy!
			<div v-images-loaded:on.progress="imageProgress">
				<div v-masonry transition-duration="0.3s" item-selector=".item" :origin-top="true" :horizontal-order="false" >
					<div class="row mason_thumbs">
						<div v-masonry-tile class="col-md-3 "  v-for="(post, index) in posts">
							<router-link :to="{ name: 'detail',  params: { bu: post.url } }">
							<img class="thumb grid-item" v-if="post.thumb" :src="'./oe_img/thumbs/' + post.thumb"  height='161' width='220' >
							</router-link>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>

<script>
	import imagesLoaded from 'vue-images-loaded';
	export default {
	
  data () {
    return {
    	posts: []

    }
  },
  mounted() {
    this.getPosts();
    console.log('fetching masonry');
    
  },
  directives: {
        imagesLoaded
    },
	methods: {
    imageProgress(instance, image ) {
        const result = image.isLoaded ? 'loaded' : 'broken';
        //console.log( 'image is ' + result + ' for ' + image.img.src );
    },
    getPosts () {
  		axios.get('./thumb')
			.then((response) => {
				console.log('in then');
				//console.log(response.data);
				let row;
				let x=0;

				for(row in response.data)
				{
					//console.log(response.data[row]['thumb']);
					this.posts.push({'thumb': response.data[row]['thumb'], 'id':x++, 'url':response.data[row]['unit'],});
				}

				
			});
  	},
    
  }}
</script>

<style>

.grid-item {
  float: left;
  width: 220px;
  height: 161px;
  margin:1px;
  border: 2px solid hsla(0, 0%, 0%, 0.5);
}

.thumb:hover{
	-webkit-transform: rotateY(150deg); /* Safari */
    transform: rotateY(150deg);
    transform: scale(1.2) skewY(2deg);
}

.mason_thumbs
{
	margin-bottom:200px;
}
</style>

