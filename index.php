<?php
// session_start(); // Start the session
include 'session_check.php'; 
if (isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html>

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Zomato logo in title tab -->

	<!-- fontawesome.com icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
		integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
		crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Poppins font by google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" />

	<!-- Linking CSS file -->
	<link rel="stylesheet" href="./styles.css" />

	<title>Zomato Landing Page Clone</title>
</head>

<body>
	<!-- This is for hero section -->
	<section class="hero__section">
		<header>
			<nav class="navbar">
				<a href="#">Get the App</a>
				<div class="navbar__menu_container">
					<a href="LoginPage.php" class="link">Logout</a>
					<a href="#" class="user_icon"><i class="fa-solid fa-user"></i></a>
				</div>
			</nav>
		</header>
		<div class="hero__section_container">
			<img src="./Images/Cannibals_Paradise.png" alt="Cannibals' paradise" class="hero__section_logo" />

			<h1 class="hero__section_heading">Discover the best food & drinks</h1>
			<div class="hero__section_container_input">
				<i class="fa-sharp fa-solid fa-location-dot" id="location_icon"></i>
				<select class="hero__section_input_location">
						<option>Surat</option>
						<option>Ahmedabad</option>
						<option>Vapi</option>
						<option>Valsad</option>
						<option>Navsari</option>
				</select>
				<i class="fa-solid fa-magnifying-glass" id="search_icon"></i>
				<input class="hero__section_input_search" type="text"
					placeholder="Search for a restaurant, cuisine or a dish" />
			</div>
		</div>
	</section>
	<!-- This is for cards that restoran offer -->
	<section class="container_cards">

		<div class="we_offer__cards">
			<img src="./Images/item1.png" alt="card1 image" />
			<div class="we_offer__cards_content">
				<h2>Order Online</h2>
				<p>Stay home and order to your doorstep</p>
			</div>
		</div>

		<div class="we_offer__cards">
			<img src="./Images/item2.png" alt="card1 image" />
			<div class="we_offer__cards_content">
				<h2>Dining</h2>
				<p>Visit amazing restaurants and cafes</p>
			</div>
		</div>

		<div class="we_offer__cards">
			<img src="./Images/item3.png" alt="card1 image" />
			<div class="we_offer__cards_content">
				<h2>Nightlife and clubs</h2>
				<p>Spend leisure time enjoying the nightlife of Pune</p>
			</div>
		</div>

		<div class="we_offer__cards">
			<img src="./Images/item4.png" alt="card1 image" />
			<div class="we_offer__cards_content">
				<h2>Takeaway services</h2>
				<p>We ensure timely delivery to our customers</p>
			</div>
		</div>

	</section>

	<!-- Location Sections -->
	<section class="container_locations">
		<h1>Popular Localities</h1>
		<div class="sub_heading__container">
			<span>Taste the food of different localities..!!</span>
		</div>

		<div class="main_box">
			<form action="main.php" method="post">
				<span><input type="submit" name="branch" value="Adajan" class="boxes" id="box1"></span>
				<span><input type="submit" name="branch" value="Pal" class="boxes" id="box2"></span>
				<span><input type="submit" name="branch" value="Athwagate" class="boxes" id="box3"></span>
				<span><input type="submit" name="branch" value="Vesu" class="boxes" id="box4"></span>
				<span><input type="submit" name="branch" value="Piplod" class="boxes" id="box5"></span>
				<span><input type="submit" name="branch" value="Chowk" class="boxes" id="box6"></span>
				<span><input type="submit" name="branch" value="Nanpura" class="boxes" id="box7"></span>
				<span><input type="submit" name="branch" value="Sosyo Circle" class="boxes" id="box8"></span>
				<span><input type="submit" name="branch" value="Bhagal" class="boxes" id="box9"></span>
				<span><input type="submit" name="branch" value="Bhatar" class="boxes" id="box10"></span>
				<span><input type="submit" name="branch" value="Katargam" class="boxes" id="box11"></span>
				<span><input type="submit" name="branch" value="Dumas" class="boxes" id="box12"></span>
				<span><input type="submit" name="branch" value="City Light" class="boxes" id="box13"></span>
				<span><input type="submit" name="branch" value="See More.." class="boxes" id="box14"></span>
			</form>
			
		</div>
	</section>

	<!-- This is for collection section -->
	<section class="container_collections">
		<h1>Collections</h1>
		<div class="sub_heading__container">
			<span>Explore curated lists of top restaurants, cafes, pubs in Pune based on trends</span>
			<span id="span">All collections in Pune</span>
		</div>
		<div class="collections__cards_container">

			<div class="cards card1">
				<div class="overlay"></div>
				<div class="collections__content">
					<h4>Live Cricket Screening</h4>
					<span>56 places</span>
				</div>
			</div>

			<div class="cards card2">
				<div class="overlay"></div>
				<div class="collections__content">
					<h4>Koregaon Park specials</h4>
					<span>12 places</span>
				</div>
			</div>

			<div class="cards card3">
				<div class="overlay"></div>
				<div class="collections__content">
					<h4>Newly opened Restaurants</h4>
					<span>36 places</span>
				</div>
			</div>

			<div class="cards card4">
				<div class="overlay"></div>
				<div class="collections__content">
					<h4>Trending Pubs Near me</h4>
					<span>16 places</span>
				</div>
			</div>

		</div>
	</section>

	<!-- this is for Explore places section -->
	<section class="explore_places__container">
		<div class="sub_container">
			<div>
				<h1>Explore Options Near Me</h1>
				<span>Explore the restaurants and cuisines across various cities under our service</span>
			</div>
			<div class="drop_down__container">
				<div>
					<select class="drop_down_menu">
						<option>Popular cuisines Near Me</option>
						<option>Chinese</option>
						<option>Punjabi</option>
						<option>Tandoori</option>
						<option>Italian</option>
						<option>Mexican</option>
						<option>Thai Food</option>
					</select>
				</div>
				<div>
					<select class="drop_down_menu">
						<option>Popular Restaurant Near Me</option>
						<option>Meet Soda Cafe</option>
						<option>Chirag Locho House</option>
						<option>Himanshi Himganga IceCream</option>
						<option>Kuldeep Pethawala</option>
						<option>Dhvani Black Magic Maggi</option>
						<option>Dhyata Dosa Zone</option>
						<option>Shivam Frankie House</option>
						<option>Malhar Dosa House</option>
					</select>
				</div>
				<div>
					<select class="drop_down_menu">
						<option>Cities We Deliver To</option>
						<option>Surat</option>
						<option>Ahmedabad</option>
						<option>Vapi</option>
						<option>Valsad</option>
						<option>Navsari</option>
					</select>
				</div>
			</div>
		</div>
	</section>
	<!-- This is for footer section -->
	<footer class="footer__container">
		<div class="footer_section1">
			<img src="./Images/Cannibals_Paradise.png" alt="Cannibals_Paradise" />
			<div class="section1__button_container">
				<button>
					<img src="./Images/IndianFlag.png" alt="Indian Flag" style="width: 16px; height: 16px" />
					<select style="border: none; background: #e8e8e8; cursor: pointer">
						<option>India</option>
						<option>United States</option>
						<option>Australia</option>
						<option>New Zealand</option>
						<option>Spain</option>
						<option>England</option>
					</select>
				</button>
				<button>
					<i class="fa fa-globe"></i>
					<select style="border: none; background: #e8e8e8; cursor: pointer">
						<option>English</option>
						<option>Español</option>
						<option>Čeština</option>
						<option>Slovenčina</option>
						<option>Polish</option>
						<option>Italian</option>
					</select>
				</button>
			</div>
		</div>
		<div class="navigation_container">
			<div class="link_container">
				<h5>About Cannibals' Paradise</h5>
				<div class="link_container_anchors">
					<a href="#">Who We Are</a>
					<a href="#">Blog</a>
					<a href="#">Work With Us</a>
					<a href="#">Investor Relations</a>
					<a href="#">Report Fraud</a>
					<a href="#">Contact Us</a>
				</div>
			</div>

			<div class="link_container">
				<h5>For Restaurants</h5>
				<div class="link_container_anchors">
					<a href="#">Partner With Us</a>
					<a href="#">Apps For You</a>
				</div>
				<h5 id="enterprises">For Enterprises</h5>
				<div class="link_container_anchors">
					<a href="#">Cannibals' Paradise For Work</a>
				</div>
			</div>

			<div class="link_container">
				<h5>Learn More</h5>
				<div class="link_container_anchors">
					<a href="#">Privacy</a>
					<a href="#">Security</a>
					<a href="#">Terms</a>
					<a href="#">Sitemap</a>
				</div>
			</div>

			<div class="link_container">
				<h5>Social Links</h5>
				<div class="social_media_icon_buttons">
					<button><i class="fa-brands fa-linkedin-in"></i> </button>
					<button><i class="fa-brands fa-instagram"></i></button>
					<button><i class="fa-brands fa-twitter"></i></button>
					<button><i class="fa-brands fa-facebook"></i></button>
					<button><i class="fa-brands fa-youtube"></i></button>
					<div class="social_media_logos">
						<img src="./Images/appleStore.png" alt="Apple store" />
						<img src="./Images/playStore.png" alt="Play store" id="img2" />
					</div>
				</div>
			</div>
		</div>
		<div class="disclaimer">
			By continuing past this page, you agree to our Terms of Service, Cookie Policy,
			Privacy Policy and Content Policies. All trademarks are properties of their respective owners.
			2008-2023 © Cannibals' Paradise™ Ltd. All rights reserved.
		</div>
	</footer>
</body>

</html>
<?php
} else {
    header('location: LoginPage.php');
}
?>