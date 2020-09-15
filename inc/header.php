<?php include 'config/config.php'; ?>
<?php include 'lib/Database.php'; ?>
<?php include 'helpers/Format.php'; ?>
<?php
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	//set headers to NOT cache a page
	header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
	header("Pragma: no-cache"); //HTTP 1.0
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");  
	?>
	<?php
		if (isset($_GET['blogPageId'])) {
			$id = $_GET['blogPageId'];

			$query = "SELECT * FROM tbl_page WHERE id = '$id'";
			$temp = $db->select($query);

			if ($temp) {
				$resultTitle = $temp->fetch_assoc();
				$title = $resultTitle['name'];
			}
			
		} elseif (isset($_GET['id'])) {
			$id = $_GET['id'];

			$query = "SELECT * FROM tbl_post WHERE id = '$id'";
			$temp = $db->select($query);

			if ($temp) {
				$resultTitle = $temp->fetch_assoc();
				$title = $resultTitle['title'];
			}
		} else {
			$title = $fm->title();
		}
	?>
	<title><?= ucwords($title); ?> - <?= TITLE; ?></title>
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<meta name="language" content="English">
	<meta name="description" content="<?= isset($resultTitle['title']) ? $resultTitle['title'] : KEYWORDS; ?>">
	<meta name="keywords" content="<?= isset($resultTitle['tags']) ? $resultTitle['tags'] : KEYWORDS; ?>">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<?php
			$query = "SELECT * FROM tbl_logo";
			if ($logo = $db->select($query)) {
				$result = $logo->fetch_assoc();
			}

		?>
		<a href="#">
			<div class="logo">
				<img src="admin/<?= $result['logo']; ?>" alt="Logo"/>
				<h2><?= $result['title']; ?></h2>
				<p><?= $result['slogan']; ?></p>
			</div>
		</a>
		<?php
			$querySocial = "SELECT * FROM tbl_social";
			$post = $db->select($querySocial);

			if ($post) {
				$resultSocial = $post->fetch_assoc();
			}
		?>
		<div class="social clear">
			<div class="icon clear">
				<a href="<?= $resultSocial['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?= $resultSocial['tw']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?= $resultSocial['ln']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?= $resultSocial['gp']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a id="<?= $fm->title() == 'home' ? 'active': ''; ?>" href="index.php">Home</a></li>
		<?php
			$query = "SELECT * FROM tbl_page";
			$temp = $db->select($query);

			if ($temp) {
				while($resultPage = $temp->fetch_assoc()) {
		?>
					<li>
						<a id="<?= isset($_GET['blogPageId']) && $_GET['blogPageId'] == $resultPage['id'] ? 'active' : ''; ?>"
							href="blogpage.php?blogPageId=<?= $resultPage['id']; ?>"><?= $resultPage['name']; ?></a>
					</li>	
		<?php
				}
			}
		?>
		<li><a id="<?= $fm->title() == 'contact' ? 'active': ''; ?>" href="contact.php">Contact</a></li>
	</ul>
</div>
