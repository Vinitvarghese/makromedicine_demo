<?php defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('get_medical_classification_name')) {
    function get_medical_classification_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Medical_classifiction_model');
            $medical_classification = $CI->Medical_classifiction_model->filter(['id' => $id])->with_translation()->one();
            if ($medical_classification) {
                return $medical_classification->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('generateSeoURL')) {
  function generateSeoURL($string, $wordLimit = 0){
      $separator = '-';
      if($wordLimit != 0){
          $wordArr = explode(' ', $string);
          $string = implode(' ', array_slice($wordArr, 0, $wordLimit));
      }
      $quoteSeparator = preg_quote($separator, '#');
      $trans = array(
          '&.+?;'                  => '',
          '[^\w\d _-]'             => '',
          '\s+'                    => $separator,
          '('.$quoteSeparator.')+' => $separator
      );
      $string = strip_tags($string);
      foreach ($trans as $key => $val){
          $string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
      }
      $string = strtolower($string);
      return trim(trim($string, $separator));
    }
}
if (!function_exists('get_packing_type_name')) {
    function get_packing_type_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Packing_type_model');
            $packing_type = $CI->Packing_type_model->filter(['id' => $id])->with_translation()->one();
            if ($packing_type) {
                return $packing_type->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_meaning')) {
    function get_atc_code_meaning($name = false) {
        $CI = & get_instance();
        if ($name) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['atc_code' => trim($name)])->with_translation()->one();
            if ($atc_code) {
                return $atc_code->meaning;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_name')) {
    function get_atc_code_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['id' => $id])->with_translation()->one();
            if ($atc_code) {
                return $atc_code->atc_code;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_no')) {
    function get_atc_code_no($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['id' => $id])->with_translation()->one();
            if ($atc_code) {
                return $atc_code->meaning;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_id')) {
    function get_atc_code_id($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['atc_code' => $code])->with_translation()->one();
            if ($atc_code) {
                return $atc_code->id;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_id_like')) {
    function get_atc_code_id_like($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['atc_code like "%'.$code.'%"' => NULL])->with_translation()->all();
            if ($atc_code) {
                $return_data=array();
                foreach ($atc_code as $key => $value) {
                  $return_data[] = $value->id;
                }
                return $return_data;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_atc_code_id_from_mn')) {
    function get_atc_code_id_from_mn($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Atc_code_model');
            $atc_code = $CI->Atc_code_model->filter(['meaning like "%'.$code.'%"' => NULL])->with_translation()->all();
            if ($atc_code) {
                $return_data=array();
                foreach ($atc_code as $key => $value) {
                  $return_data[] = $value->id;
                }
                return $return_data;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_herbal_name')) {
    function get_herbal_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Plants_model');
            $herbal = $CI->Plants_model->filter(['id' => $id])->with_translation()->one();
            if ($herbal) {
                return $herbal->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_animal_name')) {
    function get_animal_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Animal_model');
            $animal = $CI->Animal_model->filter(['id' => $id])->with_translation()->one();
            if ($animal) {
                return $animal->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_cas_no')) {
    function get_cas_no($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Cas_list_model');
            $cas = $CI->Cas_list_model->filter(['id' => $id])->with_translation()->one();
            if ($cas) {
                return $cas->cas_no;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_cas_formula')) {
    function get_cas_formula($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Cas_list_model');
            $cas = $CI->Cas_list_model->filter(['id' => $id])->with_translation()->one();
            if ($cas) {
                return $cas->molecular_formula;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_cas_name')) {
    function get_cas_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Cas_list_model');
            $cas = $CI->Cas_list_model->filter(['id' => $id])->with_translation()->one();
            if ($cas) {
                return $cas->chemical_name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_cas_id_from_no')) {
    function get_cas_id_from_no($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Cas_list_model');
            $cas = $CI->Cas_list_model->filter(['cas_no like "%'.$id.'%"' => NULL])->with_translation()->all();
            if ($cas) {
                 $return_data=array();
                foreach ($cas as $key => $value) {
                  $return_data[] = $value->id;
                }
                return $return_data;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_cas_id_from_name')) {
    function get_cas_id_from_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Cas_list_model');
            $cas = $CI->Cas_list_model->filter(['chemical_name like "%'.$id.'%"' => NULL])->with_translation()->all();
            if ($cas) {
                 $return_data=array();
                foreach ($cas as $key => $value) {
                  $return_data[] = $value->id;
                }
                return $return_data;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_selected_medical'))
{
    function get_selected_medical($id = false) {
        $CI = & get_instance();
        if ($id && $id!='') {
            $id = ltrim($id, ',');
            $id = rtrim($id, ',');
            $CI->load->model('Medical_classifiction_model');
            $medical = $CI->Medical_classifiction_model->filter(['id IN ('.$id.')' => NULL])->with_translation()->all();
            if ($medical) {
                return $medical;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_selected_medical_extra'))
{
    function get_selected_medical_extra($id = false) {
        $CI = & get_instance();
        if ($id && $id!='') {
            $CI->load->model('Medical_classifiction_model');
            $medicals = $CI->Medical_classifiction_model->filter(['id IN ('.$id.')' => NULL])->with_translation()->all();
            if ($medicals) {
                foreach($medicals as $medical)
                {
                    $medical_cl[] = $medical->name;
                }
                return implode(',', $medical_cl);
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_unit_name'))
{
    function get_unit_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Unit_model');
            $unit = $CI->Unit_model->filter(['id'=> $id])->with_translation()->one();
            if ($unit) {
                return $unit->short_name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_drug_type_name'))
{
    function get_drug_type_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Drug_type_model');
            $unit = $CI->Drug_type_model->filter(['id'=> $id])->with_translation()->one();
            if ($unit) {
                return $unit->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_drug_type_code'))
{
    function get_drug_type_code($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Drug_type_model');
            $unit = $CI->Drug_type_model->filter(['id'=> $id])->with_translation()->one();
            if ($unit) {
                return $unit->code;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_country_name'))
{
    function get_country_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Country_model');
            $country = $CI->Country_model->filter(['id'=> $id])->with_translation()->one();
            if ($country) {
                return $country->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_country_code'))
{
    function get_country_code($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Country_model');
            $country = $CI->Country_model->filter(['id'=> $id])->with_translation()->one();
            if ($country) {
                return $country->code;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_country_id'))
{
    function get_country_id($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Country_model');
            $country = $CI->Country_model->filter(['code'=> $code])->with_translation()->one();
            if ($country) {
                return $country->id;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_continent_code'))
{
    function get_continent_code($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Country_model');
            $country = $CI->Country_model->filter(['code'=> $code])->with_translation()->one();
            if ($country) {
                return $country->continent_id;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_continent_id'))
{
    function get_continent_id($code = false) {
        $CI = & get_instance();
        if ($code) {
            $CI->load->model('Continent_model');
            $country = $CI->Continent_model->filter(['code'=> $code])->with_translation()->one();
            if ($country) {
                return $country->id;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_continent_name'))
{
    function get_continent_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Continent_model');
            $continent = $CI->Continent_model->filter(['id'=> $id])->with_translation()->one();
            if ($continent) {
                return $continent->name;
            }
            return false;
        }
        return false;
    }
}

if (!function_exists('get_continent_name_by_country')){
    function get_continent_name_by_country($country_id){
        $CI = & get_instance();

        $CI->load->model('Company_model');

        return $CI->Company_model->getContinentName($country_id);
    }
}

if (!function_exists('get_trade_term_name'))
{
    function get_trade_term_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Trade_term_model');
            $trade_term = $CI->Trade_term_model->filter(['id'=> $id])->with_translation()->one();
            if ($trade_term) {
                return $trade_term->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_group_name'))
{
    function get_group_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Group_model');
            $groups = $CI->Group_model->filter(['id'=> $id])->one();
            if ($groups) {
                return $groups->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_standart_name'))
{
    function get_standart_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Standart_model');
            $standart = $CI->Standart_model->filter(['id'=> $id])->with_translation()->one();
            if ($standart) {
                return $standart->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_product_type_name'))
{
    function get_product_type_name($id = false) {
        $CI = & get_instance();
        if ($id) {
            $CI->load->model('Product_type_model');
            $pr_type = $CI->Product_type_model->filter(['id'=> $id])->with_translation()->one();
            if ($pr_type) {
                return $pr_type->name;
            }
            return false;
        }
        return false;
    }
}
if (!function_exists('get_company_name'))
{
    function get_company_name($id = false) {
        $CI = & get_instance();
        if ($id) {

            $CI->load->model('User_model');
            $pr_type=$CI->User_model->getUserData( [ 'u.id' => $id ] );

            //$pr_type = $CI->User_model->fields(['id','company_name', 'company_info', 'website','phone', 'slug','email','images'])->filter(['id'=> $id])->one();
             if (!empty($pr_type->website)){
              if(strpos($pr_type->website, 'http') !== 0)
              $pr_type->website = 'http://'.$pr_type->website; 
      }
            if ($pr_type) {
                return $pr_type;
            }
            return false;
        }
        return false;
    }
}
