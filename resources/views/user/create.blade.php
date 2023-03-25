@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12 ">
        @include('user.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9 mt-3">
            <div class="col-span-12 mx-3 p-3 rounded shadow md:col-span-12 h-fit bg-neutral-900">
                <div class="flex justify-between flex-wrap mt-2">
                    <h1 class="text-lg mb-5 font-bold text-white">Membuat Kontes</h1>
                    @if($saldo == 'nol')
                    <p class="text-white">saldo anda : nol <a class="text-green-600" href="/deposit/{{ $auth->username}}" title="halaman untuk pengisian saldo">( Klik untuk mengisi saldo )</a></p>
                    @else
                    <p class="text-white">Saldo Anda: Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                    @endif
                </div>
                <form action="/user" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="col-span-10 hidden">
                            <input type="text" name="user_id" id="user_id" placeholder="{{ $auth->user_detiles->first_name }} {{ $auth->user_detiles->middle_name }} {{ $auth->user_detiles->last_name }}" class="block w-full border rounded-md py-2 px-3 @error('user_id') is-invalid @enderror" readonly>
                            @error('user_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>                                                                     
                        <div class="flex justify-between items-end flex-wrap p-3">
                            <div class="">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <label for="title" class="text-xs block text-white">&nbsp;&nbsp;&nbsp;&nbsp;Title :</label>
                                        <input type="text" name="title" id="title" placeholder="Title" class="border-b bg-neutral-900 text-white w-[570px] px-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" autofocus autocomplete="off">
                                    </div>
                                </div>
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="flex justify-between items-end gap-2" style="width: 250px">
                                <div class="">
                                    <label for="deadline" class="text-xs block text-white">deadline :</label>
                                    <input style="width: 120px" type="text" name="deadline" id="deadline" placeholder="format day" class="border-b bg-neutral-900 text-white w-[100px] @error('deadline') is-invalid @enderror" autocomplete="off">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="reward" class="text-xs block text-white ">reward :</label>
                                    <input style="width: 120px" id="isreward" type="text" pattern="[0-9]+" name="reward" placeholder="reward" class="text-right border-b bg-neutral-900 text-white w-[100px] @error('reward') is-invalid @enderror" autocomplete="off" onblur="validateReward()" onkeyup="formatNumber(this)">
                                    @error('reward')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <script>
                                        function validateReward() {
                                            var rewardInput = document.getElementById('isreward');
                                            var saldo = parseInt('{{ $saldo }}');
                                            var reward = parseInt(rewardInput.value);
                                            if (reward > saldo) {
                                                alert('Maaf, saldo Anda tidak cukup untuk melakukan Konstes.');
                                                rewardInput.value = '';
                                            }
                                        }
                                        // function formatNumber(element) {
                                        //     // Mengambil nilai pada input
                                        //     let value = element.value.replace(/\D/g, '');
                                            
                                        //     // Mengubah nilai pada input agar dipisahkan per 3 digit
                                        //     let formattedValue = new Intl.NumberFormat('id-ID').format(value);

                                        //     // Mengisi kembali nilai input dengan format baru
                                        //     element.value = formattedValue;
                                        // }
                                    </script>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 mt-2">
                            <label for="description" class="text-white">Description :</label>
                            <textarea name="description" id="description" placeholder="Description" rows="5" class="bg-neutral-900 text-white w-full border rounded px-3 pt-1 @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 bg-neutral-800 mt-2 p-3">
                            <div class="flex justify-start items-start flex-col">
                                <small class="text-white">File pendukung, yang bisa membantu pekerja untuk mengejakan perkerjaan kontes sesuai yang anda harapkan :</small>
                                <small class="text-white">Contoh kasus :</small>
                                <small class="text-white">1. jika anda mencari logo, berikan contoh logo yang ada suka, sebagai referensi</small>
                                <small class="text-white">2. jika anda mencari packaging, anda bisa upload logo dan contoh packaging lain sebagai referensi</small>
                                    <div class="flex justify-center items-center flex-col w-full">
                                        <label for="input_file" class="rounded px-5 py-1 bg-neutral-700 cursor-pointer mt-5 hover:text-white">Upload File</label>
                                        <input id="input_file" type="file" class="hidden" multiple name="input_file[]">                         
                                    </div>
                            </div>
                            <div class="col-span-12">
                            <ol class="text-white" id="file_list"></ol>
                            </div>
                            <script>
                                const input = document.getElementById('input_file');
                                const fileList = document.getElementById('file_list');
                                let lastFileNumber = 0;
                                const style = document.createElement('style');
                                style.innerHTML = '#file_list li { margin-bottom: 5px; display: flex; justify-content: space-between; }';
                                document.head.appendChild(style);
                                input.addEventListener('change', () => {
                                  const files = input.files;
                                  for (let i = 0; i < files.length; i++) {
                                    const fileName = files[i].name;
                                    let duplicateFound = false;
                                    const listItems = fileList.querySelectorAll('li');
                                    listItems.forEach((item) => {
                                      if (item.textContent.includes(fileName)) {
                                        duplicateFound = true;
                                      }
                                    });
                                    if (!duplicateFound) {
                                      const li = document.createElement('li');
                                      if (lastFileNumber > 0) {
                                        li.textContent = `${lastFileNumber + 1}) ${fileName}`;
                                      } else {
                                        li.textContent = `${i + 1}) ${fileName}`;
                                      }
                                      fileList.appendChild(li);
                                      lastFileNumber++;
                                    }
                                  }
                                });
                              </script>                                                                          
                        </div>                          
                        <div class="col-span-12 flex justify-end mt-2 gap-5">
                            <button type="submit" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">Submit</button>
                            <a href="/user" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">Cancel</a>
                        </div>
                        <div class="col-span-12 flex justify-start flex-col bg-neutral-800 mt-2 p-3">
                            <small class="text-white">Aturan kontes :</small>
                            <small class="text-white">2. jika anda mencari packaging, anda bisa upload logo dan contoh packaging lain sebagai referensi</small>
                        </div>
                    </div>
                </form>
            </div>                 
        </div>
    </div>
</section>
@endsection