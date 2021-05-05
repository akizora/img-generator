<template>
<div>
  <the-header />
	<section class="hero">
		<div class="background-image">
    </div>
		<p>はんこ画像 作成</p>
		<div>
			<input type="text" placeholder="名前を入力してください" class="new" v-model="imgName">
			<a class="btn" id="newBtn" @click="this.createImg">つくる</a>
		</div>
    <div class="prev">
			<a :href="hankoImg" :download="imgName"><img :src="hankoImg" /></a>
    </div>
	</section>	

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
      imgName : "",
      hankoImg : "http://localhost:8000/storage/png.png"
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
          this.hankoImg = "";
          console.log(res.data);
          // const filename = res.data.file_name;
          const fileURL = res.data.download_link;
          const fileLink = document.createElement('a');
          fileLink.href = fileURL;
          // fileLink.setAttribute('download', filename);
          document.body.appendChild(fileLink);
          console.log(fileLink)
          // fileLink.click();
          this.hankoImg = "";
          this.hankoImg = fileURL;
        })
        .catch((err) => {
          console.error(err);
        })
    }
  }
}
</script>

<style>
.btn {
  background-color: #fc2414 !important;
}
.prev {
  background: #fff;
}
input::placeholder {
  color: #cccccc;
}
</style>