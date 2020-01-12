<template>
<div>

	<div class="container panel panel-default" style="background-color: #fff;padding:10px; border:1px solid #ccc; margin-top: 10px;">
		<div class="row border"
			<div class="col-sm-6 col-md-12">
				<div
					class="thumbnail"
					align="center"
					:style="!this.zip ? 'height:200;' : 'height:500;'"
					>
					<div id="img"></div>
					<div class="row">
						<p>Another incarnation of Weather Kitty! <br>This Vue JS app hits the WeatherUnderground API, which returns a giant JSON object, that I parse so that Weather Kitty can tell you if you're going to have bad hair day or not. I've written and re-written this app in <a href="https://www.oepstein.a2hosted.com/reactkitty/" target="_blank">React</a> VueJS, NodeJS, VanillaJS, and Python, and its in memory of my cat, whose name was Kitty. Enter your zip code to get started!</p>
					</div>
					<div class="caption">
						<div class="clearfix"></div>
						<h1><span id='title'><i class="fa fa-paw greenies" aria-hidden="true"></i>&nbsp;Weather Kitty&nbsp;<i class="fa fa-paw greenies" aria-hidden="true"></i></span></h1>

						<h4><span id='desc'>{{this.dewpoint.desc}}</span></h4>

						<div id="info">
							<img v-if="this.dewpoint.img" :src="this.dewpoint.img" height=200 width=200>
							<div v-if="this.dewpoint.temp">
								{{this.dewpoint.temp}}
							</div>
							<div v-if="this.dewpoint.dew">
							</p>
							Current Dewpoint: <span v-bind:style="{ color: this.dewpoint.color }">{{this.dewpoint.dew}}</span>
						</div>
						<div v-if="this.dewpoint.humidity">
							Relative Humidity: <span v-bind:style="{ color: this.dewpoint.color }">{{this.dewpoint.humidity}}</span>
						</div>
						<img v-if="this.dewpoint.sky" :src='this.dewpoint.sky'>
					</div>
					<p v-if="this.errors.length">
						<b>Please correct the following error(s):</b>
						<ul>
							<li v-for="error in this.errors">{{ error }}</li>
						</ul>
					</p>
					<div class="input-group col-md-6">
						<div class="clearfix"></div>
						<input type="text" class="form-control" id="zip" placeholder="Enter your zip code...." size="5" v-model="zip" min="5">
						<span class="input-group-btn">
							<button  @click="getWeather()" class="btn btn-primary" id="submit" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</template>
<script>
import dotenv from '../env/dotenv.js';
var jsonp = require('jsonp');
export default {
	data: function(){
		return {
			errors: [],
			zip: '',
			dewpoint: {
				temp: '',
				zip: '',
				img: '',
				desc: '',
				temp: '',
				dew: '',
				humidity: '',
				sky: '',
				color: '',

			}
		}
	},
	methods:{
		getWeather: async function(){
			console.log('here in function23');
			let self = this;
			let zipcode = zip.value;
			if(zipcode.length <5)
			{
				this.errors.push('Zip code must be 5 digits');
				return;
			}
			else
			{
				this.errors = [];
			}
	try {

// 		axios.defaults.headers.common = {};
// axios.defaults.headers.common.accept = 'application/json';
// 			const xresp = await axios.get('https://api.wunderground.com/api/'+dotenv.VUE_WUAPI+'/forecast/geolookup/conditions/q/'+zipcode+'/format.json')
// console.log(xresp);

const resp = jsonp('https://api.wunderground.com/api/'+dotenv.VUE_WUAPI+'/forecast/geolookup/conditions/q/'+zipcode+'/format.json', {headers: { 'Content-Type': null}}, function (err, data) {
  if (err) {
    console.error(err.message);
  } else {
    console.log(data);

			console.log(data);
				const bad_hair_cat = 'https://cdn.shopify.com/s/files/1/0344/6469/files/Screen_Shot_2017-08-18_at_3.46.44_PM.png?v=1503086296';

			const good_hair_cat = 'http://i.imgur.com/ZiEBSak.jpg?1';
			let location = data['location']['city'];
			let temp_f = data['current_observation']['temp_f'];
			let dewpoint = data['current_observation']['dewpoint_string'];
			let dewpoint_f = data['current_observation']['dewpoint_f'];
			let humidity = data['current_observation']['relative_humidity'];
			let icon_url = data['current_observation']['icon_url'];
			let image = (dewpoint_f > 65 ? bad_hair_cat: good_hair_cat);
			let desc = (dewpoint_f > 65 ? "Bad hair day! Run!" : "Good hair day, good kitty!");
			let color = (dewpoint_f > 65 ? "red" : "green");
			self.dewpoint.img = image;
			self.dewpoint.desc = desc;
			self.dewpoint.temp = "Current temperature in " + location + " is: " + temp_f;
			self.dewpoint.dew = dewpoint;
			self.dewpoint.humidity = humidity;
			self.dewpoint.sky = icon_url;
			self.dewpoint.color = color;

  }
});


	} catch (e) {

	}
			}
		}
	}
</script>
<style>
.red{
	color:red;
}
.green{
	color:green;
}
</style>
