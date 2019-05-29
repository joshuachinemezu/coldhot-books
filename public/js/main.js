"use strict";

var onboardWizard = {
    stepCount: 0,
    formName: '',
    setResponsive: function () {
        var $__this = this;
        var $__windowHeight = $(window).height();
        var $__windowWidth = $(window).width();
        $__windowHeight = $__windowHeight > 360 ? $__windowHeight : 360;
        var $el = $(".luna-signup-container");
        var option = $(".luna-signup-left");
        var _msgSibling = $(".luna-signup-left-overlay");
        if ($__windowWidth >= 768) {
            $el.add(option).add(_msgSibling).innerHeight($__windowHeight);
        } else {
            $el.add(option).add(_msgSibling).css("height", "auto");
        }
        _msgSibling.width(($(window).width() - $(".container").width()) / 2 + 10);
    },
    changeStep: function (steps, step) {
        var $__this = this;
        console.log(step);
        console.log(this.stepCount);
        $("html,body").animate({
            scrollTop: 0
        }, "slow");
        if (step <= 0 || step > this.stepCount) {
            return false;
        }
        var $__thisFormName = $(`form[name='${this.formName}']`);
        $__thisFormName.validate({
            rules: {
                printType: {
                    required: true
                },
                paperType: {
                    required: true
                },
                bindingType: {
                    required: true
                },
                bookSize: {
                    required: true
                },
                coverThickness: {
                    required: true
                },
                coverPageFinish: {
                    required: true
                },
                phone: {
                    required: true,
                    minlength: 13,
                },
                magazineSize: {
                    required: true
                },
                flyerThickness: {
                    required: true
                },
                flyerPrintType: {
                    required: true
                },
                flyerSize: {
                    required: true
                },
                posterThickness: {
                    required: true
                },
                posterSize: {
                    required: true
                },
                cardThickness: {
                    required: true
                },
                cardPrintType: {
                    required: true
                }
            },
            messages: {
                printType: {
                    required: "You need to select a print Print type",
                },
                paperType: {
                    required: "You need to select a paper Print type",
                },
                bindingType: {
                    required: "You need to select a binding type",
                },
                bookSize: {
                    required: "You need to select a book size",
                },
                coverThickness: {
                    required: "You need to select a book cover thickness",
                },
                coverPageFinish: {
                    required: "You need to select a book cover page finish type",
                },
                bookPageCount: {
                    required: "The book page count is required",
                },
                bookPageQuantity: {
                    required: "The book page quantity is required",
                },
                phone: {
                    required: "The Phone number field is required",
                    minlength: "The phone number must be at least 11 characters!",
                },
                magazineSize: {
                    required: "You need to select a magazine size",
                },
                flyerThickness: {
                    required: "The flyer Thickness is required",
                },
                flyerPrintType: {
                    required: "The flyer Print Type is required",
                },
                flyerSize: {
                    required: "The flyer size is required",
                },
                posterThickness: {
                    required: "The poster Thickness is required",
                },
                posterSize: {
                    required: "The poster size is required",
                },
                cardThickness: {
                    required: "The card Thickness is required",
                },
                cardPrintType: {
                    required: "The card Print Type is required",
                },
            },
            ignore: ":hidden:not('.step-active .hidden')",
            errorPlacement: function (label, error) {
                // notify("warning", "Validation error", label.text());
                var $__formGroupParent = error.parents(".form-group");
                $__formGroupParent.find(".errorIcon").remove();
                $__formGroupParent.append('<span class="errorIcon"><i class="icon icon-info"></i></span>');
                error.parents(".form-group").find(".errorIcon").show().find("i").attr("title", label.text()).tooltip({
                    container: "body"
                });
            }
        });
        if (step > steps) {
            if (!$__thisFormName.valid()) {
                console.log("form is invalid");
                return;
            }
            $(".step-active").removeClass("step-active").addClass("step-hide");
        } else {
            $(".step-active").removeClass("step-active");
        }
        var $__formDataStepID = $(".step[data-step-id='" + step + "']");
        $__formDataStepID.removeClass("step-hide").addClass("step-active");
        var $__stepCounterText = $(".steps-count");
        if (step === $__this.stepCount) {
            $__stepCounterText.html("CONFIRM DETAILS");
            $(".button-container").hide();
            $(".toNext").hide();
            var $__confirmStep = $(".step-confirm");
            $__thisFormName.find("input[type='text'],input[type='email'],input[type='number'],input[type='tel'],select, textarea").each(function () {
                $__confirmStep.find("." + $(this).attr("name")).text($(this).val());
            });
            $__thisFormName.find("input[type='radio']").each(function () {
                if ($(this).prop("checked")) {
                    $__confirmStep.find("." + $(this).attr("name")).text($(this).val());
                }
            });
        } else {
            $(".button-container").show();
            $(".toNext").show();
        }
        $__stepCounterText.find("span.step-current").text(step);
        $(".dots span").removeClass("selected");
        $(".dots li:nth-child(" + step + ") span").addClass("selected");
        var $__previousStep = $(".prevStep");
        if (step === 1) {
            $__previousStep.hide();
        } else {
            $__previousStep.css("display", "inline-block");
        }
    },
    setInputError: function (el) {
        el.addClass("input-error");
        el.parents(".step").find(".help-info").hide();
        el.parents(".step").find(".help-error").show();
    },
    isEmail: function (value) {
        value = value.toLowerCase();
        /** @type {!RegExp} */
        var writeScale = new RegExp(/^[a-z]{1}[\d\w\.-]+@[\d\w-]{3,}\.[\w]{2,3}(\.\w{2})?$/);
        return writeScale.test(value);
    },
    start: function (formName) {
        var formTilesFuncs = this;
        formTilesFuncs.formName = formName;
        $(".luna-signup-container input[type='checkbox'], .select").uniform();
        // $(document).on('change', "input[type='radio']", function(){
        //     $(this).parent().parent().parent().parent().find("i,h4").removeClass("text-danger");
        //     $(this).parent().parent().find("i,h4").addClass("text-danger");
        // });
        // var checkedRadios = $('[data-checked="true"]');
        // $(checkedRadios).each(function () {
        //     $(this).trigger('click');
        // });
        $(".luna-signup-container input[name='phone'],.luna-signup-container input[name='tn_phone']").mask("0000 000 0000");
        $(".datepicker").datepicker().on("changeDate", function (event) {
            $(this).datepicker("hide");
            $(this).focus().parents(".form-group").find(".errorIcon").remove();
        });
        window.setTimeout(function () {
            $("#tn_name").focus();
        }, 500);
        formTilesFuncs.setResponsive();
        $(window).resize(function () {
            formTilesFuncs.setResponsive();
        });
        formTilesFuncs.stepCount = $(`form[name='${formTilesFuncs.formName}'] .luna-steps .step`).length;
        $(`form[name='${formTilesFuncs.formName}'] .luna-steps .step`).each(function () {
            $(".dots").append("<li><span></span></li>");
            $(".step-count").text(formTilesFuncs.stepCount);
        });
        $(".dots span").first().addClass("selected");
        $(".nextStep").on("click", function () {
            var fltScore = $(".step-active").attr("data-step-id");
            /** @type {number} */
            var tiles = parseFloat(fltScore) + 1;
            formTilesFuncs.changeStep(fltScore, tiles);
        });
        $(".prevStep").on("click", function () {
            var fltScore = $(".step-active").attr("data-step-id");
            /** @type {number} */
            var tiles = parseFloat(fltScore) - 1;
            formTilesFuncs.changeStep(fltScore, tiles);
        });
        var $__thisConfirmStep = $(".step-confirm");
        $__thisConfirmStep.find(".input-container a.editInput").on("click", function () {
            $(this).parent().find("input").focus();
        });
        $__thisConfirmStep.find(".input-container a.showPass").on("mousedown", function () {
            $(this).parent().find("input").attr("type", "text");
        }).mouseup(function () {
            $(this).parent().find("input").attr("type", "password");
        });
        $__thisConfirmStep.find(".input-container input").on("focus", function () {
            $(this).parent().find("a").hide();
        });
        $__thisConfirmStep.find(".input-container input").on("focusout", function () {
            if (!$(this).hasClass("confirm-input-error")) {
                $(this).parent().find("a").show();
            }
        });
        $__thisConfirmStep.find("select").on("shown.bs.select", function (event) {
            $(this).parents(".form-group").find("a.editInput").hide();
        }).on("hidden.bs.select", function (event) {
            $(this).parents(".form-group").find("a.editInput").show();
        });
        $(document).on("keypress", function (event) {
            if (event.keyCode === 13) {
                $(".button-container .nextStep").click();
            }
        });
    }
};
/**
 * @return {undefined}
 */
