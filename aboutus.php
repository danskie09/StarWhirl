<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

       
       



        *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	list-style: none;
	scroll-behavior: smooth;
}

:root{
	--bg-color: #f5f5f5;
	--text-color: #121212;
	--main-font: 2.2rem;
	--p-font: 1.1rem;
}
body{
	background: var(--bg-color);
	color: var(--text-color);
}
header{
	width: 100%;
	top: 0;
	right: 0;
	z-index: 1000;
	position: fixed;
	background: var(--bg-color);
	box-shadow: 0px 14px 18px 0 rgba(0, 0, 0, 0.2);
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 20px 8%;
	transition: .3s;
    box-sizing: border-box;
    height: 70px;
}
.logo {
    width: 150px;
    height: 150px;
    display: block; /* Ensure it's a block-level element for centering */
   
}
#menu-icon{
	font-size: 38px;
	color: var(--text-color);
	z-index: 10001;
	display: none;
}
.navbar{
	display: flex;
   
}
.navbar a{
	font-size: var(--p-font);
	color: var(--text-color);
	font-weight: 600;
	padding: 10px 15px;
	margin: 0 10px;
	transition: all .40s ease;
}
.navbar a:hover{
	background: #f5bf42;
	color: #fff;
}
.icons{
	display: inline-block;
}
.icons a{
	color: var(--text-color);
	font-size: var(--p-font);
    background: black;
	color: #fff;
    margin-right: 30px;
	margin-left: 30px;
    font-weight: 600;
	padding: 5px 10px;
    border-radius: 5px;
}
.icons a:hover{
	opacity: 0.7;
    background: #f5bf42;
    color: white;
}

.result{
        
        margin-top: 30px;
        align-items: center;
        justify-content: center;
         text-align: center;
    border: 2px #f5bf42 dashed;
    border-radius: 30px;
        padding: 30px 30px;
        width: 1000px;
        height: auto;
        margin-left: 150px;
        margin-right: 100px;
        background-color: white;
    } 

    .formContainer{
        display: flex;
        margin-top: 100px;
        margin-bottom: 40px;
        justify-content: center;
        text-align: center;
        
    }

    .formContainer form{
        color: #f5bf42;
        width: 500px;
    }

    .searchContainer{
    display: flex;
}

    .formContainer input[type=text] {
width: 400px;
box-sizing: border-box;
border: 2px solid #ccc;
border-radius: 4px;
font-size: 16px;
background-color: white;
background-image: url('images/search.png');
background-position: 2px 3px;
background-size: 20px 20px; 
background-repeat: no-repeat;
padding: 12px 20px 12px 40px;
height: 20px;
}

.formContainer input[type=submit]{
    width: 100px;
    box-sizing: border-box;
    font-size: 16px;
    border-radius: 5px;
    background-color: #f5bf42;
    color: white;
    border: none;

}

.formContainer input[type=submit]:hover{
    opacity: 0.5;
}


.welcome {
  background-image: url('images/final.webp'); /* Ag black background ni sa welcome to gadget haven sa homepage*/
  background-size: cover;
  background-position: center;
  text-align: center;
  color: black;
  padding: 100px 0;
}


    .btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: black;
  color: white;
  font-weight: 600;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 20px;
  transition: background-color 0.3s;
}

.btn:hover{
    opacity: 0.7;
}

@media screen and (max-width: 600px) {
    header {
        padding: 15px 5%;
    }

    .navbar {
        
        align-items: center;
        text-align: center;
        display: flex;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: var(--bg-color);
        box-shadow: 0px 14px 18px 0 rgba(0, 0, 0, 0.2);
        margin-bottom: 60px;

    }

    .navbar.active {
        display: flex;
    }

    .navbar a {
        margin: 10px 0;
        font-size: 15px;
        padding: 5px 5px;
    }

    #menu-icon {
        display: block;
    }

    .logo {
        width: 100px; /* Adjust size as needed */
        height: 100px; /* Adjust size as needed */
    }

    .formContainer {
        margin-top: 100px;
    }

    .formContainer form {
        width: 90%;
    }

    .formContainer input[type=text] {
        width: 100%;
    }

    .result {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .welcome {
        padding: 50px 0;
    }

    .container-welcome {
        text-align: center;
    }
}


.services {
  margin-top: 80px;
  justify-content: center;
  display: flex;
}

.services h1 {
  font-weight: bolder;
  font-family: var(--p-font);
  font-size: 60px;
  border-bottom: 5px solid #f5bf42; /* Adjust the thickness and color as needed */
  padding-bottom: 1px; /* Adjust the value (e.g., 10px) based on your preference */
}




.content .gallery{
    
max-width: 10000px;
  padding: 10px 0;

  
}

.content .gallery img{
    width: 100%;
}

.content .map{
    
    max-width: 10000px;
      padding: 10px 0;
    
      
    }
    
    .content .map img{
        width: 100%;
        height: auto;
    }


    .content .last{
    
    max-width: 10000px;
      padding: 10px 0;
    
      
    }
    
    .content .last img{
        width: 100%;
        height: auto;
    }



    </style>
</head>
<body>
<header>
        <!-- <a href="#" class="logo">StarWhirl</a> -->
            <img src="images/starWhirl.png" alt="" class="logo">
        
    
        <ul class="navbar">
            <li><a href="index.php">Tracking</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="aboutus.php">About Us</a></li>
        </ul>
    
        <div class="icons">
            

            
            
            <a href="login.php">Login</a>
            
        </div>
    </header>  

    
    

</div>
</div>

<div class="services">
<h1>ABOUT US</h1>
</div>



<div class="content">

<div class="gallery">
    <img src="images/gallery.png" alt="galery">
</div>


<div class="map">

    <img src="images/location.png" alt="map">
</div>


<div class="last">
    <img src="images/last.png" alt="">
</div>







</div>


</head>
</body>
</html>