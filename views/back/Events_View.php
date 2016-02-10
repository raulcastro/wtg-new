<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Tools.php';

class Events_View
{
	private $data;
	
	public function __construct($data)
	{
		$this->data = $data;
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
				Eventos mothafoka!
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
	
	
}