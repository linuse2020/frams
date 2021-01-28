<?php
/**
 * @file
 * Contains \Drupal\frams-pro\Controller\TestTwigController.
 */

namespace Drupal\frams_pro\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy;
use Drupal\taxonomy\TermInterface;
use Drupal\taxonomy\Entity\Term;

class IndividualHabController extends ControllerBase {
  public function individualHabitation() {
    $count = 0;
    $district_data = [];
    $tot_ind_hab_received = [];
    $tot_ind_hab_recognised = [];
    $tot_ind_hab_demarcated = [];
    $ind_hab_ror_issued = [];
    $ind_hab_issued_couple = [];
    $ind_hab_issued_woman = [];
    $tot_ind_hab_fdst = [];
    $tot_ind_hab_otfd = [];
    $term_districts =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('district');
    foreach ($term_districts as $district) {
      $count ++;
      $dist = $district->name;
      $tot_ind_hab_received = \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_habitation')->count()->execute();
      $query = \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=');
      $group = $query->orConditionGroup()->exists('field_alloted_land_for_both')->exists('field_alloted_land_habitation');
      $query->condition($group);
      $tot_ind_hab_recognised = $query->count()->execute();
      $tot_ind_hab_demarcated =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_survey_details')->exists('field_habitation')->count()->execute();
      $ind_hab_ror_issued =   \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_upload_ror_issued')->condition($group)->count()->execute();
      $ind_hab_issued_couple =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_family_category','Couple','=')->condition($group)->count()->execute();
      $ind_hab_issued_woman =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_family_category','female','=')->condition($group)->count()->execute();
      $tot_ind_hab_fdst =   \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_is_schedules_tribe',TRUE,'=')->condition($group)->count()->execute();
      $tot_ind_hab_otfd =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_caste_cert_spouse_',TRUE,'=')->condition($group)->count()->execute();

       $district_data[] = [
        'sl_no' => $count,
        'district' => $district->name,
        'tot_ind_hab_received' => $tot_ind_hab_received,
        'tot_ind_hab_recognised' => $tot_ind_hab_recognised,
        'tot_ind_hab_demarcated' => $tot_ind_hab_demarcated,
        'tot_ind_hab_ror_issued' => $ind_hab_ror_issued,
        'tot_ind_hab_issued_couple' => $ind_hab_issued_couple,
        'tot_ind_hab_issue_wom' => $ind_hab_issued_woman,
        'tot_ind_hab_fdst' => $tot_ind_hab_fdst,
        'tot_ind_hab_otfd' => $tot_ind_hab_otfd,
      ];
    }

    return [
      '#theme' => 'individual_hab',
      '#ind_hab_data' => $district_data,
    ];
  }
  public function individualCultivation() {
    $count = 0;
    $district_data = [];
    $tot_ind_cul_received = [];
    $tot_ind_cul_recognised = [];
    $tot_ind__demarcated = [];
    $ind_cul_ror_issued = [];
    $ind_cul_issued_couple = [];
    $ind_cul_issued_woman = [];
    $tot_ind_cul_fdst = [];
    $tot_ind_cul_otfd = [];
    $term_districts =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree('district');
    foreach ($term_districts as $district) {
      $count ++;
      $dist = $district->name;
      $tot_ind_cul_received = \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_self_cultivation')->count()->execute();
      $query = \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=');
      $group = $query->orConditionGroup()->exists('field_alloted_land_for_both')->exists('field_alloted_land_cultivation');
      $query->condition($group);
      $tot_ind_cul_recognised = $query->count()->execute();
      $tot_ind_cul_demarcated =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_survey_details')->exists('field_self_cultivation')->count()->execute();
      $ind_cul_ror_issued =   \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->exists('field_upload_ror_issued')->condition($group)->count()->execute();
      $ind_cul_issued_couple =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_family_category','Couple','=')->condition($group)->count()->execute();
      $ind_cul_issued_woman =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_family_category','female','=')->condition($group)->count()->execute();
      $tot_ind_cul_fdst =   \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_is_schedules_tribe',TRUE,'=')->condition($group)->count()->execute();
      $tot_ind_cul_otfd =  \Drupal::entityQuery('node')->condition('type','application')->condition('field_claimant_district',$district->tid,'=')->condition('field_caste_cert_spouse_',TRUE,'=')->condition($group)->count()->execute();

       $district_data[] = [
        'sl_no' => $count,
        'district' => $district->name,
        'tot_ind_cul_received' => $tot_ind_cul_received,
        'tot_ind_cul_recognised' => $tot_ind_cul_recognised,
        'tot_ind_cul_demarcated' => $tot_ind_cul_demarcated,
        'tot_ind_cul_ror_issued' => $ind_cul_ror_issued,
        'tot_ind_cul_issued_couple' => $ind_cul_issued_couple,
        'tot_ind_cul_issue_wom' => $ind_cul_issued_woman,
        'tot_ind_cul_fdst' => $tot_ind_cul_fdst,
        'tot_ind_cul_otfd' => $tot_ind_cul_otfd,
      ];
    }
    return [
      '#theme' => 'individual_cul',
      '#ind_cul_data' => $district_data,
    ];
  }
}
