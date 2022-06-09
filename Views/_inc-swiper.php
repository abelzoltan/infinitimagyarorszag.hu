<link rel="stylesheet" href="<?php echo PATH_WEB; ?>vendors/Swiper-3.4.2/dist/css/swiper.min.css">
<style>
.my-slider{
	position: relative;	
}

.my-slider-button{
	position: absolute;
	top: 50%;
	left: 15px;
    z-index: 2;
	color: #fff;
	cursor: pointer;
	visibility: hidden;
	opacity: 0;
	transform: translateY(-50%);
		-webkit-transform: translateY(-50%);
		-moz-transform: translateY(-50%);
		-ms-transform: translateY(-50%);
		-o-transform: translateY(-50%);
}

.my-slider-button-next{
	left: auto;
	right: 15px;
}

.my-slider:hover .my-slider-button{
	visibility: visible;
	opacity: .8;
}

.my-slider-button:hover{
	opacity: 1;	
}

.my-slider-button i{
    display: block;
    font-size: 80px;
    line-height: 80px;
}

.my-slider-pagination{
	bottom: 10px !important;
	height: 20px;
}

.my-slider-pagination .swiper-pagination-bullet{
	width: 16px;
	height: 16px;
	margin: 0 5px !important;
	padding: 0;
	border: 2px solid #000;
	border-radius: 50%;
	opacity: 1;	
	background: transparent;
	background-image: none;
	background-color: transparent;
}

.my-slider-pagination .swiper-pagination-bullet:hover, .my-slider .swiper-pagination-bullet-active{
	background-color: #000;
}
</style>
<script src="<?php echo PATH_WEB; ?>vendors/Swiper-3.4.2/dist/js/swiper.jquery.min.js"></script>