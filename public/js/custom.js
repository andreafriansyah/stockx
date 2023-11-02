$(document).ready(function () {
    // Saat input berubah (user memilih gambar), tampilkan pratinjau gambar
    $("#foto").change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#imagePreview").attr("src", e.target.result).show();
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            $("#imagePreview").hide();
        }
    });

    $("#list-barang").change(function () {
        var input = this.value;
       
        fetchData(input)
    });
});

function fetchData(selectedValue) {
    console.log(selectedValue)
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open('GET', '/barang/detail-barang/' + selectedValue, true);

    // Define a callback function to handle the response
    xhr.onload = function() {
      if (xhr.status >= 200 && xhr.status < 300) {
        // Request was successful
        var response = JSON.parse(xhr.responseText);

        $('#hm_input').val(response.data.harga_modal);
        $('#harga_modal').val('Rp ' + formatRupiah(response.data.harga_modal));

        
        $('#hj_input').val(response.data.harga_jual);
        $('#harga_jual').val('Rp ' + formatRupiah(response.data.harga_jual));

        // var imageServerURL = 'localhost:8000/storage' + response.data.foto
        $("#imagePreview").attr("src", response.data.foto).show();
            // reader.readAsDataURL(input.files[0]);
        console.log(response)
        // document.getElementById('result').textContent = response.data;
      } else {
        // Request failed
        document.getElementById('result').textContent = 'Error: ' + xhr.status;
      }
    };

    // Send the request
    xhr.send();
  }

function hargaJualInput() {
    let rupiahValue = $('#harga_jual').val().replace(/\D/g, '');
    let intValue = parseInt(rupiahValue);

    // Format as Indonesian Rupiah
    value = 'Rp ' + formatRupiah(rupiahValue);

    $('#harga_jual').val(value);
    $('#hj_input').val(intValue);
}

function hargaModalInput() {
    let rupiahValue = $('#harga_modal').val().replace(/\D/g, '');
    let intValue = parseInt(rupiahValue);

    // Format as Indonesian Rupiah
    value = 'Rp ' + formatRupiah(rupiahValue);

    $('#harga_modal').val(value);
    $('#hm_input').val(intValue);
}

function formatRupiah(angka) {
    var reverse = angka.toString().split('').reverse().join('');
    var thousands = reverse.match(/\d{1,3}/g);
    var formatted = thousands.join('.').split('').reverse().join('');
    return formatted;
}

function deleteBarang(itemId) {
    if (confirm('Anda yakin ingin menghapus item ini?')) {
        fetch(`/barang/delete/${itemId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.code == 204) {
                Swal.fire({
                    title: 'Sukses',
                    text: data.message,
                    icon: 'success'
                });

                // Item berhasil dihapus
                const itemElement = document.querySelector(`#delete-barang[data-id="${itemId}"]`);
                itemElement.closest('tr').remove();
            } else if (data.code == 400) {
                // Item tidak ditemukan
                Swal.fire({
                    title: 'Kesalahan',
                    text: data.message,
                    icon: 'error'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Kesalahan',
                text: data.error,
                icon: 'error'
            });
        });
    }


    document.getElementById('list-barang').addEventListener('change', function() {
        // Get the selected value
        var selectedValue = this.value;

        console.log(selectedValue)
  
        // Call the fetchData function with the selected value
        fetchData(selectedValue);
      });
  
}
