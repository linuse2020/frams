/*
 *  Custom JS
 *
 */

(function ($) {
  // Store our function as a property of Drupal.behaviors.
  Drupal.behaviors.ClaimantRegister = {
    attach: function (context, settings) {
      $(window).scroll(function() {
        if ($(this).scrollTop() > 100){
          $('header').addClass("sticky");
        }
        else{
          $('header').removeClass("sticky");
        }
      });
      $('#btn-meeting-request').on('click',function(){
        var id = [];
        $(".view-display-id-frc_all table input[type=checkbox]:checked").each(function () {
            var row = $(this).closest("tr")[0];
            id.push($.trim(row.cells[0].innerHTML));
        });
        window.open('/private-message/create?nid=' +  id.filter(Number),'_blank');
      });

      if (window.location.pathname == '/claimant/register') {
        var panchayat_select = '#edit-claimant-profiles-0-entity-field-grama-panchayat';
        var frc_select = '#edit-claimant-profiles-0-entity-field-frc';
        var settlement_select = '#edit-claimant-profiles-0-entity-field-settlement';
        $(panchayat_select).empty();
        $(frc_select).empty();
        $(settlement_select).empty();
        // $('#edit-claimant-profiles-0-entity-field-settlement').empty();
        // $('#edit-frc-profiles-0-entity-field-grama-panchayat').empty();
        // $('#edit-frc-profiles-0-entity-field-frc').empty();

        // Get panchayat list
        $('#edit-claimant-profiles-0-entity-field-district', context).once('frams').on('change', function (e) {
          $(panchayat_select).empty();
          $(frc_select).empty();
          $(settlement_select).empty();
          var nid = this.value;
          var url = window.location.origin + '/api/rest/grama-panchayat/json/' + nid;
          $.get(url, function() {
          })
          .done(function (res) {
            console.log(res);
            $.each(res, function( key, value ) {
              $(panchayat_select).append($("<option></option>").attr("value", value.id).text(value.name));
            });
            $(panchayat_select).trigger("chosen:updated");
            $(panchayat_select).val($(panchayat_select + " option:first").val()).change();
          });
        });

        // Get FRC List
        $(panchayat_select,context).once('frams').on('change',function (e) {
          $(frc_select).empty();
          $(settlement_select).empty();
          var nid = this.value;
          var url = window.location.origin + '/api/rest/frc/json/' + nid;
          $.get(url, function() {
          })
          .done(function (res) {
            $.each(res, function( key, value ) {
              $(frc_select).append($("<option></option>").attr("value", value.id).text(value.name));
            });
            $(frc_select).trigger("chosen:updated");
            $(frc_select).val($(frc_select + " option:first").val()).change();
          });
        });

        // Get Settlement List
        $(frc_select,context).once('frams').on('change',function (e) {
          $(settlement_select).empty();
          var nid = this.value;
          var url = window.location.origin + '/api/rest/settlements/json/' + nid;
          $.get(url, function() {
          })
          .done(function (res) {
            $.each(res, function( key, value ) {
              $(settlement_select).append($("<option></option>").attr("value", value.id).text(value.name));
            });
            $(settlement_select).trigger("chosen:updated");
            $(settlement_select).val($(frc_select + " option:first").val()).change();
          });
        });


      }
    }
  };


}(jQuery));
