<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Tools.php';
require_once $root.'/views/back/Events_View.php';

class Layout_View
{
	private $data;
	private $title;
	private $section;
	
	public function __construct($data, $title)
	{
		$this->data = $data;
		$this->title = $title;
	}    
	
	/**
	 * function printHTMLPage
	 * 
	 * Prints the content of the whole website
	 * 
	 * @param head 		(string) Is the head of the HTML structure
	 * @param header 	(string) Is the menu and logo section
	 * @param bodyType	(string) Is for CSS purposes
	 * @param body		(string) Content of the website
	 * 
	 */
	
	public function printHTMLPage($section)
    {
    	$this->section = $section;
    ?>
	<!DOCTYPE html>
	<html class='no-js' lang='<?php echo $this->data['appInfo']['lang']; ?>'>
		<head>
			<!--[if IE]> <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
			<link rel="shortcut icon" href="favicon.ico" />
			<link rel="icon" type="image/gif" href="favicon.ico" />
			<title><?php echo $this->title; ?> - <?php echo $this->data['appInfo']['title']; ?></title>
			<meta name="keywords" content="<?php echo $this->data['appInfo']['keywords']; ?>" />
			<meta name="description" content="<?php echo $this->data['appInfo']['description']; ?>" />
			<meta property="og:type" content="website" /> 
			<meta property="og:url" content="<?php echo $this->data['appInfo']['url']; ?>" />
			<meta property="og:site_name" content="<?php echo $this->data['appInfo']['siteName']; ?> />
			<link rel='canonical' href="<?php echo $this->data['appInfo']['url']; ?>" />
			<?php echo self::getCommonDocuments(); ?>			
			<?php 
			switch ($section) {
				case 'sign-in':
 					echo self :: getSignInHead();
				break;
			
				case 'main-gallery':
					echo self :: getMainGalleryHead();
				break;
				
				case 'add-company':
					echo self :: getAddCompanyHead();
				break;
				
				case 'edit-company-main':
					echo self :: getEditCompanyMainHead();
				break;
				
				case 'edit-company-info':
					echo self :: getEditCompanyInfoHead();
				break;
				
				case 'edit-company-seo':
					echo self :: getEditCompanySeoHead();
				break;
				
				case 'edit-company-social':
					echo self :: getEditCompanySocialHead();
				break;
				
				case 'edit-company-contact':
					echo self :: getEditCompanyContactHead();
				break;
				
				case 'edit-company-media':
					echo self :: getEditCompanyMediaHead();
				break;
				
				case 'edit-company-settings':
					echo self :: getEditCompanySettingsHead();
				break;
				
				case 'settings':
					echo self :: getSettingsHead();
				break;
				
				case 'members':
					echo self :: getMembersHead();
				break;
				
				case 'member-detail':
					echo self :: getMembersDetailsHead();
				break;
				
				case 'categories':
					echo self :: getCategoriesHead();
				break;
				
				case 'locations':
					echo self :: getLocationHead();
				break;
				
				case 'videos':
					echo self :: getVideosHead();
				break;
				
				case 'edit-company-events':
					echo self :: getEventsListHead();
				break;
			}
			?>
		</head>
		<body id="<?php echo $section; ?>">
			<?php 
 			echo self :: getHeader();
			?>
			<div id='main-content'>
				<?php 
				switch ($section) {
					case 'sign-in':
						echo self :: getSignInContent();
					break;
					
					case 'companies':
						echo self :: getGridContent();
					break;
					
					case 'main-gallery':
						echo self :: getMainGalleryContent();
					break;
					
					case 'add-company':
						echo self :: getAddCompanyBox();
					break;
					
					case 'edit-company-main':
						echo self :: getEditCompanyMainContent();
					break;
					
					case 'edit-company-info':
						echo self :: getEditCompanyInfoContent();
					break;
					
					case 'edit-company-seo':
						echo self :: getEditCompanySeoContent();
					break;
					
					case 'edit-company-social':
						echo self :: getEditCompanySocialContent();
					break;
					
					case 'edit-company-contact':
						echo self :: getEditCompanyContactContent();
					break;
					
					case 'edit-company-media':
						echo self :: getEditCompanyMediaContent();
					break;
					
					case 'edit-company-settings':
						echo self :: getEditCompanySettingsContent();
					break;
	
					case 'settings':
						echo self :: getSettingsContent();
					break;
					
					case 'members':
						echo self :: getMembersContent();
					break;
					
					case 'member-detail':
						echo self :: getMembersDetailsContent();
					break;
					
					case 'categories':
						echo self :: getCategoriesContent();
					break;
					
					case 'locations':
						echo self :: getLocationContent();
					break;
					
					case 'videos':
						echo self :: getVideosContent();
					break;
					
					case 'edit-company-events':
						echo self :: getEventsLisContent();
					break;
					
					default:
					break;
				}
				?>
			</div>
			<?php 
 			echo self :: getFooter(); 
			?>
		</body>
	</html>
    <?php
    }
    
    /**
     * getCommonDocuments
     * 
     * returns the common css and js that are in all the web documents
     * 
     * @return string
     */
    public function getCommonDocuments()
    {
    	ob_start();
    	?>
       	<link href="/css/back/style.css" media="screen" rel="stylesheet" type="text/css" />
    	<script type="text/javascript" src="/js/jquery.js"></script>
    	<script type="text/javascript" src="/js/back/scripts.js"></script>
       	<?php 
       	$documents = ob_get_contents();
       	ob_end_clean();
       	return $documents; 
    }
    
    /**
     * getHeader
     *
     * it's the top and main navigation menu
     *
     * @return string
     */
    public function getHeader()
    {
    	ob_start();
    	$active='class="active"';
    	?>  		
    	<header id='masthead'>
			<div class='inside-masthead cf'>
				<?php 
				if ($this->section == 'sign-in')
				{
					?>
				<a class='logo' href='/admin/'>
					<span>where to go</span>
				</a>
				<nav id='nav'>
					<ul>
						<li><a href="/admin/" class="active">Sign In</a></li>
						<li><a href="../contact-us/">Sign Up</a></li>
					</ul>
				</nav>
					<?php 
				}
				else 
				{
					?>
				<nav id='nav'>
					<ul>
						<li><a <?php if ($_GET['section'] == 1) echo $active; ?> href="/admin/grid/">Profile</a></li>
						<li><a <?php if ($_GET['section'] == 2) echo $active; ?> href="/admin/add-company/">Add Company</a></li>
						<li><a <?php if ($_GET['section'] == 3) echo $active; ?> href="/admin/grid/ ">Companies</a></li>
						<li><a <?php if ($_GET['section'] == 4) echo $active; ?> href="#">Emails</a></li>
						<li><a <?php if ($_GET['section'] == 5) echo $active; ?> href="/admin/members/">Members</a></li>
						<li><a <?php if ($_GET['section'] == 6) echo $active; ?> href="#">Tasks</a></li>
						<li><a <?php if ($_GET['section'] == 7) echo $active; ?> href="/admin/main-gallery/">Main Gallery</a></li>
						<li><a <?php if ($_GET['section'] == 8) echo $active; ?> href="/admin/videos/">Videos</a></li>
						<li><a <?php if ($_GET['section'] == 9) echo $active; ?> href="/admin/settings/">Settings</a></li>
						<li><a <?php if ($_GET['section'] == 10) echo $active; ?> href="#">Sign Out</a></li>
					</ul>
				</nav>
					<?php 
				}
				?>
				
			</div>
		</header>
    	<?php
    	$header = ob_get_contents();
    	ob_end_clean();
    	return $header;
    }
    
