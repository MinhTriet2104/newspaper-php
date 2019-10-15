<?php
require_once './config/Database.php';
spl_autoload_register(function ($className) {
    require './app/models/' . $className . '.php';
});

$id = "";
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $newspaperModels = new Newspapers();
  $categoryModels = new Categories();

  $newsList = $newspaperModels->getNewsByCategoryId($id);
  $categoryName = $categoryModels->getNameById($id);
  $categoryList = $categoryModels->getCategoriesList();
}

// Tao url
function createUrl($str, $id) {
  $str = strip_tags($str);
  $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
  $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
  $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
  $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
  $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
  $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
  $str = preg_replace("/(đ)/", 'd', $str);
  $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
  $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
  $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
  $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
  $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
  $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
  $str = preg_replace("/(Đ)/", 'D', $str);
  $str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\-|\^)/", '', $str);
  $str = trim(preg_replace("/\s+/", ' ', $str));
  return strtolower(str_replace(' ', '-', $str) . '-' . $id);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Callie HTML Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CMuli:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<!-- HEADER -->
	<header id="header">
		<!-- NAV -->
		<div id="nav">
			<!-- Top Nav -->
			<div id="nav-top">
				<div class="container">
					<!-- social -->
					<ul class="nav-social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul>
					<!-- /social -->

					<!-- logo -->
					<div class="nav-logo">
						<a href="index.html" class="logo"><img src="./img/logo.png" alt=""></a>
					</div>
					<!-- /logo -->

					<!-- search & aside toggle -->
					<div class="nav-btns">
						<button class="aside-btn"><i class="fa fa-bars"></i></button>
						<button class="search-btn"><i class="fa fa-search"></i></button>
						<div id="nav-search">
							<form>
								<input class="input" name="search" placeholder="Enter your search...">
							</form>
							<button class="nav-close search-close">
								<span></span>
							</button>
						</div>
					</div>
					<!-- /search & aside toggle -->
				</div>
			</div>
			<!-- /Top Nav -->

			<!-- Main Nav -->
			<div id="nav-bottom">
				<div class="container">
					<!-- nav -->
					<ul class="nav-menu">
						<li class="has-dropdown">
							<a href="index.php">Trang chủ</a>
							<div class="dropdown">
								<div class="dropdown-body">
									<ul class="dropdown-list">
										<li><a href="about.html">About Us</a></li>
										<li><a href="contact.html">Contacts</a></li>
										<li><a href="blank.html">Regular</a></li>
									</ul>
								</div>
							</div>
						</li>
            <!-- Tin moi -->
						<li class="has-dropdown megamenu">
							<a href="#">Tin mới</a>
							<div class="dropdown tab-dropdown">
								<div class="row">
									<div class="col-md-2">
										<ul class="tab-nav">
											<?php
											echo' <li class="active"><a data-toggle="tab" href="#tab1">'.$categoryList[0]['category_name'].'</a></li>';
											for ($i=1; $i<count($categoryList); $i++) {
												echo '<li><a data-toggle="tab" href="#tab'.($i + 1).'">'.$categoryList[$i]['category_name'].'</a></li>';
											}
											?>
											<!-- <li class="active"><a data-toggle="tab" href="#tab1">Lifestyle</a></li>
											<li><a data-toggle="tab" href="#tab2">Fashion</a></li>
											<li><a data-toggle="tab" href="#tab1">Health</a></li>
											<li><a data-toggle="tab" href="#tab2">Travel</a></li> -->
										</ul>
									</div>
									<div class="col-md-10">
										<div class="dropdown-body tab-content">
											<!-- tab1 -->
											<div id="tab1" class="tab-pane fade in active">
												<div class="row">
												<?php
												$categoryNews = $newspaperModels->getLimitRecentByCategoryId(1, 3);
												// echo var_dump($categoryNews);
												foreach ($categoryNews as $news) {
												?>
												<!-- post -->
												<div class="col-md-4">
													<div class="post post-sm">
														<a class="post-img" href="blog-post.html"><img src="<?php echo $news['newspaper_imgae']; ?>" alt="news-img"></a>
														<div class="post-body">
															<div class="post-category">
																<a href="category.html"><?php echo $categoryList[0]['category_name']; ?></a>
															</div>
															<h3 class="post-title title-sm"><a href="blog-post.html"><?php echo strip_tags($news['newspaper_title']); ?></a></h3>
															<ul class="post-meta">
																<li><a href="author.html"><?php echo $newspaperModels->getAuthorById(1)['author_name']; ?></a></li>
																<?php
																$date = new DateTime($news['newspaper_date']);
																$date = $date->format('d M Y, H:i');
																?>
																<li><?php echo $date; ?></li>
															</ul>
														</div>
													</div>
												</div>
												<?php
												}
												?>
												</div>
											</div>
											<!-- /tab1 -->

											<!-- tab2 -> end -->
											<?php
											for ($i=2; $i <= count($categoryList); $i++) { 
											?>
											<div id="tab<?php echo $i; ?>" class="tab-pane fade in">
												<div class="row">
												<?php
												$categoryNews = $newspaperModels->getLimitRecentByCategoryId($i, 3);
												// echo var_dump($categoryNews);
												foreach ($categoryNews as $news) {
												?>
												<!-- post -->
												<div class="col-md-4">
													<div class="post post-sm">
														<a class="post-img" href="blog-post.html"><img src="<?php echo $news['newspaper_imgae']; ?>" alt="news-img"></a>
														<div class="post-body">
															<div class="post-category">
																<a href="category.html"><?php echo $categoryList[$i - 1]['category_name']; ?></a>
															</div>
															<h3 class="post-title title-sm"><a href="blog-post.html"><?php echo strip_tags($news['newspaper_title']); ?></a></h3>
															<ul class="post-meta">
																<li><a href="author.html"><?php echo $newspaperModels->getAuthorById($i)['author_name']; ?></a></li>
																<?php
																$date = new DateTime($news['newspaper_date']);
																$date = $date->format('d M Y, H:i');
																?>
																<li><?php echo $date; ?></li>
															</ul>
														</div>
													</div>
												</div>
												<?php
												}
												?>
												</div>
											</div>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</li>
						<!-- Categories -->
						<?php
						for ($i=0; $i < count($categoryList); $i++) { 
						?>
						<li><a href="category.php?id=<?php echo $i + 1; ?>"><?php echo $categoryList[$i]['category_name']; ?></a></li>
						<?php
						}
						?>
					</ul>
					<!-- /nav -->
				</div>
			</div>
			<!-- /Main Nav -->

			<!-- Aside Nav -->
			<div id="nav-aside">
				<ul class="nav-aside-menu">
					<li><a href="index.html">Home</a></li>
					<li class="has-dropdown"><a>Categories</a>
						<ul class="dropdown">
            			<?php
						for ($i=0; $i < count($categoryList); $i++) { 
						?>
						<li><a href="category.php?id=<?php echo $i + 1; ?>"><?php echo $categoryList[$i]['category_name']; ?></a></li>
						<?php
						}
						?>
						</ul>
					</li>
					<li><a href="about.html">About Us</a></li>
					<li><a href="contact.html">Contacts</a></li>
				</ul>
				<button class="nav-close nav-aside-close"><span></span></button>
			</div>
			<!-- /Aside Nav -->
		</div>
		<!-- /NAV -->

		<!-- PAGE HEADER -->
		<div class="page-header">
			<div class="page-header-bg" style="background-image: url('./img/header-1.jpg');" data-stellar-background-ratio="0.5"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-offset-1 col-md-10 text-center">
						<h1 class="text-uppercase"><?php echo $categoryName['category_name']; ?></h1>
					</div>
				</div>
			</div>
		</div>
		<!-- /PAGE HEADER -->
	</header>
	<!-- /HEADER -->

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-8">
					<!-- post -->
					<div class="post post-thumb">
						<a class="post-img" href="blog-post.html"><img src="./img/hot-post-3.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Fashion</a>
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title title-lg"><a href="blog-post.html">Hello World</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
						</div>
					</div>
					<!-- /post -->

					<div class="row">
          <?php
						$newsRecent = $newspaperModels->getLimitRecentByCategoryId($id, 4);
						$i = 0;
						foreach ($newsRecent as $news) {
						?>
						<div class="col-md-6">
							<div class="post">
								<a class="post-img" href="blog-post.php/<?php echo createUrl($news['newspaper_title'], $news['newspaper_id']); ?>"><img src="<?php echo $news['newspaper_imgae'] ?>" alt="news-img"></a>
								<div class="post-body">
									<div class="post-category">
										<a href="category.php?id=<?php echo $news['newspaper_category_id'] ?>"><?php echo $categoryModels->getNameById($news['newspaper_category_id'])['category_name']; ?></a>
									</div>
									<h3 class="post-title"><a href="blog-post.php/<?php echo createUrl($news['newspaper_title'], $news['newspaper_id']); ?>"><?php echo strip_tags($news['newspaper_title']); ?></a></h3>
									<ul class="post-meta">
										<li><a href="author.html"><?php echo $newspaperModels->getAuthorById($news['newspaper_author_id'])['author_name']; ?></a></li>
										<?php
										$date = new DateTime($news['newspaper_date']);
										$date = $date->format('d M Y, H:i');
										?>
										<li><?php echo $date; ?></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						$i++;
						if ($i === 2) echo '<div class="clearfix visible-md visible-lg"></div>';
						}
						?>
					</div>

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.html"><img src="./img/post-13.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Travel</a>
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post.html">Mel ut impetus suscipit tincidunt. Cum id ullum laboramus persequeris.</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
						</div>
					</div>
					<!-- /post -->

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.html"><img src="./img/post-6.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Fashion</a>
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post.html">Sed ut perspiciatis, unde omnis iste natus error sit</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
						</div>
					</div>
					<!-- /post -->

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.html"><img src="./img/post-8.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Fashion</a>
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post.html">Postea senserit id eos, vivendo periculis ei qui</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
						</div>
					</div>
					<!-- /post -->

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.html"><img src="./img/post-12.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post.html">Sed ut perspiciatis, unde omnis iste natus error sit</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
						</div>
					</div>
					<!-- /post -->

					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post.html"><img src="./img/post-7.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category.html">Health</a>
								<a href="category.html">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post.html">Ne bonorum praesent cum, labitur persequeris definitionem quo cu?</a></h3>
							<ul class="post-meta">
								<li><a href="author.html">John Doe</a></li>
								<li>20 April 2018</li>
							</ul>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...</p>
						</div>
					</div>
					<!-- /post -->

					<div class="section-row loadmore text-center">
						<a href="#" class="primary-button">Load More</a>
					</div>
				</div>

				<div class="col-md-4">
					<!-- ad widget-->
					<div class="aside-widget text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/ad-3.jpg" alt="">
						</a>
					</div>
					<!-- /ad widget -->

					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="#" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- category widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Categories</h2>
						</div>
						<div class="category-widget">
              <ul>
								<?php
								foreach ($categoryList as $cat) {
								?>
									<li><a href="#"><?php echo $cat['category_name']; ?> <span><?php echo ($newspaperModels->countCategory($cat['category_id'])['COUNT(newspaper_category_id)']); ?></span></a></li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
					<!-- /category widget -->

					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
								<input class="input" name="newsletter" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->

					<!-- post widget -->
					<div class="aside-widget">
          <div class="section-title">
						<h2 class="title">Các bài đang nổi</h2>
						</div>
						<!-- post -->
            <?php
            $hotNews = $newspaperModels->getHotNews(6);
            foreach ($hotNews as $news) {
            ?>
            <div class="post post-widget">
							<a class="post-img" href="blog-post.php/<?php createUrl($news['newspaper_name'], $news['newspaper_id']); ?>"><img src="<?php echo $news['newspaper_imgae']; ?>" alt="news-img"></a>
							<div class="post-body">
								<div class="post-category">
									<a href="category.php?id=<?php echo $news['newspaper_category_id']; ?>"><?php echo $categoryModels->getNameById($news['newspaper_category_id'])['category_name']; ?></a>
								</div>
								<h3 class="post-title"><a href="blog-post.php/<?php createUrl($news['newspaper_name'], $news['newspaper_id']); ?>"><?php echo strip_tags($news['newspaper_title']); ?></a></h3>
							</div>
						</div>
            <?php
            }
            ?>
						<!-- /post -->
					</div>
					<!-- /post widget -->

					<!-- galery widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Instagram</h2>
						</div>
						<div class="galery-widget">
							<ul>
								<li><a href="#"><img src="./img/galery-1.jpg" alt=""></a></li>
								<li><a href="#"><img src="./img/galery-2.jpg" alt=""></a></li>
								<li><a href="#"><img src="./img/galery-3.jpg" alt=""></a></li>
								<li><a href="#"><img src="./img/galery-4.jpg" alt=""></a></li>
								<li><a href="#"><img src="./img/galery-5.jpg" alt=""></a></li>
								<li><a href="#"><img src="./img/galery-6.jpg" alt=""></a></li>
							</ul>
						</div>
					</div>
					<!-- /galery widget -->

					<!-- Ad widget -->
					<div class="aside-widget text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/ad-1.jpg" alt="">
						</a>
					</div>
					<!-- /Ad widget -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- FOOTER -->
	<footer id="footer">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-3">
					<div class="footer-widget">
						<div class="footer-logo">
							<a href="index.html" class="logo"><img src="./img/logo-alt.png" alt=""></a>
						</div>
						<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium. Nisl purus in mollis nunc sed. Nunc non blandit massa enim nec.</p>
						<ul class="contact-social">
							<li><a href="#" class="social-facebook"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#" class="social-twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#" class="social-google-plus"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#" class="social-instagram"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Categories</h3>
						<div class="category-widget">
							<ul>
								<li><a href="#">Lifestyle <span>451</span></a></li>
								<li><a href="#">Fashion <span>230</span></a></li>
								<li><a href="#">Technology <span>40</span></a></li>
								<li><a href="#">Travel <span>38</span></a></li>
								<li><a href="#">Health <span>24</span></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Tags</h3>
						<div class="tags-widget">
							<ul>
								<li><a href="#">Social</a></li>
								<li><a href="#">Lifestyle</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Travel</a></li>
								<li><a href="#">Technology</a></li>
								<li><a href="#">Fashion</a></li>
								<li><a href="#">Life</a></li>
								<li><a href="#">News</a></li>
								<li><a href="#">Magazine</a></li>
								<li><a href="#">Food</a></li>
								<li><a href="#">Health</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="footer-widget">
						<h3 class="footer-title">Newsletter</h3>
						<div class="newsletter-widget">
							<form>
								<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
								<input class="input" name="newsletter" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="footer-bottom row">
				<div class="col-md-6 col-md-push-6">
					<ul class="footer-nav">
						<li><a href="index.html">Home</a></li>
						<li><a href="about.html">About Us</a></li>
						<li><a href="contact.html">Contacts</a></li>
						<li><a href="#">Advertise</a></li>
						<li><a href="#">Privacy</a></li>
					</ul>
				</div>
				<div class="col-md-6 col-md-pull-6">
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
