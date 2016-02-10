<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/models/front/Layout_Model.php';

class generalBackend
{
	protected  $model;
	
	public function __construct()
	{
		$this->model = new Layout_Model();
	}
	
	public function loadBackend($section = '')
	{
		$data 		= array();
		
// 		Info of the Application
		
		$appInfoRow = $this->model->getGeneralAppInfo();
		
		$appInfo = array( 
				'title' 		=> $appInfoRow['title'],
				'siteName' 		=> $appInfoRow['site_name'],
				'url' 			=> $appInfoRow['url'],
				'content' 		=> $appInfoRow['content'],
				'description'	=> $appInfoRow['description'],
				'keywords' 		=> $appInfoRow['keywords'],
				'location'		=> $appInfoRow['location'],
				'creator' 		=> $appInfoRow['creator'],
				'creatorUrl' 	=> $appInfoRow['creator_url'],
				'twitter' 		=> $appInfoRow['twitter'],
				'facebook' 		=> $appInfoRow['facebook'],
				'googleplus' 	=> $appInfoRow['googleplus'],
				'pinterest' 	=> $appInfoRow['pinterest'],
				'linkedin' 		=> $appInfoRow['linkedin'],
				'youtube' 		=> $appInfoRow['youtube'],
				'instagram'		=> $appInfoRow['instagram'],
				'email'			=> $appInfoRow['email'],
				'lang'			=> $appInfoRow['lang']
		);
		
		$data['appInfo'] = $appInfo;

		// 		Categories
		$categoriesArray = $this->model->getCategoriesWithCompanies();
		$data['categories'] = $categoriesArray;

		// 		Locations
		$locationsArray = $this->model->getLocations();
		$data['locations'] = $locationsArray;

		switch ($section) 
		{
			case 'mainSection':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
				
				// 		array of the main sliders
				$slidersArray = $this->model->getMainSliders();
				$data['mainSliders'] = $slidersArray;
				
				// 		array of videos
				$videosArray = $this->model->getVideos(2);
				$data['lastTwoVideos'] = $videosArray;
				
				// 		Main promoted companies
				$mainPromotedArray = $this->model->getMainPromotedCompanies();
				$data['mainPromoted'] = $mainPromotedArray;
			break;

			case 'byCategory':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
				
				//		get category info by the category id
				$categoryInfo = $this->model->getCategoryInfoById($_GET['category']);
				$data['categoryInfo'] = $categoryInfo;
				
				//		get the category's subcategories
				$subcategoryArray = $this->model->getSubcategoriesByCategoryId($_GET['category']);
				$data['subcategories'] = $subcategoryArray;
				
				//		get companies by category
				$companiesArray	= $this->model->getCompaniesByCategoryId($_GET['category']);
				$data['companies'] = $companiesArray;
			break;
			
			case 'bySubcategory':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;

				//		get category info by the category id
				$categoryInfo = $this->model->getCategoryInfoById($_GET['category']);
				$data['categoryInfo'] = $categoryInfo;
			
				//		get the category's subcategories
				$subcategoryArray = $this->model->getSubcategoriesByCategoryId($_GET['category']);
				$data['subcategories'] = $subcategoryArray;
			
				$subcategoryInfo = $this->model->getSubcategoryInfoById($_GET['subcategory']);
				$data['subcategoryInfo'] = $subcategoryInfo;
				
				//		get companies by subcategory
				$companiesArray	= $this->model->getCompaniesBySubcategotyId($_GET['subcategory']);
				$data['companies'] = $companiesArray;
			break;
			
			case 'byLocation':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
			
				//		Location info
				$locationInfo = $this->model->getLocationInfoById($_GET['location']);
				$data['locationInfo'] = $locationInfo;
				
				//		get companies by location
				$companiesArray	= $this->model->getCompaniesByLocation($_GET['location']);
				$data['companies'] = $companiesArray;
			break;
			
			case 'byCompany' :
				$companyId 		= $_GET['company'];
				$subcategoryId 	= $_GET['subcategory'];
				$categoryId 	= $_GET['category'];
				
				// 		get the background file for use as blur
				$background = $this->model->getCompanyLogo($companyId);
				$data['background'] = $background;
				
				$companySeoInfo		  = $this->model->getCompanySeoInfo($companyId);
				$general	     	  = $this->model->companyInfo($companyId);
				$lastSlider			  = $this->model->getLastSlider($companyId);
				$sliders			  = $this->model->getCompanySliders($companyId);
				$gallery			  = $this->model->getCompanyGaleries($companyId);
				$social			      = $this->model->getCompanySocialInfo($companyId);
				$emails           	  = $this->model->getEmails($companyId);
				$phones               = $this->model->getPhones($companyId);
				$subcategoryInfo 	  = $this->model->getSubcategoryInfoById($subcategoryId);
				
				$companyInfo = array(
						'seo'			=> $companySeoInfo,
						'logo' 			=> $background,
						'lastSlider' 	=> $lastSlider,
						'general'		=> $general,
						'emails' 		=> $emails,
						'phones' 		=> $phones,
						'gallery' 		=> $gallery,
						'sliders' 		=> $sliders,
						'social'		=> $social,
						'subcategoryInfo' => $subcategoryInfo
				);
				
				$data['company'] = $companyInfo;
				
				//		get companies by subcategory
				$companiesArray		= $this->model->getCompaniesBySubcategotyId($subcategoryId);
				$data['companies'] 	= $companiesArray;
				
				//		get the category's subcategories
				$subcategoryArray 		= $this->model->getSubcategoriesByCategoryId($categoryId);
				$data['subcategories'] 	= $subcategoryArray;
				
				//		events
				$eventsArray = $this->model->getEventsByCompany($companyId);
				
				if ($eventsArray)
				{
					$yearsArray = $this->model->getEventsYears($companyId);
// 					var_dump($yearsArray);
					$events = array();
					foreach ($yearsArray as $years)
					{
						$node['year'] 	= $years['year'];
						
						$monthsArray 	= $this->model->getMonthsByYear($companyId, $years['year']);
						$node['months'] = array();
						foreach ($monthsArray as $months)
						{
							$monthsNode['month'] 	= $months['month'];
							$monthsNode['events'] 	= $this->model->getEventsByYearAndMonth($companyId, $years['year'], $months['month']);
							array_push($node['months'], $monthsNode);
						}
						array_push($events, $node);
					}
					$data['events'] = $events;
				}
				
				if ($_GET['belong_company'])
				{
					$belongCompany 					= $_GET['belong_company'];
					$belongCompanyLogo 				= $this->model->getCompanyLogo($belongCompany);
					$data['belongCompany']['logo'] 	= $belongCompanyLogo;
					$data['belongCompany']['info'] 	= $this->model->getCompanySeoInfo($belongCompany);
					$data['belongCompany']['totalEvents'] = sizeof($this->model->getEventsByCompany($belongCompany));
					
					$belongCompanyInfo 							= $this->model->companyInfo($belongCompany);
					$data['belongCompany']['category'] 			= $belongCompanyInfo['category'];
					$data['belongCompany']['categoryName'] 		= $belongCompanyInfo['category_name'];
					$data['belongCompany']['belongCompanyId'] 	= $belongCompany;
					$data['belongCompany']['belongCompanyName'] = $belongCompanyInfo['name'];
					
					$data['event']['detail']		= $this->model->getEventDetailByEventId($companyId);
				}
			break;

			case 'map':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
			
				//		get companies with a correct location
				$companiesArray	= $this->model->getCompaniesWithLocation();
				$data['companies'] = $companiesArray;
			
			break;
			
			case 'videos':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
					
				$videosArray 	= $this->model->getVideos();
				$data['videos'] = $videosArray;
				
				$data['section'] = "other";
					
			break;
			
			case 'search':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
					
				$data['section'] = "other";
				
				//	Search operations
				
				$dataSearch = $_GET;
				$term 		= $dataSearch['term'];
				$from 		= $dataSearch['from'];
				$to 		= $dataSearch['to'];
				$term 		= str_replace('-', ' ', $term);
				$results 	= '';
				$total		= 0;
				
				if (!$to)
				{
					$to = 12;
				}
				
				$searchDataArray = array(
					'data' 	=> $data,
					'term' 	=> $term,
					'from' 	=> $from,
					'to' 	=> $to,
					'term' 	=> $term,
					'total'	=> $total	
				);
				
				$data['searchData'] = $searchDataArray;
				
				$companiesArray = array();
				
				if ($dataSearch['categoryId'] == 'site')
				{
					$companiesArray	= $this->model->searchTerm($term, $from, $to);
					$totalResults 	= $this->model->countResultsAll($term);
				
					$totalResults 	= sizeof($totalResults);
				}
				
				$data['companies'] 	= $companiesArray;
			break;
			
			case 'contact':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
			
				$data['section'] = "other";
			break;
			
			case 'allEvents':
				// 		get the background file for use as blur
				$background = $this->model->getRandomBlur();
				$data['background'] = $background;
					
				$data['section'] = "allEvents";
				
				//		events
				$companiesArray		= $this->model->getAllEvents();
				$data['companies'] 	= $companiesArray;
				
				if ($companiesArray)
				{
					$yearsArray = $this->model->getAllEventsYears();
					// 					var_dump($yearsArray);
					$events = array();
					foreach ($yearsArray as $years)
					{
						$node['year'] 	= $years['year'];
				
						$monthsArray 	= $this->model->getAllMonthsByYear($years['year']);
						$node['months'] = array();
						foreach ($monthsArray as $months)
						{
							$monthsNode['month'] 	= $months['month'];
							$monthsNode['events'] 	= $this->model->getAllEventsByYearAndMonth($years['year'], $months['month']);
							array_push($node['months'], $monthsNode);
						}
						array_push($events, $node);
					}
					$data['events'] = $events;
				}
			break;
			
			default:
			break;
		}
		
		return $data;
	}
}

$backend = new generalBackend();

// $info = $backend->loadBackend();
// var_dump($info['categoryInfo']);
