/* ------------------------------------------------------------------------------
 *
 *  # স্টেপস উইজার্ড
 *
 *  form_wizard.html পৃষ্ঠার জন্য ডেমো JS কোড
 *
 * ---------------------------------------------------------------------------- */


// মডিউল সেটআপ
// ------------------------------

var FormWizard = function() {


    //
    // মডিউল কম্পোনেন্ট সেটআপ
    //

    // উইজার্ড
    var _componentWizard = function() {
        if (!$().steps) {
            console.warn('সতর্কতা - steps.min.js লোড হয়নি।');
            return;
        }

        // বেসিক উইজার্ড সেটআপ
        $('.steps-basic').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            transitionEffect: 'fade',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            onFinished: function (event, currentIndex) {
                $(this).submit();
            }
        });

        // অ্যাসিঙ্ক কন্টেন্ট লোড
        $('.steps-async').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            transitionEffect: 'fade',
            titleTemplate: '<span class="number">#index#</span> #title#',
            loadingTemplate: '<div class="card-body text-center"><i class="icon-spinner2 spinner mr-2"></i>  #text#</div>',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            onContentLoaded: function (event, currentIndex) {
                $(this).find('.card-body').addClass('hide');

                // কম্পোনেন্ট পুনরায় চালু
                _componentSelect2();
                _componentUniform();
            },
            onFinished: function (event, currentIndex) {
                // alert('ফর্ম জমা দেওয়া হয়েছে।');
            }
        });

        // উইজার্ড স্টেট সংরক্ষণ
        $('.steps-state-saving').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            transitionEffect: 'fade',
            saveState: true,
            autoFocus: true,
            onFinished: function (event, currentIndex) {
                alert('ফর্ম জমা দেওয়া হয়েছে।');
            }
        });

        // কাস্টম শুরু স্টেপ নির্ধারণ
        $('.steps-starting-step').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            transitionEffect: 'fade',
            startIndex: 2,
            autoFocus: true,
            onFinished: function (event, currentIndex) {
                alert('ফর্ম জমা দেওয়া হয়েছে।');
            }
        });

        // সব স্টেপ সক্রিয় এবং ক্লিকযোগ্য
        $('.steps-enable-all').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            transitionEffect: 'fade',
            enableAllSteps: true,
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            onFinished: function (event, currentIndex) {
                alert('ফর্ম জমা দেওয়া হয়েছে।');
            }
        });


        //
        // যাচাইকরণ সহ উইজার্ড
        //

        if (!$().validate) {
            console.warn('সতর্কতা - validate.min.js লোড হয়নি।');
            return;
        }

        // ফর্ম দেখান
        var form = $('.steps-validation').show();

        // উইজার্ড চালু করুন
        $('.steps-validation').steps({
            headerTag: 'h6',
            bodyTag: 'fieldset',
            titleTemplate: '<span class="number">#index#</span> #title#',
            labels: {
                previous: '<i class="icon-arrow-left13 mr-2" /> পূর্ববর্তী',
                next: 'পরবর্তী <i class="icon-arrow-right14 ml-2" />',
                finish: 'ফর্ম জমা দিন <i class="icon-arrow-right14 ml-2" />'
            },
            transitionEffect: 'fade',
            autoFocus: true,
            onStepChanging: function (event, currentIndex, newIndex) {
                if (currentIndex > newIndex) return true;

                if (currentIndex < newIndex) {
                    form.find('.body:eq(' + newIndex + ') label.error').remove();
                    form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
                }

                form.validate().settings.ignore = ':disabled,:hidden';
                return form.valid();
            },
            onFinishing: function (event, currentIndex) {
                form.validate().settings.ignore = ':disabled';
                return form.valid();
            },
            onFinished: function (event, currentIndex) {
                $(this).submit();
            }
        });

        // ভ্যালিডেশন চালু করুন
        $('.steps-validation').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            errorPlacement: function(error, element) {
                if (element.parents().hasClass('form-check')) {
                    error.appendTo(element.parents('.form-check').parent());
                } else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                } else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                email: {
                    email: true
                }
            }
        });
    };

    // Uniform
    var _componentUniform = function() {
        if (!$().uniform) {
            console.warn('সতর্কতা - uniform.min.js লোড হয়নি।');
            return;
        }

        $('.form-input-styled').uniform({
            fileButtonClass: 'action btn bg-blue'
        });
    };

    // Select2 নির্বাচন
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('সতর্কতা - select2.min.js লোড হয়নি।');
            return;
        }

        var $select = $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity,
            width: '100%'
        });

        $select.on('change', function() {
            $(this).trigger('blur');
        });
    };


    // মডিউলের জন্য অবজেক্ট রিটার্ন করুন
    return {
        init: function() {
            _componentWizard();
            _componentUniform();
            _componentSelect2();
        }
    }
}();


// মডিউল চালু করুন
// ------------------------------

document.addEventListener('DOMContentLoaded', function() {
    FormWizard.init();
});
