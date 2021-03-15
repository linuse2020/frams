<?php
/**
 * @file
 * Contains \Drupal\frams-pro\Controller\DownloadReports.
 */

namespace Drupal\frams_pro\Controller;
use Drupal\frams_pro\Controller\IndividualHabController;

use Drupal\Core\Controller\ControllerBase;
use Drupal\taxonomy;
use Drupal\taxonomy\TermInterface;
use Drupal\taxonomy\Entity\Term;
use ParseCsv\Csv;
use Symfony\Component\HttpFoundation\Response;
use Dompdf\Dompdf;
use \Drupal\Component\Render;
use \Drupal\Component\Render\MarkupInterface;



class DownloadReports extends ControllerBase {
  public function individualHabitation_report_pdf() {
    $IndividualHab = new IndividualHabController();
    $value = $IndividualHab->individualHabitation();
    $filename = 'individualHabitation-report';
    $dompdf = new Dompdf();
    $markup = drupal_render($value);
    $dompdf->loadHtml($markup);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
    $response = new Response('IndividualHabitation Report', 200, array());
      return $response;
  }
  public function individualHabitation_report_csv() {
    $IndividualHab = new IndividualHabController();
    $value = $IndividualHab->individualHabitation();
    $filename = 'individualHabitation-report';
    $csv = new \ParseCsv\Csv();
    $csv->linefeed = "\n";
    $header = array('Sl No', 'District ID','District','No of Claim Received','No Of Rights Recognised','No of title demarcated','No of Rights Updated in RoR.','No of title Issued joinly in the name of both the spouses','No of title Issued single woman headedhouseholds','No of FDST benificiaries','No of OTFD benificiaries');
    $csv->output($filename.'.csv', $value['#ind_hab_data'], $header, ',');
    $response = new Response('IndividualHabitation Report', 200, array());
      return $response;
  }
  public function individualCultivation_report_pdf() {
    $IndividualCul = new IndividualHabController();
    $value = $IndividualCul->individualCultivation();
    $filename = 'individualCultivation-report';
    $dompdf = new Dompdf();
    $markup = drupal_render($value);
    $dompdf->loadHtml($markup);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
    $response = new Response('IndividualHabitation Report', 200, array());
      return $response;
  }
  public function individualCultivation_report_csv() {
    $IndividualCul = new IndividualHabController();
    $value = $IndividualCul->individualCultivation();
    $filename = 'individualCultivation-report';
    $csv = new \ParseCsv\Csv();
    $csv->linefeed = "\n";
    $header = array('Sl No','District ID', 'District','No of Claim Received','No Of Rights Recognised','No of title demarcated','No of Rights Updated in RoR.','No of title Issued joinly in the name of both the spouses','No of title Issued single woman headedhouseholds','No of FDST benificiaries','No of OTFD benificiaries');
    $csv->output($filename.'.csv', $value['#ind_cul_data'], $header, ',');
    $response = new Response('IndividualHabitation Report', 200, array());
      return $response;
  }
  public function individual_report_pdf() {
    $IndividualCul = new IndividualHabController();
    $value = $IndividualCul->individualCultivation();
    $filename = 'individual-report';
    $dompdf = new Dompdf();
    $markup = drupal_render($value);
    $dompdf->loadHtml($markup);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream($filename.'.pdf', array('Attachment' => 1));
    $response = new Response('Individual Report', 200, array());
      return $response;
  }
  public function individual_report_csv() {
    $IndividualCul = new IndividualHabController();
    $value = $IndividualCul->individualCultivation();
    $filename = 'individual-report';
    $csv = new \ParseCsv\Csv();
    $csv->linefeed = "\n";
    $header = array('Sl No','District ID', 'District','No of Claim Received','No Of Rights Recognised','No of title demarcated','No of Rights Updated in RoR.','No of title Issued joinly in the name of both the spouses','No of title Issued single woman headedhouseholds','No of FDST benificiaries','No of OTFD benificiaries');
    $csv->output($filename.'.csv', $value['#ind_cul_data'], $header, ',');
    $response = new Response('Individual Report', 200, array());
      return $response;
  }
}
