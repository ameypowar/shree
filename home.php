<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: reset-code.php');
            }
        }else{
            header('Location: user-otp.php');
        }
    }
}else{
    header('Location: login-user.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta name="viewport" content="device-width, initial-scale=1.0">
    <title>Shree Kedar Batteries</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet"/>
    <link rel="stylesheet" href="styles.css" />
    <title>Shree Kedar Batteries</title>
    <style>
        /* Google Font Import - Poppins */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

:root{
    /* ===== Colors ===== */
    --body-color: #E4E9F7;
    --sidebar-color: #FFF;
    --primary-color: #695CFE;
    --primary-color-light: #F6F5FF;
    --toggle-color: #DDD;
    --text-color: #707070;

    /* ====== Transition ====== */
    --tran-03: all 0.2s ease;
    --tran-03: all 0.3s ease;
    --tran-04: all 0.3s ease;
    --tran-05: all 0.3s ease;
}

body{
    min-height: 100vh;
    background-color: var(--body-color);
    transition: var(--tran-05);
}

::selection{
    background-color: var(--primary-color);
    color: #fff;
}

body.dark{
    --body-color: #18191a;
    --sidebar-color: #242526;
    --primary-color: #3a3b3c;
    --primary-color-light: #3a3b3c;
    --toggle-color: #fff;
    --text-color: #ccc;
}

/* ===== Sidebar ===== */
 .sidebar{
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 250px;
    padding: 10px 14px;
    background: var(--sidebar-color);
    transition: var(--tran-05);
    z-index: 100;  
}
.sidebar.close{
    width: 88px;
}

/* ===== Reusable code - Here ===== */
.sidebar li{
    height: 50px;
    list-style: none;
    display: flex;
    align-items: center;
    margin-top: 10px;
}

.sidebar header .image,
.sidebar .icon{
    min-width: 60px;
    border-radius: 6px;
}

.sidebar .icon{
    min-width: 60px;
    border-radius: 6px;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.sidebar .text,
.sidebar .icon{
    color: var(--text-color);
    transition: var(--tran-03);
}

.sidebar .text{
    font-size: 17px;
    font-weight: 500;
    white-space: nowrap;
    opacity: 1;
}
.sidebar.close .text{
    opacity: 0;
}
/* =========================== */

.sidebar header{
    position: relative;
}

.sidebar header .image-text{
    display: flex;
    align-items: center;
}
.sidebar header .logo-text{
    display: flex;
    flex-direction: column;
}
header .image-text .name {
    margin-top: 2px;
    font-size: 18px;
    font-weight: 600;
}

header .image-text .profession{
    font-size: 16px;
    margin-top: -2px;
    display: block;
}

.sidebar header .image{
    display: flex;
    align-items: center;
    justify-content: center;
}

.sidebar header .image img{
    width: 40px;
    border-radius: 6px;
}

.sidebar header .toggle{
    position: absolute;
    top: 50%;
    right: -25px;
    transform: translateY(-50%) rotate(180deg);
    height: 25px;
    width: 25px;
    background-color: var(--primary-color);
    color: var(--sidebar-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    cursor: pointer;
    transition: var(--tran-05);
}

body.dark .sidebar header .toggle{
    color: var(--text-color);
}

.sidebar.close .toggle{
    transform: translateY(-50%) rotate(0deg);
}

.sidebar .menu{
    margin-top: 40px;
}

#searchInput {
    padding: 7px;
    width: 150px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 10px;
}

#searchForm button {
    padding:7px;
    width: 65px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 10px;
}
#searchForm button:hover {
    background-color: #0056b3;
}
.sidebar li a{
    list-style: none;
    height: 100%;
    background-color: transparent;
    display: flex;
    align-items: center;
    height: 100%;
    width: 100%;
    border-radius: 6px;
    text-decoration: none;
    transition: var(--tran-03);
}

.sidebar li a:hover{
    background-color: var(--primary-color);
}
.sidebar li a:hover .icon,
.sidebar li a:hover .text{
    color: var(--sidebar-color);
}
body.dark .sidebar li a:hover .icon,
body.dark .sidebar li a:hover .text{
    color: var(--text-color);
}

.sidebar .menu-bar{
    height: calc(100% - 55px);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow-y: scroll;
}
.menu-bar::-webkit-scrollbar{
    display: none;
}
.sidebar .menu-bar .mode{
    border-radius: 6px;
    background-color: var(--primary-color-light);
    position: relative;
    transition: var(--tran-05);
}

.menu-bar .mode .sun-moon{
    height: 50px;
    width: 60px;
}

.mode .sun-moon i{
    position: absolute;
}
.mode .sun-moon i.sun{
    opacity: 0;
}
body.dark .mode .sun-moon i.sun{
    opacity: 1;
}
body.dark .mode .sun-moon i.moon{
    opacity: 0;
}

.menu-bar .bottom-content .toggle-switch{
    position: absolute;
    right: 0;
    height: 100%;
    min-width: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    cursor: pointer;
}
.toggle-switch .switch{
    position: relative;
    height: 22px;
    width: 40px;
    border-radius: 25px;
    background-color: var(--toggle-color);
    transition: var(--tran-05);
}

.switch::before{
    content: '';
    position: absolute;
    height: 15px;
    width: 15px;
    border-radius: 50%;
    top: 50%;
    left: 5px;
    transform: translateY(-50%);
    background-color: var(--sidebar-color);
    transition: var(--tran-04);
}

body.dark .switch::before{
    left: 20px;
}

.home{
    position: absolute;
    top: 0;
    top: 0;
    left: 250px;
    height: 100vh;
    width: calc(100% - 250px);
    background-color: var(--body-color);
    transition: var(--tran-05);
}
.home .text{
    font-size: 30px;
    font-weight: 500;
    color: var(--text-color);
    padding: 12px 60px;
}

.sidebar.close ~ .home{
    left: 78px;
    height: 100vh;
    width: calc(100% - 78px);
}
body.dark .home .text{
    color: var(--text-color);
}
</style> 
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo1.jpg" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name">Shree Kedar</span>
                    <span class="profession">Batteries</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                 <div class="search-container">
                      <form id="searchForm" action="#" method="GET">
                           <input type="text" id="searchInput" name="query" placeholder="Search products...">
                           <button type="submit">Search</button>
                           <div id="productSuggestions"></div>
                      </form>
                 </div>


                    <li class="nav-link">
                        <a href="productpageamaron.html">
                            <i class='bx bx-car icon' ></i>
                            <span class="text nav-text">AMARON</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="productpageexide.html">
                            <i class='bx bxs-zap icon' ></i>
                            <span class="text nav-text">EXIDE</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="productpageelito.html">
                            <i class='bx bxl-internet-explorer icon'></i>
                            <span class="text nav-text">ELITO</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="contact.html">
                            <i class='bx bxs-contact icon'></i>
                            <span class="text nav-text">CONTACT US</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="service.html">
                            <i class='bx bxs-car-mechanic bx-tada icon' ></i>
                            <span class="text nav-text">SERVICES</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="logout-user.php">
                          <i class='bx bx-power-off icon'></i>
                         <span class="text nav-text">LOGOUT</span>
                         </a>
                    </li>
                </ul>
            </div>

            <div class="bottom-content">
                
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
                
            </div>
        </div>

    </nav>

    <section>
    <div class="container">
      <div class="container__left">
        <h1>Welcome To,<br> SHREE KEDAR BATTERIES</h1>
      </div>
      <div class="container__right">
        <div class="images">
        <img src="pic1.png" alt="tent-1" class="tent-1" height="150px" />
          <img src="pic2.png" alt="tent-2" class="tent-2" height="88px" />
          <img src="pic3.jpg" alt="tent-3" class="tent-3" height="150px"/>
        </div>
        <div class="content">
          <h4><B>AUTHORIZED DEALER OF AMARON ELITO & EXIDE</B></h4>
          <h2>Batteries And Inverters</h2>
          <h3>Sales and Services</h3>
          <p>
            Amaron Automative Batteries <br>
            UPS And Spray Pump Batteries <br>
            Inverter And Inverter Batteries <br>
            Solar Inverter And Inverter Batteries <br>
            <b>Amaron Oil And Lubricants</b><br>
          </p>
        </div>
      </div>
      <div class="location">
        <span><i class="ri-map-pin-2-fill"></i></span>
        Wathar-Kodoli Main Road,<br>Amrutnagar(Warananagar),Kolhapur.
      </div>
      <div class="socials">
        <span>
          <a href="#"><i class="ri-facebook-fill"></i></a>
        </span>
        <span>
          <a href=""><i class="ri-instagram-line"></i></a>
        </span>
        <span>
          <a href="#"><i class="ri-twitter-fill"></i></a>
        </span>
      </div>
    </div>
    </section>

    <script>

         document.getElementById("searchForm").addEventListener("submit", function(event) {
                event.preventDefault(); // Prevent default form submission

                var query = document.getElementById("searchInput").value.trim();
                if (query !== '') {
                   // Redirect based on search query
                   if (query.includes("Amaron two wheeler")) {
                          window.location.href = "Amaron two wheeler.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Amaron four wheeler")) {
                          window.location.href = "Amaron four wheeler.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Amaron Inverter")) {
                          window.location.href = "Amaron Inverter.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Amaron Lubricant")) {
                          window.location.href = "Amaron Lubricant.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Exide two wheeler")) {
                          window.location.href = "Exide two wheeler.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Exide four wheeler")) {
                          window.location.href = "Exide four wheeler.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Elito two wheeler")) {
                          window.location.href = "Elito two wheeler.html?query=" + encodeURIComponent(query);
                   } else if (query.includes("Elito four wheeler")) {
                          window.location.href = "Elito four wheeler.html?query=" + encodeURIComponent(query);             


                   } else {
                      // Default redirect or error handling
                         alert("No matching page found for your search query.");
                   }
                } else {
                      // Handle empty search query
                     alert("Please enter a search query.");
                }
            });

        var products = ["Amaron two wheeler","Amaron four wheeler","Amaron Inverter","Amaron Lubricant","Exide two wheele", "Exide four wheeler", "Elito two wheeler", "Elito four wheeler", ];

        var searchInput = document.getElementById("searchInput");
        var productSuggestions = document.getElementById("productSuggestions");

        // Function to display product suggestions
        function showProductSuggestions() {
            var query = searchInput.value.trim().toLowerCase();
            productSuggestions.innerHTML = "";
            if(query) {
                products.forEach(function(product) {
                if (product.toLowerCase().startsWith(query)) {
                    var productItem = document.createElement("div");
                    productItem.classList.add("product-item");
                    productItem.textContent = product;
                    productItem.addEventListener("click", function() {
                        searchInput.value = product;
                        productSuggestions.style.display = "none";
                    });
                    productSuggestions.appendChild(productItem);
                }
                
            });
            if (productSuggestions.innerHTML === "") {
                  productSuggestions.style.display = "none";
            } else {
                   productSuggestions.style.display = "block";
            }
       }
    }

// Event listener for input field to show product suggestions
searchInput.addEventListener("input", function() {
    if (searchInput.value.trim() === "") {
        productSuggestions.style.display = "none";
    } else {
        showProductSuggestions();
    }
});

// Hide product suggestions when clicking outside the dropdown
document.addEventListener("click", function(event) {
    if (!event.target.matches("#searchInput")) {
        productSuggestions.style.display = "none";
    }
});
        const body = document.querySelector('body'),
      sidebar = body.querySelector('nav'),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");


      toggle.addEventListener("click" , () =>{
      sidebar.classList.toggle("close");})

      searchBtn.addEventListener("click" , () =>{
      sidebar.classList.remove("close");})

      modeSwitch.addEventListener("click" , () =>{
      body.classList.toggle("dark");
    
       if(body.classList.contains("dark")){
         modeText.innerText = "Light mode";
       }else{
         modeText.innerText = "Dark mode";
        
    }});
    </script>

    
</body>
</html>