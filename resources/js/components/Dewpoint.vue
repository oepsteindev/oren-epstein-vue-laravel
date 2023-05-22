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
                        Sadly, all the APIs I used to use have come and gone, and Weather Kitty doesnt work anymore. In Loving memory of my cat, Mr. Kitty T. Cat.<hr>
                    </div>
					<div class="row">
						<p>Another incarnation of Weather Kitty! <br>This Vue JS app hits the Accuweather.com API, which returns a giant JSON response, that I parse so that Weather Kitty can tell you if you're going to have bad hair day or not. I've written and re-written this app with 3 API's over the years and in <a href="https://www.oepstein.a2hosted.com/reactkitty/" target="_blank">React</a> VueJS, NodeJS, VanillaJS, and Python, and its in memory of my cat, whose name was Kitty. Enter your zip code to get started!</p>
					</div>
					<div class="caption">
						<div class="clearfix"></div>
						<h1><span id='title'><i class="fa fa-paw greenies" aria-hidden="true"></i>&nbsp;Weather Kitty&nbsp;<i class="fa fa-paw greenies" aria-hidden="true"></i></span></h1>

						<h4><span id='desc'>{{this.dewpoint.desc}}</span></h4>

						<div id="info">
							<img v-if="this.dewpoint.img" :src="this.dewpoint.img" height=200 width=200 class="spaceout">
							<div v-if="this.dewpoint.temp" class="spaceout">
								{{this.dewpoint.temp}}
							</div>
							<div v-if="this.dewpoint.dew" class="spaceout">

							Current Dewpoint: <span v-bind:style="{ color: this.dewpoint.color }">{{this.dewpoint.dew}}</span>
						</div>
						<div v-if="this.dewpoint.humidity" class="spaceout">
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
						<input type="text" class="form-control" id="zip" placeholder="Enter your zip code...." value="33614" size="5" v-model="zip" min="5">
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

		let location_response = await fetch('http://dataservice.accuweather.com/locations/v1/cities/search?apikey='+dotenv.VUE_WUAPI+'&q=33614&language=en-us');
	    // proceed once promise is resolved
	    let location_json = await location_response.json();

	 	let ld = location_json[0];


	    let weather_response = await fetch('http://dataservice.accuweather.com/currentconditions/v1/33614?apikey='+dotenv.VUE_WUAPI+'&language=en-us&details=true');

	    let weather_json = await weather_response.json();

	    let wd = weather_json[0];

	    const bad_hair_cat ="http://img06.deviantart.net/2c2a/i/2013/236/5/5/doodle_237___persian_cat_by_giovannag-d6jlpei.jpg";
	    const good_hair_cat = "http://i.imgur.com/ZiEBSak.jpg?1";
	    let dewpoint = wd.DewPoint.Imperial.Value;
	    let city = ld.EnglishName;
	    let temp_f = wd.Temperature.Imperial.Value;
	    let humidity = wd.RelativeHumidity;
	    let image = dewpoint > 65 ? bad_hair_cat : good_hair_cat;
	    let desc = dewpoint > 65 ? "Bad hair day! Run!" : "Good hair day, good kitty!";
	    let temp = "The Current temperature in " + city + " is: " + temp_f;
	    let color = dewpoint > 65 ? "red" : "green";

	    self.dewpoint.img = image;
		self.dewpoint.desc = desc;
		self.dewpoint.temp = "Current temperature in " + ld.ParentCity.EnglishName + " is: " + temp_f;
		self.dewpoint.dew = dewpoint;
		self.dewpoint.humidity = temp_f;
		self.dewpoint.color = color;
		// self.dewpoint.sky = icon_url;

	} catch (e) {
		alert(e)
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
.spaceout{
	margin:5px;
}
</style>