$.fn.materialInput = function () {
    var $__thisMaterialInput;
    var materialInput = this;
    materialInput.find("input.formInput").focus(function (data) {
        materialInput.setLabel(data.target);
        materialInput.checkFocused(data.target);
    });
    materialInput.find("input.formInput").focusout(function (data) {
        materialInput.setLabel(data.target);
        materialInput.checkUnFocused(data.target);
    });
    materialInput.find("input.formInput").keypress(function (event) {
        $(this).parents(".form-group").find(".errorIcon").hide();
    });
    /**
     * @param {?} label
     * @return {undefined}
     */
    this.setLabel = function (label) {
        $__thisMaterialInput = materialInput.find("label[for=" + label.id + "]");
    };
    /**
     * @return {?}
     */
    this.getLabel = function () {
        return $__thisMaterialInput;
    };
    /**
     * @param {?} delete_behavior_form
     * @return {undefined}
     */
    this.checkFocused = function (delete_behavior_form) {
        materialInput.getLabel().addClass("active", "");
        $(delete_behavior_form)["removeClass"]("input-error");
    };
    /**
     * @param {?} delete_behavior_form
     * @return {undefined}
     */
    this["checkUnFocused"] = function (delete_behavior_form) {
        if ($(delete_behavior_form)["val"]()["length"] === 0) {
            materialInput["getLabel"]()["removeClass"]("active");
        }
    };
};
/**
 * @return {undefined}
 */
function handleFileSelect() {
    if (!window["File"] || !window["FileReader"] || !window["FileList"] || !window["Blob"]) {
        alert("The File APIs are not fully supported in this browser.");
        return;
    }
    input = document["getElementById"]("fileinput");
    if (!input) {
        alert("Um, couldn't find the fileinput element.");
    } else {
        if (!input["files"]) {
            alert("This browser doesn't seem to support the `files` property of file inputs.");
        } else {
            if (!input["files"][0]) {
                alert("Please select a file before clicking 'Load'");
            } else {
                file = input["files"][0];
                /** @type {!FileReader} */
                fr = new FileReader;
                fr["onload"] = receivedText;
                fr["readAsDataURL"](file);
            }
        }
    }
}

$(document)["ready"](function () {
    $(".luna-loader-container")["fadeOut"]("slow");
    $(".user-type-container").show();
    $(".luna-steps")["materialInput"]();
    $(".selectpicker")["selectpicker"]();
});