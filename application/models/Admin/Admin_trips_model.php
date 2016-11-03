<?php

class Admin_trips_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @uses : this function is used to get result based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_all_trips() {
        $columns = ['trip_booking_details.id','user.display_name', 'trip.start_city', 'trip.end_city', 'trip.dept_date_time','cuser.display_name', 'trip_booking_details.no_of_seat', 'trip.total_price', 'trip_booking_details.is_approved'];
        $this->db->select('trip_booking_details.id,trip_booking_details.is_approved,trip.start_city,trip.end_city,DATE_FORMAT(trip.dept_date_time,"%d %b %Y <br> %l:%i %p") as dept_date_time,trip_booking_details.no_of_seat,trip.total_price,user.display_name,cuser.display_name as co_traveller');
        $this->db->join('trip', 'trip.id=trip_booking_details.trip_id');
        $this->db->join('users user', 'trip.user_id=user.id');
        $this->db->join('users cuser', 'trip_booking_details.user_id=cuser.id');
        $this->db->where('trip.dept_date_time >= now()');
        $this->db->where('(trip_booking_details.approval_time >= now() OR trip_booking_details.approval_time IS NULL )');
        $this->db->where('trip_booking_details.is_cancelled != 1');
        $this->db->where('(`trip_booking_details`.`is_approved` = 1 OR `trip_booking_details`.`is_approved` IS NULL)');
        $keyword = $this->input->get('search');
        if (!empty($keyword['value'])) {
            $this->db->having('trip.start_city LIKE "%' . $keyword['value'] . '%" OR trip.end_city LIKE "%' . $keyword['value'] . '%" OR user.display_name LIKE "%' . $keyword['value'] . '%" OR cuser.display_name LIKE "%' . $keyword['value'] . '%"', NULL);
        }
        $this->db->order_by($columns[$this->input->get('order')[0]['column']], $this->input->get('order')[0]['dir']);
        $this->db->limit($this->input->get('length'), $this->input->get('start'));
        $res_data = $this->db->get('trip_booking_details')->result_array();
        return $res_data;
    }

    /**
     * @uses : this function is used to count rows of users based on datatable in user list page
     * @param : @table 
     * @author : HPA
     */
    public function get_trips_count() {
        $this->db->join('trip', 'trip.id=trip_booking_details.trip_id');
        $this->db->join('users', 'trip.user_id=users.id');
        $this->db->where('trip.dept_date_time >= now()');
        $this->db->where('(trip_booking_details.approval_time >= now() OR trip_booking_details.approval_time IS NULL )');
        $this->db->where('trip_booking_details.is_cancelled != 1');
        $this->db->where('(`trip_booking_details`.`is_approved` = 1 OR `trip_booking_details`.`is_approved` IS NULL)');
        $res_data = $this->db->get('trip_booking_details')->num_rows();
        return $res_data;
    }

    /**
     * @uses : This function is used get result from the table
     * @param : @table 
     * @author : HPA
     */
    public function get_result($table, $condition = null) {
        $this->db->select('*');
        if (!is_null($condition)) {
            $this->db->where($condition);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }

}

?>