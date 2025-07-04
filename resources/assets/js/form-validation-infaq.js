// Form Validation for Tambah Infaq Page
'use strict';

(function () {
  window.Helpers.initCustomOptionCheck();

  const flatPickrTanggal = document.querySelector('#tanggal');
  if (flatPickrTanggal) {
    flatPickrTanggal.flatpickr({
      allowInput: true,
      dateFormat: 'Y-m-d'
    });
  }

  const bsValidationForms = document.querySelectorAll('.needs-validation');
  Array.prototype.slice.call(bsValidationForms).forEach(function (form) {
    form.addEventListener(
      'submit',
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      },
      false
    );
  });

  const formEl = document.querySelector('form[action*="infaq"]');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      nominal: {
        validators: {
          notEmpty: { message: 'Nominal wajib diisi' },
          numeric: { message: 'Nominal harus berupa angka' },
          greaterThan: {
            inclusive: false,
            min: 0,
            message: 'Nominal harus lebih dari 0'
          }
        }
      },
      tanggal: {
        validators: {
          notEmpty: { message: 'Tanggal wajib diisi' },
          date: {
            format: 'YYYY-MM-DD',
            message: 'Format tanggal tidak valid'
          }
        }
      },
      keterangan: {
        validators: {
          stringLength: {
            max: 255,
            message: 'Keterangan maksimal 255 karakter'
          }
        }
      }
    },
    plugins: {
      trigger: new FormValidation.plugins.Trigger(),
      bootstrap5: new FormValidation.plugins.Bootstrap5({
        eleValidClass: '',
        rowSelector: '.col-md-6, .col-md-12, .col-12'
      }),
      submitButton: new FormValidation.plugins.SubmitButton(),
      defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
      autoFocus: new FormValidation.plugins.AutoFocus()
    }
  });
})();
