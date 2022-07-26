<script>
    
    $(document).ready(function(){
        tampilDataBarang(); //menampilkan data dari jquery
        tampilBarangKeluar(); //menampilkan data dari jquery
        
        // fungsi menampilkan semua data barang
        function tampilDataBarang(){
            $.ajax({
                type: "GET",
                url: "/tampil-barang",
                dataType: "json",
                success: function(response){
                    // console.log(response.barang);
                    $('#tblMasterBarang').html("");
                    var no = 1;
                    $.each(response.barang, function(key, item){
                        if (item.status_barang == 1) {
                            status = "Available";
                        } else {
                            status = "Not Available"
                        }
                        $('#tblMasterBarang').append('<tr>' +
                            '<td align="center">'+ no+++'</th>' +
                            '<td align="center">'+ item.kode_barang +'</td>' +
                            '<td>'+ item.nama_barang +'</td>' +
                            '<td align="center">'+ item.jumlah_barang + '</td>' +
                            '<td align="center">'+ item.satuan_barang +'</td>' +
                            '<td align="center">'+ rupiah(item.harga_beli) +'</td>' +
                            '<td align="center">'+ status +'</td>' +
                            '<td align="center">' +
                                '<div class="dropdown">' +
                                    '<button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false"></button>' +
                                    '<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">' +
                                        '<li><button id="btnModalBarangKeluar" type="button" value="'+item.id+'" class="dropdown-item">Barang Keluar</button></li>' +
                                        '<li><button id="btnEdit" type="button" value="'+item.id+'" class="dropdown-item">Edit</button></li>' +
                                        '<li><button id="btnHapus" type="button" value="'+item.id+'" class="dropdown-item"><span class="text-danger">Hapus</span></button></li>' +
                                    '</ul>' +
                                '</div>' +
                            '</td>' +
                            '</tr>');
                    });
                }
            });
        }

        // fungsi menampilkan data barang keluar
        function tampilBarangKeluar(){
            $.ajax({
                type: "GET",
                url: "/tampil-barangkeluar",
                dataType: "json",
                success: function(response){
                    // console.log(response.barangkeluar);
                    $('#tblBarangKeluar').html("");
                    var no = 1;
                    $.each(response.barangkeluar, function(key, item){
                        if (item.status_barang == 1) {
                            status = "Available";
                        } else {
                            status = "Not Available"
                        }
                        $('#tblBarangKeluar').append('<tr>' +
                            '<td align="center">'+ no+++'</th>' +
                            '<td align="center">'+ item.kode_barang +'</td>' +
                            '<td>'+ item.nama_barang +'</td>' +
                            '<td align="center">'+ item.jumlah + '</td>' +
                            '<td align="center">'+ item.satuan_barang +'</td>' +
                            '<td align="center">'+ item.created_at +'</td>' +
                            '<td align="center">'+ 
                                '<input type="hidden" id="item_jumlahkeluar" value="'+item.jumlah+'">' +
                                '<input type="hidden" id="id_keluar" value="'+item.id_keluar+'">' +
                                '<button id="btnBatalkan" class="btn btn-sm text-danger" value="'+item.id+'">Batalkan</button>' +
                            '</td>' +
                            '</tr>');
                    });
                }
            });
        }
                    
        // simpan data
        $("#btnSimpan").on("click", function(e){
            e.preventDefault();
            $('#modalTambah').modal("show");
            $(this).text('Simpan');
            var data = {
                'kode_barang' : $('[name="kode_barang"]').val(),
                'nama_barang' : $('[name="nama_barang"]').val(),
                'jumlah_barang' : $('[name="jumlah_barang"]').val(),
                'satuan_barang' : $('[name="satuan_barang"]').val(),
                'harga_beli' : $('[name="harga_beli"]').val(),
                'status_barang' : $('[name="status_barang"]').val()
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "POST",
                url: '/simpan-barang',
                data: data,
                dataType: "json",
                success: function(response){
                    // console.log(response);
                    if (response.status == 400) {
                        $('#kode_barang_error').append(response.errors.kode_barang);
                        $('#nama_barang_error').append(response.errors.nama_barang);
                        $('#jumlah_barang_error').append(response.errors.jumlah_barang);
                        $('#satuan_barang_error').append(response.errors.satuan_barang);
                        $('#harga_beli_error').append(response.errors.harga_beli);
                        $('#status_barang_error').append(response.errors.status_barang);
                    }
                    else if(response.status == 404){
                        Toast.fire({icon: 'success', title: response.message});
                    }
                    
                    else {
                        Toast.fire({icon: 'success', title: response.message});
                        $("#modalTambah").modal("hide");
                        $("#btnUpdate").text('Simpan');
                        $("#modalTambah").find('input').val("");
                        tampilDataBarang();
                        tampilBarangKeluar();
                    }
                }
            })
        });
                    
        $(document).on("click", "#btnEdit", function(e){
            var id = $(this).val();
            // alert(id);
            $("#modalEdit").modal("show");
            $.ajax({
                type:"GET",
                url: '/edit-barang/'+id,
                success: function(response){
                    // console.log(response);
                    if (response.status == 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                    else{
                        $('[name="edit_kode_barang"]').val(response.barang.kode_barang);
                        $('[name="edit_nama_barang"]').val(response.barang.nama_barang);
                        $('[name="edit_jumlah_barang"]').val(response.barang.jumlah_barang);
                        $('[name="edit_satuan_barang"]').val(response.barang.satuan_barang);
                        $('[name="edit_harga_beli"]').val(response.barang.harga_beli);
                        $('[name="edit_status_barang"]').val(response.barang.status_barang);
                        $('[name="edit_id"]').val(id);
                    }
                }
            });
        })
                    
        // update data
        $("#btnUpdate").on("click", function(e){
            e.preventDefault();
            $(this).text('updating');
            var id = $('[name="edit_id"]').val();
            var data = {
                'kode_barang' : $('[name="edit_kode_barang"]').val(),
                'nama_barang' : $('[name="edit_nama_barang"]').val(),
                'jumlah_barang' : $('[name="edit_jumlah_barang"]').val(),
                'satuan_barang' : $('[name="edit_satuan_barang"]').val(),
                'harga_beli' : $('[name="edit_harga_beli"]').val(),
                'status_barang' : $('[name="edit_status_barang"]').val()
            }
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type: "PUT",
                url: 'update-barang/' + id,
                data: data,
                dataType: "json",
                success: function(response){
                    // console.log(response);
                    if (response.status == 400) {
                        $('#kode_barang_error_edit').append(response.errors.kode_barang);
                        $('#nama_barang_error_edit').append(response.errors.nama_barang);
                        $('#jumlah_barang_error_edit').append(response.errors.jumlah_barang);
                        $('#satuan_barang_error_edit').append(response.errors.satuan_barang);
                        $('#harga_beli_error_edit').append(response.errors.harga_beli);
                        $('#status_barang_error_edit').append(response.errors.status_barang);
                        
                        $("#btnUpdate").text('updating');
                        
                    }
                    else if(response.status == 404){
                        Toast.fire({icon: 'success', title: response.message});
                    }
                    
                    else {
                        Toast.fire({icon: 'success', title: response.message});
                        $("#modalEdit").modal("hide");
                        $("#btnUpdate").text('Update');
                        tampilDataBarang();
                        tampilBarangKeluar();
                    }
                }
            })
        });

        // modal barang keluar
        $(document).on("click", "#btnModalBarangKeluar", function(e){
            var id = $(this).val();
            // alert(id);
            $("#modalBarangKeluar").modal("show");
            $("#keluar_jumlah_barangkeluar").focus();
            $.ajax({
                type:"GET",
                url: '/edit-barang/'+id,
                success: function(response){
                    // console.log(response);
                    if (response.status == 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                    else{
                        $('[name="keluar_kode_barang"]').val(response.barang.kode_barang);
                        $('[name="keluar_nama_barang"]').val(response.barang.nama_barang);
                        $('[name="keluar_jumlah_barang"]').val(response.barang.jumlah_barang);
                        $('[name="keluar_id"]').val(id);
                      
                    }
                }
            });
        })

        // sumbit barang keluar
        $("#btnSubmitKeluar").on("click", function(e){
            e.preventDefault();
            var stok = $('[name="keluar_jumlah_barang"]').val();
            var id_barang = $('[name="keluar_id"]').val();
            var jumlah_barang = $('[name="keluar_jumlah_barangkeluar"]').val();
            var data = {
                'id_barang' : id_barang,
                'jumlah_barang' : jumlah_barang
            };

            if (jumlah_barang == 0) {
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jumlah tidak boleh kosong',
                });
            } else {
                 if (stok - jumlah_barang < 0) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Stok tidak mencukupi',
                    });
                } else {
                    $(this).text('submitting ...');
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                
                    $.ajax({
                        type: "POST",
                        url: '/submit-barangkeluar',
                        data: data,
                        dataType: "json",
                        success: function(response){
                            // console.log(response);
                            if (response.status == 400) {
                                $('#jumlah_barang_error_keluar').append(response.errors.jumlah_barang);
                                $("#btnSubmitKeluar").text('update');
                                
                            }
                            else if(response.status == 404){
                                Toast.fire({icon: 'success', title: response.message});
                            }
                            
                            else {
                                Toast.fire({icon: 'success', title: response.message});
                                $("#modalBarangKeluar").modal("hide");
                                $("#btnSubmitKeluar").text('Submit');
                                $("#modalBarangKeluar").find('input').val("");
                                tampilDataBarang();
                                tampilBarangKeluar();
                            }
                        }
                    });
                }
            }
            
            
        });

        // Fungsi klik batalkan barang keluar
            $(document).on("click", "#btnBatalkan", function(e){
                e.preventDefault();
                var id_barang = $(this).val();
                var id_keluar = $("#id_keluar").val();
                var item_jumlahkeluar = $("#item_jumlahkeluar").val();
                var data = {'id_barang' : id_barang, 'jumlah_keluar' : item_jumlahkeluar, 'id_keluar':id_keluar};
                Swal.fire({
                    title: 'Anda yakin membatalkan data?',
                    showDenyButton: true,
                    confirmButtonText: 'Tutup',
                    denyButtonText: `Ya, Batalkan`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    tampilBarangKeluar;
                    tampilDataBarang;
                } else if (result.isDenied) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type:"PUT",
                        data : data,
                        dataType:"json",
                        url: "/batalkan/"+id_keluar,
                        success:function(response){
                            Toast.fire({icon: 'success', title: 'Sukses' });
                            tampilBarangKeluar();
                            tampilDataBarang();
                        }
                    });
                }
                })
            })
        
                    
        // tampilkan modal hapus
        $(document).on("click", "#btnHapus", function(e){
            e.preventDefault();
            var id = $(this).val();
            $("#modalHapus").modal("show");
            $('[name="hapus_id"]').val(id);
        })
        
        // hapus data
        $("#btnDestroy").on("click", function(e){
            e.preventDefault();
            var id = $('[name="hapus_id"]').val();
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                type:"DELETE",
                url: "/hapus-barang/"+id,
                success:function(response){
                    Toast.fire({icon: 'success', title: response.message});
                    $("#modalHapus").modal("hide");
                    tampilDataBarang();
                    tampilBarangKeluar();
                }
            });
        });

    });
                
    // configurasi notifikasi toastr
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: false,
    })
        
    // fungsi format rupiah
    const rupiah = (number)=>{
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR"
        }).format(number);
    }
</script>
                