    /**
     * getSignInHead 
     * 
     * it is the head that works for the sign in section, aparently isn't getting 
     * any parameter, I just left it here for future cases
     * 
     * @return string
     */
    public function getSignInHead()
    {
    	ob_start();
    	?>
    	<script type="text/javascript">
		</script>
    	<?php
    	$signIn = ob_get_contents();
    	ob_end_clean();
    	return $signIn;
    }
    
    /**
     * getSignInContent
     * 
     * the sign-in box
     * 
     * @return string
     */
    public function getSignInContent()
    {
    	ob_start();
    	?>
    	<div class='inside-main-content cf'>
	    	<div id='signin'>
				<section class='panel sign-up-panel'>
					<header>
						<h1>Sign in</h1>
					</header>
					<div class='inside-panel'>
						<p>ready for the fun?</p>
						
						<form id="slick-login" method='post' 
								action="<?php echo $_SERVER['REQUEST_URI']; ?>">
							<label for="username">username</label>
							<input type="text" class="placeholder"
									placeholder="<?php echo $this->data['appInfo']['email']; ?>"
									onkeypress="check(event);"
									name='loginUser' />
							<label for="password">password</label>
							<input type="password" class="placeholder"
									placeholder="password"
									onkeypress="check(event);"
									name='loginPassword' />
							<input type="hidden" name="submitButton" value="1">
						</form>
						
						<ul class='sign-up-buttons'>
							<li>
								<a class='button' href='/go/' id="login">
									Sign in
								</a>
							</li>
						</ul>
					</div><!-- /inside-panel -->
				</section>
				
				<p class='sign-up-terms'>
					Need an account?
					<a href="../contact-us/"><?php echo $this->data['appInfo']['siteName']; ?></a>.
				</p>
			
			</div><!-- /panel sign-up-panel -->
		</div>
        <?php
        $wideBody = ob_get_contents();
        ob_end_clean();
        return $wideBody;
    }
    
    /**
     * getGridInHead
     * 
     * the head for the grid
     * 
     * @return string
     */
    public function getGridInHead()
    {
    	ob_start();
    	?>
       	<script type="text/javascript">
    	</script>
       	<?php
       	$signIn = ob_get_contents();
       	ob_end_clean();
       	return $signIn;
    }
    
    /**
     * getTopBar
     * 
     * it's the menu of the categories, i'ts present in all the documents
     * @return string
     */
    public function getTopBar()
    {
    	ob_start();
    	$curCat = $_GET['categoryId'];
    	?>
   		<div class='filter-bar' id='x-scopes-bar'>
   			<div class='inside cf'>
   				<ul class='filter-nav' id='x-scopes'>
   					<li>
   						<a href="/admin/grid/"
   								<?php
   								if($curCat == '')
   								{
   								?>
   									class="selected"
   								<?php
   								}
   								?>
   								 >
   								All
   						</a>
   					</li>
   					<li>
   						<a href="/admin/grid/promoted/">Promoted</a>
   					</li>
    				<?php
   					$i = 0;
   					
   				    foreach ($this->data['categories'] as $c)
   				    {
   					    $i++;
   				    ?>
   			        <li>
   						<a href="/admin/grid/<?php echo $c['category_id']; ?>/<?php echo Tools::slugify($c['name']); ?>/"
   							<?php
   							if($curCat == $c['category_id'])
   							{
   							?>
   								class="selected"
   							<?php
   							}
   							?>
   						>
   							<?php echo $c['name']; ?>
   						</a>
   					</li>
   				    <?php
   				    }
   				    ?>
   				</ul>
   				
   				<ul class='toggle-nav'>
   					<li>
   						<a class='action search' href='#' id='x-show-search' onclick="showSearchBar(); return false;"></a>
   					</li>
   				</ul>
   			</div><!-- /inside cf -->
   		</div><!-- /filter-.bar -->
   		
   		<?php
   		$topBar = ob_get_contents();
   		ob_end_clean();
   		return $topBar;
   	}
   	
   	/**
   	 * getSearchBar
   	 * 
   	 * it's the search bar, actually it doesn't work
   	 * 
   	 * @return string
   	 */
    
   	public static function getSearchBar()
   	{
   		ob_start();
   		?>
   		<!-- /search bar -->
   		<div class='filter-bar hide search-bar' id='x-search'>
   			<div class='inside cf'>
   				<form class='search-bar' href='#'>
   					<input name='search' id='input-search' placeholder='Type here to search, for example: La fe' type='text'>
   				</form>
   	   				<ul class='toggle-nav'>
   					<li>
   						<a class='action search' href='#' onclick="showTopBar(); return false;" id='x-hide-search'></a>
   					</li>
   				</ul>
   			</div><!-- /inside cf -->
   		</div>
   		<?php
   		$searchBar = ob_get_contents();
   		ob_end_clean();
   		return $searchBar;
   	}
   	
   	/**
   	 * getGrid
   	 * 
   	 *The grid of all the companies, it doesn't matter if it's published or not 
   	 * @return string
   	 */
   	public function getGrid()
   	{
   		ob_start();
   		?>
   		<div id="main-grid" class='inside cf'>
   			<?php
   				$i = 0;
   				$j = 1;
   				foreach ($this->data['companies'] as $a)
   				{
   					if ($i == 0)
   					{
   					?>
   				<ul class='protips-grid cf'>
   					<?php
   					}
   					?>
   					<li 
   						<?php 
   						if ($a['published'] == 0)
   						{
   							?>
   							class='unpublished'
   							<?php
   						}
   						?>
   					>
   						<article class='protip' id='ms_n0w'>
   							<header>
   								<?php 
   								$logo = "";
   								
   								if ($a['logo'])
   								{
   									$logo = "/img-up/companies_pictures/logo/".$a['logo'];
   								}
   								else {
									$logo = "/images/default_item_front.jpg";
								}
   								?>
   								<img src="<?php echo $logo; ?>" />
   							</header>
   							<a href="/admin/company/main/<?php echo $a['company_id']; ?>/<?php echo Tools::slugify($a['name']); ?>/" class="title hyphenate track x-mode-popup" ><?php echo $a['name']; ?></a>
   							<footer class='cf'>
   								<ul class='author'>
   									<li class='user'>
   										<?php echo $a['category']; ?>
   									</li>
   								</ul>
   							</footer>
   						</article>
   					</li>
   					<?php
   					$i++;
   					
   					if ($i == 4)
   					{
   					?>
   				</ul>
   					<?php
   					$i = 0;
   					$j++;
   					}
   				}
   			?>
   		</div>
   		<?php		
   		$items = ob_get_contents();
   		ob_end_clean();
   		return $items;
   	}
   	
   	/**
   	 * getGridContent
   	 * it returns the structure of the grid 
   	 * @return string
   	 */
    public function getGridContent()
    {
    	ob_start();
    	?>
    	<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
				echo self::getTopBar();
				echo self::getSearchBar();
				echo self::getGrid();
			?>
		</section>
    	<?php
    	$grid = ob_get_contents();
    	ob_end_clean();
    	return $grid;
    }
    
