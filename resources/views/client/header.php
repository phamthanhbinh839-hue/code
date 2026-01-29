<?php if (!defined('IN_SITE')) {
    die('The Request Not Found');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?=$title?></title
        <meta name="description" content="<?=$TN->site('description');?>">
        <meta name="keywords" content="<?=$TN->site('keywords');?>">
        <!-- Open Graph data -->
        <meta property="og:title" content="<?=$TN->site('title');?>">
        <meta property="og:type" content="Website">
        <meta property="og:url" content="<?=BASE_URL('');?>">
        <meta property="og:image" content="<?=$TN->site('anhbia');?>">
        <meta property="og:description" content="<?=$TN->site('description');?>">
        <meta property="og:site_name" content="<?=$TN->site('title');?>">
        <meta property="article:section" content="<?=$TN->site('description');?>">
        <meta property="article:tag" content="<?=$TN->site('keywords');?>">
        <meta name="author" content="Thái Nguyên">
        <link rel="shortcut icon" href="<?=$TN->site('favicon');?>">
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="<?=$TN->site('anhbia');?>">
        <meta name="twitter:site" content="@nlcgaming">
        <meta name="twitter:title" content="<?=$TN->site('title');?>">
        <meta name="twitter:description" content="<?=$TN->site('description');?>">
        <meta name="twitter:creator" content="@nlcgaming">
        <meta name="twitter:image:src" content="<?=$TN->site('anhbia');?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link data-n-head="ssr" rel="preconnect" href="https://fonts.gstatic.com">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Goldman&amp;display=swap">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&amp;family=Roboto:wght@900&amp;display=swap">

    <link href="<?=BASE_URL('')?>public/assets/cute/cute-alert.css" rel="stylesheet">
    <script src="<?=BASE_URL('')?>public/assets/cute/cute-alert.js"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta content="width=device-width, initial-scale=1.0, user-scalable=no" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <link data-n-head="ssr" rel="preconnect" href="https://fonts.gstatic.com">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Goldman&amp;display=swap">
        <link data-n-head="ssr" rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&amp;family=Roboto:wght@900&amp;display=swap">
        <link href="<?=BASE_URL('public/theme/');?>assets/frontend/css/style.css?v=1621615725" rel="stylesheet" type="text/css" />
        <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/plugins/jquery/jquery-2.1.0.min.js"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/plugins/jquery-cookie/jquery.cookie.js"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/theme/assets/plugins/js-cookie/js.cookie.js" type="text/javascript"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/theme/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/js/kun.js"></script>
        <script src="<?=BASE_URL('public/theme/');?>assets/frontend/js/backtotop.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>  
        <script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.2/dist/lazyload.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <?=$body['header'];?> 
</head>

<body>
    <!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->