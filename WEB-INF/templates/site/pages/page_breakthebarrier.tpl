<section id="detail" class="breakthebarrier">
    <div class="intro">


        <img src="content/img/detail/breakthebarrier/cover-breakthebarrier.jpg" />

        <div class="facts-container">
            <div class="heading">
                <h1>Break The Barrier</h1>
                <h2>It’s Fast, Furious and a World First</h2>
            </div>
            <div class="facts">
                <p>
                    <strong>£39.95</strong><br>
                    Adult
                </p>
                <p>
                    <strong>£31.50</strong><br>
                    Child<br>(10-14 years)
                </p>
                <p>
                    <strong>£75</strong><br>
                    Couple<br>
                    (2 adults)
                </p>
                <p>
                    <strong>£135</strong><br>
                    Family<br>(2+2)
                </p>
                <p>
                    <strong>£435.00</strong><br>
                    Charter <br>(per hour)
                </p>
            </div>
            <div class="actions">
                <div class="booknow"></div>

                <button class="btn btn-main md-trigger" tourid="12" data-modal="modal-1"> book this trip  </button>
                <button id="voucherBtn" class="btn btn-secondary md-trigger" voucherid="9" data-modal="modal-1"> buy gift voucher  </button>
            </div>
        </div>
    </div>
    <div class="grid content">



        <div class="col-3-6 first-column">
            <h5>About the trip</h5>
            <p class="lead">It’s fast, it’s furious, it’s a world first.</p>
            <p>London RIB Voyages launched Break the Barrier in the summer of 2013 and immediately changed the way we power-boat on the Thames. Operating exclusively in the ‘High Speed Zone’ this is the all-new speed experience which is just that – ALL SPEED!</p>
            <p>Boarding at St Katharine Pier in the shadow of the iconic Tower Bridge you set sail to a rousing “Best of British” soundtrack from iconic music to the unmistakable voices of Winston Churchill, Peggy Mitchell, Del Boy, Mayor of London Boris Johnson and many more.</p>
            <p>Before you know it, we let rip! Pushing speeds of up to 30 knots (35mph!) our 12 metre long aero-dynamically designed fiberglass ‘Thames Rocket’ will twist and turn its way east flashing past Canary Wharf, the Cutty Sark, Greenwich and the O2 arena. </p>
            <p>There’s a chance to catch your breath as we cruise through the marvel that is the Thames Barrier, before ‘Pulling G’ and firing up the 630hp engines to blast us home.</p>
            <p>Plenty more music and memories along the way, and with an expert Skipper and award winning guide on hand to keep you entertained this is a jam packed 40 minutes that’ll leave you wanting to turn round and do it all again!</p>
            <p>London RIB Voyages brings you ‘Break the Barrier’... Are you ready?</p>

        </div>

        <div class="col-2-6 third-column">
            <div class="thebox">
                <h5>Featured on</h5>
                <blockquote>
                    <p>"London RIB Voyages, one of the best 10 things to do in the UK"</p>
                    <img src="content/img/brand/sundaytimes.jpg" alt="The Sunday Times"/>
                </blockquote>
                <blockquote>
                    <p>"What a fantastic experience we had"</p>
                    <img src="content/img/brand/exposure.jpg" alt"Exposure Films">
                </blockquote>
                <blockquote>
                    <p>"We had a perfect trip on the Thames in one of these speedboats and it was so much fun. It was extraordinary and very fast!"</p>
                    <img src="content/img/brand/tareview.jpg" alt"TripAdvisor Review">
                </blockquote>
            </div>
        </div>

        <div class="col-1-6 second-column">
            <h5>Complimentary information</h5>
            <ul>
                <li><span>40</span> <i>minutes ride</i></li>
                <li><span>8</span> <i>sitepoints</i></li>
                <li><span>35</span> <i>rpm</i></li>
                <li><span>Three course dining</span></li>
            </ul>
            <div class="attractions">
                <h5>What you will see</h5>
                <ul>
                    <li><span>The Shard</span></li>
                    <li><span>Tower Bridge</span> </li>
                    <li><span>Canary Wharf</span></li>
                    <li><span>Greenwich University</span></li>
                    <li><span>Royal Observatory</span></li>
                    <li><span>Cutty Sark</span></li>
                    <li><span>O2 Arena</span></li>
                    <li><span>Thames Barrier</span></li>
                </ul>
                <a href="map.php" class="viewmore">View all</a>
            </div>
        </div>

    </div>

</section>

<br/><br/><br/><br/>

{if $openVoucher == 1}
{literal}
    <script>
        $(document).ready(function(){
            setTimeout(
                    function()
                    {
                        $('#voucherBtn').click();
                    }, 1000);

        })
    </script>
{/literal}
{/if}