    /**
     * getMainGalleryContent
     * 
     * returns the content box for the galleries, in fact are the sliders
     * 
     * @return string
     */
    public function getMainGalleryContent()
    {
    	ob_start();
    	?>
       	<section class='new-main-content cf' id='x-protips-grid'>
    		<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
    		<?php 
    			echo self::getTopBar();
    			echo self::getSearchBar();
    			echo self::getMainGalleryBox();
    		?>
    	</section>
       	<?php
       	$grid = ob_get_contents();
       	ob_end_clean();
       	return $grid;
    }
    
    
    /**
     * getMainGalleryHead
     * 
     * returns all the js and css for the main gallery
     * 
     * @return string
     */
    public function getMainGalleryHead()
    {
    	ob_start();
    	?>
    		<link href="/css/back/uploadfile.css" rel="stylesheet">
    		<link href="/css/back/jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
    		<script src="/js/jquery-ui.min.js"></script>
    		<script src="/js/back/jquery.uploadfile.min.js"></script>
    		<script src="/js/back/imagesloaded.js"></script>
			<script src="/js/back/scale.fix.js"></script>
			<script src="/js/back/jquery.drag-n-crop.js"></script>
			<script src="/js/back/main-sliders.js"></script>
        	<script type="text/javascript">
			width = 0;
			height = 0;
			image = "";
			x=0;
			y=0;
			lastId = 0;
			var dnd;
			
        	$(document).ready(function()
        	{
        		$(".uploader").uploadFile({
	        		url:"/ajax/back/main-sliders.php?option=1",
	        		fileName:"myfile",
	        		multiple: false,
	        		doneStr:"uploaded!",
	        		onSuccess:function(files,data,xhr)
	        		{
	        			obj 	= JSON.parse(data);
	        			width 	= obj.wp;
	        			height 	= obj.hp;
	        			image 	= obj.fileName;
	        			lastId 	= obj.lastId;
	        			createDrag(obj.fileName);
	        			$('.save-crop').show();
	        		}
        		});
				
        		function createDrag(image)
        		{
            		source = '/img-up/main-gallery/medium/'+image;
            		$('#crop').attr('src', source);
        			dnd = $('#crop').dragncrop({
            			instruction: false,
            			centered: false,
            			stop: function(evnt, position){
            			   	dimensions = String(position.dimension);
            			   	res = dimensions.split(",");
            			   	x = res[0];
            			   	y = res[1];
            			  }
                    });
            	}

            	$('#save-crop').click(function(){
					save();
					dnd.dragncrop('destroy');
					return false;
                });

            	$('#add-slider').click(function(){
            		$('.main-slider-upload').show();
            		return false; 
                });

                $('.save-slider').click(function(){
					saveSliderData($(this).attr('sid'));
					return false;
                });

                $('.delete-slider').click(function(){
                	deleteSlider($(this).attr('sid'));
					return false;
                });
        	});
        	
        	function save()
        	{
        		imgId = image;
        		
        	    $.ajax({
        	        type:   'POST',
        	        url:    '/ajax/back/main-sliders.php?option=2',
        	        data:{  x: x,
        	                y: y,
        	            imgId: imgId
        	             },
        	        success:
        	        function(xml)
        	        {
        	            if (0 != xml)
        	            {
        	            	$('.main-slider-upload').fadeOut();
        	            	item = '<div class="slider-item" id="sid-'+lastId+'">'
								+'<header>'
								+'<a href="#" class="button red delete-slider" sid="'+lastId+'">delete</a>'
								+'<a href="#" class="button save-slider" sid="'+lastId+'">save</a>'
								+'</header>'
								+'<section>'
								+'<div class="img-container">'
								+'<img src="/img-up/main-gallery/thumb/'+imgId+'" />'
								+'</div>'
								+'<div class="slider-labels">'
								+'<label>Title</label>'
								+'<input type="text" value="" class="slider-title" />'
								+'<div class="clr"></div>'
								+'</div>'
								+'</section>'
								+'<div class="clr"></div>'
								+'<div class="sliders-promos">'
								+'<label>Link</label>'
								+'<input type="text" value="" class="slider-link" />'
								+'<div class="clr"></div>'
								+'<label>Promos</label>'
								+'<textarea rows="" cols="" class="slider-promos"></textarea>'
								+'</div>'
								+'<div class="clr"></div>'
								+'</div>';

							$('#slider-items').prepend(item);

							$('.save-slider').click(function(){
								saveSliderData($(this).attr('sid'));
								return false;
			                });

			                $('.delete-slider').click(function(){
			                	deleteSlider($(this).attr('sid'));
								return false;
			                });
        	            }
        	        }
        	    });
        	}

    		</script>
       	<?php
       	$signIn = ob_get_contents();
       	ob_end_clean();
       	return $signIn;
    }
    
    /**
     * getMainGalleryBox
     * it's the place where all the action happen ;) 
     * @return string
     */
    public function getMainGalleryBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<header>
				<a href="#" id="add-slider">Add slider</a>
				<div class="clr"></div>
			</header>
			<h1>Main slider</h1>
			<p>(970px / 300px)</p>
			
