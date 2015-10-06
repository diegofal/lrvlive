		{if $results.status == 'OK'}
			<section id="random-section" class="success">
				<div>
					<h1>Payment process success :)</h1>
					<div class="content">
						<p class="lead">The payment was performed properly.</p>
						<p>If you have any doubt or want to make any question you can contact us:<br>- by phone: <strong>0207 - 928 - 8933</strong><br>- by email: <a href="mailto:bookings@londonribvoyages.com">bookings@londonribvoyages.com</a></p>
					</div>
				</div>
			</section>
        {else}
			<section id="random-section" class="error">
				<div>
					<h1>Something went wrong :(</h1>
					<div class="content">
						<p class="lead">The payment operation could not be performed properly: <strong>{$results.status}</strong></p>
						<p>Try again or contact us<br>- by phone: <strong>0207 - 928 - 8933</strong><br>- by email: <a href="mailto:bookings@londonribvoyages.com">bookings@londonribvoyages.com</a></p>
					</div>
				</div>
			</section>
        {/if}
