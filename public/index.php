<?php
error_reporting(0);
session_start();
if (empty($_SESSION['USER'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="Wanderlust-logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wanderlust Travel-Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">



</head> 

<body>
    <header>
        <nav>
            <div class="logo">Wanderlust</div>
           <ul class="nav-link">
    <li><a href="#destinations">Destinations</a></li>
    <li><a href="#travel-tips">Travel Tips</a></li>
    <li><a href="#gallery">Gallery</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="logout.php" class="logout-btn">Logout</a></li>
</ul>

        </nav>
    </header>
   <section class="hero">
    <div class="hero-content">
        <h1> Explore The World  </h1>
        <p>Discover breathtaking destinations and unforgettable experiences, <?php echo $_SESSION['USER']['username']; ?> — your adventure awaits!</p>

        <a href="#destinations" class="s-button">Start Exploring</a>
    </div>
</section>
<br>
<?php
include '../app/core/init.php';

// Fetch destinations
$dest_query = "SELECT * FROM destinations ORDER BY id DESC";
$dest_result = mysqli_query($con, $dest_query);
?>

    <section id="destinations" class="destinations">
        <div class="section-header">
            <h2>Popular Destinations</h2>
            <p>Discover our handpicked selection of amazing places around the globe</p>
        </div>
    <div class="cll">
    <?php while ($row = mysqli_fetch_assoc($dest_result)) : ?>
    <div class="destination-grid">
        <div class="destination-card1">
            <div class="destination-img">
                <img src="../uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">
                <div class="destination-tag"><?= htmlspecialchars($row['type']) ?></div>
            </div>
            <div class="destination-info">
                <h3><?= htmlspecialchars($row['title']) ?></h3>
                <p><?= htmlspecialchars($row['description']) ?></p>
                <a href="destination_details.php?id=<?= $row['id'] ?>" class="read-more">
    Read More <i class="fas fa-arrow-right"></i>
</a>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
</div>

            </div>
        </div>

    </section>
   <section>
    <div class="newsletter">
        <div class="newsletter-contect">
            <h2>Get Travel Inspiration</h2>
            <p class="pp">Subscribe to our newsletter for exclusive travel tips and destination guides</p>
            
            <form class="letter-form" method="POST" action="subscribe.php">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>

            <!-- success message -->
            <p id="msg">🎉 Subscribed Successfully!</p>
        </div>
    </div>
</section>


    <section id="travel-tips" class="travel-tips">
        <div class="section-header">
            <h2>Travel Tips & Guides</h2>
            <p>Expert advice to make your travels smoother and more enjoyable</p>
        </div>
        <div class="tips-grid">
            <div class="tips-card">
                <div class="tips-icon">
                    <i class="fas fa-suitcase"></i>
                </div>
               <a href="packing.html" class="card-link">
    <div class="card-box">
     
      <h2>Packing Essentials</h2>
      <p>Learn how to pack efficiently for any trip...</p>
    </div>
  </a>
            </div>
            <div class="tips-card">
                <div class="tips-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <a href="photography.html" class="card-link">
    <div class="card-box">
   
      <h2>Photography Tips</h2>
      <p>Capture stunning travel memories...</p>
    </div>
  </a>
            </div>
            <div class="tips-card">
                <div class="tips-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <a href="budget.html" class="card-link">
    <div class="card-box">
      
      <h2>Budget Travel</h2>
      <p>Discover how to explore the world...</p>
    </div>
  </a>
            </div>
            <div class="tips-card">
                <div class="tips-icon">
                    <i class="fas fa-utensils"></i>
                </div>
                
  <a href="food.html" class="card-link">
    <div class="card-box">
     
      <h2>Food Adventures</h2>
      <p>Find the best local cuisines...</p>
    </div>
  </a>

            </div>

        </div>
    </section>
    <section id="gallery" class="gallery">
        <div class="section-header">
            <h2>Travel Gallery</h2>
            <p>Inspiring images from around the world</p>
        </div>
        <div class="gallery-grid">

<?php
include 'config/db.php';

$sql = "SELECT * FROM gallery ORDER BY id DESC";
$result = mysqli_query($con, $sql);

while($row = mysqli_fetch_assoc($result)){
?>
    <div class="gallery-item">
        <img src="../uploads/gallery/<?= $row['image']; ?>" alt="Gallery Image">

    </div>

<?php } ?>

</div>



        </div>
    </section>
    <section id="about" class="about">
        <div class="about-content">
            <div class="about-text">
                <h2>About Wanderlust</h2>
                <p>Wanderlust was born from a passion for exploration and adventure. Our mission is to inspire travelers
                    around the world to discover new places, experience different cultures, and create unforgettable
                    memories.</p>
                <p>Founded by a group of avid travelers in 2023, we share authentic travel stories, practical advice,
                    and stunning photography to help you plan your next journey.</p>
                <a href="our-story.html" class="s-button">Our Story</a>
            </div>
            <div class="about-image">
                <img src="aboyr.jpg" alt="Traveler">
            </div>

        </div>


    </section>
    <section id="contact" class="contact">
        <div class="section-header">
            <h2>Get In Touch</h2>
            <p>Have questions or suggestions? We'd love to hear from you!</p>

        </div>
        <div class="contact-container">
             <form class="contact-form" action="save_contact.php" method="POST">
    <div class="form-group">
        <input type="text" name="name" placeholder="Your Name" required>
    </div>

    <div class="form-group">
        <input type="email" name="email" placeholder="Your Email" required>
    </div>

    <div class="form-group">
        <input type="text" name="subject" placeholder="Subject">
    </div>

    <div class="form-group">
        <textarea name="message" placeholder="Your Message" required></textarea>
    </div>

    <button type="submit" class="s-button">Send Message</button>
</form>

        
        <div class="contact-info">
            <div class="info-item">
                    <i class="fas fa-envelope"></i>
                    <p>hello@wanderlust.com</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-phone"></i>
                    <p>+19 931-681-9746</p>
                </div>
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <p>123 Adventure St, Traveler's City</p>
                </div>
                <div class="v">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
        </div>
        </div>
    </section>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <h3>Wanderlust</h3>
                <p>Explore. Dream. Discover.</p>
            </div>
             <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#destinations">Destinations</a></li>
                    <li><a href="#travel-tips">Travel Tips</a></li>
                    <li><a href="#gallery">Gallery</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="../admin/dashboard.php">admin</a></li>
                </ul>
            </div>
            <div class="footer-links">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Travel Guides</a></li>
                    <li><a href="#">Packing Lists</a></li>
                    <li><a href="#">Travel Insurance</a></li>
                    <li><a href="#">FAQs</a></li>
                </ul>
            </div>
        </div>
        </div>
        <div class="footer-botton">
            <p>&copy; 2025 Wanderlust. All rights reserved.</p>
        </div>
    </footer>
    <script>
document.querySelector(".letter-form").addEventListener("submit", function(e){
    // backend reload ko roke (for UI preview)
    e.preventDefault();
    
    document.getElementById("msg").style.display = "block";
    this.reset();

    // 3 sec baad hide
    setTimeout(() => {
        document.getElementById("msg").style.display = "none";
    }, 3000);
});

</script>
<script>
const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".nav-link li a");

window.addEventListener("scroll", () => {
    let current = "";

    sections.forEach(sec => {
        const top = window.scrollY;
        const offset = sec.offsetTop - 150;
        const height = sec.offsetHeight;
        const id = sec.getAttribute("id");

        if (top >= offset && top < offset + height) {
            current = id;
        }
    });

    navLinks.forEach(a => {
        a.classList.remove("active");
        if (a.getAttribute("href") === "#" + current) {
            a.classList.add("active");
        }
    });
});
</script>




</body>

</html>
<?php
include '../app/core/init.php';
?>