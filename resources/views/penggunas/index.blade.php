<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Penggunas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Halaman Pengguna</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('penggunas.create') }}" class="btn btn-md btn-success mb-3">Tambah Pengguna</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Nama Lengkap</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Username</th>
                                <th scope="col">Password</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($penggunas as $pengguna)
                                <tr>
                                    <td>{{ $pengguna->nama_lengkap }}</td>
                                    <td>{{ $pengguna->alamat }}</td>
                                    <td>{{ $pengguna->jenis_kelamin }}</td>
                                    <td>{{ $pengguna->username }}</td>
                                    <td>{{ $pengguna->password }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('penggunas.destroy', $pengguna->id) }}" method="POST">
                                            <a href="{{ route('penggunas.show', $pengguna->id) }}" class="btn btn-sm btn-dark">Lihat</a>
                                            <a href="{{ route('penggunas.edit', $pengguna->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Pengguna belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'Berhasil!'); 
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'Gagal!'); 
        @endif
    </script>

</body>
</html>
