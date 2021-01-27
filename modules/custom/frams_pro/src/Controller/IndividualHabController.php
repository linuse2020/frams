<?php
/**
 * @file
 * Contains \Drupal\frams-pro\Controller\TestTwigController.
 */

namespace Drupal\frams_pro\Controller;

use Drupal\Core\Controller\ControllerBase;

class IndividualHabController extends ControllerBase {
  public function individualHabitation() {
  	$tot_ind_hab_received = $this->ind_hab_received(0, 'application');
  	$tot_ind_hab_recognised =  $this->ind_hab_recognised(0, 'application');
  	$tot_ind_hab_demarcated =  $this->ind_hab_demarcated(0, 'application');
  	$ind_hab_ror_issued =  $this->ind_hab_ror_issued(0, 'application');
  	$ind_hab_issued_couple =  $this->ind_hab_issued_couple(0, 'application');
  	$ind_hab_issued_woman =  $this->ind_hab_issued_woman(0, 'application');
  	$tot_ind_hab_fdst =  $this->ind_hab_fdst(0, 'application');
  	$tot_ind_hab_otfd =  $this->ind_hab_otfd(0, 'application');
  	/*$sl_no =*/
    return [
	    '#theme' => 'individual_hab',
	    '#test_var' => $val,
			'#sl_no' => 1,
			'#tot_ind_hab_received' => $tot_ind_hab_received ,
			'#tot_ind_hab_recognised' => $tot_ind_hab_recognised ,
			'#tot_ind_hab_demarcated' => $tot_ind_hab_demarcated,
			'#tot_ind_hab_ror_issued' => $ind_hab_ror_issued,
			'#tot_ind_hab_issued_couple' => $ind_hab_issued_couple,
			'#tot_ind_hab_issue_wom' => $ind_hab_issued_woman ,
			'#tot_ind_hab_fdst' => $tot_ind_hab_fdst,
			'#tot_ind_hab_otfd' => $tot_ind_hab_otfd,
    ];
  }
  public function ind_hab_received($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           /*->exists('')*/ //field_alloted_land_habitation
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
  public function ind_hab_recognised($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->exists('field_alloted_land_for_both') // field_alloted_land_habitation
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
  public function ind_hab_demarcated($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           	->exists('field_survey_details')
          	->exists('field_alloted_land_for_both') // field_habitation
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
  public function ind_hab_ror_issued($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->exists('field_upload_ror_issued')
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
  public function ind_hab_issued_couple($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->condition('field_family_category','Couple','=')
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
  public function ind_hab_issued_woman($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
         /*  ->condition('field_family_category','female','=')*/
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
/*  public function ind_hab_issued_man($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->condition('field_family_category','male','=')
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }*/
  public function ind_hab_fdst($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->condition('field_is_schedules_tribe',TRUE,'=')
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
   public function ind_hab_otfd($status, $type) {
    $query = \Drupal::entityQuery('node')
            ->condition('status', $status)
           ->condition('field_caste_cert_spouse_',TRUE,'=')
           ->exists('field_alloted_land_habitation')
            ->condition('type', $type);
    $result = $query->count()->execute();
    return $result;
  }
}
