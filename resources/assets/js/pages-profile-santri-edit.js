'use strict';

document.addEventListener('DOMContentLoaded', function () {
  const formEl = document.getElementById('formAccountSettings');
  if (!formEl) return;

  const fv = FormValidation.formValidation(formEl, {
    fields: {
      username: {
        validators: {
          notEmpty: { message: 'Username wajib diisi' },
          stringLength: {
            min: 3,
            max: 50,
            message: 'Username harus 3-50 karakter'
          }
        }
      },
      password: {
        validators: {
          stringLength: {
            min: 6,
            message: 'Password minimal 6 karakter'
          }
        }
      },
      password_confirmation: {
        validators: {
          identical: {
            compare: function () {
              return formEl.querySelector('[name="password"]').value;
            },
            message: 'Konfirmasi password harus sama dengan password'
          }
        }
      },
      nama_lengkap: {
        validators: {
          notEmpty: {
            message: 'Nama lengkap wajib diisi'
          },
          stringLength: {
            max: 50,
            message: 'Nama lengkap maksimal 50 karakter'
          }
        }
      },
      nama_panggil: {
        validators: {
          notEmpty: {
            message: 'Nama panggilan wajib diisi'
          },
          stringLength: {
            max: 50,
            message: 'Nama panggilan maksimal 50 karakter'
          }
        }
      },
      tanggal_lahir: {
        validators: {
          notEmpty: {
            message: 'Tanggal lahir wajib diisi'
          }
        }
      },
      jenis_kelamin: {
        validators: {
          notEmpty: {
            message: 'Jenis kelamin wajib dipilih'
          }
        }
      },
      pendidikan_asal: {
        validators: {
          notEmpty: {
            message: 'Pendidikan asal wajib diisi'
          }
        }
      },
      alamat: {
        validators: {
          notEmpty: {
            message: 'Alamat wajib diisi'
          },
          stringLength: {
            max: 255,
            message: 'Alamat maksimal 255 karakter'
          }
        }
      },
      no_telepon: {
        validators: {
          stringLength: {
            max: 14,
            message: 'No Telepon maksimal 14 karakter'
          },
          regexp: {
            regexp: /^[0-9+\s()-]+$/,
            message: 'Format No Telepon tidak valid'
          }
        }
      },
      email: {
        validators: {
          emailAddress: {
            message: 'Format email tidak valid'
          },
          stringLength: {
            max: 50,
            message: 'Email maksimal 50 karakter'
          }
        }
      },
      nama_ayah: {
        validators: {
          notEmpty: {
            message: 'Nama ayah wajib diisi'
          }
        }
      },
      pekerjaan_ayah: {
        validators: {
          notEmpty: {
            message: 'Pekerjaan ayah wajib diisi'
          }
        }
      },
      no_hp_ayah: {
        validators: {
          notEmpty: {
            message: 'No HP ayah wajib diisi'
          }
        }
      },
      nama_ibu: {
        validators: {
          notEmpty: {
            message: 'Nama ibu wajib diisi'
          }
        }
      },
      pekerjaan_ibu: {
        validators: {
          notEmpty: {
            message: 'Pekerjaan ibu wajib diisi'
          }
        }
      },
      no_hp_ibu: {
        validators: {
          notEmpty: {
            message: 'No HP ibu wajib diisi'
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
});
