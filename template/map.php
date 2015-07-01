
<?php include 'head.php';?>

<?php include 'menu.php';?> 

<section id="map" class="full-screen grid">
	<div id="controls" class="">
		<div id="controls-tabs"></div>
	</div>
	<div id="gmap-tabs" class="col-6-6 no-pad"></div>
	<div class="info-container"></div>
	<div id="info"></div>
</section>

<?php include 'scripts.php';?>

<script type="text/javascript">
$(function() {

	    var LocsB = [
				    {
				        lat: 51.503363,
				        lon:  -0.119534,
				        title: 'The London Eye',
				        html: [
				            '<h3>The London Eye </h3>',
				            '<p class="lead">Or as we like to call it - home! This is where you&#39;ll be whizzing out on your London RIB Voyage, and we think it&#39;s the perfect base.  443 feet tall and 394 feet in diameter, the London Eye is the most successful tourist attraction in the UK, with 30 million people riding the London Eye since March 2000.</p>',
				            '<img src="content/img/map/londoneye.jpg"/>',
							'<p>Considering it began with a temporary 5-year planning permission, we think our neighbours have created an extraordinary bit of history! 32 pods represent the 32 boroughs that make up this city as a whole, each offering the awesome sight of London&#39;s famous skyline.</p>',
							'<p>The London Eye has become a centrepoint for New Years Eve celebrations and the firework displays as Big Ben chimes in the new year are unrivalled. Although a famous British landmark, the construction employed companies from all over Europe, including France, Germany, Italy, the Netherlands and Czech Republic, and there are now similar attractions all around the world &#8211; as far as Singapore &#8211; proving the universal appeal of this unique experience.</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark1.png'
				    },
				    {
				        lat: 51.505523,
				        lon:   -0.075168,
				        title: 'Tower Bridge',
				        html: [
				            '<h3>Tower Bridge</h3>',
				            '<p class="lead">To see this bridge open in the centre archway for the first time in 1894 must have been an amazing sight. </p>',
				            '<img src="content/img/map/towerbridge.jpg"/>',
				            '<p>To be honest, we think it still is! It still happens, particularly at weekends, so if you are lucky you may even get to watch this spectacular event on your voyage with us. You’ve got to hand it to the Victorians – they knew how to build! You will see their stamp all over London.</p>',
				            '<p>Parliament, Tower Bridge and the embankment of the river is all their amazing work. The towers of the bridge were designed to be in keeping with the look of the Tower of London and for much of its life the bridge was painted brown! It was the silver jubilee of 1977 when we decided to update the colours to that of the British flag. The walkway at the top was originally for pedestrians. The cumbersome nature of climbing to the top and down again just to cross the river proved unpopular and were closed in 1910. In 1982, 2 years before it&#39;s 100th birthday, they were reopened as part of the Tower Bridge Experience giving visitors the chance to explore how and why the bridge was built, and to experience the steam room that originally powered the opening of the bridge.</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark2.png'
				    },
				    {
				        lat: 51.500876, 
				        lon:  -0.124614,
				        title: 'Houses of Parliament',
				        html: [
				            '<h3>Houses of Parliament</h3>',
				            '<p class="lead">The awesome Victorian façade of this English Gothic Perpendicular Architecture (now that&#39;s a mouthful!) is sure to take your breath away from our particular vantage point on the river.</p>',
				            '<img src="content/img/map/parliament.jpg"/>',
				            '<p>See if you can spot the Lord&#39;s Prayer written in Latin carved into the stonework all around the outside. Built against the river under the instruction of the Duke of Wellington in order to protect the building being surrounded by the mob (probably a wise decision), this has got to be one of the greatest Victorian masterpieces in London. </p>',
				            '<p>A record breaker in its day, the Victoria Tower opposite Big Ben was the largest stone square tower in the world when the Victorians built it – another example of their incredible feats of engineering, many of which you will see from your unique view in your very own speedboat! Home of the House of Lords and the House of Commons, there are over 3 miles of corridor inside – which must be why it takes so long to get anything done in government!</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },{
				        lat: 51.500727,
				        lon: -0.124526,
				        title: 'Big Ben',
				        html: [
				            '<h3>Big Ben</h3>',
				            '<p class="lead">The quintessential British landmark – Big Ben has been telling London the time since 31st May 1859. That&#39;s because it is not the tower that is named Big Ben, it is the huge 13.5 tonne bell within. </p>',
				            '<img src="content/img/map/bigben.jpg"/>',
				            '<p>If you&#39;re lucky enough to pass on the hour you will hear the Westminster Bells singing out Handel&#39;s Messiah followed by the unmistakable first chime which is required to be correct to within one second.</p>',
				            '<p>Look closely and you may notice the tower leans slightly. It&#39;s not an optical illusion! This was due to the construction of the Jubilee line that runs right below it knocking it off its foundations.</p>',
				            '<p> Luckily, it still stands as sign of London’s resilience. After celebrating her Diamond Jubilee in 2012 the tower was renamed in the Queen&#39;s honour and is now officially known as the Elizabeth Tower. You cannot travel around London without hearing the famous bell within.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.508501,
				        lon: -0.120105,
				        title: 'Cleopatras Needle',
				        html: [
				            '<h3>Cleopatras Needle</h3>',
				            '<p class="lead">The quintessential British landmark – Big Ben has been telling London the time since 31st May 1859. That&#39;s because it is not the tower that is named Big Ben, it is the huge 13.5 tonne bell within. </p>',
				            '<img src="content/img/map/cleopatra.jpg"/>',
				            '<p>Standing on the north bank of the Thames is one of the oldest things you will see in London (other than the river of course!). This is Cleopatra&#39;s needle. Dated at over 3500 years old, it was given as a present from the ruler of Sudan (named Mohammed Ali &#8211; no relation!) to Nelson for his part in the Battle of the Nile 1798.</p>',
				            '<p>Look carefully and the Egyptian Hieroglyphics are still visible today! A time capsule was buried at the base of the needle by the Victorians. It includes: a set of 12 photographs of the best looking English women of the day, a box of hairpins, a box of cigars, several tobacco pipes, a set of imperial weights, a baby&#39;s bottle, some children&#39;s toys, a shilling razor, a hydraulic jack and some samples of the cable used when installing the needle, a 3&#39; bronze model of the monument, a complete set of British coins, a rupee, a portrait of Queen Victoria, a written history of the strange tale of the transport of the monument, plans on vellum, a translation of the inscriptions, copies of the bible in several languages, a copy of John 3:16 in 215 languages, a copy of Whitaker&#39;s Almanack, a Bradshaw Railway Guide, a map of London and copies of 10 daily newspapers..</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.511052, 
				        lon: -0.116826,
				        title: 'Somerset House',
				        html: [
				            '<h3>Somerset House</h3>',
				            '<p class="lead">A rather nice place to live we think! Certainly for the Duke of Somerset who began building his dream palace in 1547.</p>',
				            '<img src="content/img/map/somerset.jpg"/>',
				            '<p>This area proved a very strategic home for ambitious nobles, being placed perfectly on the thoroughfare between the Tower of London and the Palace of Westminster. Unfortunately, the Duke had upset quite a few people with the demolition of churches and chapels to create his mansion, and he was finally overthrown and beheaded for treason on Tower Hill in January 1552. Falling into the hands of the crown, Somerset House soon became a centre of royal social and artistic life. </p>',
				            '<p>Elizabeth I, James I, and Charles I all enjoyed life at this Tudor Palace. Oliver Cromwell was laid in state here 	in 1658 and the Palace even escaped the clutches of the Great Fire of 1666, which stopped just short of the site. 100 years later, and Somerset House was a shadow of its former glory. Falling into disrepair, George III ordered the demolition of the Palace and relocated the official dower house of the queen to Buckingham House.</p>',
				            '<p>The rebuilding of the House resulted in what you see today. The courtyard plays host to an ice rink in the winter and an outdoor cinema in the summer &#8211; keeping its original traditions of social and artistic life very much alive!</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.508360,
				        lon:  -0.108123,
				        title: 'OXO Tower',
				        html: [
				            '<h3>OXO Tower</h3>',
				            '<p class="lead">The OXO Tower looks rather elegant for an ex-power station. Today it is home to the glorious Harvey Nichols restaurant along the top floor and interesting boutique shops along the bottom.</p>',
				            '<img src="content/img/map/oxo.jpg"/>',
				            '<p>You may be surprised to learn the apartments in the middle are all council flats! Controversy surrounded the famous logo on the tower when the architect, Albert Moore, was refused permission to advertise the product being made in the building during the 1920&#39;s. His answer? He installed a set of square and triangular windows on each side. When the lights were switched on somehow they managed to spell out the name &#39;OXO&#39;!</p>',
				            '<p>When cornered, Albert Moore blamed coincidence and managed to get away with it, leaving the iconic tower proudly displaying the illegal advert. Get yourself a table in the restaurant bar one evening and enjoy a cocktail while watching the sunset over St Paul&#39;s Cathedral.</p>',
				            '<p>You might even see us whizzing by far below…</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.510689, 
				        lon: -0.108468,
				        title: 'HMS President',
				        html: [
				            '<h3>HMS President</h3>',
				            '<p class="lead">The ship that now sits here on the Thames as a bar and venue hire has had a very covert past! This was a Q-Ship during WWI. Impressively, it is one of the only three surviving warships built by the Royal Navy for that conflict.</p>',
				            '<img src="content/img/map/hms.jpg"/>',
				            '<p>Built specifically for anti-submarine warfare her successors evolved into todays frontline Frigates. As a Q-Ship it was an undercover ship. When submarine attacks on British merchant ships became a serious menace after 1916, the existing Flower-class minesweepers were transferred to convoy escort duty, and fitted with depth charges as well as 4.7-inch naval guns. </p>',
				            '<p>They were designed to look like merchant ships, while carrying concealed 4-inch and 12-pounder naval guns. U boats would dive at the sight of a warship, so these undercover vessels posing as merchant ships could approach close enough to unveil its true identity! Today the ship plays host to weddings, birthdays and many other special occasions.</p>',
				            '<p>It stands as a quiet reminder of the crafty side of naval warfare, which was so vital in the success of our famous maritime nation.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.513862, 
				        lon:  -0.098367,
				        title: 'St Paul&#39;s Cathedral',
				        html: [
				            '<h3>St Paul&#39;s Cathedral</h3>',
				            '<p class="lead">Well what can you say?! The masterpiece of the genius of Christopher Wren &#8211; the architect we traditionally thank for rebuilding London after the Great Fire off 1666, which destroyed two thirds of the medieval city.</p>',
				            '<img src="content/img/map/stpauls.jpg"/>',
				            '<p>The blaze took down the old St Paul&#39;s on the same site, and it fell to Wren to build something bigger and better than ever before. We think he did a rather good job! Wren is today buried in the crypt he designed. Blink and you 	miss him though &#8211; a small square plaque on the floor. But it&#8217;s the crafty epitaph, "Reader, if you seek my monument, look around you" which gives Wren the last laugh!</p>',
				            '<p>Home to some of the biggest public ceremonies including Charles and Diana&#39;s wedding in 1981 to Margaret Thatcher&#39;s funeral in 2013.</p>',
				            '<p>Climb to the top of the dome to stand 365 feet over London (one foot for every day of the year) and it&#8217;s hard not to appreciate the rich and diverse architecture we are so lucky to have.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    
				    {
				        lat: 51.509536,
				        lon:  -0.098569,
				        title: 'Millennium Bridge',
				        html: [
				            '<h3>Millennium Bridge</h3>',
				            '<p class="lead">The same &#39;Mr Tate&#39; of &#39;Tate and Lyle&#39; sugar fame opened the Tate Britain way back in the 1880&#39;s for his classical art collection. What is housed here in the old Bankside powerstation is its up-to-date younger brother.</p>',
				            '<img src="content/img/map/milleniumbridge.jpg"/>',
				            '<p>The Tate Modern is Britain&#39;s home of modern art, and whether it&#39;s an unmade bed you are looking at or a Dali painting, the collection here boasts something for everyone. Free e30ry means it is a must-do on anyone&#39;s itinerary, making it the most visited modern art gallery in the world with around 4.7 million visitors every year!</p>',
				            '<p>Linking the Tate Modern with St Paul&#39;s Cathedral on the other side of the river is the Millennium Bridge. As super stylish as some of the exhibits in the gallery, the opening of the bridge was marred with embarrassment when the walking rhythm of the first pedestrians to cross caused the faulty bridge to wobble uncontrollably.</p>',
				            '<p>Imaginatively dubbed &#39;the wobbly bridge&#39;, it was closed and finally opened 2 years late in 2002. Whoops! It may look familiar to any Harry Potter fans onboard as it featured in the 2009 film &#39;Harry Potter and the Half-Blood Prince&#39; where it was shown to be destroyed following an attack by Death Eaters! Don’t worry. If they turn up again we&#39;re sure to outrun them.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.507595,
				        lon: -0.099125,
				        title: 'Tate Modern',
				        html: [
				            '<h3>Tate Modern</h3>',
				            '<p class="lead">The same &#39;Mr Tate&#39; of &#39;Tate and Lyle&#39; sugar fame opened the Tate Britain way back in the 1880&#39;s for his classical art collection. What is housed here in the old Bankside powerstation is its up-to-date younger brother.</p>',
				            '<img src="content/img/map/tate.jpg"/>',
				            '<p>The Tate Modern is Britain&#39;s home of modern art, and whether it&#39;s an unmade bed you are looking at or a Dali painting, the collection here boasts something for everyone. Free e30ry means it is a must-do on anyone&#39;s itinerary, making it the most visited modern art gallery in the world with around 4.7 million visitors every year!</p>',
				            '<p>Linking the Tate Modern with St Paul&#39;s Cathedral on the other side of the river is the Millennium Bridge. As super stylish as some of the exhibits in the gallery, the opening of the bridge was marred with embarrassment when the walking rhythm of the first pedestrians to cross caused the faulty bridge to wobble uncontrollably.</p>',
				            '<p>Imaginatively dubbed &#39;the wobbly bridge&#39;, it was closed and finally opened 2 years late in 2002. Whoops! It may look familiar to any Harry Potter fans onboard as it featured in the 2009 film &#39;Harry Potter and the Half-Blood Prince&#39; where it was shown to be destroyed following an attack by Death Eaters! Don’t worry. If they turn up again we&#39;re sure to outrun them.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.508075, 
				        lon:  -0.097187,
				        title: 'Shakespeare&#39;s Globe',
				        html: [
				            '<h3>Shakespeare&#39;s Globe</h3>',
				            '<p class="lead">Ah, Shakespeare&#39;s Globe, the only building in London today since the Great Fire of 1666 that is allowed by law a thatch roof in its construction. </p>',
				            '<img src="content/img/map/shakespeare.jpg"/>',
				            '<p>In that sense, this is a real snapshot of Tudor London and a visit here is not only a chance to see Shakespeare at it&#39;s very best, but also to immerse yourself in an environment where his plays were performed for the first time. Unfortunately this is not the original. The first Globe theatre was destroyed in 1613. We wanted to celebrate the King&#39;s arrival to a show and we thought what better way in a wooden and thatch building than to fire a load of cannons.</p>',
				            '<p>What could possibly go wrong?! Yes you guessed it - we burnt it down. It was really embarrassing! 400 years later this exact replica was the work of the American actor Sam Wannamaker.</p>',
				            '<p>Unfortunately he never saw it completed in 1997 but it is a hugely valued and now iconic part of London&#39;s famous South Bank and with tickets as little as £5 you&#39;d be mad not to indulge in a little culture from this country&#39;s greatest ever playwright.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.506942, 
				        lon: -0.090279,
				        title: 'Golden Hinde',
				        html: [
				            '<h3>Golden Hinde</h3>',
				            '<p class="lead">The Golden Hinde sits next to Southwark Cathedral and is an exact replica of the vessel that Sir Francis Drake sailed around the world on between 1597 and 1580. The first Englishman to ever circumnavigate the globe, he was knighted by Queen Elizabeth I on 4th April 1581. Celebrated by school syllabuses as a hero of Elizabethan England!</p>',
				            '<img src="content/img/map/golden.jpg"/>',
				            '<p>That is until you look closer. On his expedition he managed to &#39;acquire&#39; &#163;600,000 &#8211; which is many millions by today&#39;s standards. In fact, he cleared our national debt by stealing it from the rest of the world. Abroad he is a villain! Yet here, he&#39;s a bona fide British a hero.</p>',
				            '<p>Today the replica offers a glimpse into life on an Elizabethan sea vessel. Open for tours and educational experiences, it is a far cry from today&#39;s power-driven boats. The Golden Hind was originally known as the Pelican and was renamed in mid-voyage (1577) by Drake as he prepared to enter the Straits of Magellan.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.507872,
				        lon:   -0.087748,
				        title: 'London Bridge',
				        html: [
				            '<h3>London Bridge</h3>',
				            '<p class="lead">The current version of London Bridge was designed by engineer John Rennie and completed by his son (of the same name) over a seven-year period from 1824 to 1831.</p>',
				            '<img src="content/img/map/londonbridge.jpg"/>',
				            '<p>The Bridge was constructed from Dartmoor granite, with a length of 928 feet and a width of 49 feet. It was widened in 1902-1904 in an attempt to combat London&#39;s chronic traffic congestion.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    
				    {
				        lat: 51.510143, 
				        lon:  -0.085937,
				        title: 'Monument',
				        html: [
				            '<h3>Monument</h3>',
				            '<p class="lead">London is a city of survival. With 2000 years of human history it is inevitable that our capital was going to run into a few problems along the way.</p>',
				            '<img src="content/img/map/monument.jpg"/>',
				            '<p>In September 1666 one of our most famous disasters struck changing the face of London forever. The King&#39;s baker, Thomas Farriner, left kindling alight as he retired for the night. It wasn&#39;t long before the wood and thatch building was on fire. An easterly breeze pushed the fire into the city and the rest is history! 13,200 houses, 87 parish churches, the old St Paul&#39;s Cathedral and most of the buildings of the City authorities disappeared in a conflagration that lasted 4 days and 4 nights.</p>',
				            '<p>The Monument now stands the same distance as it&#39;s height from the site on Pudding Lane where the bakers	shop was, and serves as a reminder of London&#39;s ability to rebuild itself. Still an observation deck today with the golden urn of flames at the top creating the impression of an everlasting candle – this is yet another contribution from Christopher Wren to the re-establishment of the London skyline. </p>',
				            '<p>It is still today the tallest isolated stone column in the world and a real testament to the resilience of Londoners to use disaster as a springboard for achievement.  </p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.504487, 
				        lon: -0.086505,
				        title: 'The Shard',
				        html: [
				            '<h3>The Shard</h3>',
				            '<p class="lead">Many people who visit the capital comment that one of its greatest charms is the diversity of the architecture. From one building to the next you can travel hundreds of years. </p>',
				            '<img src="content/img/map/theshard.jpg"/>',
				            '<p>The Shard Tower is our latest addition to the London skyline, and it&#39;s easy to imagine you are looking into the future!</p>',
				            '<p>The broken top creates the impression of a huge shard of glass rising up out of the capital. The tallest building in the European Union towers at 1016ft from base to tip. It&#39;s on the 72nd floor on the Shard&#39;s observation deck you can enjoy views as far as the English Channel over 50 miles away!</p>',
				            '<p>Filled with offices, leisure complexes, retail space, hotels and residences, the Shard is a vertical city in the middle of London. If you fancy one of 	the luxury apartments it&#39;ll set you back a mere &#163;50million. And if you dare travel the 72 floors to the top deck don&#39;t forget to give us a wave.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.508860, 
				        lon: -0.083941,
				        title: 'Old Billingsgate Fish Market',
				        html: [
				            '<h3>Old Billingsgate Fish Market</h3>',
				            '<p class="lead">New Billingsgate is near Canary Wharf and not nearly so beautiful as the old building. Fish tell us the wind direction from this building as they dive from the roof!</p>',
				            '<img src="content/img/map/billingsgate.jpg"/>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.506572, 
				        lon: -0.081351,
				        title: 'HMS Belfast',
				        html: [
				            '<h3>HMS Belfast</h3>',
				            '<p class="lead">This is one of the most significant battle-ships of our recent history. It&#39;s 6th June 1944. 06:30. As the sun rises one of the most important events of modern history is about to take place. It would become known as D-day. HMS Belfast was the largest ship in the British fleet and it&#39;s these guns, with a range of 12.5 miles, which started firing at Hitler&#39;s troops on that historic day. </p>',
				            '<img src="content/img/map/hms-belfast.jpg"/>',
				            '<p>During the five-week bombardment of German troops in Normandy, Belfast fired 1,996 rounds from her 6-inch guns. The name is of course from the capital city of Northern Ireland and the port it was built in was incidentally the same port as the Titanic! Thankfully its career has been much more successful than its peer and you can visit the museum ship at its permanent mooring here next to Tower Bridge.</p>',
				            '<p>From our twelve-seater RIB seeing the ominous fa&#231;ade of the hull up close proves what an awesome and mighty warship this once was. You&#8217;ll notice it&#39;s much friendlier today so don&#8217;t forget to wave at the visitors as they enviously look down! </p>',
				            '<p>With over 250,000 visitors per year HMS Belfast has proved to be a hugely popular glimpse into a small part of this nations rich maritime history.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.514479,
				        lon:  -0.080301,
				        title: 'The Gherkin',
				        html: [
				            '<h3>The Gherkin</h3>',
				            '<p class="lead">Now a staple of the London skyline, 30 St Mary&#39;s Axe, more commonly known as &#39;The Gherkin&#39;, was opened at the end of May 2004. Designed to maximise daylight and reduce the need for artificial light, with reduced carbon dioxide emissions and energy use due to its aerodynamic form, this is an all green super slick construction by the seemingly ubiquitous Norman Foster. </p>',
				            '<img src="content/img/map/gherkin.jpg"/>',
				            '<p>It&#39;s over 3 times the height of Niagra Falls, and surprisingly there is only one piece of curved glass – the lens at the top of the building. The rest are smaller, flat panels giving the illusion of a curved structure.</p>',
				            '<p>During construction the grave of a Roman girl was discovered on the site. She was sheltered in the Museum of London during construction, and returned once work was completed.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.504834,
				        lon:  -0.078631,
				        title: 'GLA Building',
				        html: [
				            '<h3>GLA Building</h3>',
				            '<p class="lead">Another unusual design here, City Hall sits next to Tower Bridge on the edge of a larger development known as More London comprising of offices and shops. It is here that our most eccentric Englishman - Boris Johnson &#8211; cycles to work everyday. </p>',
				            '<img src="content/img/map/gla.jpg"/>',
				            '<p>Boris is our Mayor of London, and he works here along with the London Assembly together forming the Greater London Authority. Look carefully and you can see most of the building contains stairs! A huge spiral staircase runs right through the central chamber. </p>',
				            '<p>It was meant to symbolise transparency, although many Londoners would question the reflected transparency of the Mayor himself! The building has spawned many nicknames due to it&#39;s unusual shape, including: Darth Vader&#39;s Helmet; the Misshapen Egg; the Woodlouse; the Motorcycle Helmet and from Boris himself; the Glass Gonad! </p>',
				            '<p>You cannot deny the impact from our vantage point of City Hall representing modern London on one side of the river, compared to the stoic and ominous front of the Tower of London squared up on the other side. The spectrum of time is palpable here and it&#39;s a real display of 1000 years of evolving London separated by a just a small stretch of water and just a few metres apart!</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.508119, 
				        lon: -0.075708,
				        title: 'Tower of London',
				        html: [
				            '<h3>Tower of London</h3>',
				            '<p class="lead">What&#39;s the most famous date in British history? 1066. The race for the English Crown after the death of the childless Edward the Confessor came to a head at the Battle of Hastings, where William the Conqueror became the last person to ever successfully invade Britain. </p>',
				            '<img src="content/img/map/toweroflondon.jpg"/>',
				            '<p>He needed to quickly stamp his authority on the Saxon town and he did it with this &#8211; a mighty palace and fortress that was to stand the test of time and become the most enduring and historic site in London.</p>',
				            '<p>The Tower has survived every major disaster in London and been in some way related to nearly every major event over its 1000 year lifetime. With a lifetime to last a millennium it is inevitably going to be used for a huge range needs. The Tower has been home to the royal treasury, the royal mint, London Zoo, an armoury and a place of execution and torture, to name but a few. You will see the entry to the traitors gate from our RIB where the accused were brought to be imprisoned and eventually executed.</p>',
				            '<p>Home of the Crown Jewels today and probably the most important 	thing you should do in London (apart from a London RIB Voyage of course!), the Tower continues to be a fascinating anchor to an event that was to shape the way we live to this day.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.505523,
				        lon:   -0.075168,
				        title: 'Tower Bridge',
				        html: [
				            '<h3>Tower Bridge</h3>',
				            '<p class="lead">To see this bridge open in the centre archway for the first time in 1894 must have been an amazing sight. </p>',
				            '<img src="content/img/map/towerbridge.jpg"/>',
				            '<p>To be honest, we think it still is! It still happens, particularly at weekends, so if you are lucky you may even get to watch this spectacular event on your voyage with us. You’ve got to hand it to the Victorians – they knew how to build! You will see their stamp all over London.</p>',
				            '<p>Parliament, Tower Bridge and the embankment of the river is all their amazing work. The towers of the bridge were designed to be in keeping with the look of the Tower of London and for much of its life the bridge was painted brown! It was the silver jubilee of 1977 when we decided to update the colours to that of the British flag. The walkway at the top was originally for pedestrians. The cumbersome nature of climbing to the top and down again just to cross the river proved unpopular and were closed in 1910. In 1982, 2 years before it&#39;s 100th birthday, they were reopened as part of the Tower Bridge Experience giving visitors the chance to explore how and why the bridge was built, and to experience the steam room that originally powered the opening of the bridge.</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark2.png'
				    },
				    {
				        lat: 51.503013, 
				        lon: -0.060129,
				        title: 'Wapping Police Station',
				        html: [
				            '<h3>Wapping Police Station</h3>',
				            '<p class="lead">This is the current home of the Wapping River Police, so please act naturally as we slow down to get past! They are the oldest police force on record dating from 1798! </p>',
				            '<img src="content/img/map/wappingpolice.jpg"/>',
				            '<p>Setup originally to tackle looting and theft from ships in the pool of London, today the River Police are an invaluable team maintaining law and order on the greatest waterway in the world!</p>',
				            '<p>Today&#8217;s problems must differ greatly from those of their eighteenth century counterparts. Be sure to look at their super modern fast patrol launches (these are capable of over 40 knots!), which have replaced the original rowing galleys.</p>',
				            '<p>Officers are more likely to be involved in "Counter Terrorism" patrols or people stuck on the beaches as the tide comes in rather than preventing pirates looting the river&#39;s trade ships. However, the dark and murky waters of the Thames are still policed on a twenty four hour a day basis by traditional London "Bobbies" and to the people who live and work on the Thames they are still simply known as "The Thames River Police" </p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.505534,
				        lon: -0.027857,
				        title: 'Canary Wharf',
				        html: [
				            '<h3>Canary Wharf</h3>',
				            '<p class="lead">This is the other major financial district of London. Canary Wharf is home to some of the tallest buildings in the UK. These are the world or European headquarters of some of the worlds major banks, professional services firms and media organisations including Barclays, Citigroup,Clifford Chance, Credit Suisse, Fitch Ratings, HSBC, J.P. Morgan, KPMG, MetLife, Morgan Stanley, Skadden, State Street and Thomson Reuters.</p>',
				            '<img src="content/img/map/canary.jpg"/>',
				            '<p>One Canada Square is the tallest building here, and was the tallest building in the United Kingdom from 1990 until 2010 when the construction of the Shard Tower overtook the record.</p>',
				            '<p>If you don&#39;t recognize it, think again! It has been featured in many cinema and television shows including The World is not Enough, The Bourne Supremacy, Harry Potter and the Order of the Phoenix, 28 Weeks Later, Johnny English, Doctor Who, Torchwood, The Apprentice and Eastenders.</p>',
				            '<p>In fact, the area of Canary Wharf has boomed ever since its construction in the 1980&#39;s and is well worth a visit if you are thinking about experiencing some of the outskirts of the main city. </p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.505534,
				        lon: -0.027857,
				        title: 'Cutty Sark',
				        html: [
				            '<h3>Cutty Sark</h3>',
				            '<p class="lead">Here on the waterside at Greenwich sits one of the fastest clipper ships of the Victorian age. The opening of the Suez Canal in 1869 meant the race was on to transport tea &#8211; a highly sought after item - to Britain&#39;s shores. </p>',
				            '<img src="content/img/map/cutty.jpg"/>',
				            '<p>In those days, the  ship arriving with the first tea of the year receiving a substantial bonus there was a lot riding on the safe but speedy passage of the ship and crew. It was the Cutty Sark that always came out on top, taking just 117 days for a round trip.</p>',
				            '<p>On 21st May 2007, a fire tore through the ship leaving most of it damaged. It was discovered the cause of the fire was due to a cleaner leaving a hoover running! Huge restoration work ensued at a cost of &#163;50million and the new Cutty Sark was unveiled in April 2012.</p>',
				            '<p>Opened by the Queen &#8211; a familiar ceremony as the Queen opened the 19th century tea clipper exhibit in 1957. Unusually the name &#39;Cutty Sark&#39; is Scottish slang for &#39;short undergarments&#39;! And if you look carefully you may see the figurehead. </p>',
				            '<p>The lady is a witch called &#39;Nanny&#39; from a famous Robert Burns poem. Why? Well the Cutty Sark was launched from Dumbarton in Scotland.</p>'

				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.483308,
				        lon: -0.003965,
				        title: 'Greenwich University',
				        html: [
				            '<h3>Greenwich University</h3>',
				            '<p class="lead">Welcome to the heart of Britain&#8217;s maritime history! Look at the glorious buildings of the Old Royal Naval College designed by none other than Christopher Wren (that bloke who designed St Paul&#39;s). Greenwich is a royal borough and it was on this site the Palace of Palentia once stood.</p>',
				            '<img src="content/img/map/green-univ.jpg"/>',
				            '<p>This was the home of the Tudors, with Henry VIII, Mary I and Elizabeth I all being born in Greenwich. Greenwich Park was a hunting ground for Henry, one of our most famous Kings and on the distant tree line from your RIB you can see the Royal Observatory.</p>',
				            '<p>A wonderful, vibrant market town today, Greenwich retains its royal roots mixed with modern trend cementing its place as one of the most important historical areas beyond the Cities of London and Westminster.</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },
				    {
				        lat: 51.476846,
				        lon: -0.000504,
				        title: 'Greenwich Observatory',
				        html: [
				            '<h3>Greenwich Observatory</h3>',
				            '<p class="lead">Today Greenwich is famous as the home of the line of longitude that runs right through the observatory itself. In fact, you will pass from the western hemisphere to the eastern hemisphere with us! King Charles II commissioned the building in 1675, and also created the role of Astronomer Royal.</p>',
				            '<img src="content/img/map/green-village.jpg"/>',
				            '<p>The post was appointed to John Flamsteed under the order to "apply himself with the most exact care and diligence to the rectifying of the tables of the motions of the heavens, and the places of the fixed stars, so as to find out the so much desired longitude of places for the perfecting of the art of navigation.</p>',
				            '<p>So without Flamsteed and the observatory, we wouldn&#39;t be able to travel here at all on our super slick RIB&#39;s! Today the buildings include a museum of astronomical and navigational tools, which is part of the National Maritime Museum, and is open to the general public throughout the year. Not only that, but the views from the top of the hill are quite amazing!</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },{
				        lat: 51.503005,
				        lon:  0.003202,
				        title: 'O2 Arena',
				        html: [
				            '<h3>O2 Arena</h3>',
				            '<p class="lead">Built as the Millennium Dome to celebrate the start of the third millennium with a huge exhibition, the dome opened to the public on time on 1st January 2000. Unfortunately, visitor numbers didn&#39;t reach anticipated figures and the dome faced an uncertain future after its first year. Huge redevelopment ensued and on the 24st June 2007 the rebranded O2 arena opened its doors with a huge concert from Bon Jovi. </p>',
				            '<img src="content/img/map/o2.jpg"/>',
				            '<p>It showcased the 20,000 capacity arena in the heart of the dome and has become the venue of choice for stadium performances in London. </p>',
				            '<p>Some of the biggest names in music have performed here including AC/DC, Rod Stewart, Tina Turner, The Rolling Stones, Paul McCartney, Led Zeppelin, Kylie Minogue, Justin Timberlake, Guns N&#8217; Roses, Bob Dylan, Queen and Metallica to name just a handful! Up At The O2 opened in 2012, offering visitors the chance to walk on a specially designed walkway over the dome itself. The dome has a diameter of 365 metres, a height of 52 metres and 12 &#39;needles&#39; sticking out the top representing time itself &#8211; 365 days in the year, 52 weeks and 12 months respectively.</p>',
				            '<p>With many attractions inside including shops, restaurants, bars, exhibitions, the IndigO2 arena for more intimate gigs and a cinema you won&#8217;t be short of finding something to do in this area of Greenwich that has been completely reshaped by this celebration of the millennium.</p>'
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },{
				        lat: 51.495770, 
				        lon: 0.037359,
				        title: 'Thames Barrier',
				        html: [
				            '<h3>Thames Barrier</h3>',
				            '<p class="lead">The reason London is in existence (and London RIB Voyages for that matter!) is the river. No river, no London. It is how London has made money and grown by trading with Europe.</p>',
				            '<img src="content/img/map/thames.jpg"/>',
				            '<p>But with an 8 metre difference in the tide happening twice every day, it has always been London&#39;s biggest threat at the same time. Flooding has proved problematic over the centuries. In fact it wasn&#8217;t until the great North Sea flood of 1953 where the land death toll reach 307 that we started thinking about a substantial defence system. </p>',
				            '<p>Cue the Thames Flood Barrier! This is the second largest flood defence system in the world and has undoubtedly played a huge part in the protection of London since its opening in 1984.</p>',
				            '<p>As we cruise through in our intimate RIB ride you can see up close the huge mechanisms in between each island ready to turn and bring up the huge defences that are buried into the riverbed. Costing over &#163;500million (over &#163;1billion of todays money) it wasn&#8217;t cheap, but remains absolutely vital in the preservation of the City.</p>',
				            '<p>Sitting quietly on the edge of London the Barrier is a silent but indispensable tool to the lives of all who live and work in the City.</p>',
				        ].join(''),
				        zoom: 16,
				        show_infowindow: false,
				        icon: 'content/img/map/mark3.png'
				    },

				];

    	
	new Maplace({
	    locations: LocsB,
	    map_div: '#gmap-tabs',
	    controls_div: '#controls-tabs',
	    controls_type: 'list',
	    controls_applycss: false,
	    styles: {
	        'Greyscale':[
    {
        "featureType": "poi.attraction",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#ec1305"
            }
        ]
    },
    {
        "featureType": "poi.attraction",
        "elementType": "labels.icon",
        "stylers": [
            {
                "weight": "7.72"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "color": "#c7c7c7"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    }
]
	    },
	    afterShow: function(index, location, marker) {
	        $('#info').html(location.html);
	        $('#info').addClass("come-in");
	    },
	    controls_on_map: false,
	    show_infowindow: false
	    
	}).Load(); 

	

});
</script>