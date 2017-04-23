<!--StAuth10127: I Mahesh Jethva, 000327510 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>My Photo Galleries</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	</style>
  </head>
  <body>
	<div class = "row">
	
		<h1 class="text-info" style="text-align: center">
			<a class="text-info" href="<?= $TPL['ctlr'] ?>"><?= $TPL['gallery_title'] ?></a>
		</h1>
		
	</div>
	
	<div class="controller" style="margin-left: 35px; margin-right: 35px;">
		
		<div class="row">
			
		<?  if ($TPL['one_photo']) { ?>
			<div class="text-center">
				
				<h4><?= $TPL['desc'];?></h4>
				
				<a class="btn btn-warning" href = "<?= $TPL['ctlr'] ?>?act=onephoto&dir=<?= $TPL['dir'] ?>&id=<?= $TPL['previousImage']?>">Previous</a>
				<a class="btn btn-success" href = "<?= $TPL['ctlr'] ?>?act=onephoto&dir=<?= $TPL['dir'] ?>&id=<?= $TPL['nextImage']?>">Next</a>
				
				<span><?= '(' . $TPL['thisone'] . '/' . $TPL['totalCount'] . ')' ?></span>
				
				<a class="btn btn-info" href="<?= $TPL['ctlr'] ?>?act=allphotos&dir=<?= $TPL['dir'] ?>">Show all</a>				
				<img id = "main" class="center-block img-responsive text-center" src = "<? echo $TPL['pathtophotos'] . $TPL['phototodisplay']; ?>"></img>
				
			</div>
		<? } ?>
					
		<? if ($TPL['all_gallery_images']) { ?>			
			<? foreach ($TPL['gallery_entries'] as $index => $gallery) { ?>
				
				<div class="col-lg-4 col-md-3 col-xs-6" style="margin-top: 20px; padding-left: 20px; padding-right: 20px;">
					
					<div class="alert alert-dismissible alert-success">
						
						<a href="<?= $TPL['ctlr'] ?>?act=allphotos&dir=<?= $gallery['dir'] ?>&id=<?php echo $index;?>">
							<img class="center-block img-responsive" src = "<?php echo $gallery['LASTTHUMB'] ?>"></img>
						</a>
						
						<p class="img-rounded text-center"><a href = '<?= $TPL['ctlr'] ?>?act=allphotos&dir=<?= $gallery['dir'] ?>' class = 'link'><?= $gallery['desc']?></a></p>
						
					</div>
					
				</div>
				
			<? } ?>
		<? } ?>
					
		<? if ($TPL['all_photos']) { ?>
		
			<div class="alert alert-dismissible alert-success" style="width: 50%;">
			
				<p><? $TPL['desc']?></p>
				<p>Click on a photo to start a slide show</p>
				
			</div>
				
				<? foreach ($TPL['thumbs'] as $index => $gallery) { ?>
					
					<div class="col-lg-2 col-md-3 col-sm-2 col-xs-3 text-center" style="margin-top: 1%;">
					
						<a href="<?= $TPL['ctlr'] ?>?act=onephoto&dir=<?= $TPL['dir'] ?>&id=<?php echo $index;?>">
							<img class = "center-block img-responsive text-center" src = "<?php echo $TPL['pathtothumbs'] . $gallery;?>"></img>
						</a>
						
					</div>
					
				<? } ?>
				
		<? } ?>
			
		</div>		
	</div>
	
	<div>
		<!--
		<?php print_r($TPL); ?>
		-->
	</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>