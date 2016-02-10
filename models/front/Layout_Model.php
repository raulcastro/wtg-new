<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root.'/Framework/Front_Default_Header.php';

class Layout_Model
{
    private $db; 
	
	public function __construct()
	{
		$this->db = new Mysqli_Tool(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
	
	/**
	 * getGeneralAppInfo
	 *
	 * get all the info that from the table app_info, this is about the application
	 * the name, url, creator and so
	 *
	 * @return array row containing the info
	 */
	
	public function getGeneralAppInfo()
	{
		try {
			$query = 'SELECT * FROM app_info';
	
			return $this->db->getRow($query);
	
		} catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * getMainSliders
	 * 
	 * sliders that should be displayed in the index
	 * @param NULL 
	 * @return array on succes, false on fail 
	 */
	
	public function getMainSliders()
	{
	    try
	    {
	        $query = 'SELECT * 
	        		FROM main_gallery 
	                ORDER BY picture_id DESC';
	        return $this->db->getArray($query);
	    }
	    catch (Exception $e)
	    {
	        return false;
	    }
	}
	
	/**
	 * getCategoriesWithCompanies
	 * 
	 * Get all the categories that at least have one one company related
	 * 
	 * @return multitype:unknown |boolean
	 */
	public function getCategoriesWithCompanies()
	{
	    try
	    {
	        $query = 'SELECT cat.category_id, cat.name
                FROM companies c
                LEFT JOIN categories cat ON cat.category_id = c.category
                WHERE category IS NOT NULL 
	        	AND c.published = 1 
	        	GROUP BY category
	        	ORDER BY cat.name ASC';
                
                return $this->db->getArray($query);
	    }
	    catch (Exception $e)
	    {
	        return false;
	    }
	}
	
	/**
	 * getVideos
	 * 
	 * return only n videos from main_videos
	 * @param int limit, n videos for return
	 * @return multitype:unknown |boolean
	 */
	public function getVideos($limit = '')
	{
		try
		{
			$query = 'SELECT *
	        		FROM main_videos
	        		ORDER BY video_id DESC';
			
			if ($limit > 0) {
				$query .= ' LIMIT '.$limit;
			}
	
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getLocations
	 * 
	 * get all the location that at least are related to any company
	 * 
	 * @return multitype:unknown |boolean
	 */
	public function getLocations()
	{
		try
		{
			$query = 'SELECT l.*, cu.ubication
					FROM locations l
					LEFT JOIN companies_ubication cu ON cu.ubication = l.location_id
					WHERE ubication != "NULL"
					GROUP BY  l.name';
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * Get The last 20 logos from company_logo, check if the file exists
	 * if the logo exists then return it, if it doesnt then test if the
	 * next item on the array exists, until it exists .... bliiin!
	 */
	
	public function getRandomBlur()
	{
		try {
			$src = './img-up/companies_pictures/logo/';
			$query = 'SELECT logo
					FROM company_logo
					ORDER BY logo_id
					DESC LIMIT 20';
				
			$logos = $this->db->getArray($query);
				
			shuffle($logos);
	
			for ($i = 0; $i <= sizeof($logos); $i++) {
				if (file_exists($src.$logos[$i]['logo'])) {
					return $logos[$i]['logo'];
					exit;
				}
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getMainPromotedCompanies
	 * 
	 * return the info for the main_promoted companies, there must to be four
	 * 
	 * @return multitype:unknown |boolean
	 */
	public function getMainPromotedCompanies()
	{
		try {
			$query = 'SELECT 
					c.company_id, 
					c.name, 
					s.description, 
					cat.name as category_name,
					cat.category_id, 
					cl.logo 
					FROM companies c 
					LEFT JOIN seo s ON s.company_id = c.company_id 
					LEFT JOIN categories cat ON c.category = cat.category_id 
					LEFT JOIN company_logo cl ON cl.company_id = c.company_id
					WHERE c.main_promoted = 1';
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	/**
	 * getCategoryInfoById
	 * 
	 * return the info form the category by a given category_id
	 * 
	 * @param int $category it's the category id, got from the get param
	 * @return array|boolean returns an array with the category info
	 */
	public function getCategoryInfoById($category)
	{
		try
		{
			$category = (int) $category;
			$query = 'SELECT * 
					FROM categories
			        WHERE category_id = '.$category;
			return $this->db->getRow($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getSubcategoriesByCategoryId
	 * 
	 * returns the subcategories that belongs to an specific category Id and that 
	 * hast at least one company related
	 * 
	 * @param int $category
	 * @return array |boolean array on success, false otherwise
	 */
	public function getSubcategoriesByCategoryId($category)
	{
		$category = (int) $category;
		try
		{
			$category = (int) $category;
			$query = 'SELECT s.name, s.subcategory_id
				FROM subcategories s
				LEFT JOIN companies_subcategories cs ON cs.subcategory = s.subcategory_id
				WHERE category = '.$category.'
				AND cs.subcategory !=  "NULL"
				GROUP BY cs.subcategory	
				ORDER BY s.name ASC';
	
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompaniesByCategoryId
	 * 
	 * returns all the companies that belongs to a given category
	 * 
	 * @param int $id this is the category id
	 * @return multitype:unknown |boolean
	 */
	public function getCompaniesByCategoryId($categoryId)
	{
		$categoryId = (int) $categoryId;
	
		try
		{
			$query = 'SELECT 
			c.name,
			c.company_id, 
			c.promoted,
			c.closed,
			s.description,
			ca.name AS category,
			ca.category_id, 
			p.logo
		
			FROM companies c
			LEFT JOIN seo s ON c.company_id = s.company_id
			LEFT JOIN company_logo p ON c.company_id = p.company_id
			LEFT JOIN categories ca ON ca.category_id = c.category
		
			WHERE c.category = '.$categoryId.'
			AND c.published = 1
			GROUP BY c.company_id
			ORDER BY c.name ASC';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getSubcategoryInfoById
	 *
	 * return the info form the category by a given subcategory_id
	 *
	 * @param int $category it's the category id, got from the get param
	 * @return array|boolean returns an array with the subcategory info
	 */
	public function getSubcategoryInfoById($subcategory)
	{
		$subcategory = (int) $subcategory;
		try
		{
			$category = (int) $category;
			$query = 'SELECT *
					FROM subcategories
			        WHERE subcategory_id = '.$subcategory;
			
			return $this->db->getRow($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompaniesBySubcategotyId
	 * 
	 * retturns an array of the companies that belongs to a give subcategory
	 * 
	 * @param int $subcategoryId
	 * @return multitype:unknown |boolean
	 */
	public function getCompaniesBySubcategotyId($subcategoryId)
	{
		$subcategoryId = (int) $subcategoryId;
		
		try
		{
			$query = '
			SELECT 
			c.name,
			c.company_id, 
			c.promoted,
			c.closed,
			s.description,
			ca.name AS category,
			ca.category_id, 
			p.logo
		
			FROM companies c
			LEFT JOIN seo s ON c.company_id = s.company_id
			LEFT JOIN companies_subcategories cs ON cs.company = c.company_id
			LEFT JOIN company_logo p ON c.company_id = p.company_id
			LEFT JOIN categories ca ON ca.category_id = c.category
		
			WHERE cs.subcategory = '.$subcategoryId.'
			AND c.published = 1
			GROUP BY c.company_id
			ORDER BY c.promoted AND c.company_id DESC';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompaniesByLocation
	 * 
	 * get all the companies that belongs to an specific location
	 * 
	 * @param int $id
	 * @return multitype:unknown |boolean
	 */
	public function getCompaniesByLocation($id)
	{
		$id = (int) $id;
		
		try
		{
			$query = 'SELECT
			c.name,
			c.company_id, 
			c.promoted,
			c.closed,
			s.description,
			ca.name AS category,
			ca.category_id, 
			p.logo,
			l.name as location_name

			FROM companies c
			LEFT JOIN seo s ON c.company_id = s.company_id
			LEFT JOIN companies_ubication cu ON c.company_id = cu.company
			LEFT JOIN company_logo p ON c.company_id = p.company_id
			LEFT JOIN categories ca ON ca.category_id = c.category
			LEFT JOIN locations l ON cu.ubication = l.location_id
		
			WHERE cu.ubication = '.$id.'
			AND c.published = 1
			GROUP BY c.company_id
			ORDER BY c.promoted AND c.company_id DESC';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getLocationInfoById
	 * 
	 * get the info of a location by a given location_id
	 * 
	 * @param int $id
	 * @return multitype:|boolean
	 */
	public function getLocationInfoById($id)
	{
		try
		{
			$id = (int) $id;
			
			$query = 'SELECT *
					FROM locations
					WHERE location_id = '.$id;
				
			return $this->db->getRow($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompanyLogo
	 * 
	 * get the logo of a given company
	 * 
	 * @param int $companyId
	 * @return boolean
	 */
	public function getCompanyLogo($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT logo
					FROM company_logo
					WHERE company_id = '.$companyId;

			return $this->db->getValue($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompanySeoInfo
	 * 
	 * returns the seo and social column according to a companyId
	 * 
	 * @param unknown $companyId
	 * @return multitype:|boolean
	 */
	public function getCompanySeoInfo($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT *
	        		FROM seo s
	        		LEFT JOIN social so ON so.company_id = s.company_id
	        		WHERE s.company_id = '.strip_tags($companyId);
			 
			return  $this->db->getRow($query);
				
		}
		catch (Exception $e)
		{
			return  false;
		}
	}
	
	/**
	 * companyInfo
	 * 
	 * get's the company info ... meh
	 * 
	 * @param int $companyId
	 * @return multitype:|boolean
	 */
	public function companyInfo($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
				
			$query = 'SELECT C.*, 
					S.seo_id, S.title, S.description AS seo_description, S.keywords,
					SOC.social_id, SOC.tuit_url, SOC.tripadvisor,  
					cat.name as category_name
					FROM companies AS C
					LEFT JOIN seo S ON S.company_id = C.company_id
					LEFT JOIN social SOC ON SOC.company_id = C.company_id
					LEFT JOIN categories cat ON cat.category_id = C.category
					WHERE C.company_id =
					'.$companyId;
				
			return $this->db->getRow($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * this gets the last slider linked to a company
	 * @param int $companyId
	 * @return boolean
	 */
	public function getLastSlider($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
				
			$query = 'SELECT slider
					FROM company_sliders
					WHERE company_id = '.$companyId.'
					ORDER BY sliders_id
					DESC LIMIT 1';
				
			return $this->db->getValue($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompanySlider
	 * 
	 * gets the sliders linked to a company
	 * 
	 * @param unknown $companyId
	 * @return multitype:unknown |boolean
	 */
	public function getCompanySliders($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT slider
					FROM company_sliders
					WHERE company_id = '.$companyId.' 
					ORDER BY sliders_id DESC';
	
			$sliders = $this->db->getArray($query);
	
			if (!$sliders)
			{
				$query = 'SELECT slider
					FROM default_sliders
					ORDER BY default_slider_id DESC';
					
				return $this->db->getArray($query);
			}
			else
			{
				return $sliders;
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompanyGaleries
	 * 
	 * the photos related to a company
	 * 
	 * @param unknown $companyId
	 * @return multitype:unknown |boolean
	 */
	public function getCompanyGaleries($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT picture
					FROM company_galeries
					WHERE company_id = '.$companyId.'
					ORDER BY picture_id DESC';
	
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompanySocialInfo
	 * 
	 * the social thing
	 * 
	 * @param unknown $companyId
	 * @return multitype:|boolean
	 */
	public function getCompanySocialInfo($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT * FROM social WHERE company_id='.strip_tags($companyId);
			return $this->db->getRow($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getEmails
	 * 
	 * emails related to a company
	 * 
	 * @param unknown $companyId
	 * @return multitype:unknown |boolean
	 */
	public function getEmails($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT e_mail, e_mail_id
					FROM email WHERE company_id = '.$companyId;
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
		#	        echo $e->getMessage();
			return false;
		}
	}
	
	/**
	 * getPhones
	 * 
	 * get the phones related to a company
	 * 
	 * @param unknown $companyId
	 * @return multitype:unknown |boolean
	 */
	public function getPhones($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT telephone, telephone_id
					FROM telephone WHERE company_id = '.$companyId;
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getCompaniesWithLocation
	 * 
	 * Returns an array of companies with location, not null, numeric, != 0
	 * 
	 * @return multitype:unknown |boolean
	 */
	public function getCompaniesWithLocation()
	{
		try
		{
			$query = 'SELECT C.*, 
					S.title, S.description AS seo_description,
					cat.name as category_name,
					p.logo
					FROM companies AS C
					LEFT JOIN seo S ON S.company_id = C.company_id
					LEFT JOIN categories cat ON cat.category_id = C.category
					LEFT JOIN company_logo p ON C.company_id = p.company_id
					WHERE (C.longitude IS NOT NULL AND C.longitude != 0) AND
					(C.latitude IS NOT NULL AND C.latitude != 0)';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * getResultsAll
	 * 
	 * search a term
	 * 
	 * @param unknown $term
	 * @param unknown $from
	 * @param unknown $to
	 * @return boolean
	 */
	public function searchTerm($term, $from, $to)
	{
		try
		{
			$term 	= str_replace('-', ' ', $term);
			$from 	= (int) $from;
			$to 	= (int) $to;
				
			$query = 'SELECT 
					c.description, 
					c.name,
					c.category,
					c.company_id,
					cl.logo, 
					ca.name as category_name,
					MATCH (c.name, c.description)
					AGAINST ("'.$term.'" IN BOOLEAN MODE) AS coincidencias
					FROM companies c
					LEFT JOIN categories ca ON ca.category_id = c.category
					LEFT JOIN company_logo cl ON c.company_id = cl.company_id
					WHERE MATCH (c.name, c.description)
					AGAINST ("'.$term.'" IN BOOLEAN MODE)
					AND c.published = 1
					GROUP BY c.company_id
					ORDER BY coincidencias DESC
					LIMIT '.$from.', '.$to;
// 			echo $query;
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	/**
	 * countResultsAll
	 * count the results
	 * @param unknown $term
	 * @return multitype:unknown |boolean
	 */
	
	public function countResultsAll($term)
	{
		try
		{
			$term = str_replace('-', ' ', $term);
			$from = (int) $from;
			$to = (int) $to;
				
			$query = 'SELECT c.description, c.name, ca.name as category_name,
					MATCH (c.name, c.description)
					AGAINST ("'.$term.'" IN BOOLEAN MODE) AS coincidencias
					FROM companies c
					LEFT JOIN categories ca ON ca.category_id = c.category
					WHERE MATCH (c.name, c.description)
					AGAINST ("'.$term.'" IN BOOLEAN MODE)
					GROUP BY c.company_id
					ORDER BY coincidencias DESC';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getEventsByCompany($companyId)
	{
		try
		{
			$query = 'SELECT e.*,
					s.*,
					ed.*
					FROM companies e
					LEFT JOIN seo s ON s.company_id = e.company_id
					LEFT JOIN events ed ON ed.event_id = e.company_id
					WHERE e.belong_company = '.$companyId.'
					ORDER BY ed.date DESC';
			
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getEventsYears($companyId)
	{
		try
		{
			$query = 'SELECT DATE_FORMAT(ed.date, "%Y") AS year
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					WHERE e.belong_company = '.$companyId.'
					GROUP BY DATE_FORMAT(ed.date, "%Y")
					ORDER BY ed.date DESC ';
			
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getMonthsByYear($companyId, $year)
	{
		try
		{
			$query = 'SELECT DATE_FORMAT(ed.date, "%M") AS month
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					WHERE e.belong_company = '.$companyId.'
					AND DATE_FORMAT(ed.date, "%Y") = '.$year.'
					GROUP BY DATE_FORMAT(ed.date, "%M")
					ORDER BY ed.date DESC';
			
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getEventsByYearAndMonth($companyId, $year, $month)
	{
		try
		{
			$query = 'SELECT
					e.belong_company as company_id, e.name,
					s.title, s.description,
					ed.event_id, ed.date
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					LEFT JOIN seo s ON s.company_id = e.company_id
					WHERE e.belong_company = '.$companyId.'
					AND DATE_FORMAT(ed.date, "%Y") = '.$year.'
					AND DATE_FORMAT(ed.date, "%M") = "'.$month.'"
					ORDER BY ed.date DESC';
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getAllEvents()
	{
		try
		{
			$query = 'SELECT
					e.belong_company as company_id, e.name,
					s.title, s.description,
					ed.event_id, ed.date,
					cl.logo,
					c.name AS company_name
					FROM companies e
					LEFT JOIN seo s ON s.company_id = e.company_id
					LEFT JOIN events ed ON ed.event_id = e.company_id
					LEFT JOIN company_logo cl ON cl.company_id = e.company_id
					LEFT JOIN companies c ON c.company_id = e.belong_company
					WHERE e.belong_company IS NOT NULL
					ORDER BY ed.date DESC';
			
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getAllEventsYears()
	{
		try
		{
			$query = 'SELECT DATE_FORMAT(ed.date, "%Y") AS year
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					WHERE e.belong_company IS NOT NULL
					GROUP BY DATE_FORMAT(ed.date, "%Y")
					ORDER BY ed.date DESC ';
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getAllMonthsByYear($year)
	{
		try
		{
			$query = 'SELECT DATE_FORMAT(ed.date, "%M") AS month
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					WHERE e.belong_company IS NOT NULL
					AND DATE_FORMAT(ed.date, "%Y") = '.$year.'
					GROUP BY DATE_FORMAT(ed.date, "%M")
					ORDER BY ed.date DESC';
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getAllEventsByYearAndMonth($year, $month)
	{
		try
		{
			$query = 'SELECT e.company_id, e.name, e.belong_company, ed.date,
					c.name AS company_name
					FROM companies e
					LEFT JOIN events ed ON ed.event_id = e.company_id
					LEFT JOIN companies c ON c.company_id = e.belong_company
					WHERE e.belong_company IS NOT NULL
					AND DATE_FORMAT(ed.date, "%Y") = '.$year.'
					AND DATE_FORMAT(ed.date, "%M") = "'.$month.'"
					ORDER BY ed.date DESC';
			
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getEventDetailByEventId($eventId)
	{
		try 
		{
			$eventId = (int) $eventId;
			$query = 'SELECT date, time FROM events WHERE event_id = '.$eventId;
			return $this->db->getRow($query);
		} catch (Exception $e) {
			return false;
		}
	}
}
