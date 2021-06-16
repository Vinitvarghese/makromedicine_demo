<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webcoder_Model extends CI_Model
{
    
    /**
    * Select the database connection from the group names defined inside the database.php configuration file or an
    * array.
    */
    protected $database_connection = null;

    /** @var
     * This one will hold the database connection object
     */
    protected $database;

    
    /** @var null
     * Sets table name
     */
    public $table = null;
    
    /** @var null
     * Sets table name
     */
    public $table_translation = null;

    /**
     * @var null
     * Sets PRIMARY KEY
     */
    public $primary_key = 'id';
    
    /**
     * @var null
     * Sets Translation table related key
     */
    public $table_translation_key = null;
    
    /**
     * @var null
     * Sets Translation table language key
     */
    public $table_language_key = 'language_id';

    /**
     * @var null|array
     * Sets fillable fields.
     * If value is set as null, the $fillable property will be set as an array with all the table fields (except the primary key) as elements.
     * If value is set as an array, there won't be any changes done to it (ie: no field of the table will be updated or inserted).
     */
    public $fillable = null;

    /**
     * @var null|array
     * Sets protected fields.
     * If value is set as null, the $protected will be set as an array with the primary key as single element.
     * If value is set as an array, there won't be any changes done to it (if set as empty array, the primary key won't be inserted here).
     */
    public $protected = null;

    /** @var bool | array
     * Enables created_at and updated_at fields
     */


    public $as_array = false;
    public $deleted_at = true;
    protected $timestamps = true;
    protected $timestamps_format = 'Y-m-d H:i:s';

    protected $created_at_field;
    protected $updated_at_field;
    protected $deleted_at_field;

    protected $authors = true;
    protected $created_by_field;
    protected $updated_by_field;
    protected $deleted_by_field;
    
    /** @var bool
     * Enables soft_deletes
     */
    protected $soft_deletes = true;

    /** Relationships Variables */
    private $relationships = [];
    public $has_one = [];
    public $has_many = [];
    public $has_many_pivot = [];
    public $separate_subqueries = true;
    private $requested = [];
    /** End Relationships Variables */

    /*caching*/
    public $cache_driver = 'file';
    public $cache_prefix = 'mm';
    protected $cache = [];
    public $delete_cache_on_save = false;

    private $validated = TRUE;
    private $row_fields_to_update = array();
    
    /**
     * The various callbacks available to the model. Each are
     * simple lists of method names (methods will be run on $this).
     */
    protected $before_create = [];
    protected $after_create = [];
    protected $before_update = [];
    protected $after_update = [];
    protected $before_get = [];
    protected $after_get = [];
    protected $before_delete = [];
    protected $after_delete = [];
    protected $before_soft_delete = [];
    protected $after_soft_delete = [];

    protected $callback_parameters = [];

    protected $return_as = 'object';
    protected $return_as_dropdown = null;
    protected $dropdown_field = '';

    private $trashed = 'without';

    private $select = '*';

    public function __construct()
    {
        parent::__construct();
        $this->table = $this->db->dbprefix($this->table);
        $this->set_connection();
        $this->set_timestamps();
        $this->set_author();
        $this->fetch_table();
    }

    /**
     * private function set_connection()
     *
     * Sets the connection to database
     */
    private function set_connection()
    {
        if (isset($this->database_connection)) {
            $this->database = $this->load->database($this->database_connection, true);
        } else {
            $this->database =$this->db;
        }
        // This may not be required
        return $this;
    }

    /**
    * private function set_timestamps()
    *
    * Sets the fields for the created_at, updated_at and deleted_at timestamps
    * @return bool
    */
    private function set_timestamps()
    {
        if ($this->timestamps !== false) {
            $this->created_at_field = (is_array($this->timestamps) && isset($this->timestamps['created_at'])) ? $this->timestamps['created_at'] : 'created_at';
            $this->updated_at_field = (is_array($this->timestamps) && isset($this->timestamps['updated_at'])) ? $this->timestamps['updated_at'] : 'updated_at';
            $this->deleted_at_field = (is_array($this->timestamps) && isset($this->timestamps['deleted_at'])) ? $this->timestamps['deleted_at'] : 'deleted_at';
        }
        return true;
    }

    /**
    * private function set_author()
    *
    * Sets the fields for the created_by, updated_by and deleted_by timestamps
    * @return bool
    */
    private function set_author()
    {
        $this->created_by_field = (isset($this->authors['created_by'])) ? $this->authors['created_by'] : 'created_by';
        $this->updated_by_field = (isset($this->authors['updated_by'])) ? $this->authors['updated_by'] : 'updated_by';
        $this->deleted_by_field = (isset($this->authors['deleted_by'])) ? $this->authors['deleted_by'] : 'deleted_by';
        
        return true;
    }

    /**
     * this function verifies if a table name was defined. if not, it calls the get_table_name in order to retrieve a potential table name,
     * which will be tested if exists. If all went well, the table name will be saved as $this->table
     * @return boolean
     */
    private function fetch_table()
    {
        if (!isset($this->table)) {

            $this->table = $this->get_table_name(get_class($this));

            if (!$this->database->table_exists($this->table)) {
                show_error(
                   sprintf('While trying to figure out the table name, couldn\'t find an existing table named: <strong>"%s"</strong>.<br />You can set the table name in your model by defining the protected variable <strong>$table</strong>.', $this->table),
                   500,
                   sprintf('Error trying to figure out table name for model "%s"', get_class($this))
               );
            }
        }

        $this->set_table_fillable_protected();

        return true;
    }

    /**
     * private function get_table_name($model_name)
     * returns a table name as proper to its model_name
     * @param string $model_name
     * @return string
     */
    private function get_table_name($model_name)
    {
        $table_name = preg_replace('/(_model|_Model|model|Model)?$/', '', strtolower($model_name));
        return $table_name;
    }

    /**
     * private function set_table_fillable_protected()
     * Sets fillable and protected fields
     * @return $this
     */
    private function set_table_fillable_protected()
    {

        if (is_null($this->fillable)) {
            $table_fields = $this->database->list_fields($this->table);
            foreach ($table_fields as $field) {
                if (is_array($this->protected) && !in_array($field, $this->protected)) {
                    $this->fillable[] = $field;
                } elseif (is_null($this->protected) && ($field !== $this->primary_key)) {
                    $this->fillable[] = $field;
                }
            }
        }
        if (is_null($this->protected)) {
            $this->protected = array($this->primary_key);
        }
        return $this;
    }

    public function getUserData($filter=[], $return_all=false, $where_in=false){

        $this->db->select("
        u.*,
        c.id AS `company_id`,  
        c.industry_id,
        c.company_name, 
        c.company_info, 
        c.tags, 
        c.standart, 
        c.establishment_date, 
        c.banned, 
        c.status, 
        c.checked, 
        c.isvisible, 
        c.process, 
        c.slug, 
        REPLACE(c.company_logo, ' ', '_') AS company_logo, 
        REPLACE(c.company_banner, ' ', '_') AS company_banner, 
        c.country_id AS company_country_id,
        c.company_address, 
        c.company_lat, 
        c.company_lng, 
        c.website, 
        c.company_facebook, 
        c.company_twitter, 
        c.company_linkedin, 
        c.company_youtube, 
        rel.id AS rel_main_id, 
        rel.position_id AS position, 
        rel.user_id AS admin_id, 
        rel.start_date, 
        rel.end_date, 
        rel.display_company, 
        rel.approved, 
        tr.name AS position_name,
        r.name AS role_name,
        in.create_company
        ");
        $this->db->from('wc_users AS u');

        foreach ($filter as $k => $v){

            if ($where_in){
                $this->db->where_in($k, $v);
            }else{
                $this->db->where($k, $v);
            }
        }

        $this->db->join('wc_company_user_rel AS rel', 'rel.user_id = u.id AND rel.delete_at IS NULL', 'left');
        $this->db->join('wc_companies AS c', 'c.id = rel.company_id', 'left');
        $this->db->join('wc_industry AS in', 'in.id = c.industry_id', 'left');
        $this->db->join('wc_person_type_translation AS tr', 'tr.person_type_id = rel.position_id AND tr.language_id=1', 'left');
        $this->db->join('wc_groups AS r', 'r.id = rel.role_id', 'left');
        $query = $this->db->get();

        if (!$return_all){
            $get_data=$query->row();

            if (!empty($get_data)){
                $get_data->images=$this->checkUserAvatar($get_data);

                $get_data->company_logo=$this->checkCompanyLogo($get_data);
            }



            return $get_data;
        }else{
           $get_data= $query->result_array();


           return $get_data;
        }

    }

    public function getUserMainData($filter=[]){

        $this->db->select("
        u.*,
        '' AS `company_id`, 
        '' AS industry_id, 
        '' AS company_name, 
        '' AS company_info, 
        '' AS tags, 
        '' AS standart, 
        '' AS establishment_date, 
        '' AS banned, 
        '' AS status, 
        '' AS checked, 
        '' AS isvisible, 
        '' AS process, 
        '' AS slug, 
        '' AS company_logo, 
        '' AS company_banner, 
        '' AS company_country_id,
        '' AS company_address, 
        '' AS company_lat, 
        '' AS company_lng, 
        '' AS website, 
        '' AS company_facebook, 
        '' AS company_twitter, 
        '' AS company_linkedin, 
        '' AS company_youtube, 
        '' AS rel_main_id, 
        '' AS position, 
        '' AS admin_id, 
        '' AS start_date, 
        '' AS end_date, 
        '' AS display_company, 
        '' AS position_name
        ");
        $this->db->from('wc_users AS u');

        foreach ($filter as $k => $v){
            $this->db->where($k, $v);
        }
        $query = $this->db->get();
        $get_data=$query->row();
        $get_data->images=$this->checkUserAvatar($get_data);

        return $get_data;
    }

    public function getApliedUsers($company_id, $user_id, $approved){

        $this->db->select("
        u.*,
        c.id AS `company_id`, 
        c.industry_id, 
        c.company_name, 
        c.company_info, 
        c.tags, 
        c.standart, 
        c.establishment_date, 
        c.banned, 
        c.status, 
        c.checked, 
        c.isvisible, 
        c.process, 
        c.slug, 
        REPLACE(c.company_logo, ' ', '_') AS company_logo, 
        REPLACE(c.company_banner, ' ', '_') AS company_banner,
        c.country_id AS company_country_id,
        c.company_address, 
        c.company_lat, 
        c.company_lng, 
        c.website, 
        c.company_facebook, 
        c.company_twitter, 
        c.company_linkedin, 
        c.company_youtube, 
        rel.id AS rel_main_id, 
        rel.position_id AS position, 
        rel.start_date, 
        rel.end_date, 
        rel.display_company, 
        rel.approved, 
        tr.name AS position_name
        ");
        $this->db->from('wc_users AS u');
        $this->db->join('wc_company_user_rel AS rel', 'rel.user_id = u.id AND rel.delete_at IS NULL', 'inner');
        $this->db->where(["rel.company_id" => $company_id, "rel.user_id!=" => $user_id,  "rel.approved" => $approved]);
        $this->db->join('wc_companies AS c', 'c.id = rel.company_id', 'inner');
        $this->db->join('wc_groups AS tr', 'tr.id = rel.role_id', 'left');
        $this->db->group_by("rel.id");
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getCompanyPeople($company_id){

        $this->db->select("
        u.*,
        c.id AS `company_id`, 
        c.industry_id, 
        rel.id AS rel_main_id, 
        rel.position_id AS person_type, 
        rel.position_id AS position, 
        rel.start_date, 
        rel.end_date, 
        rel.display_company, 
        rel.approved, 
        tr.name AS position_name
        ");
        $this->db->from('wc_users AS u');
        $this->db->join('wc_company_user_rel AS rel', 'rel.user_id = u.id AND rel.delete_at IS NULL', 'inner');
        $this->db->where(["rel.company_id" => $company_id]);
        $this->db->join('wc_companies AS c', 'c.id = rel.company_id', 'inner');
        $this->db->join('wc_person_type_translation AS tr', 'tr.person_type_id = rel.position_id AND tr.language_id=1', 'inner');
        $this->db->group_by("rel.id");
        $query = $this->db->get();
        return $query->result_object();
    }

    public function getUserProfileMainData($link){
        $this->db->select('*');
        $this->db->from('wc_users');
        $this->db->where('slug_user', $link);
        $query = $this->db->get();

        if ($query->num_rows() == 1){
            $get_data=$query->row();

            $get_data->images=$this->checkUserAvatar($get_data);

            return $get_data;
        }

        return false;
    }

    public function getComplainReasons($type=1){

        $this->db->select('id, name');
        $this->db->from('wc_complain_reasons');
        $this->db->where(['type' => $type]);
        $query = $this->db->get();
        return $query->result_object();
    }

    public function checkUserAvatar($data){
        $check_user_photo=(!empty($data->images) && file_exists("uploads/catalog/users/".$data->images)) ? $data->images : "avatar-placeholder.png";

        return base_url( 'uploads/catalog/users/' ).$check_user_photo;
    }

    public function checkCompanyLogo($data){
        $img='uploads/catalog/users/'.str_replace([site_url(), 'uploads/catalog/users/'], ['', ''], $data->company_logo);
        return (!empty($data->company_logo) && file_exists($img)) ? site_url().$img : base_url('uploads/catalog/users/avatar-placeholder.png');
    }


    public function getPageDataByLink($link){
        $this->db->select('c.*, in.create_company');
        $this->db->from('wc_companies AS c');
        $this->db->join('wc_industry AS in', 'in.id = c.industry_id', 'left');
        $this->db->where('c.slug', $link);
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? $query->row() : false;
    }

    public function getIndustries()
    {
        $this->db->select('id, name');
        $this->db->from('wc_industry');
        $query = $this->db->get();

        return $query->result_object();
    }

    public function getUserPermissionByPage($user_id, $company_id){
        $this->db->select('rel.role_id, rel.user_id, rel.company_id, tr.name AS role_name, c.company_name, c.slug AS company_link');
        $this->db->from('wc_company_user_rel AS rel');
        $this->db->where(['rel.company_id' => $company_id, 'rel.user_id' => $user_id]);
        $this->db->join('wc_page_roles AS tr', 'tr.id = rel.role_id AND rel.delete_at IS NULL', 'inner');
        $this->db->join('wc_companies AS c', "c.id=rel.company_id",  'inner');
        $this->db->group_by("rel.id");
        $query = $this->db->get();

        return ($query->num_rows() == 1) ? $query->row() : false;
    }

    public function getAccountConfirmationData($user_id)
    {
        $this->db->select('*');
        $this->db->from('wc_confirm_profile');
        $this->db->where(['user_id' => $user_id]);
        $query = $this->db->get();
        return $query->row();
    }

    public function getUserPermission($role_id){
        $role_id=(!$role_id || $role_id==0) ? 2 : $role_id;
        $this->db->select('p.permission_id, pn.name, p.add, p.edit, p.view, p.delete, p.reply');
        $this->db->from('wc_page_role_permission AS p');
        $this->db->where('p.`role_id`', $role_id);
        $this->db->join('wc_page_permission AS pn', 'pn.id=permission_id', 'inner');
        $this->db->order_by("p.permission_id", "ASC");
        $query = $this->db->get();
        $data=$query->result_object();
        $list=[];

        foreach ($data as $k => $v){
            $list[$v->permission_id] = $v;
        }

        return $list;
    }

    public function getCompanyAvgRate($company_id){
        $this->db->select('CEIL(SUM(`rate`) / COUNT(`id`)) AS `avg_rate`');
        $this->db->where('profile_id', $company_id);
        $query3=$this->db->get('wc_ratings');
        $data3=$query3->row();


        return ($query3->num_rows()) ? $data3->avg_rate : 0;
    }

    public function getCompanyRateByUser($company_id, $user_id){
        $this->db->select('rate');
        $this->db->where('profile_id', $company_id);
        $this->db->where('user_id', $user_id);
        $query=$this->db->get('wc_ratings');

        return ($query->row()) ? $query->row()->rate : 0;
    }

    public function getProductStatus($company_id)
    {
        $this->db->select('id');
        $this->db->where('company_id', $company_id);
        $query = $this->db->get('wc_product');

        return ($query->row()) ? $query->num_rows() : 0;
    }

    public function getUserCompanyAndRoles($user_id){
        $this->db->select('
            rel.company_id, rel.role_id, rel.user_id, rel.approved,
            c.company_name, c.slug AS company_link, c.company_logo, c.company_banner, c.standart, c.website, c.company_address,
            c.tags, c.company_info, c.company_facebook, c.company_twitter, c.company_linkedin, c.company_youtube, c.checked,
            tr.name AS role_name,
            (SELECT COUNT(id) FROM wc_user_notify WHERE company_id=c.id  AND `status`=1) AS `page_notif_count`,
            (SELECT COUNT(id) FROM wc_user_notify WHERE company_id=c.id AND send_id!="'.$user_id. '" AND user_id=rel.user_id AND  `status`=1) AS `page_user_count`,
            in.create_company
         ');
        $this->db->from('wc_company_user_rel AS rel');
        $this->db->where('rel.user_id', $user_id);
        $this->db->join('wc_companies AS c', "c.id=rel.company_id AND rel.delete_at IS NULL",  'inner');
        $this->db->join('wc_industry AS in', 'in.id = c.industry_id', 'left');
        $this->db->join('wc_page_roles AS tr', 'tr.id = rel.role_id', 'left');
        $this->db->group_by("rel.id");
        $this->db->order_by("rel.created_at", "DESC");
        $query = $this->db->get();
        $object=$query->result_object();

        if (!empty($object)){

            foreach ($object as $k => $v){
                $v->company_logo=$this->checkCompanyLogo($v);
            }
        }

        return $object;

    }

    public function getBlockedUsers($user_id, $name=false){
        $this->db->select('b.id, u.fullname, u.images,  u.slug_user AS user_slug, c.company_name, c.slug AS company_slug, tr.name AS position_name');
        $this->db->from('wc_block_profile_and_company AS b');
        $this->db->where(['b.user_id' => $user_id, "b.company_id" => 0]);

        if ($name && !empty($name)){
            $this->db->like('u.fullname', $name, 'both');
        }

        $this->db->join('wc_users AS u', "u.id=b.profile_id",  'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.user_id=u.id AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_companies AS c', "c.id=rel.company_id", 'left');
        $this->db->join('wc_person_type_translation AS tr', "tr.person_type_id=rel.role_id AND tr.language_id=1", 'left');
        $this->db->group_by("u.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){
                $check_user_photo=(!empty($v->images) && file_exists("uploads/catalog/users/".$v->images)) ? $v->images : "avatar-placeholder.png";

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->fullname,
                    'user_image' => base_url( 'uploads/catalog/users/' ).$check_user_photo,
                    'user_slug' => site_url_multi('/').'users/'.$v->user_slug,
                    'company_name' => (!empty($v->company_name)) ? "( ".$v->company_name." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->position_name)) ? $v->position_name : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getBlockedCompanies($user_id, $name=false){
        $this->db->select('b.id, c.country_id, c.company_name, c.slug AS company_slug, c.company_logo, g.name AS company_status');
        $this->db->from('wc_block_profile_and_company AS b');
        $this->db->where(['b.user_id' => $user_id, "b.profile_id" => 0]);

        if ($name && !empty($name)){
            $this->db->like('c.company_name', $name, 'both');
        }

        $this->db->join('wc_companies AS c', "c.id=b.company_id", 'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.company_id=b.company_id AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_users AS u', "u.id=rel.user_id", 'left');
        $this->db->join('wc_groups AS g', "g.id=u.user_groups_id", 'left');
        $this->db->group_by("c.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->company_name,
                    'user_image' => $this->checkCompanyLogo($v),
                    'user_slug' => site_url_multi('/')."companies/".$v->company_slug,
                    'company_name' => (!empty($v->company_status)) ? "( ".$v->company_status." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->country_id)) ? get_country_name($v->country_id) : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getFollowingUsers($user_id, $name=false){
        $this->db->select('b.id, u.fullname, u.images,  u.slug_user AS user_slug, c.company_name, c.slug AS company_slug, tr.name AS position_name');
        $this->db->from('wc_user_follow AS b');
        $this->db->where(['b.follower_id' => $user_id, "b.followed_company" => 0]);

        if ($name && !empty($name)){
            $this->db->like('u.fullname', $name, 'both');
        }

        $this->db->join('wc_users AS u', "u.id=b.followed_user",  'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.user_id=u.id AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_companies AS c', "c.id=rel.company_id", 'left');
        $this->db->join('wc_person_type_translation AS tr', "tr.person_type_id=rel.role_id AND tr.language_id=1", 'left');
        $this->db->group_by("u.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){
                $check_user_photo=(!empty($v->images) && file_exists("uploads/catalog/users/".$v->images)) ? $v->images : "avatar-placeholder.png";

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->fullname,
                    'user_image' => base_url( 'uploads/catalog/users/' ).$check_user_photo,
                    'user_slug' => site_url_multi('/').'users/'.$v->user_slug,
                    'company_name' => (!empty($v->company_name)) ? "( ".$v->company_name." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->position_name)) ? $v->position_name : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getFollowingCompanies($user_id, $name=false){
        $this->db->select('b.id, c.country_id, c.company_name, c.slug AS company_slug, c.company_logo, g.name AS company_status');
        $this->db->from('wc_user_follow AS b');
        $this->db->where(['b.follower_id' => $user_id, "b.followed_user" => 0]);

        if ($name && !empty($name)){
            $this->db->like('u.fullname', $name, 'both');
        }

        $this->db->join('wc_companies AS c', "c.id=b.followed_company", 'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.company_id=b.followed_company AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_users AS u', "u.id=rel.user_id", 'left');
        $this->db->join('wc_groups AS g', "g.id=u.user_groups_id", 'left');
        $this->db->group_by("c.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){
                $check_user_photo=(!empty($v->images) && file_exists("uploads/catalog/users/".$v->images)) ? $v->images : "avatar-placeholder.png";

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->company_name,
                    'user_image' => $this->checkCompanyLogo($v),
                    'user_slug' => site_url_multi('/')."companies/".$v->company_slug,
                    'company_name' => (!empty($v->company_status)) ? "( ".$v->company_status." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->country_id)) ? get_country_name($v->country_id) : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getFollowersUsers($user_id, $name=false){
        $this->db->select('b.id, u.fullname, u.images,  u.slug_user AS user_slug, c.company_name, c.slug AS company_slug, tr.name AS position_name');
        $this->db->from('wc_user_follow AS b');
        $this->db->where(['b.followed_user' => $user_id, "b.followed_company" => 0]);

        if ($name && !empty($name)){
            $this->db->like('u.fullname', $name, 'both');
        }

        $this->db->join('wc_users AS u', "u.id=b.follower_id",  'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.user_id=u.id AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_companies AS c', "c.id=rel.company_id", 'left');
        $this->db->join('wc_person_type_translation AS tr', "tr.person_type_id=rel.role_id AND tr.language_id=1", 'left');
        $this->db->group_by("u.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){
                $check_user_photo=(!empty($v->images) && file_exists("uploads/catalog/users/".$v->images)) ? $v->images : "avatar-placeholder.png";

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->fullname,
                    'user_image' => base_url( 'uploads/catalog/users/' ).$check_user_photo,
                    'user_slug' => site_url_multi('/').'users/'.$v->user_slug,
                    'company_name' => (!empty($v->company_name)) ? "( ".$v->company_name." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->position_name)) ? $v->position_name : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getFollowersCompanies($user_id, $name=false){
        $this->db->select('b.id, c.country_id, c.company_name, c.slug AS company_slug, c.company_logo, g.name AS company_status');
        $this->db->from('wc_user_follow AS b');
        $this->db->where(['b.followed_user' => $user_id, "b.followed_company!=" => 0]);

        if ($name && !empty($name)){
            $this->db->like('c.company_name', $name, 'both');
        }

        $this->db->join('wc_companies AS c', "c.id=b.followed_company", 'inner');
        $this->db->join('wc_company_user_rel AS rel', "rel.company_id=b.followed_company AND rel.delete_at IS NULL", 'left');
        $this->db->join('wc_users AS u', "u.id=rel.user_id", 'left');
        $this->db->join('wc_groups AS g', "g.id=u.user_groups_id", 'left');
        $this->db->group_by("c.id");
        $this->db->order_by("b.create_at", "DESC");
        $query = $this->db->get();
        $data=$query->result_object();

        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->company_name,
                    'user_image' => $this->checkCompanyLogo($v),
                    'user_slug' => site_url_multi('/')."companies/".$v->company_slug,
                    'company_name' => (!empty($v->company_status)) ? "( ".$v->company_status." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->country_id)) ? get_country_name($v->country_id) : "&nbsp;"
                ];
            }
        }

        return $list;

    }

    public function getUserPositions(){
        $this->db->select('person_type_id AS id, name' );
        $this->db->from( 'wc_person_type_translation' )->where(['language_id' => 1 ]);
        $query            = $this->db->get();
        return $query->result_array();
    }

    public function getUserGroups()
    {
        $this->db->select('id, name');
        $this->db->from('wc_groups');
        $this->db->where('type', 1);
        $query            = $this->db->get();
        return $query->result_array();
    }

    public function searchEmployee($name, $company_id){
        $this->db->select('u.id, u.fullname, u.images,  u.slug_user AS user_slug, u.country_id, c.company_name, c.slug AS company_slug, tr.name AS position_name');
        $this->db->from('wc_users AS u');
        $this->db->join('wc_company_user_rel AS rel', "rel.user_id=u.id AND rel.delete_at IS NULL", 'left');
        $this->db->where("u.id NOT IN(select user_id from wc_company_user_rel WHERE company_id='".$company_id."') ");
        //$this->db->where(["rel.company_id!=" => $company_id]);

        if ($name && !empty($name)){
            $this->db->like('u.fullname', $name, 'both');
        }

        $this->db->join('wc_companies AS c', "c.id=rel.company_id", 'left');
        $this->db->join('wc_person_type_translation AS tr', "tr.person_type_id=rel.role_id AND tr.language_id=1", 'left');
        $this->db->group_by("u.id");
        $this->db->order_by("u.fullname", "ASC");
        $query = $this->db->get();
        $data=$query->result_object();


        $list=[];

        if (!empty($data)){
            foreach ($data as $k => $v){
                $check_user_photo=(!empty($v->images) && file_exists("uploads/catalog/users/".$v->images)) ? $v->images : "avatar-placeholder.png";

                $list[]=(object)[
                    'id' => $v->id,
                    'fullname' => $v->fullname,
                    'user_image' => base_url( 'uploads/catalog/users/' ).$check_user_photo,
                    'user_slug' => site_url_multi('/').'users/'.$v->user_slug,
                    'country_name' => get_country_name($v->country_id)
                    /*'company_name' => (!empty($v->company_name)) ? "( ".$v->company_name." )" : "&nbsp;",
                    'company_slug' => !empty($v->company_name) ? site_url_multi('/')."companies/".$v->company_slug : "javascript:",
                    'position_name' => (!empty($v->position_name)) ? $v->position_name : "&nbsp;"*/
                ];
            }
        }

        return $list;

    }

    /**
     * public function prep_before_write($data)
     * Before writing database this function checks if field in given parameter is fillable or not. At final it returns new data
     * @param array or object $data
     * @return array
     */
    public function prep_before_write($data)
    {
        // Let's make sure we receive an array...
        $data_as_array = (is_object($data)) ? (array)$data : $data;

        $new_data = [];
        $multi = $this->is_multidimensional($data);
        if ($multi === false) {
            foreach ($data_as_array as $field => $value) {
                if($field!='id'){
                    if (in_array($field, $this->fillable)) {
                        $new_data[$field] = $value;
                    } else {
                        show_error('MY_Model: Unknown column ('.$field.') in table: ('.$this->table.').'.var_dump($this->fillable));
                    }
                }
            }
        } else {

            foreach ($data_as_array as $key => $row) {
                foreach ($row as $field => $value) {
                    if (in_array($field, $this->fillable)) {
                        $new_data[$key][$field] = $value;
                    } else {
                        show_error('MY_Model: Unknown column '.$field.' in table: '.$this->table);
                    }
                }
            }
        }
        return $new_data;
    }

    /**
     * public function prep_after_write()
     * this function simply deletes the cache related to the model's table if $this->delete_cache_on_save is set to true
     * It should be called by any "save" method
     * @return $this
     */
    public function prep_after_write()
    {
        if ($this->delete_cache_on_save === true) {
            $this->delete_cache('*');
        }
        return true;
    }

    public function prep_before_read()
    {
    }

    /**
     * public function prep_after_read($data, $multi = true)
     *
     * @param array $data
     * @param boolean $multi
     * @return object
     */
    public function prep_after_read($data, $multi = true)
    {
        // let's join the subqueries...
        $data = $this->join_temporary_results($data);
        $this->database->reset_query();
        $this->requested = [];
        if (isset($this->return_as_dropdown) && $this->return_as_dropdown == 'dropdown') {
            foreach ($data as $row) {
                $dropdown[$row[$this->primary_key]] = $row[$this->_dropdown_field];
            }
            $data = $dropdown;
            $this->return_as_dropdown = null;
        } elseif ($this->return_as == 'object') {
            $data = $this->array_to_object($data);
        }
        if (isset($this->select)) {
            $this->select = '*';
        }
        return $data;
    }

    /**
    * public function is_multidimensional($array)
    * Verifies if an array is multidimensional or not;
    * @param array $array
    * @return bool return true if the array is a multidimensional one
    */
    public function is_multidimensional($array)
    {
        if (is_array($array)) {
            foreach ($array as $element) {
                if (is_array($element)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * public function object_to_array($object)
     * Converts object to array
     * @param object $object
     * @return array
     */
    public function object_to_array($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }
        if (is_object($object)) {
            $object = get_object_vars($object);
        }
        return array_map(array($this, 'object_to_array'), $object);
    }

    /**
     * public function array_to_object($array)
     * @param array $array
     * @return runs _array_to_object($array, $obj) function which do convert operation
     */
    public function array_to_object($array)
    {
        $obj = new stdClass();
        return $this->_array_to_object($array, $obj);
    }

    /**
     * public function _array_to_object($array, &$obj)
     * Converts array to object
     * @param array $array
     * @param object $obj
     * @return object
     */
    private function _array_to_object($array, &$obj)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $obj->$key = new stdClass();
                $this->_array_to_object($value, $obj->$key);
            } else {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    /**
     * Verifies if an array is associative or not
     * @param array $array
     * @return bool
     */
    protected function is_assoc(array $array)
    {
        return (bool)count(array_filter(array_keys($array), 'is_string'));
    }


    /**
    * public function insert($data)
    * Inserts data into table. Can receive an array or a multidimensional array depending on what kind of insert we're talking about.
    * @param $data
    * @return int/array Returns id/ids of inserted rows
    */
    public function insert($data = null, $table_name = null)
    {
        //insert data into table
        if ($table_name) {
            $this->database->insert($table_name, $data);
            return true;
        }

        if (!isset($data) && $this->validated != false) {
            $data = $this->validated;
            $this->validated = false;
        } elseif (!isset($data)) {
            return false;
        }

        $data = $this->prep_before_write($data);

        //now let's see if the array is a multidimensional one (multiple rows insert)
        $multi = $this->is_multidimensional($data);

        // if the array is not a multidimensional one...
        if ($multi === false) {
            if ($this->timestamps !== false) {
                $data[$this->created_at_field] = $this->the_timestamp();
            }

            if ($this->authors !== false) {
                $data[$this->created_by_field] = $this->the_author();
            }


            $data = $this->trigger('before_create', $data);
            if ($this->database->insert($this->table, $data)) {
                $this->prep_after_write();
                $id = $this->database->insert_id();
                $return = $this->trigger('after_create', $id);
                return $return;
            }
            return false;
        } else {
            $return = [];
            foreach ($data as $row) {
                if ($this->timestamps !== false) {
                    $row[$this->created_at_field] = $this->the_timestamp();
                }

                if ($this->authors !== false) {
                    $row[$this->created_by_field] = $this->the_author();
                }

                $row = $this->trigger('before_create', $row);
                if ($this->database->insert($this->table, $row)) {
                    $return[] = $this->database->insert_id();
                }
            }
            $this->prep_after_write();
            $after_create = [];
            foreach ($return as $id) {
                $after_create[] = $this->trigger('after_create', $id);
            }
            return $after_create;
        }
        return false;
    }

    /**
    * private function the_timestamp()
    *
    * returns a value representing the date/time depending on the timestamp format choosed
    * @return string
    */
    private function the_timestamp()
    {
        if ($this->timestamps_format == 'timestamp') {
            return time();
        } else {
            return date($this->timestamps_format);
        }
    }

    /**
    * private function the_author()
    *
    * returns a value representing the date/time depending on the timestamp format choosed
    * @return string
    */
    private function the_author()
    {
        $CI =& get_instance();
        $us_id = $CI->session->userdata('id_a');
        $us_id = (!is_null($us_id))? $us_id : $CI->session->userdata('id');
        return $us_id;
    }

    /**
    * public function update($data)
    * Updates data into table. Can receive an array or a multidimensional array depending on what kind of update we're talking about.
    * @param array $data
    * @param array|int $column_name_where
    * @param bool $escape should the values be escaped or not - defaults to true
    * @return str/array Returns id/ids of inserted rows
    */
    public function update($data = null, $column_name_where = null, $escape = true)
    {
        if (!isset($data) && $this->validated != false) {
            $data = $this->validated;
            $this->validated = false;
        } elseif (!isset($data)) {
            $this->database->reset_query();
            return false;
        }


        $data = $this->prep_before_write($data);

        //now let's see if the array is a multidimensional one (multiple rows insert)
        $multi = $this->is_multidimensional($data);

        // if the array is not a multidimensional one...
        if ($multi === false) {
            if ($this->timestamps !== false) {
                $data[$this->updated_at_field] = $this->the_timestamp();
            }

            if ($this->authors !== false) {
                $data[$this->updated_by_field] = $this->the_author();
            }

            $data = $this->trigger('before_update', $data);

            if ($this->validated === false && count($this->row_fields_to_update)) {
                $this->where($this->row_fields_to_update);
                $this->row_fields_to_update = [];
            }

            if (isset($column_name_where)) {
                if (is_array($column_name_where)) {
                    $this->where($column_name_where);
                } elseif (is_numeric($column_name_where)) {
                    $this->database->where($this->primary_key, $column_name_where);
                } else {
                    $column_value = (is_object($data)) ? $data->{$column_name_where} : $data[$column_name_where];
                    $this->database->where($column_name_where, $column_value);
                }
            }

            if ($escape) {
                if ($this->database->update($this->table, $data)) {
                    $this->prep_after_write();
                    $affected = $this->database->affected_rows();
                    $return = $this->trigger('after_update', $affected);
                    return $return;
                }
            } else {
                if ($this->database->set($data, null, false)->update($this->table)) {
                    $this->prep_after_write();
                    $affected = $this->database->affected_rows();
                    $return = $this->trigger('after_update', $affected);
                    return $return;
                }
            }
            return false;
        } else {
            $rows = 0;
            foreach ($data as $row) {
                if ($this->timestamps !== false) {
                    $row[$this->updated_at_field] = $this->the_timestamp();
                }

                if ($this->authors !== false) {
                    $row[$this->updated_by_field] = $this->the_author();
                }
                $row = $this->trigger('before_update', $row);
                if (is_array($column_name_where)) {
                    $this->database->where($column_name_where[0], $column_name_where[1]);
                } else {
                    $column_value = (is_object($row)) ? $row->{$column_name_where} : $row[$column_name_where];
                    $this->database->where($column_name_where, $column_value);
                }
                if ($escape) {
                    if ($this->database->update($this->table, $row)) {
                        $rows++;
                    }
                } else {
                    if ($this->database->set($row, null, false)->update($this->table)) {
                        $rows++;
                    }
                }
            }
            $affected = $rows;
            $this->prep_after_write();
            $return = $this->trigger('after_update', $affected);
            return $return;
        }
        return false;
    }

    /**
    * public function where($field_or_array = null, $operator_or_value = null, $value = null, $with_or = false, $with_not = false, $custom_string = false)
    * Sets a where method for the $this object
    * @param null $field_or_array - can receive a field name or an array with more wheres...
    * @param null $operator_or_value - can receive a database operator or, if it has a field, the value to equal with
    * @param null $value - a value if it received a field name and an operator
    * @param bool $with_or - if set to true will create a or_where query type pr a or_like query type, depending on the operator
    * @param bool $with_not - if set to true will also add "NOT" in the where
    * @param bool $custom_string - if set to true, will simply assume that $field_or_array is actually a string and pass it to the where query
    * @return $this
    */
    public function where($field_or_array = null, $operator_or_value = null, $value = null, $with_or = false, $with_not = false, $custom_string = false)
    {
        if (is_array($field_or_array)) {
            $multi = $this->is_multidimensional($field_or_array);
            if ($multi === true) {
                foreach ($field_or_array as $where) {
                    $field = $where[0];
                    $operator_or_value = isset($where[1]) ? $where[1] : null;
                    $value = isset($where[2]) ? $where[2] : null;
                    $with_or = (isset($where[3])) ? true : false;
                    $with_not = (isset($where[4])) ? true : false;
                    $this->where($field, $operator_or_value, $value, $with_or, $with_not);
                }
                return $this;
            }
        }

        if ($with_or === true) {
            $where_or = 'or_where';
        } else {
            $where_or = 'where';
        }

        if ($with_not === true) {
            $not = '_not';
        } else {
            $not = '';
        }

        if ($custom_string === true) {
            $this->database->{$where_or}($field_or_array, null, false);
        } elseif (is_numeric($field_or_array)) {
            $this->database->{$where_or}(array($this->table.'.'.$this->primary_key => $field_or_array));
        } elseif (is_array($field_or_array) && !isset($operator_or_value)) {
            $this->database->where($field_or_array);
        } elseif (!isset($value) && isset($field_or_array) && isset($operator_or_value) && !is_array($operator_or_value)) {
            $this->database->{$where_or}(array($this->table.'.'.$field_or_array => $operator_or_value));
        } elseif (!isset($value) && isset($field_or_array) && isset($operator_or_value) && is_array($operator_or_value) && !is_array($field_or_array)) {
            $this->database->{$where_or.$not.'_in'}($this->table.'.'.$field_or_array, $operator_or_value);
        } elseif (isset($field_or_array) && isset($operator_or_value) && isset($value)) {
            if (strtolower($operator_or_value) == 'like') {
                if ($with_not === true) {
                    $like = 'not_like';
                } else {
                    $like = 'like';
                }

                if ($with_or === true) {
                    $like = 'or_'.$like;
                }

                $this->database->{$like}($field_or_array, $value);
            } else {
                $this->database->{$where_or}($field_or_array.' '.$operator_or_value, $value);
            }
        }
        return $this;
    }

    /**
    * public function limit($limit, $offset = 0)
    * Sets a rows limit to the query
    * @param $limit
    * @param int $offset
    * @return $this
    */
    public function limit($limit, $offset = 0)
    {
        $this->database->limit($limit, $offset);
        return $this;
    }
    
    /**
     * public function group_by($grouping_by)
     * A wrapper to $this->database->group_by()
     * @param $grouping_by
     * @return $this
     */
    public function group_by($grouping_by)
    {
        $this->database->group_by($grouping_by);
        return $this;
    }

    /**
     * public function delete($where)
     * Deletes data from table.
     * @param $where primary_key(s) Can receive the primary key value or a list of primary keys as array()
     * @return Returns affected rows or false on failure
     */
    public function delete($where = null)
    {
        if (!empty($this->before_delete) || !empty($this->before_soft_delete) || !empty($this->after_delete) || !empty($this->after_soft_delete) || ($this->soft_deletes === true)) {
            $to_update = [];
            if (isset($where)) {
                $this->where($where);
            }

            $query = $this->database->get($this->table);
            foreach ($query->result() as $row) {
                $to_update[] = [$this->primary_key => $row->{$this->primary_key}];
            }

            if (!empty($this->before_soft_delete)) {
                foreach ($to_update as &$row) {
                    $row = $this->trigger('before_soft_delete', $row);
                }
            }

            if (!empty($this->before_delete)) {
                foreach ($to_update as &$row) {
                    $row = $this->trigger('before_delete', $row);
                }
            }
        }

        if (isset($where)) {
            $this->where($where);
        }

        $affected_rows = 0;

        if ($this->soft_deletes === true) {
            if (isset($to_update)&& count($to_update) > 0) {
                foreach ($to_update as &$row) {
                    $row[$this->deleted_at_field] = $this->the_timestamp();
                    $row[$this->deleted_by_field] = $this->the_author();
                }
                $affected_rows = $this->database->update_batch($this->table, $to_update, $this->primary_key);
                $to_update['affected_rows'] = $affected_rows;
                $this->prep_after_write();
                $this->trigger('after_soft_delete', $to_update);
            }
            return $affected_rows;
        } else {
            if ($this->database->delete($this->table)) {
                $affected_rows = $this->database->affected_rows();
                if (!empty($this->after_delete)) {
                    $to_update['affected_rows'] = $affected_rows;
                    $to_update = $this->trigger('after_delete', $to_update);
                    $affected_rows = $to_update;
                }
                $this->prep_after_write();
                return $affected_rows;
            }
        }
        return false;
    }

    /**
    * public function force_delete($where = null)
    * Forces the delete of a row if soft_deletes is enabled
    * @param null $where
    * @return bool
    */
    public function force_delete($where = null)
    {
        if (isset($where)) {
            $this->where($where);
        }
        if ($this->database->delete($this->table)) {
            $this->prep_after_write();
            return $this->database->affected_rows();
        }
        return true;
    }
    
    /**
    * public function restore($where = null)
    * "Un-deletes" a row
    * @param null $where
    * @return bool
    */
    public function restore($where = null)
    {
        $this->with_trashed();
        if (isset($where)) {
            $this->where($where);
        }
        
        if ($affected_rows = $this->database->update($this->table, [$this->deleted_at_field => null, $this->deleted_by_field => 0])) {
            $this->prep_after_write();
            return $affected_rows;
        }
        return false;
    }

    /**
     * public function with_trashed()
     * Sets $_trashed to with
     */
    public function with_trashed()
    {
        $this->trashed = 'with';
        return $this;
    }

    /**
     * public function trashed($where = null)
     * Verifies if a record (row) is soft_deleted or not
     * @param null $where
     * @return bool
     */
    public function trashed($where = null)
    {
        $this->only_trashed();
        if (isset($where)) {
            $this->where($where);
        }
        $this->limit(1);
        $query = $this->database->get($this->table);
        if ($query->num_rows() == 1) {
            return true;
        }
        return false;
    }
    
    /**
     * public function with_trashed()
     * Sets $_trashed to only
     */
    public function only_trashed()
    {
        $this->trashed = 'only';
        return $this;
    }

    /**
     * public function get_joined($requested)
     * Joins requested table to the query
     * @param array $requested
     */
    public function get_joined($requested)
    {
        $this->database->join($this->relationships[$requested['request']]['foreign_table'], $this->table.'.'.$this->relationships[$requested['request']]['local_key'].' = '.$this->relationships[$requested['request']]['foreign_table'].'.'.$this->relationships[$requested['request']]['foreign_key']);
        $the_select = '';
        if (!empty($requested['parameters'])) {
            if (array_key_exists('fields', $requested['parameters'])) {
                $fields = explode(',', $requested['parameters']['fields']);
                $sub_select = [];
                foreach ($fields as $field) {
                    $sub_select[] = ((strpos($field, '.') === false) ? '`' . $this->relationships[$requested['request']]['foreign_table'] . '`.`' . trim($field) . '`' : trim($field)).' AS '.$requested['request'].'_'.trim($field);
                }
                $the_select = implode(',', $sub_select);
            } else {
                $the_select = $this->relationships[$requested['request']]['foreign_table'] . '.*';
            }
        }
        $this->database->select($the_select);
        unset($this->requested[$requested['request']]);
    }

    /**
    * protected function join_temporary_results($data)
    * Joins the subquery results to the main $data
    * @param $data
    * @return mixed
    */
    protected function join_temporary_results($data)
    {
        foreach ($this->requested as $requested_key => $request) {
            $order_by = [];
            $order_inside_array = [];
            $pivot_table = null;
            $relation = $this->relationships[$request['request']];
            $this->load->model($relation['foreign_model'], $relation['foreign_model_name']);
            $foreign_key = $relation['foreign_key'];
            $local_key = $relation['local_key'];
            $foreign_table = $relation['foreign_table'];
            $type = $relation['relation'];
            $relation_key = $relation['relation_key'];
            
            if ($type == 'has_many_pivot') {
                $pivot_table = $relation['pivot_table'];
                $pivot_local_key = $relation['pivot_local_key'];
                $pivot_foreign_key = $relation['pivot_foreign_key'];
                $get_relate = $relation['get_relate'];
            }

            if (array_key_exists('order_inside', $request['parameters'])) {
                //$order_inside = $request['parameters']['order_inside'];
                $elements = explode(',', $request['parameters']['order_inside']);
                foreach ($elements as $element) {
                    $order = explode(' ', $element);
                    if (sizeof($order)==2) {
                        $order_inside_array[] = array(trim($order[0]), trim($order[1]));
                    } else {
                        $order_inside_array[] = array(trim($order[0]), 'desc');
                    }
                }
            }


            $local_key_values = [];
            foreach ($data as $key => $element) {
                if (isset($element[$local_key]) and !empty($element[$local_key])) {
                    $id = $element[$local_key];
                    $local_key_values[$key] = $id;
                }
            }
            if (!$local_key_values) {
                $data[$key][$relation_key] = null;
                continue;
            }
            if (!isset($pivot_table)) {
                $sub_results = $this->{$relation['foreign_model_name']};
                $select = [];
                $select[] = '`'.$foreign_table.'`.`'.$foreign_key.'`';
                if (!empty($request['parameters'])) {
                    if (array_key_exists('fields', $request['parameters'])) {
                        if ($request['parameters']['fields'] == '*count*') {
                            $the_select = '*count*';
                            $sub_results = (isset($the_select)) ? $sub_results->fields($the_select) : $sub_results;
                            $sub_results = $sub_results->fields($foreign_key);
                        } else {
                            $fields = explode(',', $request['parameters']['fields']);
                            foreach ($fields as $field) {
                                $select[] = (strpos($field, '.') === false) ? '`' . $foreign_table . '`.`' . trim($field) . '`' : trim($field);
                            }
                            $the_select = implode(',', $select);
                            $sub_results = (isset($the_select)) ? $sub_results->fields($the_select) : $sub_results;
                        }
                    }
                    if (array_key_exists('fields', $request['parameters']) && ($request['parameters']['fields']=='*count*')) {
                        $sub_results->group_by('`' . $foreign_table . '`.`' . $foreign_key . '`');
                    }
                    
                    if (array_key_exists('where', $request['parameters']) || array_key_exists('non_exclusive_where', $request['parameters'])) {
                        $the_where = array_key_exists('where', $request['parameters']) ? 'where' : 'non_exclusive_where';
                    }
                    
                    $sub_results = isset($the_where) ? $sub_results->where($request['parameters'][$the_where], null, null, false, false, true) : $sub_results;

                    if (isset($order_inside_array)) {
                        foreach ($order_inside_array as $order_by_inside) {
                            $sub_results = $sub_results->order_by($order_by_inside[0], $order_by_inside[1]);
                        }
                    }

                    //Add nested relation
                    if (array_key_exists('with', $request['parameters'])) {
                        // Do we have many nested relation
                        if (is_array($request['parameters']['with']) && isset($request['parameters']['with'][0])&& is_array($request['parameters']['with'][0])) {
                            foreach ($request['parameters']['with'] as $with) {
                                $with_relation = array_shift($with);
                                $sub_results->with($with_relation, array($with));
                            }
                        } else {
                            $with_relation = array_shift($request['parameters']['with']);
                            $sub_results->with($with_relation, array($request['parameters']['with']));
                        }
                    }
                }

                $sub_results = $sub_results->where($foreign_key, $local_key_values)->all();
            } else {
                $this->database->join($pivot_table, $foreign_table.'.'.$foreign_key.' = '.$pivot_table.'.'.$pivot_foreign_key, 'left');
                $this->database->join($this->table, $pivot_table.'.'.$pivot_local_key.' = '.$this->table.'.'.$local_key, 'left');
                $this->database->select($foreign_table.'.'.$foreign_key);
                $this->database->select($pivot_table.'.'.$pivot_local_key);
                if (!empty($request['parameters'])) {
                    if (array_key_exists('fields', $request['parameters'])) {
                        if ($request['parameters']['fields'] == '*count*') {
                            $this->database->select('COUNT(`'.$foreign_table.'`.`'.$foreign_key.'`) as counted_rows, `' . $foreign_table . '`.`' . $foreign_key . '`', false);
                        } else {
                            $fields = explode(',', $request['parameters']['fields']);
                            $select = array();
                            foreach ($fields as $field) {
                                $select[] = (strpos($field, '.') === false) ? '`' . $foreign_table . '`.`' . trim($field) . '`' : trim($field);
                            }
                            $the_select = implode(',', $select);
                            $this->database->select($the_select);
                        }
                    }

                    if (array_key_exists('where', $request['parameters']) || array_key_exists('non_exclusive_where', $request['parameters'])) {
                        $the_where = array_key_exists('where', $request['parameters']) ? 'where' : 'non_exclusive_where';

                        $this->database->where($request['parameters'][$the_where], null, null, false, false, true);
                    }
                }
                
                $this->database->where_in($pivot_table.'.'.$pivot_local_key, $local_key_values);

                if (!empty($order_inside_array)) {
                    $order_inside_str = '';
                    foreach ($order_inside_array as $order_by_inside) {
                        $order_inside_str .= (strpos($order_by_inside[0], '.')=== false) ? '`'.$foreign_table.'`.`'.$order_by_inside[0].' '.$order_by_inside[1] : $order_by_inside[0].' '.$order_by_inside[1];
                        $order_inside_str .= ',';
                    }
                    $order_inside_str = rtrim($order_inside_str, ",");
                    $this->database->order_by($order_inside_str);
                }
                $sub_results = $this->database->get($foreign_table)->result_array();
                $this->database->reset_query();
            }

            if (isset($sub_results) && !empty($sub_results)) {
                $subs = [];
                foreach ($sub_results as $result) {
                    $result_array = (array)$result;
                    $the_foreign_key = $result_array[$foreign_key];
                    if (isset($pivot_table)) {
                        $the_local_key = $result_array[$pivot_local_key];
                        if (isset($get_relate) and $get_relate === true) {
                            $subs[$the_local_key][$the_foreign_key] = $this->{$relation['foreign_model']}->where($foreign_key, $result[$foreign_key])->get();
                        } else {
                            $subs[$the_local_key][$the_foreign_key] = $result;
                        }
                    } else {
                        if ($type == 'has_one') {
                            $subs[$the_foreign_key] = $result;
                        } else {
                            $subs[$the_foreign_key][] = $result;
                        }
                    }
                }
                $sub_results = $subs;

                foreach ($local_key_values as $key => $value) {
                    if (array_key_exists($value, $sub_results)) {
                        $data[$key][$relation_key] = $sub_results[$value];
                    } else {
                        if (array_key_exists('where', $request['parameters'])) {
                            unset($data[$key]);
                        }
                    }
                }
            } else {
                $data[$key][$relation_key] = null;
            }
            if (array_key_exists('order_by', $request['parameters'])) {
                $elements = explode(',', $request['parameters']['order_by']);
                if (sizeof($elements) == 2) {
                    $order_by[$relation_key] = array(trim($elements[0]), trim($elements[1]));
                } else {
                    $order_by[$relation_key] = array(trim($elements[0]), 'desc');
                }
            }
            unset($this->requested[$requested_key]);
        }
        if (!empty($order_by)) {
            foreach ($order_by as $field => $row) {
                list($key, $value) = $row;
                $data = $this->_build_sorter($data, $field, $key, $value);
            }
        }
        return $data;
    }

    public function get_count_rows($ch_del=false)
    {
        if(!$ch_del)
        {
            if( $this->deleted_at )
                {
                    $this->db->where("deleted_at", NULL);
                }
            else
                {
                    $this->db->where("deleted_at !=", NULL);
                }
            }
        
        $row = $this->db->get($this->table);
        return $row->num_rows();
    }


    /**
    * public function get()
    * Retrieves one row from table.
    * @param null $where
    * @return mixed
    */
    public function one($where = null)
    {
        $data = $this->get_from_cache();

        if (isset($data) && $data !== false) {
            $this->database->reset_query();
            if (isset($this->cache)) {
                unset($this->cache);
            }
            return $data;
        } else {
            $this->trigger('before_get');
            if ($this->select) {
                $this->database->select($this->select);
            }

            if (!empty($this->requested)) {
                foreach ($this->requested as $requested) {
                    if (isset($requested['parameters']['join'])) {
                        $this->get_joined($requested);
                    } else {
                        $this->database->select($this->table.'.'.$this->relationships[$requested['request']]['local_key']);
                    }
                }
            }

            if (isset($where)) {
                $this->where($where);
            }

            if ($this->soft_deletes === true) {
                $this->where_trashed();
            }

            $this->limit(1);

            $query = $this->database->get($this->table);

            $this->reset_trashed();

            if ($query->num_rows() == 1) {
                $row = $query->row_array();
                $row = $this->trigger('after_get', $row);
                $row =  $this->prep_after_read([$row], true);
                $row = is_array($row) ? $row[0] : $row->{0};
                $this->write_to_cache($row);
                return $row;
            } else {
                return false;
            }
        }
    }

    /**
     * protected function get_from_cache($cache_name = null)
     * Gets data from cahce with cache_driver if there cache_name is set.
     * @param string $cache_name
     * @return array
     */
    protected function get_from_cache($cache_name = null)
    {
        if (isset($cache_name) || (isset($this->cache) && !empty($this->cache))) {
            $this->load->driver('cache');
            $cache_name = isset($cache_name) ? $cache_name : $this->cache['cache_name'];
            $data = $this->cache->{$this->cache_driver}->get($cache_name);
            return $data;
        }
    }
    
    /**
     * private function where_trashed()
     * Switches trashed cases and sets proper results to query (where)
     * @return $this
     */
    private function where_trashed()
    {
        switch ($this->trashed) {
            case 'only':
                $this->database->where($this->table.'.'.$this->deleted_at_field.' IS NOT NULL', null, false);
                break;
            case 'without':
                $this->database->where($this->table.'.'.$this->deleted_at_field.' IS NULL', null, false);
                break;
            case 'with':
                break;
        }
        return $this;
    }

    /**
     * private function reset_trashed()
     * Sets $trashed to default 'without'
     * @return $this;
     */
    private function reset_trashed()
    {
        $this->trashed = 'without';
        return $this;
    }

    /**
     * protected function write_to_cache($data, $cache_name = null)
     * Saves to cache
     * @param mixed $data
     * @param string $cache_name (null as default)
     * @return boolean
     */
    protected function write_to_cache($data, $cache_name = null)
    {
        if (isset($cache_name) || (isset($this->cache) && !empty($this->cache))) {
            $this->load->driver('cache');
            $cache_name = isset($cache_name) ? $cache_name : $this->cache['cache_name'];
            $seconds = $this->cache['seconds'];
            if (isset($cache_name) && isset($seconds)) {
                $this->cache->{$this->cache_driver}->save($cache_name, $data, $seconds);
                $this->reset_cache($cache_name);
                return true;
            }
            return false;
        }
    }
    
    /**
     * private function reset_cache($string)
     * Resets cache
     * @param string $string
     * @return this
     */
    private function reset_cache($string)
    {
        if (isset($string)) {
            $this->cache = [];
        }
        return $this;
    }

    /**
    * public function all()
    * Retrieves rows from table.
    * @param null $where
    * @return mixed
    */
    public function all($where = null)
    {
        $data = $this->get_from_cache();

        if (isset($data) && $data !== false) {
            $this->database->reset_query();
            if (isset($this->cache)) {
                unset($this->cache);
            }
            return $data;
        } else {
            $this->trigger('before_get');
            if (isset($where)) {
                $this->where($where);
            }

            if ($this->soft_deletes === true) {
                $this->where_trashed();
            }

            if (isset($this->select)) {
                $this->database->select($this->select);
            }

            if (!empty($this->requested)) {
                foreach ($this->requested as $requested) {
                    if (isset($requested['parameters']['join'])) {
                        $this->get_joined($requested);
                    } else {
                        $this->database->select($this->table.'.'.$this->relationships[$requested['request']]['local_key']);
                    }
                }
            }
            $query = $this->database->get($this->table);
            $this->reset_trashed();

            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                $data = $this->trigger('after_get', $data);
                $data = $this->prep_after_read($data, true);
                $this->write_to_cache($data);
                return $data;
            }
            return false;
        }
    }


      /**
    * public function all()
    * Retrieves rows from table.
    * @param null $where
    * @return mixed
    */
    public function all_front($where = null)
    {

        if( $this->deleted_at )
        {
            $this->db->where("deleted_at", NULL);
        }
        else
        {
            $this->db->where("deleted_at !=", NULL);
        }

        $rows = $this->db->get($this->table);
        
        if($rows->num_rows() > 0)
        {
            if($this->as_array)
            {
                return $rows->result_array();
            }
            return $rows->result();
        }
        return false;
    
    }


    /**
     * public function count_rows()
     * Retrieves number of rows from table.
     * @param null $where
     * @return integer
     */
    public function count_rows($where = null)
    {
        if (isset($where)) {
            $this->where($where);
        }

        if ($this->soft_deletes === true) {
            $this->where_trashed();
        }

        $this->database->from($this->table);
        $number_rows = $this->database->count_all_results();
        $this->reset_trashed();
        return $number_rows;
    }

    /**
     * public function with($requests)
     * allows the user to retrieve records from other interconnected tables depending on the relations defined before the constructor
     * @param string $request
     * @param array $arguments
     * @return $this
     */
    public function with($request, $arguments = [])
    {
        $this->set_relationships();
        if (array_key_exists($request, $this->relationships)) {
            $this->requested[$request] = ['request' => $request];
            $parameters = [];

            if (isset($arguments)) {
                foreach ($arguments as $argument) {
                    if (is_array($argument)) {
                        foreach ($argument as $k => $v) {
                            $parameters[$k] = $v;
                        }
                    } else {
                        $requested_operations = explode('|', $argument);
                        foreach ($requested_operations as $operation) {
                            $elements = explode(':', $operation, 2);
                            if (sizeof($elements) == 2) {
                                $parameters[$elements[0]] = $elements[1];
                            } else {
                                show_error('MY_Model: Parameters for with_*() method must be of the form: "...->with_*(\'where:...|fields:...\')"');
                            }
                        }
                    }
                }
            }
            $this->requested[$request]['parameters'] = $parameters;
        }
        return $this;
    }

    /**
    * private function set_relationships()
    *
    * Called by the public method with() it will set the relationships between the current model and other models
    */
    private function set_relationships()
    {
        if (empty($this->relationships)) {
            $options = ['has_one', 'has_many', 'has_many_pivot'];
            foreach ($options as $option) {
                if (isset($this->{$option}) && !empty($this->{$option})) {
                    foreach ($this->{$option} as $key => $relation) {
                        $single_query = false;
                        if (!is_array($relation)) {
                            $foreign_model = $relation;
                            $model = $this->parse_model_dir($foreign_model);
                            $foreign_model = $model['foreign_model'];
                            $foreign_model_name = $model['foreign_model_name'];

                            $this->load->model($foreign_model, $foreign_model_name);
                            $foreign_table = $this->{$foreign_model_name}->table;
                            $foreign_key = $this->{$foreign_model_name}->primary_key;
                            $local_key = $this->primary_key;
                            $pivot_local_key = $this->table.'_'.$local_key;
                            $pivot_foreign_key = $foreign_table.'_'.$foreign_key;
                            $get_relate = false;
                        } else {
                            if ($this->is_assoc($relation)) {
                                $foreign_model = $relation['foreign_model'];
                                $model = $this->parse_model_dir($foreign_model);
                                $foreign_model = $model['model_dir'].$model['foreign_model'];
                                $foreign_model_name = $model['foreign_model_name'];

                                if (array_key_exists('foreign_table', $relation)) {
                                    $foreign_table = $relation['foreign_table'];
                                } else {
                                    $this->load->model($foreign_model, $foreign_model_name);
                                    $foreign_table = $this->{$foreign_model_name}->table;
                                }

                                $foreign_key = $relation['foreign_key'];
                                $local_key = $relation['local_key'];
                                if ($option == 'has_many_pivot') {
                                    $pivot_table = $relation['pivot_table'];
                                    $pivot_local_key = (array_key_exists('pivot_local_key', $relation)) ? $relation['pivot_local_key'] : $this->table.'_'.$this->primary_key;
                                    $pivot_foreign_key = (array_key_exists('pivot_foreign_key', $relation)) ? $relation['pivot_foreign_key'] : $foreign_table.'_'.$foreign_key;
                                    $get_relate = (array_key_exists('get_relate', $relation) && ($relation['get_relate'] === true)) ? true : false;
                                }
                                if ($option=='has_one' && isset($relation['join']) && $relation['join'] === true) {
                                    $single_query = true;
                                }
                            } else {
                                $foreign_model = $relation[0];
                                $model = $this->parse_model_dir($foreign_model);
                                $foreign_model = $model['model_dir'].$model['foreign_model'];
                                $foreign_model_name = $model['foreign_model_name'];
                                $this->load->model($foreign_model);
                                $foreign_table = $this->{$foreign_model}->table;
                                $foreign_key = $relation[1];
                                $local_key = $relation[2];
                                if ($option=='has_many_pivot') {
                                    $pivot_local_key = $this->table.'_'.$this->primary_key;
                                    $pivot_foreign_key = $foreign_table.'_'.$foreign_key;
                                    $get_relate = (isset($relation[3]) && ($relation[3] === true)) ? true : false;
                                }
                            }
                        }

                        if ($option=='has_many_pivot' && !isset($pivot_table)) {
                            $tables = [$this->table, $foreign_table];
                            sort($tables);
                            $pivot_table = $tables[0].'_'.$tables[1];
                        }

                        $this->relationships[$key] = [
                            'relation'              => $option,
                            'relation_key'          => $key,
                            'foreign_model'         => strtolower($foreign_model),
                            'foreign_model_name'    => strtolower($foreign_model_name),
                            'foreign_table'         => $foreign_table,
                            'foreign_key'           => $foreign_key,
                            'local_key'             => $local_key
                        ];

                        if ($option == 'has_many_pivot') {
                            $this->relationships[$key]['pivot_table'] = $pivot_table;
                            $this->relationships[$key]['pivot_local_key'] = $pivot_local_key;
                            $this->relationships[$key]['pivot_foreign_key'] = $pivot_foreign_key;
                            $this->relationships[$key]['get_relate'] = $get_relate;
                        }

                        if ($single_query === true) {
                            $this->relationships[$key]['joined'] = true;
                        }
                    }
                }
            }
        }
    }

    /**
     * private function parse_model_dir($foreign_model)
     *
     * Parse model and model folder
     * @param $foreign_model
     * @return $data
     */
    private function parse_model_dir($foreign_model)
    {
        $data['foreign_model']      = $foreign_model;
        $data['model_dir']          = '';

        $full_model = explode('/', $data['foreign_model']);
        if ($full_model) {
            $data['foreign_model'] = end($full_model);
            $data['model_dir'] = str_replace($data['foreign_model'], null, implode('/', $full_model));
        }

        $foreign_model_name = str_replace('/', '_', $data['model_dir'].$data['foreign_model']);

        $data['foreign_model_name'] = strtolower($foreign_model_name);

        return $data;
    }

    /**
     * public function on($connection_group = null)
     * Sets a different connection to use for a query
     * @param $connection_group = null - connection group in database setup
     * @return obj
     */
    public function on($connection_group = null)
    {
        if (isset($connection_group)) {
            $this->database->close();
            $this->load->database($connection_group);
            $this->database = $this->db;
        }
        return $this;
    }

    /**
     * public function reset_connection()
     * Resets the connection to the default used for all the model
     * @return obj
     */
    public function reset_connection()
    {
        $this->database->close();
        $this->set_connection();
        return $this;
    }


    /**
    * Trigger an event and call its observers. Pass through the event name
    * (which looks for an instance variable $this->event_name), an array of
    * parameters to pass through and an optional 'last in interation' boolean
    */
    public function trigger($event, $data = [], $last = true)
    {
        if (isset($this->$event) && is_array($this->$event)) {
            foreach ($this->$event as $method) {
                if (strpos($method, '(')) {
                    preg_match('/([a-zA-Z0-9\_\-]+)(\(([a-zA-Z0-9\_\-\., ]+)\))?/', $method, $matches);
                    $method = $matches[1];
                    $this->callback_parameters = explode(',', $matches[3]);
                }
                $data = call_user_func_array(array($this, $method), array($data, $last));
            }
        }
        return $data;
    }

    /**
     * public function fields($fields)
     * does a select() of the $fields
     * @param $fields the fields needed
     * @return $this
     */
    public function fields($fields = null)
    {
        if (isset($fields)) {
            if ($fields == '*count*') {
                $this->select = '';
                $this->database->select('COUNT(*) AS counted_rows', false);
            } else {
                $this->select = [];
                $fields = (!is_array($fields)) ? explode(',', $fields) : $fields;
                if (!empty($fields)) {
                    foreach ($fields as &$field) {
                        $exploded = explode('.', $field);
                        if (sizeof($exploded) < 2) {
                            $field = $field;
                        }
                    }
                }
                $this->select = $fields;
            }
        } else {
            $this->select = null;
        }
        return $this;
    }

    /**
     * public function order_by($criteria, $order = 'ASC'
     * A wrapper to $this->database->order_by()
     * @param $criteria
     * @param string $order
     * @return $this
     */
    public function order_by($criteria, $order = 'ASC')
    {
        if (is_array($criteria)) {
            foreach ($criteria as $key => $value) {
                $this->database->order_by($key, $value);
            }
        } else {
            $this->database->order_by($criteria, $order);
        }
        return $this;
    }

    /**
     * Return the next call as an array rather than an object
     * @return $this
     */
    public function as_array()
    {
        $this->return_as = 'array';
        return $this;
    }

    /**
     * Return the next call as an object rather than an array
     * @return $this
     */
    public function as_object()
    {
        $this->return_as = 'object';
        return $this;
    }

    /**
     * Return the next call as a dropdown rather than an array
     * @return $this
     */
    public function as_dropdown($field = null)
    {
        if (!isset($field)) {
            show_error('MY_Model: You must set a field to be set as value for the key: ...->as_dropdown(\'field\')->...');
            exit;
        }
        $this->return_as_dropdown = 'dropdown';
        $this->dropdown_field = $field;
        $this->select = [$this->primary_key, $field];
        return $this;
    }

    /**
     * public function set_cache($string, $seconds = 86400)
     * Saves to cache
     * @param string $string as cache_name
     * @param integer $seconds
     * @return $this
     */
    public function set_cache($string, $seconds = 86400)
    {
        $prefix = (strlen($this->cache_prefix)>0) ? $this->cache_prefix.'_' : '';
        $prefix .= $this->table.'_';
        $this->cache = [
            'cache_name'    => $prefix.$string,
            'seconds'       =>$seconds
        ];
        return $this;
    }

    /**
     * public function delete_cache($string = null)
     * Deletes from cache proper to cache_name ($string)
     * @param string $string as cache_name
     * @return $this
     */
    public function delete_cache($string = null)
    {
        $this->load->driver('cache');
        $prefix = (strlen($this->cache_prefix)>0) ? $this->cache_prefix.'_' : '';
        $prefix .= $this->table.'_';
        if (isset($string) && (strpos($string, '*') === false)) {
            $this->cache->{$this->cache_driver}->delete($prefix . $string);
        } else {
            $cached = $this->cache->file->cache_info();
            foreach ($cached as $file) {
                if (array_key_exists('relative_path', $file)) {
                    $path = $file['relative_path'];
                    break;
                }
            }

            if (isset($path)) {
                $mask = (isset($string)) ? $path.$prefix.$string : $path.$this->cache_prefix.'_*';
                array_map('unlink', glob($mask));
            }
        }
        return $this;
    }

    /**
     * private function _build_sorter($data, $field, $order_by, $sort_by = 'DESC')
     * Sorts array $data with defined conditions (with custom function)
     * @param array $data
     * @param string $field
     * @param string $order_by
     * @param string $sort_by ('DESC' as default)
     * @return array $data
     */
    private function _build_sorter($data, $field, $order_by, $sort_by = 'DESC')
    {
        usort($data, function ($a, $b) use ($field, $order_by, $sort_by) {
            $array_a = isset($a[$field]) ? $this->object_to_array($a[$field]) : null;
            $array_b = isset($b[$field]) ? $this->object_to_array($b[$field]) : null;
            return strtoupper($sort_by) ==  "DESC" ?
                ((isset($array_a[$order_by]) && isset($array_b[$order_by])) ? ($array_a[$order_by] < $array_b[$order_by]) : (!isset($array_a) ? 1 : -1))
                : ((isset($array_a[$order_by]) && isset($array_b[$order_by])) ? ($array_a[$order_by] > $array_b[$order_by]) : (!isset($array_b) ? 1: -1));
        });

        return $data;
    }

    /**
     * public function __call($method, $arguments)
     * Checks method's start parts and performs proper database functions. If method is not defined pulls an error message.
     * @param string $method
     * @param array $arguments
     * @return $this
     */
    public function __call($method, $arguments)
    {
        if (substr($method, 0, 6) == 'where_') {
            $column = substr($method, 6);
            $this->where($column, $arguments);
            
            return $this;
        }
        
        if (($method != 'with_trashed') && (substr($method, 0, 5) == 'with_')) {
            $relation = substr($method, 5);
            $this->with($relation, $arguments);

            return $this;
        }
        if (method_exists($this->database, $method)) {
            call_user_func_array(array($this->database, $method), $arguments);
            return $this;
        }
        
        $parent_class = get_parent_class($this);

        if ($parent_class !== false && !method_exists($parent_class, $method) && !method_exists($this, $method)) {
            $msg = 'The method "'.$method.'" does not exist in '. get_class($this) .' or MY_Model or CI_Model.';
            show_error($msg, EXIT_UNKNOWN_METHOD, 'Method Not Found');
        }
    }

    /**
     * public function filter($filter = [])
     * Adds conditions (filters) to the query (where)
     * @param array $filter
     * @return $this
     */
    public function filter($filter = [])
    {
        $this->where($filter);
        return $this;
    }



    /**
     * public function with_translation($language_id = false)
     * Joins translation table with language
     * @param string or integer $language_id. If not defined function will use current language.
     * @return $this
     */

    public function with_translation($language_id = false)
    {
        if ($language_id) {
            $language_id = (int)$language_id;
            $this->where([$this->table_language_key => $language_id]);
        } else {
            $this->where([$this->table_language_key => $this->data['current_lang_id']]);
        }
        $this->database->join($this->table_translation, $this->table_translation.'.'.$this->table_translation_key.' = '.$this->table.'.'.$this->primary_key, 'left');

        return $this;
    }

    public function insert_translation($data)
    {
        $this->database->insert($this->table_translation, $data);
    }

    public function delete_translation($id)
    {
        $this->database->where($this->table_translation_key, $id);
        $this->database->delete($this->table_translation);
    }

    public function insert_additional_data($table_name, $data = []){
        if($data){
            $this->db->insert_batch($table_name, $data);
            return $this->db->insert_id();
        }
        return false;
    }

    public function get_additional_data($table_name, $select, $where = [], $row = false, $as_array = false, $order_by = []) {
        $this->db->select($select);
        $this->db->where($where);
        if($order_by) {
            foreach ($order_by as $key => $value) {
                $this->db->order_by($key, $value);
            }
        }
        $query = $this->db->get($table_name);

        if($query->num_rows() > 0){
            if($row) {
                return $query->row();
            } else {
                if($as_array) {
                    return $query->result_array();
                } else {
                    return $query->result();
                }
            }
        }
        return false;
    }   

    public function delete_additional_data($table_name,$where = [])
    {
        $this->database->where($where);
        $this->database->delete($table_name);
    }

    
    public function get_rows($select, $where, $sort = false, $limit = false, $trash = false) {
        $this->db->select($select);
        $this->db->from($this->table);

        if (isset($this->relation_tables) && !empty($this->relation_tables)) {
            foreach ($this->relation_tables as $key=> $relation_table) {
                 $this->db->join($relation_table['name'], $this->table . '.' . $this->primary_key . ' = ' . $relation_table['name'] . '.' . $relation_table['column']);
            }
        }



        $this->db->where($where);

        if ($trash) {
            $this->db->where('deleted_at !=', NULL);
        }
        else {
            $this->db->where('deleted_at', NULL);
        }

        if ($limit) {
            $this->db->limit($limit['per_page'], ($limit['page'] - 1) * $limit['per_page']);
        }

        if ($sort) {
            $this->db->order_by($sort['column'], $sort['order']);
        }
        else {
            $this->db->order_by('created_at', 'DESC');
        }

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return false;
    }

}

require_once('Custom_model.php');
