<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Kiwi+Maru&family=Noto+Serif:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Destinations</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Noto Serif', serif;
            animation: reveal 1s ease-in-out forwards;
            opacity: 0;
            transform: translateY(50px);
        }
        @keyframes reveal {
            0% { opacity: 0; transform: translateY(5px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            position: fixed; 
            top: 0;
            width: 100%;
            z-index: 1000; 
        }
        .navbar a {
            color: #ffffff;
            text-decoration: none;
            padding: 9px 30px;
            margin-left: 10px;
            font-weight: bold;
        }
        .logo img {
            width: 100px;
            height: 70px;
        }
        .menu-toggle {
            font-size: 24px;
            cursor: pointer;
            display: none; 
        }
        .menu {
            list-style-type: none;
            display: flex;
            gap: 20px;
        }
        .menu-item {
            position: relative;
        }
        .menu-item a {
            color: white;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #f0f0f0;
            color: #333;
            border-radius: 30px;
            padding: 10px 30px;
        }
        .menu .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
        }
        .menu-item:hover .dropdown {
            display: block;
        }
        .dropdown a {
            padding: 10px;
            display: block;
            text-decoration: none;
            color: #000;
        }
        .login-logo {
            width: 40px;
            height: 40px;
            cursor: pointer;
        }
        .login-logo:hover {
            width: 50px;
            height: 50px;
        }
        .main-section {
            width: 100%;
            background-image: url("https://www.pixelstalk.net/wp-content/uploads/images1/Foggy-forest-wide.jpg");
            height: 70vh;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding-top: 80px; 
        }
        .main-section h1 {
            font-size: 3rem;
            margin: 0;
        }
        .destinations {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
            margin-top: 20px;
        }
        .destination {
            background-color: #f3f3f3;
            width: 200px;
            height: 40vh;
            margin: 15px 20px;
            border-radius: 10px;
            box-shadow: 1px 2px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }
        .destination:hover {
            transform: translateY(-10px);
        }
        .destination img {
            width: 100%;
            border-radius: 10px 10px 0 0;
            height: 70%;
        }
        .destination h2 {
            padding: 10px;
            font-size: 1.2rem;
        }
        .history-section {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    margin: 20px;
    max-width: 1200px;
    margin: 20px auto; 
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.table th, .table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}

.table th {
    background-color: #4CAF50;
    color: white;
}

.table tr:hover {
    background-color: #f1f1f1;
}

        @media (max-width: 600px) {

            .navbar {
                flex-direction: column;
                padding: 10px;
                margin-top: 5%;
            }
            .main-section {
                width: 100vw;
            }
            
            .logo {
                height: 30px;
                width: 30px;
                position: absolute;
                left: 5%;
                border: none
                margin-top: 5%;
            }
            .logo img {
                height: 30px;
                width: 30px;
            }
            .login-logo {
                position: absolute;
                top: 15%;
                right: 5%;
            }

            .menu-toggle {
                display: block;
                position: absolute;
                left: 50%;
            }
            .menu {
                display: none;
                flex-direction: column;
                width: 100%;
                background-color: #282c34;
                margin-top: 15%;

            }
            .menu-active {
                display: flex;
            }
            .main-section h1 {
                font-size: 2rem;
            }
            .destination {
                width: 90%;
            }
            table {
                width: 90vw;
                .table th, .table td {
                border: 1px solid #ddd;
                padding: 5px;
                text-align: center;
}
            }
            .history-section {
                width: 100vw;
            }
            
        }
        
    </style>
</head>
<body>
    <div class="main-section">
    <div class="navbar">
        <a href="secondthoughts.html" class="logo"><img src="image-removebg-preview.png" alt="Logo"></a>
        <span id="mobile-menu" class="menu-toggle">&#9776;</span>
        <ul class="menu">
            <li class="menu-item"><a href="destinations.php">Destinations</a></li>
            <li class="menu-item"><a href="food.html">Food and Culinary</a></li>
            <li class="menu-item">
                <a href="main.html">Adventures</a>
                <div class="dropdown">
                    <a id="health" href="main.html#offers">Health, Spa and Wellness</a>
                            <a id="river" href="#main.html#river">River Cruise</a>
                            <a id="festivals" href="main.html#events">Festivals and Events</a>
                </div>
            </li>
            <li class="menu-item"><a href="contact.html">Contact</a></li>
        </ul>
        <img src="user-interface.png" class="login-logo" onclick="window.location.href='account.html'">
    </div>

        <h1>Explore Our Destinations</h1>
    </div>

    <div class="destinations">
        <div class="destination">
            <img src="https://i.pinimg.com/564x/ee/dc/2a/eedc2a6df9ecf98d96ec7a1e5c9c6a51.jpg" alt="Argentina" onclick="window.location.href='packages ARG.html'">
            <h2>Argentina</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/2f/ef/a3/2fefa314fe58ab97f847fec69bc175e3.jpg" alt="Australia" onclick="window.location.href='packages AUST.html'">
            <h2>Australia</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/2c/78/d9/2c78d9f196b0e3d4872af00ec488d1c6.jpg" alt="Morocco" onclick="window.location.href='packages MOROCO.html'">
            <h2>Morocco</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/4f/b1/c9/4fb1c99d71db0f1f120f7fcbbe5e405e.jpg" alt="Japan" onclick="window.location.href='packages JAPAN.html'">
            <h2>Japan</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/79/38/ef/7938ef409b9f6bee156c717d17fae941.jpg" alt="England" onclick="window.location.href='england.html'">
            <h2>England</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/0a/b9/b2/0ab9b290c229ed9eb4dd5f05dcb3a929.jpg" alt="Brazil" onclick="window.location.href='packages BRAZ.html'">
            <h2>Brazil</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/736x/df/14/ef/df14ef46e6ed259aafbf648162951943.jpg" alt="Greece" onclick="window.location.href='packages GREECE.html'">
            <h2>Greece</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/de/96/a0/de96a0e4f7f63bee7f5b86b3d2779b24.jpg" alt="Thailand" onclick="window.location.href='packages THAILAND.html'">
            <h2>Thailand</h2>
        </div>
        <div class="destination">
            <img src="https://i.pinimg.com/564x/26/25/50/262550dad7fd7e3a23daf9afe4209440.jpg" alt="America" onclick="window.location.href='packages US.html'">
            <h2>America</h2>
        </div>
    </div>

    <div class="history-section">
        <h2>Your Booking History</h2>
        <?php include 'destinations2.php'; ?> 
        <table class="table">
            <thead>
                <tr>
                    <th>Destination</th>
                    <th>Travel Date</th>
                    <th>Number of People</th>
                    <th>Total Price</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?> 
                    <?php foreach ($bookings as $booking): ?> 
                        <tr>
                            <td><?= $booking['destination'] ?></td>
                            <td><?= $booking['travel_date'] ?></td>
                            <td><?= $booking['num_people'] ?></td>
                            <td>$<?= $booking['total_price'] ?></td>
                            <td><?= $booking['booking_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php elseif (!isset($_SESSION['user_id'])): ?>
                    <tr><td colspan="7">Not Logged in.</td></tr>
                <?php else: ?>
                    <tr><td colspan="7">No bookings found.</td></tr>
                <?php endif; ?>
                
            </tbody>
        </table>
    </div>
    

    <script>
        const menuToggle = document.querySelector('.menu-toggle');
        const menu = document.querySelector('.menu');

        menuToggle.addEventListener('click', () => {
            menuToggle.classList.toggle('active');
            menu.classList.toggle('menu-active');
        });
    </script>

</body>
</html>
