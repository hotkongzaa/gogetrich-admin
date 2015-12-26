/* [ ---- Gebo Admin Panel - wizard ---- ] */

$(document).ready(function () {
    //* simple wizard
    gebo_wizard.simple();
    //* wizard with validation
    gebo_wizard.validation();
    //* add step numbers to titles
    gebo_wizard.steps_nb();
});

gebo_wizard = {
    simple: function () {
        $('#simple_wizard').stepy({
            titleClick: true,
            nextLabel: 'Next <i class="icon-chevron-right icon-white"></i>',
            backLabel: '<i class="icon-chevron-left"></i> Previous',
            finishButton: false
        });
    },
    validation: function () {
        $('#courseDetailForm').stepy({
            nextLabel: 'Next <i class="icon-chevron-right icon-white"></i>',
            backLabel: '<i class="icon-chevron-left"></i> Previous',
            block: true,
            errorImage: true,
            titleClick: true,
            validate: true,
            finishButton: false
        });
        stepy_validation = $('#courseDetailForm').validate({
            onfocusout: false,
            errorPlacement: function (error, element) {
                error.appendTo(element.closest("div.controls"));
            },
            highlight: function (element) {
                $(element).closest("div.control-group").addClass("error f_error");
                var thisStep = $(element).closest('form').prev('ul').find('.current-step');
                thisStep.addClass('error-image');
            },
            unhighlight: function (element) {
                $(element).closest("div.control-group").removeClass("error f_error");
                if (!$(element).closest('form').find('div.error').length) {
                    var thisStep = $(element).closest('form').prev('ul').find('.current-step');
                    thisStep.removeClass('error-image');
                }

            },
            rules: {
                'courseCate': 'required',
                'courseName': 'required',
                'courseStatus': 'required'
            }, messages: {
                'courseCate': {required: 'Please select category!'},
                'courseName': {required: 'Course Name field is required!'},
                'courseStatus': {required: 'Course Status field is required!'}
            },
            ignore: ':hidden'
        });
    },
    //* add numbers to step titles
    steps_nb: function () {
        $('.stepy-titles').each(function () {
            $(this).children('li').each(function (index) {
                var myIndex = index + 1
                $(this).append('<span class="stepNb">' + myIndex + '</span>');
            });
        });
    }
};