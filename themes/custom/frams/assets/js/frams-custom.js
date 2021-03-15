
/*
 *  Custom JS
 *
 */

(function ($) {
  // Store our function as a property of Drupal.behaviors.
  Drupal.behaviors.ClaimantRegister = {
    attach: function (context, settings) {
      $('#datatable-ind').DataTable();
      $('#datatable-cul').DataTable();
      $('#datatable-hub').DataTable();

      $(window).scroll(function() {
        if ($(this).scrollTop() > 100){
          $('header').addClass("sticky");
        }
        else{
          $('header').removeClass("sticky");
        }
      });

     /* jQuery('.path-node #node-application-claimant-form #edit-field-family-category').on('change', function() {


      });*/
      jQuery("#views-form-dashboard-panchayat-applications-page-pan-sec th.select-all").attr("checked","checked");

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

        // Get panchayat listedit-field-family-category
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

  Drupal.behaviors.ReplaceCustomLanguageLinksOfArchives = {
    attach: function (context, settings) {
      var lang = $('html').attr('lang');
      if (lang === 'ml') {
      	var link = $('.archives-btn').attr('href');
      	var newlink = '/ml'+link;
      	$('.archives-btn', context).attr('href',newlink);
      }
    }
  };

  Drupal.behaviors.ReplaceCustomLanguageLinksOfApplications = {
    attach: function (context, settings) {
      var lang = $('html').attr('lang');
      if (lang === 'ml') {
      	var link = $('.application-btn').attr('href');
      	var newlink = '/ml'+link;
      	$('.application-btn', context).attr('href',newlink);
      }
    }
  };


  Drupal.behaviors.menutoggle = {
    attach: function (context, settings) {
      if ($(window).width() < 1025) {
        if (!Cookies.get('mobilemenu')) {
          Cookies.set('mobilemenu', 'true');
        }
      }
      console.log(Cookies.get());
      if (Cookies.get('mobilemenu')) {
        $('body').addClass('menu-collapse');
      }
      $('.toggle-menu', context).on('click', function() {
        if ($('body').hasClass('menu-collapse')) {
          $('body').removeClass('menu-collapse');
          Cookies.remove('mobilemenu');
        }
        else {
          $('body').addClass('menu-collapse');
          Cookies.set('mobilemenu', 'true');
        }
      });
    }
  };

}(jQuery));
