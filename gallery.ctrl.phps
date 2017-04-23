<!--StAuth10127: I Mahesh Jethva, 000327510 certify that this material is my original work. No other person's work has been used without due acknowledgement. I have not made my work available to anyone else.-->
<?

// Allows us to use undefined variables without PHP notices
error_reporting(E_ALL & ~E_NOTICE);

define("gallery_path", "photos");
define("gallery_desc", "description.txt");

$TPL['gallery_title'] = "My Photo Galleries";
$TPL['ctlr'] = $_SERVER['PHP_SELF'];

switch ($_REQUEST["act"]) :	   
		
	case "onephoto": 
		$TPL['one_photo'] = true;
		$gallerydirectory = gallery_path . "/" . $_REQUEST['dir'] . "/";
		$descText = file_get_contents($gallerydirectory . gallery_desc);
	
		if (is_dir($gallerydirectory . 'thumbs')) 
		{	
			if($directory = opendir($gallerydirectory . 'thumbs')) 
			{
				while (($file = readdir($directory)) !== false) 
				{
					if ($file == '.' || $file == '..') continue;
					
						$photoarr[] = $file;
				}
			}
			closedir($directory);
			sort($photoarr);
		}
		
		if ($_REQUEST['id'] == 0)
		{
			$prevImage = count($photoarr) - 1;		
		}
		else 
		{
			$prevImage = $_REQUEST['id'] - 1;
		}
		if ($_REQUEST['id'] == count($photoarr) - 1) 
		{
			$nextImage = 0;
		}
		else 
		{
			$nextImage = $_REQUEST['id'] + 1;
		}
		
		$TPL['photos'] = $photoarr;
		$TPL['phototodisplay'] = $photoarr[$_REQUEST['id']];
		$TPL['dir'] = $_REQUEST['dir'];
		$TPL['previousImage'] = $prevImage;
		$TPL['nextImage'] = $nextImage;
		$TPL['totalCount'] = count($photoarr);	
		$TPL['thisone'] = $_REQUEST['id'] + 1;
		$TPL['desc'] = $descText;
		$TPL['pathtophotos'] = $gallerydirectory;
		break;

		//read directories
	case "allphotos" : 		
		$TPL['all_photos'] = true;		
		$gallerydirectory = gallery_path . "/" . $_REQUEST['dir'] . "/";
		$descText = file_get_contents($gallerydirectory . gallery_desc);
		
		if (is_dir($gallerydirectory . 'thumbs'))
		{
			if ($directory = opendir($gallerydirectory . 'thumbs'))
			{
				while(($file = readdir($directory)) !== false) 
				{
					if ($file == '.' || $file == '..') continue;
						
					$photoarr[] = $file;
				}
			closedir($directory);
			sort($photoarr);
			}
		}
			
		$TPL['pathtophotos'] = $gallerydirectory;
		$TPL['pathtothumbs'] = $gallerydirectory . 'thumbs/';
		$TPL['dir'] = $_REQUEST['dir'];		
		$TPL['thumbs'] = $photoarr;
		$TPL['desc'] = $descText;
		break;
	
	default:
	
		$TPL['all_gallery_images'] = true;
		$fp = opendir(gallery_path);
		
		while(($dir = readdir($fp)) !== false) 
		{
			if ($dir == "." || $dir == "..") continue;						
			
			$gallerydirectory = gallery_path . "/" . $dir . "/";						
			$descText = file_get_contents($gallerydirectory . gallery_desc);
			
			unset($photoarr);
			
			if (is_dir($gallerydirectory . 'thumbs'))
			{
				if ($directory = opendir($gallerydirectory . 'thumbs'))
				{
					while(($file = readdir($directory)) !== false) 
					{
						if ($file == '.' || $file == '..') continue;
						
						$photoarr[] = $file;
						unset($photoarr[0]);
					}
				closedir($directory);
				sort($photoarr);
				}
			}
				
									
			$descPath = gallery_path . '/' . $dir . '/' . 'description.txt';			
			$descText = file_get_contents($descPath);
			$lastthumbpath = gallery_path . "/" . $dir . "/thumbs/" . end($photoarr);
			$gallerydir = gallery_path . "/" . $dir . "/";			
			$TPL['gallery_entries'][] = array('dir' => $dir, 'desc' => $descText, 'LASTTHUMB' => $lastthumbpath, 'THUMBS' => $photoarr);
		}
		
		closedir($fp);
		
		sort($TPL['gallery_entries']);

endswitch;

include 'gallery.view.php';
?>