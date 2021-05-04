<template>
  	<section class="our-work">
		<h3 class="title">Some of our work</h3>
		<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
		<hr>
		<ul class="grid">
			<li class="small" style="background-image: url(img/coast.jpg);"></li>
			<li class="large" style="background-image: url(img/island.jpg);"></li>
			<li class="large" style="background-image: url(img/balloon.jpg);"></li>
			<li class="small" style="background-image: url(img/mountain.jpg);"></li>
		</ul>
	</section>
</template>

<script>
export default {

}
</script>

<style>
/*--------------------
 	Our Work Section
---------------------*/

.our-work{
	background-color: #fff;
}

.our-work .grid li{
	padding: 20px;
	height: 350px;
	border-radius: 3px;

	background-clip: content-box;
	background-size: cover;
	background-position: center;
	background-color: #333;
}

.our-work .grid li.small{
	flex-basis: 40%;
}

.our-work .grid li.large{
	flex-basis: 60%;
}


@media (max-width: 1000px){

	.our-work .grid li.small,
	.our-work .grid li.large{
		flex-basis: 100%;
	}

}
</style>