<?php
class Common_functionality extends CI_Model
{
	/*
	 * get_banner_image is used to get banner image for particular page
	 * @param $page string specify page name for which you are fetching banner
	 * @return string, if page found
	 *			false, if not found
	 * develop by : ar
	 */
	public function get_banner_image($page)
	{
		$this->db->select('image');
		$this->db->where('page',$page);
		return $this->db->get('banner_images')->row_array()['image'];
	}
}
?>