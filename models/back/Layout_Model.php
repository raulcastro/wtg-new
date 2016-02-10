<?php
$root = $_SERVER['DOCUMENT_ROOT'].'/';
require_once $root.'Framework/Back_Default_Header.php';

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
	
	public function addSlider($name)
	{
		try
		{
			$query = 'INSERT INTO main_gallery(name)
	                VALUES("'.$name.'")';

			if ($this->db->run($query))
				return $this->db->insert_id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function editSliderInfo($data)
	{
		try
		{
			$query = 'UPDATE main_gallery 
					SET title = ?, 
					link = ?, 
					promos = ?
					WHERE picture_id = ?';
			$prep = $this->db->prepare($query);
			$prep->bind_param('sssi', 
					$data['title'], 
					$data['link'],
					$data['promos'],
					$data['sliderId']);
			return $prep->execute();
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function deleteSlider($picture_id)
	{
		try
		{
			$picture_id = (int) $picture_id;
			 
			$query = 'DELETE FROM main_gallery WHERE picture_id = '.$picture_id;
			 
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCompanyInfo($data)
	{
		try
		{
			$companyId = (int) $data['companyId'];
			
			$query = 'UPDATE companies
					SET name = ?,
					description = ?,
					latitude = ?,
					longitude = ?
					WHERE company_id = ?';
			
			$prep = $this->db->prepare($query);
			$prep->bind_param('ssddi',
					$data['companyName'],
					$data['companyDescription'],
					$data['companyLatitude'],
					$data['companyLongitude'],
					$data['companyId']);
			
			return $prep->execute();
		}
		catch (Exception $e)
		{
			
			return false;
		}
	}
	
	public function updateCompanySeo($data)
	{
		try
		{
			$companyId = (int) $data['companyId'];
				
			$query = 'UPDATE seo
					SET title = ?,
					description = ?,
					keywords = ?
					WHERE company_id = ?';
				
			$prep = $this->db->prepare($query);
			$prep->bind_param('sssi',
					$data['companySeoTitle'],
					$data['companySeoDescription'],
					$data['companySeoKeywords'],
					$data['companyId']);
				
			return $prep->execute();
		}
		catch (Exception $e)
		{
				
			return false;
		}
	}
	
	public function updateCompanySocial($data)
	{
		try
		{
			$companyId = (int) $data['companyId'];
	
			$query = 'UPDATE social
					SET tuit_url = ?,
					facebook = ?,
					tripadvisor = ?,
					youtube = ?,
					pinterest = ?,
					instagram = ?
					WHERE company_id = ?';
	
			$prep = $this->db->prepare($query);
			$prep->bind_param('ssssssi',
					$data['companyTwitter'],
					$data['companyFacebook'],
					$data['companyTripadvisor'],
					$data['companyYoutube'],
					$data['companyPinterest'],
					$data['companyInstagram'],
					$data['companyId']);
	
			return $prep->execute();
		}
		catch (Exception $e)
		{
	
			return false;
		}
	}
	
	public function updateCompanyEmail($data)
	{
		try {
			$emailId = (int) $data['emailId'];
			$query = 'UPDATE email 
					SET e_mail = ? 
					WHERE e_mail_id = ?';
			
			$prep = $this->db->prepare($query);
			$prep->bind_param('si', 
					$data['emailVal'], 
					$emailId);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addCompanyEmail($data)
	{
		try {
			$companyId = (int) $data['companyId'];
			$query = 'INSERT INTO email(company_id, e_mail)
						VALUES(?, ?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is', 
					$companyId,
					$data['emailVal']);
			$prep->execute();
		} catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCompanyPhone($data)
	{
		try {
			$phoneId = (int) $data['phoneId'];
			$query = 'UPDATE telephone
					SET telephone = ?
					WHERE telephone_id = ?';
				
			$prep = $this->db->prepare($query);
			$prep->bind_param('si',
					$data['phoneVal'],
					$phoneId);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addCompanyPhone($data)
	{
		try {
			$companyId = (int) $data['companyId'];
			$query = 'INSERT INTO telephone(company_id, telephone)
						VALUES(?, ?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is',
					$companyId,
					$data['phoneVal']);
			$prep->execute();
		} catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCompanyWebsite($data)
	{
		try {
			$companyId = (int) $data['companyId'];
			$query = 'UPDATE companies 
					SET website = ? 
					WHERE company_id = ?';
			$prep = $this->db->prepare($query);
			$prep->bind_param('si', 
					$data['companyWebsite'],
					$companyId);
			$prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function updateCompanyLogo($logoId, $logoName)
	{
		try {
			$query = 'UPDATE company_logo 
					SET logo = ? 
					WHERE logo_id = ? ';
			$prep = $this->db->prepare($query);
			$prep->bind_param('si', 
					$logoName,
					$logoId);
			return $prep->execute();
		} catch (Exception $e)
		{
			return false;
		}
	}
	
	public function addCompanyLogo($companyId, $logoName)
	{
		try {
			$query = 'INSERT INTO company_logo(company_id, logo)
					VALUES(?, ?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is',
					$companyId,
					$logoName);
			if ($prep->execute())
			{
				return $prep->insert_id;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addCompanySlider($companyId, $name)
	{
		try
		{
			$companyId = (int) $companyId;
			$query = 'INSERT INTO company_sliders(company_id, slider)
	                VALUES('.$companyId.', "'.$name.'")';
	
			if ($this->db->run($query))
				return $this->db->insert_id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function deleteCompanySlider($picture_id)
	{
		try
		{
			$picture_id = (int) $picture_id;
	
			$query = 'DELETE FROM company_sliders WHERE sliders_id = '.$picture_id;
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function addCompanyGallery($companyId, $name)
	{
		try
		{
			$companyId = (int) $companyId;
			$query = 'INSERT INTO company_galeries(company_id, picture)
	                VALUES('.$companyId.', "'.$name.'")';
			
			if ($this->db->run($query))
				return $this->db->insert_id;
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function deleteCompanyGallery($picture_id)
	{
		try
		{
			$picture_id = (int) $picture_id;
	
			$query = 'DELETE FROM company_galeries 
					WHERE picture_id = '.$picture_id;
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function getCompanyLocations($companyId)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'SELECT ubication 
					FROM companies_ubication 
					WHERE company = '.$companyId.' 
					GROUP BY ubication';
				
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function changeCompanyOfCategory($data)
	{
		try
		{
			$category 	= (int) $data['category'];
			$companyId	= (int) $data['companyId'];
	
			$query = 'UPDATE companies SET category = '.$category.'
					WHERE company_id = '.$companyId;
	
			if ($this->db->run($query))
			{
				$this->eraseSubcategoriesByCompany($companyId);
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function eraseSubcategoriesByCompany($companyId)
	{
		try
		{
			$query = 'DELETE FROM companies_subcategories 
					WHERE company = '.$companyId;
	
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCompanySubcategory($data)
	{
		try
		{
			$companyId = (int) $data['companyId'];
			$subcategory = (int) $data['subcategory'];
	
			$query = 'SELECT COUNT(*) FROM companies_subcategories
					WHERE company = '.$companyId.'
					AND subcategory = '.$subcategory;
	
			$c = $this->db->getValue($query);
	
			if ($c > 0)
			{
				$query = 'DELETE FROM companies_subcategories
					WHERE company = '.$companyId.'
					AND subcategory = '.$subcategory;
			}
			else
			{
				$query = 'INSERT INTO companies_subcategories(company, subcategory)
						VALUES('.$companyId.', '.$subcategory.')';
			}
	
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCompanyLocation($data)
	{
		try
		{
			$companyId = (int) $data['companyId'];
			$location_id = (int) $data['location_id'];
	
			$query = 'SELECT COUNT(*) FROM companies_ubication
					WHERE company = '.$companyId.'
					AND ubication = '.$location_id;
	
			$c = $this->db->getValue($query);
	
			if ($c > 0)
			{
				$query = 'DELETE FROM companies_ubication
					WHERE company = '.$companyId.'
					AND ubication = '.$location_id;
			}
			else
			{
				$query = 'INSERT INTO companies_ubication(company, ubication)
						VALUES('.$companyId.', '.$location_id.')';
			}
	
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function publishCompany($companyId, $todo)
	{
		try
		{
			$companyId = (int) $companyId;
				
			$query = 'UPDATE companies SET published = '.$todo.'
					WHERE company_id = '.$companyId;
				
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function closeCompany($companyId, $todo)
	{
		try
		{
			$companyId = (int) $companyId;
	
			$query = 'UPDATE companies SET closed = '.$todo.'
					WHERE company_id = '.$companyId;
	
			return $this->db->run($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function createCompany($companyName)
	{
		try
		{
			$companyId = 0;
			$query = 'INSERT INTO companies(name, published) VALUES(?, 0)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('s', $companyName);
			if ($prep->execute())
			{
				$companyId = $prep->insert_id;
				$query = 'INSERT INTO social(company_id) values('.$companyId.')';
				if ($this->db->run($query)) {
					$query = 'INSERT INTO seo(company_id) values('.$companyId.')';
					if ($this->db->run($query)) {
						return $companyId;
					}
				}
						
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateSettings($data)
	{
		try {
			$query = 'UPDATE app_info SET
					title = ?,
					site_name = ?,
					url = ?,
					content = ?,
					description = ?,
					keywords = ?,
					twitter = ?,
					facebook = ?,
					googleplus = ?,
					pinterest = ?,
					linkedin = ?,
					email = ?,
					youtube = ?,
					instagram = ?,
					location = ?
					';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param('sssssssssssssss',
					$data['siteTittle'],
					$data['siteName'],
					$data['siteUrl'],
					$data['siteContent'],
					$data['siteDescription'],
					$data['siteKeywords'],
					$data['siteTwitter'],
					$data['siteFacebook'],
					$data['siteGoogleplus'],
					$data['sitePinterest'],
					$data['siteLinkedin'],
					$data['siteEmail'],
					$data['siteYoutube'],
					$data['siteInstagram'],
					$data['siteLocation']
					);
			
			return $prep->execute();
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addCategory($data)
	{
		try {
			$query = 'INSERT INTO categories(name) VALUES(?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('s', $data['categoryName']);
			if ($prep->execute())
			{
				return $prep->insert_id;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function updateCategory($data)
	{
		try {
			$query = 'UPDATE categories SET 
					name = ?, 
					title = ?, 
					description = ? 
					WHERE category_id = ?';
			$prep = $this->db->prepare($query);
			$prep->bind_param('sssi', 
			$data['catName'],
			$data['catTitle'],
			$data['catDescription'],
			$data['catId']
			);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function deleteCategory($data)
	{
		try {
			$query = 'DELETE FROM subcategories 
					WHERE category = '.$data['catId'];
			$this->db->run($query);
			
			$query = 'DELETE FROM categories 
					WHERE category_id = '.$data['catId'];
			
			return $this->db->run($query);
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addSubcategory($data)
	{
		try {
			$query = 'INSERT 
					INTO subcategories(category, name) 
					VALUE(?, ?)';
			
			$prep = $this->db->prepare($query);
			
			$prep->bind_param('is', 
					$data['catId'],
					$data['subName']);
			if ($prep->execute())
				return $prep->insert_id;
			
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addLocation($data)
	{
		try {
			$query = 'INSERT INTO locations(name) VALUES(?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('s', $data['locationName']);
			if ($prep->execute())
			{
				return $prep->insert_id;
			}
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function updateLocation($data)
	{
		try {
			$query = 'UPDATE locations SET
					name = ?,
					description = ?
					WHERE location_id = ?';
			$prep = $this->db->prepare($query);
			$prep->bind_param('ssi',
					$data['locName'],
					$data['locDescription'],
					$data['locId']
			);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function deleteLocation($data)
	{
		try {
			$query = 'DELETE FROM locations
					WHERE location_id = '.$data['locId'];
				
			return $this->db->run($query);
				
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function load_file_from_url($url)
	{
		$curl = curl_init();
	
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_REFERER, 'http://www.wheretogo.com.mx/');
		$str = curl_exec($curl);
		curl_close($curl);
	
		return $str;
	}
	
	public function addVideo($video)
	{
		try
		{
			$url = "http://gdata.youtube.com/feeds/api/videos/".$video;
			 
			$xml = self::load_file_from_url($url);
				
			if (!$xml)
			{
				echo "Error, no se ha podido obtener la info del video $id <br />";
				return false;
			}
			else
			{
				preg_match("#<yt:duration seconds='([0-9]+)'/>#", $xml, $duracion);
					
				$xml 		= simplexml_load_string($xml);
				$img 		= 'http://i.ytimg.com/vi/'.$video.'/mqdefault.jpg';
				$title 		= $xml->title;
				$content 	= $xml->content;
				$duration 	= date('i:s',$duracion[1]);
				$query 		= 'INSERT INTO main_videos(youtube, image, title, content, duration)
							VALUES(?, ?, ?, ?, ?)';
		
				$prep 		= $this->db->prepare($query);
				$prep->bind_param('sssss', $video, $img, $title, $content, $duration);

				if ($prep->execute())
				{
					$data['image']  = $img;
					$data['title']  = $title;
					$data['id']  	= $prep->insert_id;
					
					return $data;
				}
			}
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function deleteVideo($data)
	{
		try
		{
			$video_id = (int) $data;
			$query = 'DELETE FROM main_videos WHERE video_id = '.$video_id;
		
			return $this->db->run($query);
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
                FROM categories cat
	        	ORDER BY cat.name ASC';
                
                return $this->db->getArray($query);
	    }
	    catch (Exception $e)
	    {
	        return false;
	    }
	}
	
	/**
	 * getAllCompanies
	 *
	 * returns all the companies
	 *
	 * @param int $id this is the category id
	 * @return multitype:unknown |boolean
	 */
	public function getCompanies()
	{
		try
		{
			$query = 'SELECT
			c.name,
			c.company_id,
			c.promoted,
			c.closed,
			c.published, 
			s.description,
			ca.name AS category,
			ca.category_id,
			p.logo
	
			FROM companies c
			LEFT JOIN seo s ON c.company_id = s.company_id
			LEFT JOIN company_logo p ON c.company_id = p.company_id
			LEFT JOIN categories ca ON ca.category_id = c.category
	
			GROUP BY c.company_id
			ORDER BY c.company_id DESC';
	
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
			c.published,
			s.description,
			ca.name AS category,
			ca.category_id,
			p.logo
	
			FROM companies c
			LEFT JOIN seo s ON c.company_id = s.company_id
			LEFT JOIN company_logo p ON c.company_id = p.company_id
			LEFT JOIN categories ca ON ca.category_id = c.category
	
			WHERE c.category = '.$categoryId.'
			GROUP BY c.company_id
			ORDER BY c.company_id DESC';
	
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
			$query = 'SELECT l.*
					FROM locations l';
			
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
					c.published,
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
				WHERE category = '.$category.'
				ORDER BY s.name ASC';
	
			return $this->db->getArray($query);
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function belongSubcategories($companyId)
	{
		try {
			$companyId = (int) $companyId;
	    
	        $query = 'SELECT subcategory 
	        		FROM companies_subcategories 
	        		WHERE company = '.$companyId;
			
			return $this->db->getArray($query);
		} catch (Exception $e) {
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
	
			$query = 'SELECT logo_id, logo
					FROM company_logo
					WHERE company_id = '.$companyId;

			return $this->db->getRow($query);
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
	
			$query = 'SELECT sliders_id, slider
					FROM company_sliders
					WHERE company_id = '.$companyId.' 
					ORDER BY sliders_id DESC';
	
			return $this->db->getArray($query);
	
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
	
			$query = 'SELECT picture_id, picture
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
			$term 	= str_replace('-', ' ', $term);
			$from 	= (int) $from;
			$to 	= (int) $to;
				
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
					l.logo, 
					s.*,
					ed.*
					FROM companies e 
					LEFT JOIN company_logo l ON l.company_id = e.company_id
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
	
	public function getAllMembers()
	{
		try {
			$query = 'SELECT 
					m.member_id,
					m.member_name,
					m.company_name,
					m.position,
					me.email,
					mp.phone
					FROM members m
					LEFT JOIN member_emails me ON me.member_id = m.member_id
					LEFT JOIN member_phones mp ON mp.member_id = m.member_id
					GROUP BY m.member_id
					ORDER BY m.member_id DESC';
			
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function getMemberDetail($memberId)
	{
		try {
			$memberId = (int) $memberId;
			$query = 'SELECT
					*
					FROM members m
					WHERE m.member_id = '.$memberId.'
					GROUP BY m.member_id
					ORDER BY m.member_id DESC';
				
			return $this->db->getRow($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function getMemberEmails($memberId)
	{
		try {
			$memberId = (int) $memberId;
			$query = 'SELECT email_id, email 
					FROM member_emails 
					WHERE member_id = '.$memberId;
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function getMemberPhones($memberId)
	{
		try {
			$memberId = (int) $memberId;
			$query = 'SELECT * 
					FROM member_phones 
					WHERE member_id = '.$memberId;
			return $this->db->getArray($query);
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function updateMemberInfo($data)
	{
		try
		{
			$member = (int) $data['memberId'];
				
			$query = 'UPDATE members
					SET member_name = ?,
					company_name = ?,
					position = ?,
					company_type = ?,
					address = ?,
					notes = ?
					WHERE member_id = ?';

			$prep = $this->db->prepare($query);
			$prep->bind_param('ssssssi',
					$data['memberName'],
					$data['memberCompany'],
					$data['memberPosition'],
					$data['memberCompanyType'],
					$data['memberAddress'],
					$data['memberNotes'],
					$data['memberId']);
				
			return $prep->execute();
		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateMemberEmail($data)
	{
		try {
			$emailId = (int) $data['emailId'];
			$query = 'UPDATE member_emails
					SET email = ?
					WHERE email_id = ?';
				
			$prep = $this->db->prepare($query);
			$prep->bind_param('si',
					$data['emailVal'],
					$emailId);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addMemberEmail($data)
	{
		try {
			$memberId = (int) $data['memberId'];
			$query = 'INSERT INTO member_emails(member_id, email)
						VALUES(?, ?)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is',
					$memberId,
					$data['emailVal']);
			$prep->execute();
		} catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateMemberPhone($data)
	{
		try {
			$phoneId = (int) $data['phoneId'];
			$query = 'UPDATE member_phones
					SET phone = ?
					WHERE phone_id = ?';
	
			$prep = $this->db->prepare($query);
			$prep->bind_param('si',
					$data['phoneVal'],
					$phoneId);
			return $prep->execute();
		} catch (Exception $e) {
			return false;
		}
	}
	
	public function addMemberPhone($data)
	{
		try {
			$memberId = (int) $data['memberId'];
			$query = 'INSERT INTO member_phones(member_id, phone, type)
						VALUES(?, ?, 1)';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is',
					$memberId,
					$data['phoneVal']);
			$prep->execute();
		} catch (Exception $e)
		{
			return false;
		}
	}
	
	public function addMember($data)
	{
		try {
			$query = 'INSERT INTO members(agent, member_name, date) VALUES(?, ?, CURDATE())';
			$prep = $this->db->prepare($query);
			$prep->bind_param('is',
					$_SESSION['userId'],
					$data['memberName']);
			if ($prep->execute())
				return $prep->insert_id;
			
		} catch (Exception $e) {
			return false;
		}
	}
	
}