			<div class="slider-box">
				<div class="main-slider-upload">
					<div class="uploader">
						Upload
					</div>
					<div class="crop-box">
						<div style="width: 880px; height:271px" class="crop-container"> <img src="" id="crop" /></div>
					</div>
					<a href="#" class="button save-crop" id="save-crop">save</a>
					<div class="clr"></div>
				</div>
				<div id="slider-items">
					<?php 
					foreach ($this->data['mainSliders'] as $slider) {
					?>
					<div class="slider-item" id="sid-<?php echo $slider['picture_id']; ?>">
						<header>
							<a href="#" class="button red delete-slider" sid="<?php echo $slider['picture_id']; ?>">delete</a>
							<a href="#" class="button save-slider" sid="<?php echo $slider['picture_id']; ?>">save</a>
						</header>
						<section>
							<div class="img-container">
			    				<img src="/img-up/main-gallery/thumb/<?php echo $slider['name']; ?>" />
			    			</div>
			    			<div class="slider-labels">
				    			<label>Title</label>
				    			<input type="text" value="<?php echo $slider['title']; ?>" class="slider-title" />
				    			<div class="clr"></div>
			    			</div>
						</section>
						<div class="clr"></div>
						<div class="sliders-promos">
							<label>Link</label>
			    			<input type="text" value="<?php echo $slider['link']; ?>" class="slider-link" />
			    			
			    			<div class="clr"></div>
							<label>Promos</label>
							<textarea rows="" cols="" class="slider-promos"><?php echo $slider['promos']; ?></textarea>
						</div>
						<div class="clr"></div>
					</div>
					<?php 
					}
					?>
				</div>
			</div>
		</div>
		<?php
		$mainGalleryBox = ob_get_contents();
		ob_get_clean();
		return $mainGalleryBox;
	}
	
	/**
	 * getEditCompanyMainContent
	 * 
	 * it's the structure for edit a company
	 * 
	 * @return string
	 */
	public function getEditCompanyMainContent()
	{
		ob_start();
		?>
       	<section class='new-main-content cf' id='x-protips-grid'>
    		<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
    		<?php 
    			echo self::getTopBar();
    			echo self::getSearchBar();
    			echo self::getEditCompanyMainBox();
    		?>
    	</section>
       	<?php
       	$grid = ob_get_contents();
       	ob_end_clean();
       	return $grid;
    }
    
	/**
	 * getEditCompanyHead
	 * 
	 * the head for the edit company
	 * 
	 * @return string
	 */
	public function getEditCompanyMainHead()
	{
		ob_start();
		?>
        	<script type="text/javascript">
    		</script>
       	<?php
       	$editCompanyHead = ob_get_contents();
       	ob_end_clean();
       	return $editCompanyHead;
    }
    
    /**
     * getEditCompanyTop
     *
     * menu for the company edit
     * 
     * @return string
     */
    public function getEditCompanyTop()
    {
    	ob_start();
    	?>
    	<header>
    		<a href="/admin/company/settings/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Settings</a>
   			<a href="/admin/company/events/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Events</a>
   			<a href="/admin/company/social/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Social</a>
   			<a href="/admin/company/contact/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Contact</a>
   			<a href="/admin/company/media/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Media</a>
   			<a href="/admin/company/seo/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">SEO</a>
   			<a href="/admin/company/info/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Info</a>
   			<a href="/admin/company/main/<?php echo $this->data['company']['general']['company_id']; ?>/<?php echo Tools::slugify($this->data['company']['general']['name']); ?>/" id="">Dashboard</a>
   			<div class="clr"></div>
   		</header>
   		<h1><?php echo $this->data['company']['general']['name']; ?></h1>
   		<p><?php echo $this->data['company']['general']['category_name']; ?></p>
   		<div class="edit-company-top-box">
   			<div class="dashboard-top-edit">
   				<div class="left">
   					<?php 
   					if ($this->data['company']['logo']['logo'])
   					{
   						?>
   						<img id="companyLogo" alt="<?php echo $this->data['company']['general']['name']; ?>" src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']['logo']; ?>"  />
   						<?php 
   					}
   					else
   					{
   						?>
   						<img id="companyLogo" alt="<?php echo $this->data['company']['general']['name']; ?>" src="/images/default_item_front.jpg"  width="300" height="150" />
   						<?php
   					}
   					?>
   					
   				</div>
   				<div class="center">
					<?php 
					foreach ($this->data['company']['emails'] as $e)
					{
					?>
					<p><?php echo $e['e_mail']; ?></p>
					<?php
					}
					?>
					<div class="clr"></div>
					<?php 
					foreach ($this->data['company']['phones'] as $p)
					{
					?>
					<a href="tel:<?php echo $p['telephone']; ?>" ><?php echo $p['telephone']; ?></a>
					<div class="clr"></div>
					<?php
					}
					?>
					<div class="clr"></div>
					<p class="description"><?php echo stripslashes($this->data['company']['seo']['description']); ?></p>
   				</div>
   				<div class="right">
   					<h4>Notes</h4>
   					<div class="notes"></div>
   				</div>
   				<div class="clr"></div>
   			</div>
   		</div>
    	<?php
    	$editCompanyTop = ob_get_contents();
    	ob_end_clean();
    	return $editCompanyTop;
    }
    
    /**
     * getEditCompanyInfoHead
     * 
     * all the script for edit the main info of the company
     * 
     * @return string
     */
    public function getEditCompanyInfoHead()
    {
    	ob_start();
    	?>
	       	<script src="/js/back/trumbowyg/trumbowyg.js"></script>
	       	<link rel="stylesheet" href="/js/back/trumbowyg/ui/trumbowyg.css">
	       	<script type="text/javascript">
	       	$(document).ready(function()
	        {
	       		$('#company-description').trumbowyg({
	       			fullscreenable: false,
	       			mobile: true,
	       		    tablet: true,
	       		 	resetCss: true,
		       		autogrow: true,
		       		btns: ['bold', 'italic', 'underline', 'strikethrough', '|', 
		   	       		'strong', 'em', '|', 
		   	       		'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '|', 
		   	       		'unorderedList', 'orderedList', '|', 'link']
		       	});
	        });
	        
			<?php 
			$i 		= 0;
			$varSub = '';
			
	       	foreach ($this->data['belongSubcategories'] as $s)
	    	{
	    		$varSub .= "subcategories[".$i."] = ".$s['subcategory'].'; ';
	    		$i++;
	    	}
	    	
	    	$varLoc = '';
	    	$i 		= 0;
	    	foreach ($this->data['companiesLocations'] as $c)
	    	{
	    		$varLoc .= "locations[".$i."] = ".$c['ubication'].'; ';
	    		$i++;
	    	}
	    	?>

	    	var subcategories = new Array(<?php echo count($this->data['belongSubcategories'])?>);
	    	var locations = new Array(<?php echo count($this->data['companiesLocations'])?>);
			<?php echo $varSub; ?>
			<?php echo $varLoc; ?>

			$(document).ready(function()
	        {
				checkSubategories(subcategories);
				checkLocations(locations);

				$('#categories a').click(function(){
			    	changeCategory(this);
			    });

			    $('#subcategories a').click(function(){
			    	updateSubcategoriesByCompany(this);
			    });

			    $('#locations a').click(function(){
			    	updateCompanyLocation(this);
			    });
	        });			
	       	</script>
	       	
	       	<script src="/js/back/company.js"></script>
       	<?php
       	$editCompanyHead = ob_get_contents();
       	ob_end_clean();
       	return $editCompanyHead;
    }
    
    public function getEditCompanyMainBox()
    {
    	ob_start();
    	?>
    	<div class="content-box">
    		<?php echo self::getEditCompanyTop(); ?>
    	</div>
    	<?php
    	$editContent = ob_get_contents();
    	ob_get_clean();
    	return $editContent;
    }
    
    public function getEditCompanyInfoContent()
    {
    	ob_start();
    	?>
       	<section class='new-main-content cf' id='x-protips-grid'>
       		<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
       		<?php 
       			echo self::getTopBar();
       			echo self::getSearchBar();
     			echo self::getEditCompanyInfoBox();
    		?>
    	</section>
       	<?php
       	$grid = ob_get_contents();
       	ob_end_clean();
       	return $grid;
    }
   	
   	public function getEditCompanyInfoBox()
   	{
   		ob_start();
   		?>
   		<div class="content-box">
   			<?php echo self::getEditCompanyTop(); ?>
   			<div>
   				<div class="categoriesSelection">
   					<h3>Categories</h3>
   					<div class="categoriesBox" id="categories">
   						<ul>
   							<?php 
   							foreach ($this->data['categories'] as $category) 
							{
   								?>
   								<li><a href="javascript: void(0);" 
   								<?php 
   								if ($this->data['company']['general']['category'] == $category['category_id']) {
   									?>
   									class="active"
   									<?php 
   								}
   								?>
   								category_id="<?php echo $category['category_id']; ?>"
   								><?php echo $category['name']; ?></a></li>
   								<?php
   							}
   							?>
		   				</ul>
   					</div>
   					<div class="clr"></div>
   					
   					<h3>Subcategories</h3>
   					<div class="categoriesBox" id="subcategories">
   						<ul>
		   					<?php 
   							foreach ($this->data['subcategories'] as $subcategory) {
   								?>
   								<li><a href="javascript: void(0);" id="sub_<?php echo $subcategory['subcategory_id']; ?>" subcategory="<?php echo $subcategory['subcategory_id']; ?>" ><?php echo $subcategory['name']; ?></a></li>
   								<?php
   							}
   							?>
		   				</ul>
   					</div>
   					<div class="clr"></div>
   					
   					<h3>Locations</h3>
   					<div class="categoriesBox" id="locations">
   						<ul>
		   					<?php 
   							foreach ($this->data['locations'] as $location) {
   								?>
   								<li><a href="javascript: void(0);" id="lo_<?php echo $location['location_id']; ?>" location="<?php echo $location['location_id']; ?>"><?php echo $location['name']; ?></a></li>
   								<?php
   							}
   							?>
		   				</ul>
   					</div>
   					<div class="clr"></div>
   				</div>
   				
   				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
   				<label>Name</label>
    			<input type="text" value="<?php echo $this->data['company']['general']['name']; ?>" id="companyName" />
    			<div class="clr"></div>
    			
    			<label>Latitude & Longitude <span>(separate with comma)</span></label>
    			<input type="text" value="<?php echo $this->data['company']['general']['latitude'].','.$this->data['company']['general']['longitude']; ?>" class="" id="companyLocation" />
    			<div class="clr"></div>
    			
    			<label>Description</label>
    			<textarea rows="" cols="" id="company-description"><?php echo $this->data['company']['general']['description']; ?></textarea>
    			<div class="clr"></div>
    			<a href="javascript: void(0);" class="button save-company-info" >save</a>
    			<div class="clr"></div>
   			</div>
   		</div>
   		<?php
   		$editContent = ob_get_contents();
   		ob_get_clean();
   		return $editContent;
   	}
   	
   	public function getEditCompanySeoHead()
   	{
   		ob_start();
   		?>
   	     	<script src="/js/back/company.js"></script>
   	   	<?php
   	   	$editCompanyHead = ob_get_contents();
   	   	ob_end_clean();
   	   	return $editCompanyHead;
   	}
    
	public function getEditCompanySeoContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEditCompanySeoBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
   	   	
	public function getEditCompanySeoBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div>
				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
				<label>Title</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['title']; ?>" id="companySeoTitle" />
				<div class="clr"></div>
				<label>Keywords</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['keywords']; ?>" id="companySeoKeywords" />
				<div class="clr"></div>
				<label>Description</label>
				<textarea id="companySeoDescription"><?php echo $this->data['company']['seo']['description']; ?></textarea>
				<div class="clr"></div>
				<a href="javascript: void(0);" class="button save-company-seo" >save</a>
    			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	/**
	 * getCompanySocialHead
	 * 
	 * the head section for the company social
	 * 
	 * @return string
	 */
	public function getEditCompanySocialHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/company.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	
	/**
	 * getEditCompanSocialContent
	 * 
	 * the structure for the social edit
	 * 
	 * @return string
	 */
	  	    
	public function getEditCompanySocialContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEditCompanySocialBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
	  	   	
	public function getEditCompanySocialBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div>
				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
				<label>Twitter</label>
				<input type="text" value="<?php echo $this->data['company']['social']['tuit_url']; ?>" id="companyTwitter" />
				<div class="clr"></div>
				<label>Facebook</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['facebook']; ?>" id="companyFacebook" />
				<div class="clr"></div>
				<label>Tripadvisor</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['tripadvisor']; ?>" id="companyTripadvisor" />
				<div class="clr"></div>
				<label>Youtube</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['youtube']; ?>" id="companyYoutube" />
				<div class="clr"></div>
				<label>Pinterest</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['pinterest']; ?>" id="companyPinterest" />
				<div class="clr"></div>
				<label>Instagram</label>
				<input type="text" value="<?php echo $this->data['company']['seo']['instagram']; ?>" id="companyInstagram" />
				<div class="clr"></div>
				<a href="javascript: void(0);" class="button save-company-social" >save</a>
	   			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getEditCompanyContactHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/company.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	  	    
	public function getEditCompanyContactContent()
	{
		ob_start();
	?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEditCompanyContactBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
	  	   	
	public function getEditCompanyContactBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div>
				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
				<div id="companyEmails">
					<?php
					if ($this->data['company']['emails'])
					{
						$i = 0;
						foreach ($this->data['company']['emails'] as $e)
						{
						?>
						<label>Email 
							<?php 
							if ($i == 0)
							{
								?>
							<span id="addEmailField">[+]</span>
								<?php 
							}
							?>
						</label>
						<input type="text" value="<?php echo $e['e_mail']; ?>" class="companyEmail" eid="<?php echo $e['e_mail_id']; ?>" />
						<div class="clr"></div>
						<?php
						$i++;
						}
					}
					else
					{
						?>
						<label>Email 
						<span id="addEmailField">[+]</span>
						</label>
						<input type="text" value="" class="companyEmail" eid="0" />
						<div class="clr"></div>
						<?php 
					}
					?>
				</div>
				
				<div id="companyPhones">
					<?php
					if ($this->data['company']['phones'])
					{
						$i = 0;  						
						foreach ($this->data['company']['phones'] as $p)
						{
						?>
						<label>Phone
							<?php 
								if ($i == 0)
								{
									?>
								<span id="addPhoneField">[+]</span>
									<?php 
								}
								?>
						</label>
						<input type="text" value="<?php echo $p['telephone']; ?>" class="companyPhone" pid="<?php echo $p['telephone_id']; ?>" />
						<div class="clr"></div>
						<?php
						$i++;
						}
					}
					else 
					{
						?>
						<label>Phone <span id="addPhoneField">[+]</span> </label>
						<input type="text" value="" class="companyPhone" pid="0" />
						<div class="clr"></div>
						<?php 
					}
					?>
				</div>
				
				<label>Website</label>
				<input type="text" value="<?php echo $this->data['company']['general']['website']; ?>" id="companyWebsite" />
				<div class="clr"></div>
				<a href="javascript: void(0);" class="button save-company-contact" >save</a>
	   			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getEditCompanyMediaHead()
	{
		ob_start();
		?>
			<link href="/css/back/uploadfile.css" rel="stylesheet">
    		<link href="/css/back/jquery.drag-n-crop.css" rel="stylesheet" type="text/css">
    		<script src="/js/jquery-ui.min.js"></script>
    		<script src="/js/back/jquery.uploadfile.min.js"></script>
    		<script src="/js/back/imagesloaded.js"></script>
			<script src="/js/back/scale.fix.js"></script>
			<script src="/js/back/jquery.drag-n-crop.js"></script>
	     	<script src="/js/back/company.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	
	public function getEditCompanyMediaContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />				
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEditCompanyMediaBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}

	public function getEditCompanyMediaBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div>
				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
				<input type="hidden" id="logoId" value="<?php echo $this->data['company']['logo']['logo_id']; ?>" />
				<input type="hidden" id="companyNameClean" value="<?php echo Tools::slugify($this->data['company']['general']['name']); ?>" />
				
				<div class="mediaSections" >
					<h1>Logo</h1>
					<p>(300px / 150px)</p>
					
					<div class="">
						<div class="logo-uploader">
							Upload
						</div>
						<div class="logo-box">
							<div style="width: 300px; height:150px" class="crop-container-logo"> <img src="/img-up/companies_pictures/logo/<?php echo $this->data['company']['logo']['logo']; ?>" id="cropLogo" /></div>
						</div>
						<a href="#" class="button save-crop" id="save-crop-logo">save</a>
						<div class="clr"></div>
					</div>
				</div>
				
				<div class="mediaSections" >
					<h1>Sliders</h1>
					<p>(640px / 255px)</p>
					
					<div class="slider-box">
						<div class="company-slider-uploader">
								Upload
						</div>
						<div class="company-slider-upload">
							<div class="crop-box">
								<div style="width: 640px; height:255px" class="crop-container"> <img src="" id="crop-company-slider" /></div>
							</div>
							<a href="#" class="button save-crop" id="save-crop-company-slider">save</a>
							<div class="clr"></div>
						</div>
						<div id="slider-items">
							<?php 
							foreach($this->data['company']['sliders'] as $slider) 
							{
							?>
							<div class="slider-item" id="sid-<?php echo $slider['sliders_id']; ?>">
								<header>
									<a href="#" class="button red delete-slider" sid="<?php echo $slider['sliders_id']; ?>">delete</a>
								</header>
								<section>
									<div class="img-container">
					    				<img src="/img-up/companies_pictures/sliders/<?php echo $slider['slider']; ?>"  />
					    			</div>
								</section>
								<div class="clr"></div>
							</div>
							<?php 
							}
							?>
						</div>
					</div>
				</div>
				
				<div class="mediaSections" >
					<h1>Gallery</h1>
					
					<div class="company-gallery-uploader">
						Upload
					</div>
					
					<div class="company-gallery-grid">
						<?php
						if ($this->data['company']['gallery'])
						{
							foreach($this->data['company']['gallery'] as $g)
							{
							?>
							<div class="image-box" id="cgid-<?php echo $g['picture_id']; ?>">
								<div class="image">		
									<img src="/img-up/companies_pictures/galery/<?php echo $g['picture']; ?>" />
								</div>
								<a href="javascript:void(0);" cgid="<?php echo $g['picture_id']; ?>" class="deleteGallery" >delete</a>
							</div>
							<?php
							}
						}
						?>
						<div class="clr"></div>
					</div>
				</div>
				
	   			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getEditCompanySettingsHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/company.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	  	    
	public function getEditCompanySettingsContent()
	{
		ob_start();
		?>
			<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEditCompanySettingsBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
	  	   	
	public function getEditCompanySettingsBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div class="settings">
				<input type="hidden" id="companyId" value="<?php echo $this->data['company']['general']['company_id']; ?>" />
				
				<a href="javascript:void(0);" <?php if ($this->data['company']['general']['main_promoted'] == 1) echo 'class="active"';?>>Main Promoted</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);">Category Promoted</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);">Subcategory Promoted</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);">Hide Phones</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);">Hide E-mails</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);">Hide Website</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);" <?php if ($this->data['company']['general']['published'] == 1) echo 'class="active"';?> id="publish-company">Published</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);" <?php if ($this->data['company']['general']['closed'] == 0) echo 'class="active"';?> id="close-company">Open</a>
				<div class="clr"></div>
				
				<a href="javascript:void(0);" class="delete">Delete</a>
				<div class="clr"></div>
			
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getAddCompanyHead()
	{
		ob_start();
		?>
		
	   	<script type="text/javascript">
	
	   	$(document).ready(function()
	   	{
	          	
	   	});
	       	
		</script>
		<script src="/js/back/company.js"></script>
	   	<?php
	   	$signIn = ob_get_contents();
	   	ob_end_clean();
	   	return $signIn;
	}
	   
  	public function getAddCompanyBox()
	{
		ob_start();
		?>
		<div class="content-box">
		
			<div class="add-company-box">
				<h1>Company Name</h1>
				<input type="text" id="new-company-name" value="" />
				<div>
					<a href="javascript: void(0);" class="button" id="create-company">Create</a>
					<a href="javascript: void(0);" class="button green" id="create-company-next">Next</a>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<?php
		$mainGalleryBox = ob_get_contents();
		ob_get_clean();
		return $mainGalleryBox;
	}
    
	public function getSettingsTop()
	{
		ob_start();
		?>
	    	<header>
	    		<a href="/admin/categories/" id="">Categories</a>
	    		<a href="/admin/locations/" id="">Locations</a>
	   			<div class="clr"></div>
	   		</header>
	    	<?php
	    	$editCompanyTop = ob_get_contents();
	    	ob_end_clean();
	    	return $editCompanyTop;
	    }
	
	public function getSettingsHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/settings.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	  	    
	public function getSettingsContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getSettingsBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
		  	   	
	public function getSettingsBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getSettingsTop(); ?>
			<div>
				<label>Title</label>
				<input type="text" value="<?php echo $this->data['appInfo']['title']; ?>" id="siteTittle" />
				<div class="clr"></div>
				<label>Site name</label>
				<input type="text" value="<?php echo $this->data['appInfo']['siteName']; ?>" id="siteName" />
				<div class="clr"></div>
				<label>URL</label>
				<input type="text" value="<?php echo $this->data['appInfo']['url']; ?>" id="siteUrl" />
				<div class="clr"></div>
				<label>Content</label>
				<textarea rows="" cols=""  id="siteContent" ><?php echo $this->data['appInfo']['content']; ?></textarea>
				<div class="clr"></div>
				<label>Description</label>
				<textarea rows="" cols=""  id="siteDescription" ><?php echo $this->data['appInfo']['description']; ?></textarea>
				<div class="clr"></div>
				<label>Keywords</label>
				<input type="text" value="<?php echo $this->data['appInfo']['keywords']; ?>" id="siteKeywords" />
				<div class="clr"></div>
				<label>Email</label>
				<input type="text" value="<?php echo $this->data['appInfo']['email']; ?>" id="siteEmail" />
				<div class="clr"></div>
				<label>Location</label>
				<input type="text" value="<?php echo $this->data['appInfo']['location']; ?>" id="siteLocation" />
				<div class="clr"></div>
				<label>Twitter</label>
				<input type="text" value="<?php echo $this->data['appInfo']['twitter']; ?>" id="siteTwitter" />
				<div class="clr"></div>
				<label>Facebook</label>
				<input type="text" value="<?php echo $this->data['appInfo']['facebook']; ?>" id="siteFacebook" />
				<div class="clr"></div>
				<label>Google + </label>
				<input type="text" value="<?php echo $this->data['appInfo']['googleplus']; ?>" id="siteGoogleplus" />
				<div class="clr"></div>
				<label>Pinterest</label>
				<input type="text" value="<?php echo $this->data['appInfo']['pinterest']; ?>" id="sitePinterest" />
				<div class="clr"></div>
				<label>LinkedIn</label>
				<input type="text" value="<?php echo $this->data['appInfo']['linkedin']; ?>" id="siteLinkedin" />
				<div class="clr"></div>
				<label>Youtube</label>
				<input type="text" value="<?php echo $this->data['appInfo']['youtube']; ?>" id="siteYoutube" />
				<div class="clr"></div>
				<label>Instagram</label>	
				<input type="text" value="<?php echo $this->data['appInfo']['instagram']; ?>" id="siteInstagram" />
				<div class="clr"></div>
				
				<a href="javascript: void(0);" class="button update-settings" >save</a>
	   			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getMembersTop()
	{
		ob_start();
	?>
    	<header>
    		<a href="/admin/members/" id="">Add member</a>
    		<a href="/admin/members/" id="">Members</a>
    		<a href="#" id="">Search</a>
   			<div class="clr"></div>
   		</header>
    	<?php
    	$editCompanyTop = ob_get_contents();
    	ob_end_clean();
    	return $editCompanyTop;
    }
	
	public function getMembersHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/member-info.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	
	public function getMembersContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getMembersBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
		  	   	
	public function getMembersBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getMembersTop(); ?>
			<div class="members">
				<div class="left">
					<ul>
						<li><a href="">Agent one</a></li>
						<li><a href="">Agent two</a></li>
					</ul>
				</div>
				<div class="right">
					<div class="add-member">
						<div class="add-first-step">
							<div class="name-holder">
								<input type="hidden" id="memberId" value="" />
								<label>Name: </label><input value="" id="memberName" />
							</div>
							<div class="button-holder">
								<a href="javascript: void(0);" class="button" id="addMember" >next</a>
								<div class="clr"></div>
							</div>
						</div>
						<div class="clr"></div>
						<div class="add-member-details">
							<div class="member-detail-left">
								<div class="member-tech-info">
									<label>Member Id: <span id="newMemberId"></span></label>
								</div>
								<div class="member-personal-info">
									
									<label>Address: </label><input value="" id="memberAddress" />
									<div class="clr"></div>
									<label>Company: </label><input value="" id="memberCompany" />
									<div class="clr"></div>
									<label>Position: </label><input value="" id="memberPosition" />
									<div class="clr"></div>
									<label>Type: </label><input value="" id="memberCompanyType" />
									<div class="clr"></div>
									<label>Notes: </label><textarea rows="" cols="" id="memberNotes"></textarea>
									<div class="clr"></div>
								</div>
							</div>
							<div class="member-detail-right">
								<label>Emails: <span id="addEmailField">[+]</span></label>
								<div id="memberEmails">
								<?php
								if ($this->data['memberEmails'])
								{
									foreach ($this->data['memberEmails'] as $email)
									{
									?>
									<input value="<?php echo $email['email']; ?>" class="memberEmail" meid="<?php echo $email['email_id']; ?>" />
									<?php
									}
								}
								else
								{
									?>
									<input type="text" value="" class="memberEmail" meid="0" />
									<?php
								}
								?>
								</div>
								<div class="clr"></div>
								<div id="memberPhones">
									<label>Phones: <span id="addPhoneField">[+]</span> </label>
									<?php 
									if ($this->data['memberPhones'])
									{
										foreach ($this->data['memberPhones'] as $phone)
										{
										?>
									<input value="<?php echo $phone['phone']; ?>" class="memberPhone" mpid="<?php echo $phone['phone_id']; ?>"/>
										<?php
										}
									}
									else
									{
										?>
									<input value="" class="memberPhone" mpid="0"/>	
										<?php
									}
									?>
								</div>
							</div>
							<div class="clr"></div>
							<div class="button-holder">
								<a href="javascript: void(0);" class="button save-member-info">Save</a>
								<div class="clr"></div>
							</div>
						</div>
					</div>
				
					<header>
						<div class="checks">
							<input type="checkbox" name="vehicle" value="Bike">
						</div>
						<div class="member_id">ID</div>
						<div class="name">Name</div>
						<div class="company_name">Company</div>
						<div class="position">Position</div>
						<div class="email">E - Mail</div>
						<div class="phone">Phone</div>
					</header>
					<section>
						<ul>
						<?php 
						foreach ($this->data['members'] as $members)
						{
							?>
							<li>
								 <div class="checks">
									<input type="checkbox" name="vehicle" value="Bike">
								</div>
								<a href="/admin/member-detail/<?php echo $members['member_id']; ?>/" target="_blank">
									<div class="member_id"><?php echo $members['member_id']; ?></div>
									<div class="name"><?php  if ($members['member_name']){echo $members['member_name'];} else { echo "No Name"; } ?></div>
									<div class="company_name"><?php  if ($members['company_name']){echo $members['company_name'];} else { echo "No Company"; } ?></div>
									<div class="position"><?php if ($members['position']){echo $members['position'];} else { echo "No Position"; } ?></div>
									<div class="email"><?php if ($members['email']){echo $members['email'];} else { echo "No Email"; } ?></div>
									<div class="phone"><?php if ($members['phone']){echo $members['phone'];} else { echo "No Phone"; } ?></div>
								</a>
							</li>
							<?php
						}
						?>
							
						</ul>
					</section>
				</div>
				<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getMembersDetailsHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/member-info.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	
	public function getMembersDetailsContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getMembersDetailsBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}

	public function getMembersDetailsBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getMembersTop(); ?>
			<input type="hidden" id="memberId" value="<?php echo $this->data['memberInfo']['member_id']; ?>" />
			<div class="member-detail-left">
				<label>Member Id: <?php echo $this->data['memberInfo']['member_id']; ?></label>
				<label>Date added: <?php echo Tools::formatMYSQLToFront($this->data['memberInfo']['date']); ?></label>
				<div class="member-personal-info">
					<label>Name: </label><input value="<?php echo $this->data['memberInfo']['member_name']; ?>" id="memberName" />
					<div class="clr"></div>
					<label>Address: </label><input value="<?php echo $this->data['memberInfo']['address']; ?>" id="memberAddress" />
					<div class="clr"></div>
					<label>Company: </label><input value="<?php echo $this->data['memberInfo']['company_name']; ?>" id="memberCompany" />
					<div class="clr"></div>
					<label>Position: </label><input value="<?php echo $this->data['memberInfo']['position']; ?>" id="memberPosition" />
					<div class="clr"></div>
					<label>Type: </label><input value="<?php echo $this->data['memberInfo']['company_type']; ?>" id="memberCompanyType" />
					<div class="clr"></div>
					<label>Notes: </label><textarea rows="" cols="" id="memberNotes"><?php echo $this->data['memberInfo']['notes']; ?></textarea>
					<div class="clr"></div>
				</div>
			</div>
			<div class="member-detail-right">
				<label>Emails: <span id="addEmailField">[+]</span></label>
				<div id="memberEmails">
				<?php
				if ($this->data['memberEmails'])
				{
					foreach ($this->data['memberEmails'] as $email)
					{
					?>
					<input value="<?php echo $email['email']; ?>" class="memberEmail" meid="<?php echo $email['email_id']; ?>" />
					<?php
					}
				}
				else
				{
					?>
					<input type="text" value="" class="memberEmail" meid="0" />
					<?php
				}
				?>
				</div>
				<div class="clr"></div>
				
				<div id="memberPhones">
					<label>Phones: <span id="addPhoneField">[+]</span> </label>
					<?php 
					if ($this->data['memberPhones'])
					{
						foreach ($this->data['memberPhones'] as $phone)
						{
						?>
					<input value="<?php echo $phone['phone']; ?>" class="memberPhone" mpid="<?php echo $phone['phone_id']; ?>"/>
						<?php
						}
					}
					else
					{
						?>
					<input value="" class="memberPhone" mpid="0"/>	
						<?php
					}
					?>
				</div>
			</div>
			<div class="clr"></div>
			<div class="saveMemberInfoBox">
				<a href="javascript: void(0);" class="button save-member-info" >save</a>
			</div>
			<div class="clr"></div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getCategoriesHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/categories.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
	  	    
	public function getCategoriesContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getCategoriesBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
		  	   	
	public function getCategoriesBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getSettingsTop(); ?>
			<div>
				<div class="categories-settings">
					<div class="left">
						<div class="add-section">
							<label>Category name</label>
							<input type="text" value="" id="categoryName" />
							<a href="javascript: void(0);" class="button addCategory" >save</a>
							<div class="clr"></div>
						</div>
						<ul id="categoryList">
							<?php 
							foreach ($this->data['categories'] as $category)
							{
								?>
							<li id="cat-<?php echo $category['category_id']; ?>">
								<a href="javascript:void(0);" catId="<?php echo $category['category_id']; ?>">
									<?php echo $category['name']; ?>
								</a>
							</li>
								<?php
							}
							?>
						</ul>
					</div> <!-- /left -->
					<div class="right">
						<h4 id="catName"></h4>
						<input type="hidden" value="0" id="currentCategory" />
						<label>Category name</label>
						<input type="text" value="" id="currentName" />
						<div class="clr"></div>
						<label>Category title</label>
						<input type="text" value="" id="currentTitle" />
						<div class="clr"></div>
						<label>Category description</label>
						<textarea rows="" cols="" id="currentDescription"></textarea>
						<a href="javascript: void(0);" class="button red delete-category" >delete</a>
						<a href="javascript: void(0);" class="button update-category" >save</a>
						<div class="clr"></div>
						
						<h3>Subcategories</h3>
						
						<label>Subcategory name</label>
						<input type="text" value="" id="subcategoryName" />
						<a href="javascript: void(0);" class="button addSubcategory" >save</a>
						<div class="clr"></div>
						<ul id="subcategoryList"></ul>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getLocationHead()
	{
		ob_start();
		?>
		     <script src="/js/back/locations.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}

	public function getLocationContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
		<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getLocationBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
	
	public function getLocationBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getSettingsTop(); ?>
			<div>
				<div class="categories-settings">
					<div class="left">
						<div class="add-section">
							<label>Location name</label>
							<input type="text" value="" id="locationName" />
							<a href="javascript: void(0);" class="button addLocation" >save</a>
							<div class="clr"></div>
						</div>
						<ul id="locationList">
							<?php 
							foreach ($this->data['locations'] as $location)
							{
								?>
							<li id="loc-<?php echo $location['location_id']; ?>">
								<a href="javascript:void(0);" locId="<?php echo $location['location_id']; ?>">
									<?php echo $location['name']; ?>
								</a>
							</li>
								<?php
							}
							?>
						</ul>
					</div> <!-- /left -->
					<div class="right">
						<h4 id="locName"></h4>
						<input type="hidden" value="0" id="currentLocation" />
						<label>Category name</label>
						<input type="text" value="" id="currentName" />
						<div class="clr"></div>
						<label>Category description</label>
						<textarea rows="" cols="" id="currentDescription"></textarea>
						<a href="javascript: void(0);" class="button red delete-location" >delete</a>
						<a href="javascript: void(0);" class="button update-location" >save</a>
						<div class="clr"></div>
					</div>
					<div class="clr"></div>
				</div>
	   			
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getVideosHead()
	{
		ob_start();
		?>
		     <script src="/js/back/videos.js"></script>
	   	<?php
	  	$editCompanyHead = ob_get_contents();
	  	ob_end_clean();
	  	return $editCompanyHead;
	}
			  	    
	public function getVideosContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
		<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getVideosBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
			  	   	
	public function getVideosBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<div>
				<label>Video url</label>
				<p>e.g. https://www.youtube.com/watch?v=Clg1IbQ7sNY</p>
				<input type="text" value="" id="videoURL" />
				<a href="javascript: void(0);" class="button addVideo" >save</a>
				<div class="clr"></div>
				
				<ul class="videos swipebox-video">
					<?php 
					foreach ($this->data['videos'] as $video)
					{
					$image = str_replace('2.jpg', 'mqdefault.jpg', $video['image']);
					?>
					<li id="video-<?php echo $video['video_id']; ?>">
						<article class='protip'>
							<header>
								<div class="img-cover">	
									<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title">
										<img src="<?php echo $image; ?>"
												alt="<?php $video['title']; ?>"  class="protip_li_img"/>
									</a>
								</div>
							</header>
							<div class="clr"></div>
							<a href="https://www.youtube.com/watch?v=<?php echo $video['youtube']; ?>" rel="youtube" class="title " style="font-size: 1.2em; font-weight: bold;">
								<?php echo $video['title']; ?>
							</a>
							<a href="javascript:void(0);" vid="<?php echo $video['video_id']; ?>" class="delete">delete</a>
						</article>
					</li>
					<?php
					}
					?>
					<div class="clr"></div>
				</ul>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
	public function getEventsListHead()
	{
		ob_start();
		?>
	     	<script src="/js/back/company.js"></script>
	   	<?php
	   	$editCompanyHead = ob_get_contents();
	   	ob_end_clean();
	  	return $editCompanyHead;
	}
	   
	public function getEventsLisContent()
	{
		ob_start();
		?>
		<section class='new-main-content cf' id='x-protips-grid'>
			<input type="hidden" id="category-type-hidden" value="<?php echo $c; ?>" />
			<?php 
			echo self::getTopBar();
			echo self::getSearchBar();
			echo self::getEventsLisBox();
			?>
		</section>
		<?php
		$grid = ob_get_contents();
		ob_end_clean();
		return $grid;
	}
	   	   	
	public function getEventsLisBox()
	{
		ob_start();
		?>
		<div class="content-box">
			<?php echo self::getEditCompanyTop(); ?>
			<div>
				<a href="javascript: void(0);" class="button add-event" >create event</a>
				<div class="clear"></div>
				<div class="events-list">
					<?php 
					foreach ($this->data['events'] as $event)
					{
						?>
					<div class="event-item">
						<div class="left">
							<img src="/img-up/companies_pictures/logo/<?php echo $event['logo']; ?>" />
							<div class="clear"></div>
						</div>
						<div class="right">
							<div class="controls">
								<span class="date">
									<?php echo Tools::formatMYSQLToFront($event['date']) ?>
									<?php 
									if ($event['time'])
									{
										echo " | ".Tools::formatHourMYSQLToFront($event['time']);
									}
									?>
									</span>
								<a href="javascript: void(0);" class="button save-company-seo" >edit</a>
							</div>
							<div class="info">
								<h3><?php echo $event['name']; ?></h3>
								<p><?php echo $event['description']; ?></p>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
						<?php
					}
					?>
				</div>
				
	   			<div class="clr"></div>
			</div>
		</div>
		<?php
		$editContent = ob_get_contents();
		ob_get_clean();
		return $editContent;
	}
	
    public function getFooter()
    {
    	ob_start();
    	?>
    	<footer id='footer'>
    		<div class='inside-footer cf'>
    			<nav id='footer-nav'>
					<ul class='footer-links cf'>
						<li><a href="../contact-us/">Contact</a></li>
						<li><a href="#">API &amp; Hacks</a></li>
						<li><a href="#">FAQ</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#">Terms of Service</a></li>
					</ul>
					<ul class='copyright'>
						<li>Copyright &copy; <?php echo date('Y'); ?> <?php echo $this->data['appInfo']['siteName']; ?>. All rights reserved.</li>
					</ul>
				</nav>
    		</div>
    	</footer>
    	<?php
    	$footer = ob_get_contents();
    	ob_end_clean();
    	return $footer;
    }
}