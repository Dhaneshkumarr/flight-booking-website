<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sitemap</title>
    <?php include_once("include/link.php") ?>
</head>

<body>
    <?php include_once("include/header.php")  ?>

    <div class="inner-banner">
        <div class="container">
            <h1 class="text-white bn_heading pb-3 text-uppercase fw-bold text-center">
                Sitemap
            </h1>
            <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php" class="text-warning text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Sitemap</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="py-5">
        <div class="container">
            <h2 class="title text-primary h4 fw-bold mb-4">Sitemap</h2>

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
                $pages = [
                    // Quick Links
                    "index.php" => "Home",
                    "about-us.php" => "About Us",
                    "privacy-policy.php" => "Privacy Policy",
                    "terms-conditions.php" => "Terms and Conditions",
                    "cancellation-policy.php" => "Cancellation Policy",
                    "refund-policy.php" => "Refund Policy",
                    "disclaimer.php" => "Disclaimer",
                    "cookie-policy.php" => "Cookie Policy",
                    "contact-us.php" => "Contact Us"
                ];

                foreach ($pages as $url => $name) {
                    echo '<div class="col">';
                    echo '<a href="' . $url . '" class="d-block p-3 border border-secondary rounded-3 shadow-sm text-decoration-none text-dark">';
                    echo '<i class="fas fa-link me-2 text-secondary"></i>' . $name;
                    echo '</a>';
                    echo '</div>';
                }
                ?>
            </div>

        </div>
    </div>

    <?php include_once("include/footer.php")  ?>
    <?php include_once("include/script.php")  ?>
</body>

</html>