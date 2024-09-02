$(document).on("submit", ".default-form", function (event) {    
    event.preventDefault();
    const button = $(this).find(":submit");        
    store_data(this, button);
});

function store_data(content, button) {
    $("input").blur();

    $(content).find('.is-invalid').removeClass('is-invalid');
    $(content).find('.invalid-feedback').html(null).removeClass('d-block');

    let form_data = new FormData(content);
    let action = $(content).attr("action");
    let callback = $(content).attr("function-callback") ?? null;

    $.ajax({
        url: action,
        type: "POST",
        data: form_data,
        processData: false, // tell jQuery not to process the data
        contentType: false, // tell jQuery not to set contentType
        cache: false,
        success: function (response) {            
            if (!response.error) {                
                if (
                    (response.data == null) ||
                    (response.data != null && !response.data.ignore_alert)
                ) {
                    alert(response.message)
                    location.reload()
                }

                if (typeof window[callback] === "function") window[callback](response);                               
            } else {
               alert(response.message)
            }            
        },
        error: (xhr, status, error) => {            
            let res = xhr.responseJSON;
            if (res.errors) {
                let error = ''
                $.each(res.errors, function (key, value) {
                    error += `${value[0]}\n`
                });

                alert(error)
            } else {
               alert(res.message);
            }
        },
    }).always(function () {
        
    });
}

$('.modal').on('hide.bs.modal', function () {
    let form = $(this).find('form');

    form.trigger('reset');
    form.find('.select2').val(null).trigger('change');
    form.find('.select2_custom').val(null).trigger('change');
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').html(null).removeClass('d-block');

    // reset flatpickr
    form.find('.flatpickr-date').val(null).trigger('change');
    form.find('.flatpickr-date').flatpickr({
        altInput: true,
        altFormat: 'j F Y',
        dateFormat: 'Y-m-d'
    });
});

$(document).on('click', '.update-status', function () {
    let url = $(this).data('url');
    let dataFunction = $(this).attr('data-function');

    sweetAlertConfirm({
        title: 'Apakah anda yakin?',
        text: 'Anda akan mengubah status data ini.',
        icon: 'warning',
        confirmButtonText: 'Ya, saya yakin!',
        cancelButtonText: 'Batal'
    }, function () {
        $.ajax({
            url: url,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (!response.error) {
                    showSweetAlert({
                        title: response.title ?? 'Berhasil!',
                        text: response.message,
                        icon: response.icon ?? 'success',
                        showConfirmButton: response.showConfirmButton
                    });

                    if (typeof window[dataFunction] === "function") window[dataFunction](response);
                } else {
                    showSweetAlert({
                        title: 'Gagal!',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function (xhr, status, error) {
                let res = xhr.responseJSON;
                showSweetAlert({
                    title: 'Gagal!',
                    text: res.message,
                    icon: 'error'
                });
            }
        });
    });
});

function initDataFilter(){
    let inputs = document.querySelectorAll('input[data-filter]');
    for (let input of inputs) {
    let state = {
        value: input.value,
        start: input.selectionStart,
        end: input.selectionEnd,
        pattern: RegExp('^' + input.dataset.filter + '$')
    };

    input.addEventListener('input', event => {
        if (state.pattern.test(input.value)) {
        state.value = input.value;
        } else {
        input.value = state.value;
        input.setSelectionRange(state.start, state.end);
        }
    });

    input.addEventListener('keydown', event => {
        state.start = input.selectionStart;
        state.end = input.selectionEnd;
    });
    }
}