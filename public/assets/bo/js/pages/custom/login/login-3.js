"use strict";

// Class Definition
var KTLogin = function() {
    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

    var _handleFormSignin = function() {
        var form = KTUtil.getById('kt_login_singin_form');
        var formSubmitUrl = KTUtil.attr(form, 'action');
        var formSubmitButton = KTUtil.getById('kt_login_singin_form_submit_button');

        if (!form) {
            return;
        }

        FormValidation
            .formValidation(
                form, {
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
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            //	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                            //	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                        })
                    }
                }
            )
            .on('core.form.valid', function() {
                // Show loading state on button
                KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Patientez SVP");

                // Simulate Ajax request
                setTimeout(function() {
                    form.submit()
                    KTUtil.btnRelease(formSubmitButton);
                }, 2000);

                // Form Validation & Ajax Submission: https://formvalidation.io/guide/examples/using-ajax-to-submit-the-form
                /**
		        FormValidation.utils.fetch(formSubmitUrl, {
		            method: 'POST',
					dataType: 'json',
		            params: {
		                name: form.querySelector('[name="username"]').value,
		                email: form.querySelector('[name="password"]').value,
		            },
		        }).then(function(response) { // Return valid JSON
					// Release button
					KTUtil.btnRelease(formSubmitButton);

					if (response && typeof response === 'object' && response.status && response.status == 'success') {
						Swal.fire({
			                text: "All is cool! Now you submit this form",
			                icon: "success",
			                buttonsStyling: false,
							confirmButtonText: "Ok, j'ai compris!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
			            }).then(function() {
							KTUtil.scrollTop();
						});
					} else {
						Swal.fire({
			                text: "Sorry, something went wrong, please try again.",
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
				**/
            })
            .on('core.form.invalid', function() {
                Swal.fire({
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
            });
    }

    var _handleFormForgot = function() {
        var form = KTUtil.getById('kt_login_forgot_form');
        var formSubmitUrl = KTUtil.attr(form, 'action');
        var formSubmitButton = KTUtil.getById('kt_login_forgot_form_submit_button');

        if (!form) {
            return;
        }

        FormValidation
            .formValidation(
                form, {
                    fields: {
                        email: {
                            validators: {
                                notEmpty: {
                                    message: 'Email est obligatoire'
                                },
                                emailAddress: {
                                    message: 'La valeur n\'est pas une adresse e-mail valide'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                        bootstrap: new FormValidation.plugins.Bootstrap({
                            //	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
                            //	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
                        })
                    }
                }
            )
            .on('core.form.valid', function() {
                // Show loading state on button
                KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Patientez SVP");

                // Simulate Ajax request
                setTimeout(function() {
                    form.submit()
                    KTUtil.btnRelease(formSubmitButton);
                }, 2000);
            })
            .on('core.form.invalid', function() {
                Swal.fire({
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
            });
    }

    var _handleFormSignup = function() {
        // Base elements
        var wizardEl = KTUtil.getById('kt_login');
        var form = KTUtil.getById('kt_login_signup_form');
        var wizardObj;
        var validations = [];

        if (!form) {
            return;
        }

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        // Step 1
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    'ajouter_entreprise[nomEts]': {
                        validators: {
                            notEmpty: {
                                message: 'Raison social obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[typeEts]': {
                        validators: {
                            notEmpty: {
                                message: 'Type d\'entreprise obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[sousTypeEts]': {
                        validators: {
                            notEmpty: {
                                message: 'Type d\'activité obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[numSiret]': {
                        validators: {
                            notEmpty: {
                                message: 'Numéro SIRET obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[numAssurance]': {
                        validators: {
                            notEmpty: {
                                message: 'Numéro d\'assurance obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[adresse]': {
                        validators: {
                            notEmpty: {
                                message: 'Adresse obligatoire'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 2
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    'ajouter_entreprise[email]': {
                        validators: {
                            notEmpty: {
                                message: 'Adresse email obligatoire'
                            },
                            emailAddress: {
                                message: 'La valeur n\'est pas une adresse e-mail valide'
                            }
                        }
                    },
                    'ajouter_entreprise[typeRealisation]': {
                        validators: {
                            notEmpty: {
                                message: 'Type de réalisation'
                            }
                        }
                    },
                    'ajouter_entreprise[nbreOuvrier]': {
                        validators: {
                            notEmpty: {
                                message: 'Nombre d\'ouvrier'
                            }
                        }
                    },
                    'ajouter_entreprise[CA1]': {
                        validators: {
                            notEmpty: {
                                message: 'Chiffre d\'affaire 1ère année obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[CA2]': {
                        validators: {
                            notEmpty: {
                                message: 'Chiffre d\'affaire 2ème année obligatoire'
                            }
                        }
                    },
                    'ajouter_entreprise[CA3]': {
                        validators: {
                            notEmpty: {
                                message: 'Chiffre d\'affaire 3ème année obligatoire'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 3
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    'ajouter_entreprise[siteWeb]': {
                        validators: {
                            notEmpty: {
                                message: 'Site internet obligatoire'
                            }
                        }
                    },
                    /*'ajouter_entreprise[qualification]': {
                    	validators: {
                    		notEmpty: {
                    			message: 'Fichier de qualification obligatoire'
                    		}
                    	}
                    },
                    'ajouter_entreprise[certification]': {
                    	validators: {
                    		notEmpty: {
                    			message: 'Fichier de certification obligatoire'
                    		}
                    	}
                    },
                    'ajouter_entreprise[logo]': {
                    	validators: {
                    		notEmpty: {
                    			message: 'Logo obligatoire'
                    		}
                    	}
                    },
                    'ajouter_entreprise[kbis]': {
                    	validators: {
                    		notEmpty: {
                    			message: 'Fichier kbis obligatoire'
                    		}
                    	}
                    },
                    'ajouter_entreprise[attestation]': {
                    	validators: {
                    		notEmpty: {
                    			message: 'Attestation obligatoire'
                    		}
                    	}
                    }*/
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Step 4
        validations.push(FormValidation.formValidation(
            form, {
                fields: {
                    ccname: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card name is required'
                            }
                        }
                    },
                    ccnumber: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card number is required'
                            },
                            creditCard: {
                                message: 'The credit card number is not valid'
                            }
                        }
                    },
                    ccmonth: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card month is required'
                            }
                        }
                    },
                    ccyear: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card year is required'
                            }
                        }
                    },
                    cccvv: {
                        validators: {
                            notEmpty: {
                                message: 'Credit card CVV is required'
                            },
                            digits: {
                                message: 'The CVV value is not valid. Only numbers is allowed'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
        ));

        // Initialize form wizard
        wizardObj = new KTWizard(wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
        });

        // Validation before going to next page
        wizardObj.on('beforeNext', function(wizard) {
            validations[wizard.getStep() - 1].validate().then(function(status) {
                if (status == 'Valid') {

                    $('#s1').text($('#ajouter_entreprise_nomEts').val());

                    $('#s2').text($('#ajouter_entreprise_typeEts').val());

                    $('#s3').text($('#ajouter_entreprise_sousTypeEts').val());

                    $('#s4').text($('#ajouter_entreprise_numSiret').val());

                    $('#s5').text($('#ajouter_entreprise_numAssurance').val());

                    $('#s6').text($('#ajouter_entreprise_adresse').val());

                    $('#s7').text($('#ajouter_entreprise_email').val());

                    $('#s8').text($('#ajouter_entreprise_typeRealisation').val());

                    $('#s9').text($('#ajouter_entreprise_nbreOuvrier').val());

                    $('#s10').text($('#ajouter_entreprise_CA1').val());

                    $('#s11').text($('#ajouter_entreprise_CA2').val());

                    $('#s12').text($('#ajouter_entreprise_CA3').val());

                    $('#s13').text($('#ajouter_entreprise_siteWeb').val());


                    //}
                    wizardObj.goNext();
                    KTUtil.scrollTop();
                } else {
                    Swal.fire({
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

            wizardObj.stop(); // Don't go to the next step
        });

        // Change event
        wizardObj.on('change', function(wizard) {
            KTUtil.scrollTop();
        });
    }

    // Public Functions
    return {
        init: function() {
            _handleFormSignin();
            _handleFormForgot();
            _handleFormSignup();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
    /*	
    $('#kt_login_signup_form_submit_button').click(function() {
    	alert( "Handler for .click() called." );
    });*/
});