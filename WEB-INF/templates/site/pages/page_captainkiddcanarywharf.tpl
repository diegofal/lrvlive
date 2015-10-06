

<section id="detail" class="captain-kid">
    <div class="intro">


        <img src="content/img/detail/captainkidd/cover-captainkidd.jpg" />

        <div class="facts-container">
            <div class="heading">
                <h1>Captain Kidd's Canary Wharf Voyage</h1>
                <h2>Specially designed for families</h2>
            </div>
            <div class="facts">
                <p>
                    <strong>£37.95</strong><br>
                    Adult<br>
                    (R.R.P £42.00)
                </p>
                <p>
                    <strong>£22.95</strong><br>
                    Children<br>(&lt; 14 years)
                </p>
                <p>
                    <strong>£425.00</strong><br>
                    Charter <br>(per hour)
                </p>
            </div>
            <div class="actions">
                <div class="booknow"></div>

                <button class="btn btn-main md-trigger" tourid="1" data-modal="modal-1"> book this trip  </button>
                <button id="voucherBtn" class="btn btn-secondary md-trigger" voucherid="4" data-modal="modal-1"> buy gift voucher  </button>
            </div>
        </div>
    </div>
    <div class="grid content">

        <div class="col-3-6 first-column">
            <h5>About the trip</h5>
            <p class="lead">Our Captain Kidd’s Canary Wharf voyage is specially designed with families in mind. That said, you can still expect all the thrills and spills that have become the trademark London RIB Voyages experience!</p>
            <p>Let Granny and Granddad show the kids what fun really means – swishing and swooshing over the world’s most famous waterway at an exhilarating 30 knots (35mph!). If the little ones thought they were out for yet another boring sightseeing trip, they’ll soon think again!</p>
            <p>Our friendly, funny tour guides will be your allies on this great adventure, offering the ‘need-to-know’ stories that even Dad didn’t know. And don’t worry – we’ll make sure everyone is wrapped up warm and dry with our top notch sailing gear. </p>
            <p>With super cool music pumping from the in-board speakers, let the kids rock out and roll on. There’ll be selfies galore and memories to cherish on this voyage like no other!</p>
            <p>For the young and for the young at heart, it’s fast, fun and above all safe. Why not treat the family to 50 minutes that’ll last a lifetime. </p>

        </div>

        <div class="col-2-6 third-column">
            <div class="thebox">
                <h5>Featured on</h5>
                <blockquote>
                    <p>"Kids are not usually keen on sightseeing, they’ll no doubt change tune if you offer them a London RIB Voyage"</p>
                    <img src="content/img/brand/express.jpg" alt"Daily Express">
                </blockquote>
                <blockquote>
                    <p>"An amazing trip and the best tour guide I’ve ever listened too"</p>
                    <img src="content/img/brand/fionabruce.jpg" alt"Fiona Bruce, Broadcaster">
                </blockquote>
                <blockquote>
                    <p>"Excellent fun on the Thames or as my nephew (11) described it "awesome""</p>
                    <img src="content/img/brand/tareview.jpg" alt"TripAdvisor Review">
                </blockquote>
            </div>
        </div>

        <div class="col-1-6 second-column">
            <h5>Complimentary information</h5>
            <ul>
                <li><span>50</span> <i>minutes ride</i></li>
                <li><span>22</span> <i>sitepoints</i></li>
                <li><span>35</span> <i>rpm</i></li>
            </ul>
            <div class="attractions">
                <h5>What you will see</h5>
                <ul>
                    <li><span>London Eye</span></li>
                    <li><span>Somerset House</span> </li>
                    <li><span>HMS President</span></li>
                    <li><span>London Bridge</span></li>
                    <li><span>Tate Modern</span></li>
                    <li><span>Shakespeare's Globe</span></li>
                    <li><span>The Gherkin</span></li>
                    <li><span>The Shard</span></li>
                    <li><span>HMS Belfast</span></li>
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