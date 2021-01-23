/**
 * @file
 * Global utilities.
 *
 */
(function($, Drupal) {
  'use strict';
  Drupal.behaviors.bootstrap_barrio_subtheme = {
    attach: function(context, settings) {
      /*var basepath = location.protocol + "//" + location.host ;
      $("a.nav-link--user").attr("href", basepath +'/dashboard');*/
      $('.form-item-revision.form-check-label').text('Comments');
      $('#edit-revision-log-0-value--description').text('(Briefly describe the reason if rejected).');
      $('#node-application-frc-form  vertical-tabs__menu-item first').css("display","none");

      $('#edit-claimant-profiles-0-entity-field-grama-panchayat').empty();
      $('#edit-claimant-profiles-0-entity-field-frc').empty();
      $('#edit-claimant-profiles-0-entity-field-settlement').empty();
      $('#edit-frc-profiles-0-entity-field-grama-panchayat').empty();
      $('#edit-frc-profiles-0-entity-field-frc').empty();
      $('.page-dashboard .layout-region-node-secondary').removeClass('col-md-6').css("width",'100%');
      $('#node-application-edit-form .layout-region-node-secondary').removeClass('col-md-6').css("width",'100%');
      $('.form-item-revision-log-0-value label').text('Add comments');

      var $select = $('#edit-claimant-profiles-0-entity-field-district');
      $select.val($("#edit-claimant-profiles-0-entity-field-district").find('option').first().val()).change();

      jQuery('.view-display-id-frc_all #btn-meeting-request').on('click',function(){
          /*$(this).attr("href", "http://www.google.com/");*/
          alert(jQuery(this).attr("href"));
      });
      $('#edit-claimant-profiles-0-entity-field-district').on('change', function() {
       /* console.log(this.value);  */
        var nid = this.value;
        var url = location.protocol + "//" + location.host + '/panchayat/';
        var fullurl = url + nid;
        $.ajax({
          type: 'GET',
          url: fullurl,
          dataType: "json",
          success: function (data) {
            {
              var items = []
              var $sett_select = $('#edit-claimant-profiles-0-entity-field-grama-panchayat');
              $sett_select.empty();
              data = arrUnique(data);

              $.each(data, function( key, value ) {
                $sett_select.append($("<option></option>").attr("value", value.tid).text(value.panchayat));
              });
              $sett_select.val($("#edit-claimant-profiles-0-entity-field-grama-panchayat option:first").val()).change();
            }
          }
        });
      });
      $('#edit-claimant-profiles-0-entity-field-grama-panchayat').on('change', function() {
       /* console.log(this.value);     */
        var nid = this.value;
        var url = location.protocol + "//" + location.host + '/frc/';
        var fullurl = url + nid;
        $.ajax({
          type: 'GET',
          url: fullurl,
          dataType: "json",
          success: function (data) {
            {
              var items = []
              var $sett_select = $('#edit-claimant-profiles-0-entity-field-frc');
              $sett_select.empty();
              $.each(data, function( key, value ) {
                $sett_select.append($("<option></option>").attr("value", value.nid).text(value.title));
              });

              $sett_select.val($("#edit-claimant-profiles-0-entity-field-frc  option:first").val()).change();
            }
          }
        });
      });
      $('#edit-claimant-profiles-0-entity-field-frc').on('change', function() {
        /*console.log(this.value); */
        var nid = this.value;
        var url = location.protocol + "//" + location.host + '/frc-settlements/';
        var fullurl = url + nid;
        $.ajax({
          type: 'GET',
          url: fullurl,
          dataType: "json",
          success: function (data) {
            {
              var items = []
              var $sett_select = $('#edit-claimant-profiles-0-entity-field-settlement');
              $sett_select.empty();

              $.each(data, function( key, value ) {
                $sett_select.append($("<option></option>").attr("value", value.tid).text(value.settlement));
              });
            }
          }
        });
      });
      var $select = $('#edit-frc-profiles-0-entity-field-district');
      $select.val($("#edit-frc-profiles-0-entity-field-district").find('option').first().val()).change();
      $('#edit-frc-profiles-0-entity-field-district').on('change', function() {
        var url = location.protocol + "//" + location.host + '/panchayat/';
        var nid = this.value;
        var fullurl = url + nid;
        $.ajax({
          type: 'GET',
          url: fullurl,
          dataType: "json",
          success: function (data) {
            {
              var items = []
              var $sett_select = $('#edit-frc-profiles-0-entity-field-grama-panchayat');
              $sett_select.empty();
              $.each(data, function( key, value ) {
                $sett_select.append($("<option></option>").attr("value", value.tid).text(value.panchayat));
              });
              $sett_select.val($("#edit-frc-profiles-0-entity-field-grama-panchayat").find('option').first().val()).change();
            }
          }
        });
      });

      $('#edit-frc-profiles-0-entity-field-grama-panchayat').on('change', function() {
       /* console.log(this.value);*/
        var nid = this.value;
        var url = location.protocol + "//" + location.host + '/frc/';
        var fullurl = url + nid;
        $.ajax({
          type: 'GET',
          url: fullurl,
          dataType: "json",
          success: function (data) {
            {
              var items = []
              var $sett_select = $('#edit-frc-profiles-0-entity-field-profile-frc');
              $sett_select.empty();
              $.each(data, function( key, value ) {
                $sett_select.append($("<option></option>").attr("value", value.nid).text(value.title));
              });
              $sett_select.find('option').first().prop('selected', true);            }
          }
        });
      });

      function arrUnique(arr) {

      var cleaned = [];
      arr.forEach(function(itm) {
          var unique = true;
          cleaned.forEach(function(itm2) {
              if (_.isEqual(itm, itm2)) unique = false;
          });
          if (unique)  cleaned.push(itm);
      });
      return cleaned;
      }
      $('#edit-tribal-development-office-profiles-0-entity-field-tdo-category').on('change', function() {
        /*console.log(this.value);*/
        var office = this.value;
        var items = [];

        if ($(this).val() == 69) {
          $("#edit-tribal-development-office-profiles-0-entity-field-tdo-designation [value='65']").prop('selected', true);
        }
        else if ($(this).val() == 68) {
          $("#edit-tribal-development-office-profiles-0-entity-field-tdo-designation [value='64']").prop('selected', true);
        }
      });

      var current_user = window.location.href.split('/').reverse()[1];
      var loc = null;
      $('#edit-name').val(current_user + '@'  +'name');
      $('#edit-la-profiles-0-entity-field-dlc').on('change', function() {
        loc = $("#edit-la-profiles-0-entity-field-dlc option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-frc-profiles-0-entity-field-profile-frc').on('change', function() {
        loc = $("#edit-frc-profiles-0-entity-field-profile-frc option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-sdlc-profiles-0-entity-field-profile-sdlc').on('change', function() {
        loc = $("#edit-sdlc-profiles-0-entity-field-profile-sdlc option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-dlc-profiles-0-entity-field-profile-dlc').on('change', function() {
        loc = $("#edit-dlc-profiles-0-entity-field-profile-dlc option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-slc-profiles-0-entity-field-profile-slc').on('change', function() {
        loc = $("#edit-slc-profiles-0-entity-field-profile-slc option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-panchayat-profiles-0-entity-field-grama-panchayat').on('change', function() {
        loc = $("#edit-panchayat-profiles-0-entity-field-grama-panchayat option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('#edit-panchayat-profiles-0-entity-field-grama-panchayat').on('change', function() {
        loc = $("#edit-panchayat-profiles-0-entity-field-grama-panchayat option:selected").text().toLowerCase();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $("#edit-forest-profiles-0-entity-field-forest-range-0-target-id").on( "autocompletechange", function(event,ui) {
        loc = $(this).val().split('(')[0].toLowerCase().trim();
        $('#edit-name').val(current_user + '@' + loc);
      });
      $('.nav-tabs .nav-item ul li a.active').removeAttr("style");

      $('.nav-tabs .nav-item ul li a').on('click', function() {
        $(this).parent('li').find('.nav-link').removeClass('active');

      });

    }
  };

})(jQuery, Drupal);
