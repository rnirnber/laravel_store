<img src="https://image.ibb.co/dyuSPT/shopping_cart.png" id="shopping_cart_img" />
<script type="text/javascript">
	$(document).ready(function()
	{
		$("#shopping_cart_img").click(function()
		{
			var that = $(this);
			that.css("opacity", "0.5");
			$.getJSON("/cart", function(r)
			{
				that.css("opacity", "1.0");

				var table = $("<table></table>").attr("id", "shopping_cart_line_item_tbl");
				var tbody = $("<tbody></tbody>");
				var subtotal = 0.0;
				$.each(r, function(i, prod)
				{
					var tr = $("<tr></tr>");
					$("<td></td>").text(prod.name).appendTo(tr);
					$("<td></td>").text("$" + prod.price).appendTo(tr);
					subtotal += parseFloat(prod.price);
					$("<td></td>")
					.append
					(
						$("<img />").addClass("shopping_cart_line_item_img").attr("src", prod.img_link)
					)
					.appendTo(tr);
					tr.appendTo(tbody);
				});
				$("<tr></tr>")
				.append
				(
					$("<td></td>")
					.append
					(
						$("<b></b>").text("Subtotal")
					)
				)
				.append
				(
					$("<td></td>").text("$" + (subtotal + ''))
				)
				.append
				(
					$("<td></td>")
					.append
					(
						$("<button></button>").attr("id", "shopping_cart_close_btn").text("X")
						.click(function()
						{
							$("#shopping_cart_line_item_tbl").remove();
						})
					)
				)
				.appendTo(tbody);
				tbody.appendTo(table);
				table.appendTo($("body"));
				console.log(r);
			});
		});
	});
</script>
