<!DOCTYPE html>
<html>
	<head>
		@include('fonts')
		@include('jquery')
		<link rel="stylesheet" type="text/css" href="/css/app.css" />
		<script type="text/javascript">
			$(document).ready(function()
			{
				setInterval(function()
				{
					var offset = $("#logo_img").offset().top;
					var height = $("#logo_img").height();

					var num = offset + height;
					num += 20;
					num = parseInt(num);
					num += '';
					$(".category_container").first().css("margin-top", num + 'px');
				}, 10);
				var image_animation_interval = setInterval(function()
				{
					var img_length = $("img").length;
					var completed_tally = 0;
					$("img").each(function(i, e)
					{
						completed_tally += $(e)[0].complete * 1;
					});
					if(completed_tally === img_length)
					{
						clearInterval(image_animation_interval);
					}
					$(".store_category").each(function(i, e)
					{
						$(e).animate({"left": "0%"}, 1000, function()
						{
							/*setInterval(function()
							{
								$(".black_img").each(function(i, e)
								{
									var prev_img_offset = $(e).prev().offset();
									var prev_img_height = $(e).prev().height;

									var left = (parseInt(prev_img_offset.left) + '') + 'px';
									$(e).css("left", left);
									var top = prev_img_offset.top;
									top = parseInt(top);
									top += '';
									$(e).css("top", top + 'px');
								});
							}, 20);*/
						});
					});
				}, 100);

				$(".black_img").on("mouseenter", function()
				{
					var that = $(this);
					that.css("opacity", "0.0");
				});
				$(".black_img").on("mouseleave", function()
				{
					var that = $(this);
					that.css("opacity", "0.2");
				});
			});
		</script>
	</head>
	<body>
		@include('logo')
		@include('cart')
		<div class="category_container">
			@foreach($cats as $cat)
				<a href="{{route('category', ['id' => $cat['identifier']])}}">
				<div class="store_category">
					<p>
						{{$cat['name']}}
					</p>
					<img src="{{$cat['img_link']}}" />
					<img class="black_img" src="https://image.ibb.co/mMjJDo/black.jpg" />
				</div>
				</a>
			@endforeach
		</div>
	</body>
</html>
