<div class="contact">

	<div class="column send-message">
		<div class="heading">
			<h3>drop a line</h3>
		</div>

		<form action="/php/ajax-adapter.php?controller=contact&action=sendmessage" accept-charset="utf-8" method="POST" >
			<input type="text" placeholder="name" class="name" name="name" id="contact_name">
			<input type="text" placeholder="email" class="email" name="email" id="contact_email">
			<textarea class="enquiry" placeholder="enquiry" name="enquiry"></textarea>
			<input type="submit" value="submit" class="submit">
		</form>

		<div class="success">
			form successfully sent!
		</div>

		<div class="fail">
			something went wrong. please send an email.
		</div>

	</div>
	<div class="column connect">
		<div class="heading">
			<h3>connect</h3>
		</div>
		<div class="connections">
			<div class="connection">
				<h4>email</h4>
				<a href="mailto:stephanlindauer@posteo.de">stephanlindauer@posteo.de</a>
			</div>
			<div class="connection">
				<h4>skype</h4>
				<a href="skype:stephanlindauer?chat">stephanlindauer</a>
			</div>
			<div class="connection">
				<h4>call me, maybe?</h4>
				<a href="tel:+49015739239631"> +49 (0)157 392 396 31 </a>
			</div>
            <div class="connection">
                <h4>xmpp</h4>
                <a href="xmpp:steph@jabber.ccc.de?message">steph@jabber.ccc.de</a>
            </div> 
		</div>

	</div>
	<div class="column location">
		<div class="heading">
			<h3>location</h3>
		</div>

		<div class="map">
			<span> 
				<a href="https://maps.google.de/maps?q=berlin+neuk%C3%B6lln&hl=en&ie=UTF8&safe=off&hnear=Neuk%C3%B6lln&gl=de&t=h&z=12" target="_blank">berlin-neukölln, germany</a>
			</span>
		</div>
	</div>
</div>

<script>
	main.postponedExcecution = function() {

		$(".contact form input[type='submit']").unbind('click');

		$(".contact form input[type='submit']").on("click", function(event) {
			event.preventDefault();

			$(this).attr("value", "sending...");

			$(this).css({
				"background-color" : "#191919"
			});

			var url = "/php/ajax-adapter.php?controller=contact&action=sendmessage";

			$.ajax({
				type : "POST",
				url : url,
				data : $(".contact form").serialize(),

				success : function(data) {

					if (data === "success") {
						$(".contact form").animate({
							'height' : "0px"
						});
						$(".contact .success").css({
							"display" : "block"
						}).animate({
							'opacity' : 1
						});
					} else {
						$(".contact .fail").css({
							"display" : "block"
						}).animate({
							'opacity' : 1
						});
					}
				}
			});
			return false;
		});

	}; 
</script>
