@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12 ">
        @include('user.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9 mt-3">
            <div class="col-span-12 mx-3 p-3 rounded shadow md:col-span-12 h-fit bg-neutral-900">
                <div class="flex justify-start mt-2">
                    <h1 class="text-lg mb-5 font-bold text-white">Membuat Kontes</h1>
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
                            <div class="w-full lg:w-[650px]">
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
                            <div class="flex justify-between items-end w-[200px] gap-2">
                                <div class="">
                                    <label for="deadline" class="text-xs block text-white">deadline :</label>
                                    <input type="text" name="deadline" id="deadline" placeholder="format day" class="border-b bg-neutral-900 text-white w-[100px] @error('deadline') is-invalid @enderror" autocomplete="off">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="reward" class="text-xs block text-white ">reward :</label>
                                    <input id="isreward" type="text" pattern="[0-9]+" name="reward" placeholder="Reward $" class="border-b bg-neutral-900 text-white w-[100px] @error('reward') is-invalid @enderror" autocomplete="off">
                                    @error('reward')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
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
                                <label for="input_file" class="rounded px-2 bg-white cursor-pointer mt-5">Upload File</label>
                                <input id="input_file" type="file" class="bg-neutral-800 hidden" multiple>                          
                              </div>
                            </div>
                            <div class="col-span-12">
                              <ol class="text-white" id="file_list"></ol>
                            </div>
                            <script>
                                const input = document.getElementById('input_file');
                                const fileList = document.getElementById('file_list');
                                
                                // Membuat elemen style baru dan menambahkan CSS-nya
                                const style = document.createElement('style');
                                style.innerHTML = '#file_list li { margin-bottom: 5px; display: flex; justify-content: space-between; }';
                                document.head.appendChild(style);
                              
                                input.addEventListener('change', () => {
                                  // Mengambil seluruh file yang diupload
                                  const files = input.files;
                              
                                  // Menambahkan setiap nama file dan input text sebagai elemen list
                                  for (let i = 0; i < files.length; i++) {
                                    const fileName = files[i].name;
                                    const li = document.createElement('li');
                                    li.textContent = `${i + 1}) ${fileName}`;
                                    const inputText = document.createElement('input');
                                    inputText.setAttribute('type', 'text');
                                    inputText.setAttribute('maxlength', '255');
                                    inputText.setAttribute('placeholder', 'Deskripsi File');
                                    inputText.setAttribute('style', 'width: 250px; color: black;');
                                    li.appendChild(inputText);
                                    fileList.appendChild(li);
                                  }
                                });
                            </script>                                                                         
                        </div>                          
                        <div class="col-span-12 flex justify-end mt-2 gap-5">
                            <button type="submit" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">Submit</button>
                            <a href="/user" class="flex justify-center items-center text-center bg-neutral-800 text-white rounded my-3 w-28 h-7 p-1 hover:bg-stone-700">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>                 
        </div>
    </div>
</section>
@endsection