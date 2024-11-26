<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400..700;1,400..700&family=Bebas+Neue&family=Faculty+Glyphic&family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">
    <title>Coding Course Website</title>
    <style>
        body, h1, h3, h4, p {
            margin: 0;
            padding: 0;
            font-family: 'Faculty Glyphic', Arial, sans-serif;
        }
        body {
            background-image: url("https://image.slidesdocs.com/responsive-images/background/code-technology-dark-data-business-blue-powerpoint-background_a2b80d32ab__960_540.jpg");
            background-size: auto;
            /* background: linear-gradient(135deg, #f0f4f8, #d9e4f5); */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        header {
            /* background-image: linear-gradient(to right, #2EBBF2, white); */
            background: rgb(65,105,225);
            background: linear-gradient(159deg, rgba(65,105,225,1) 0%, rgba(137,207,240,1) 100%);
            color: #fff;
            padding: 30px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
            width: 500px;
            animation: slideIn 1s ease-out;
        }
        h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        h3 {
            font-weight: normal;
            font-size: 1.2em;
            margin-bottom: 5px;
        }
        p {
            font-size: 1em;
            margin-top: 10px;
        }
        section {
            width: 100%;
            max-width: 600px;
            margin-top: 30px;
            text-align: center;
        }
        h4 {
            font-size: 1.5em;
            color: whitesmoke;
            margin-bottom: 15px;
        }
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 0;
            margin-top: 15px;
        }
        nav ul li {
            background: linear-gradient(135deg, #ffb400, #ff9500);
            border-radius: 5px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        nav ul li:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.25);
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            padding: 12px 25px;
            display: block;
            font-weight: bold;
            font-size: 1em;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div>
        <header>
            <h3>Open Enrollment!!</h3>
            <h1>Coding Course Surabaya</h1>
        </header>
    
        <section>
            <h4>Menu</h4>
            <nav>
                <ul>
                    <li><a href="form-daftar.php">Daftar Baru</a></li>
                    <li><a href="list-siswa.php">Lihat Pendaftar</a></li>
                </ul>
            </nav>
            <?php if(isset($_GET['status'])): ?>
                <p style="color: whitesmoke;">
                    <?php
                        if($_GET['status'] == 'sukses'){
                            echo "Registration Successfull";
                        } else {
                            echo "Registration Failed";
                        }
                    ?>
                </p>
            <?php endif; ?>
        </section>
    </div>
</body>
</html>
