<template>
<div>
    <the-header />
	<section class="hero">
		<div
      class="background-image"
    >
    </div>
		<h1>はんこ画像 作成</h1>
		<div>
			<input type="text" placeholder="名前を入力してください" class="new" v-model="imgName">
			<a class="btn" id="newBtn" @click="this.createImg">つくる</a>
		</div>
	</section>	

	<!-- <section class="features">
		<h3 class="title">Features and services</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>

		<ul class="grid">
			<li>
				<i class="fa fa-camera-retro"></i>
				<h4>Photography</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
			</li>
			<li>
				<i class="fa fa-cubes"></i>
				<h4>Web Development</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
			</li>
			<li>
				<i class="fa fa-newspaper-o"></i>
				<h4>Content Editing</h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
			</li>
		</ul>
	</section> -->

	<!-- <section class="reviews">
		<h3 class="title">What others say:</h3>
		<p class="quote">Mauris sit amet mauris a arcu eleifend ultricies eget ut dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
		<p class="author">— Patrick Farrell</p>
		<p class="quote">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<p class="author">— George Smith</p>
		<p class="quote">Donec commodo dolor augue, vitae faucibus tortor tincidunt in. Aliquam vitae leo quis mi pulvinar ornare. Integer eu iaculis metus.</p>
		<p class="author">— Kevin Blake</p>
	</section> -->

	<!-- <section class="contact">
		<h3 class="title">Join our newsletter</h3>	
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>

		<form>
			<input type="email" placeholder="Email">
			<a href="#" class="btn">Subscribe now</a>
		</form>
	</section> -->

	<footer>
		<ul>
			<li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
			<li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
			<li><a href="#"><i class="fa fa-snapchat-square"></i></a></li>
			<li><a href="#"><i class="fa fa-pinterest-square"></i></a></li>
			<li><a href="#"><i class="fa fa-github-square"></i></a></li>
		</ul>
		<p>Made by <a href="http://tutorialzine.com/" target="_blank">tutorialzine</a>. images courtesy to <a href="http://unsplash.com/" target="_blank">unsplash</a>.</p>
		<p>No attribution required. you can remove this footer.</p>
	</footer>

</div>
</template>

<script>
import axios from 'axios'
import TheHeader from './TheHeader.vue'

export default {
  components: {
    TheHeader
  },
  data() {
    return {
      imgName : ""
    }
  },
  methods: {
    createImg: function() {
      const url = "http://localhost:8000/api/img";
      console.log(this.imgName)
      const data = {
        "name" : this.imgName
      }
      return axios.post(url, data)
        .then((res) => {
          console.log(res.data);
          const filename = res.data.file_name;
          const fileURL = res.data.download_link;
          const fileLink = document.createElement('a');
          fileLink.href = fileURL;
          fileLink.setAttribute('download', filename);
          document.body.appendChild(fileLink);
          fileLink.click();
        })
        .catch((err) => {
          console.error(err);
        })
    }
  }
}
</script>

<style>
input::placeholder {
  color: #cccccc;
}
</style>