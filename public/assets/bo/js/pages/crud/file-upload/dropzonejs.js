"use strict";
// Class definition

var KTDropzoneDemo = function () {
    // Private functions
    var demo1 = function () {
        // file type validation
        //$('#kt_dropzone_3').dropzone({
        var dropzone = new Dropzone('#kt_dropzone_3', {
            url: "/admin/settings/photo/add", // Set the url for your upload script location
            paramName: "image", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            acceptedFiles: "image/*",
            accept: function(file, done) {
                if (file.name == "justinbieber.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            },

            dictDefaultMessage: 'Déposer des fichiers ici pour télécharger',
            dictFallbackMessage: 'Votre navigateur ne prend pas en charge les téléchargements de fichiers par glisser-déposer.',
            dictFallbackText: 'Veuillez utiliser le formulaire de secours ci-dessous pour télécharger vos fichiers comme autrefois.',
            dictFileTooBig: 'Le fichier est trop gros ({{filesize}} Mo). Taille maximale du fichier: {{maxFilesize}} Mo.',
            dictInvalidFileType: 'Vous ne pouvez pas télécharger de fichiers de ce type.',
            dictResponseError: 'Le serveur a répondu avec le code {{statusCode}}.',
            dictCancelUpload: 'Annuler le téléchargement',
            dictCancelUploadConfirmation: 'Voulez-vous vraiment annuler ce téléchargement?',
            dictRemoveFile: 'Supprimer le fichier',
            dictMaxFilesExceeded: 'Vous ne pouvez plus télécharger de fichiers.'
        });

        dropzone.on('queuecomplete', function(files)  {
            window.location.replace("/admin/settings/photos");
        });
    }

    return {
        // public functions
        init: function() {
            demo1();
        }
    };
}();

KTUtil.ready(function() {
    KTDropzoneDemo.init();
});
