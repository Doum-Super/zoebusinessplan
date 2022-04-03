"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'), {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Email obligatoire'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Mot de passe obligatoire'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signin_submit').on('click', function(e) {
            e.preventDefault();

            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    swal.fire({
                        text: "Tout est cool! Vous soumettez maintenant ce formulaire",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        //alert('hello');
                        KTUtil.scrollTop();
                        $('#kt_login_signin_form').submit();


                    });
                } else {
                    swal.fire({
                        text: "Désolé, il semble qu'il y ait des erreurs détectées, veuillez réessayer.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function(e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function(e) {
            // alert('hello');
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function() {
        var validation;

        //alert('hello');
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signup_form'), {
                fields: {
                    'inscription[firstName]': {
                        validators: {
                            notEmpty: {
                                message: 'Prénom obligatoire'
                            }
                        }
                    },
                    'inscription[nom]': {
                        validators: {
                            notEmpty: {
                                message: 'Nom obligatoire'
                            }
                        }
                    },
                    'inscription[email]': {
                        validators: {
                            notEmpty: {
                                message: 'Adresse e-mail est nécessaire'
                            },
                            emailAddress: {
                                message: 'La valeur n\'est pas une adresse e-mail valide'
                            }
                        }
                    },
                    'inscription[pwd]': {
                        validators: {
                            notEmpty: {
                                message: 'Le mot de passe est requis'
                            }
                        }
                    },
                    'inscription[repwd]': {
                        validators: {
                            notEmpty: {
                                message: 'La confirmation du mot de passe est obligatoire'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Le mot de passe et sa confirmation ne sont pas les mêmes'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'Vous devez accepter les Termes et Conditions'
                            }
                        }
                    },
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        $('#kt_login_signup_submit').on('click', function(e) {
            e.preventDefault();

            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    swal.fire({
                        text: "Tout est cool! Vous soumettez maintenant ce formulaire",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                        $('#kt_login_signup_form').submit();
                    });
                } else {
                    swal.fire({
                        text: "Désolé, il semble qu'il y ait des erreurs détectées, veuillez réessayer.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function(e) {
            e.preventDefault();
            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_forgot_form'), {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Adresse e-mail est nécessaire'
                            },
                            emailAddress: {
                                message: 'La valeur n\'est pas une adresse e-mail valide'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        );

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function(e) {
            e.preventDefault();

            validation.validate().then(function(status) {
                if (status == 'Valid') {
                    swal.fire({
                        text: "Tout est cool! Vous soumettez maintenant ce formulaire",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        // Submit form
                        KTUtil.scrollTop();
                        $('#kt_login_forgot_form').submit();
                        //KTUtil.scrollTop();
                    });


                } else {
                    swal.fire({
                        text: "Désolé, il semble qu'il y ait des erreurs détectées, veuillez réessayer.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, j'ai compris!",
                        customClass: {
                            confirmButton: "btn font-weight-bold btn-light-primary"
                        }
                    }).then(function() {
                        KTUtil.scrollTop();
                    });
                }
            });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function(e) {
            e.preventDefault();
            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
