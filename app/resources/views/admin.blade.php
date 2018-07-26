<!DOCTYPE html>
<html>
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		@include('fonts')
		@include('jquery')

		<link rel="stylesheet" type="text/css" href="/css/app.css" />
		<script type="text/javascript">
			$(document).ready(function()
			{
				$.ajaxSetup
				(
					{
						headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
					}
				);
				setInterval(function()
				{
					var offset = $("#logo_img").offset().top;
					var height = $("#logo_img").height();

					var num = offset + height;
					num += 20;
					num = parseInt(num);
					num += '';
					$(".admin_prods_tbl").first().css("margin-top", num + 'px');
				}, 10);

				var saveProduct = function(tr)
				{
					tr.css("opacity", "0.1");
					var payload = {};
					payload.identifier = tr.data("identifier");
					payload.name = tr.find("td").first().text();
					payload.img_link = tr.find("td").eq(5).text();
					payload.header = tr.find("td").eq(2).text();
					payload.description = tr.find("td").eq(3).text();
					payload.price = parseFloat(tr.find("td").eq(1).text().replace("$", "")).toFixed(2);
					payload.category = tr.find(".cat").first().find("select").first().val();
					payload.added_field = "foobaredited";

					$.post("{{ route('update_product') }}", payload).done(function(r)
					{
						tr.css("opacity", "1.0");
					});
				};

				$(".name, .price, .header, .description, .img_url").on("dblclick", function()
				{
					var that = $(this);
					that.off("blur");
					that.attr("contenteditable", "true");
					that[0].focus();
					that.on("blur", function()
					{
						saveProduct(that.closest("tr"));
					});
				});
				$(".cat").find("select").change(function()
				{
					var that = $(this);
					saveProduct(that.closest("tr"));
				});
				$("#create_product").click(function()
				{
					var n = window.prompt("What is the name of the product?");
					var p = window.prompt("What is the price (include dollar sign) of this product?");
					var i = window.prompt("What is the URL for the product image?");
					var h = window.prompt("What is the product header?");
					var d = window.prompt("Please type a description");
					var c = "05F70341078ACF6A06D423D21720F9643D5F953626D88A02636DC3A9E79582AEB0C820857FD3F8DC502AA8360D2C8FA97A985FDA5B629B809CAD18FFB62D3899";
					var a = "new product";

					var payload = {};
					payload.name = n;
					payload.img_link = i;
					payload.header = h;
					payload.description = d;
					payload.price = p.replace("$", "");
					payload.category = c;
					payload.added_field = a;

					$.post("{{ route('create_product') }}", payload).done(function(r)
					{
						window.location.reload();
					});
				});
				$(".delete button").click(function()
				{
				    var that = $(this);
				    var identifier = that.closest("tr").data("identifier");
				    var payload = {"identifier": identifier};
				    $.post("{{ route('delete_product') }}", payload).done(function(r)
				    {
				        that.closest("tr").remove();
				    });
				});
			});
		</script>
	</head>
	<body>
		@include('logo')
		<div id="admin_container">
			<table class="admin_prods_tbl">
				<tbody>
					<tr>
						<th>Name</th>
						<th>Price</th>
						<th>Header</th>
						<th>Description</th>
						<th>Category</th>
						<th>Image URL</th>
					</tr>
					<tr>
						<td colspan="7">
							<a href="javascript:void(0);" id="create_product">Create Product</a>
						</td>
					</tr>
					@foreach($prods as $prod)
						<tr data-identifier="{{ $prod['identifier'] }}">
							<td class="name">{{ $prod["name"] }}</td>
							<td class="price">{{ money_format('$%i', $prod["price"]) }}</td>
							<td class="header">{{ $prod["header"] }}</td>
							<td class="description">{{ $prod["description"] }}</td>
							<td class="cat">
								<select class="admin_prod_cat_sel">
									@foreach($cats as $cat)
										<option value="{{ $cat['identifier'] }}" @if($prod["category"] === $cat["identifier"]) selected="selected"@endif>{{ $cat["name"] }}</option>
									@endforeach
								</select>
							</td>
							<td class="img_url">{{ $prod["img_link"] }}</td>
							<td class="delete"><button>Delete Product</button></td>
					@endforeach

				</tbody>
			</table>
		</div>
	</body>
