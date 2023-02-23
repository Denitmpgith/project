@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
    @include('user.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9">
            <div class="col-span-12 m-3 p-3 rounded-xl shadow md:col-span-12 h-fit">
                <div class="flex justify-start mt-2">
                    <h1 class="text-lg mb-5 font-bold">Membuat Kontes</h1>
                </div>
                <form action="/user" method="post">
                    @csrf
                    <div class="space-y-4">
                        <div class="grid grid-cols-12 gap-5 items-end">
                            <div class="col-span-10">
                                <label for="user_id" class="block text-gray-700 font-bold">Owner of this Contest</label>
                                <input type="text" name="user_id" id="user_id" placeholder="{{ $auth->user_detiles->first_name }} {{ $auth->user_detiles->middle_name }} {{ $auth->user_detiles->last_name }}" class="block w-full border rounded-md py-2 px-3 @error('user_id') is-invalid @enderror" readonly>
                                @error('user_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-2">
                                <label for="reward" class="block text-gray-700 font-bold">Reward $</label>
                                <input type="text" pattern="[0-9]+" name="reward" id="reward" placeholder="Reward $" class="text-end block w-full border rounded-md py-2 px-3 @error('reward') is-invalid @enderror" value="{{ old('reward') }}" autofocus autocomplete="off">
                                @error('reward')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>                                                                      
                        <div class="grid grid-cols-12 gap-5 items-end">
                            <div class="col-span-12 md:col-span-6 lg:col-span-7">
                                <label for="title" class="block text-gray-700 font-bold">Title :</label>
                                <input type="text" name="title" id="title" placeholder="Title" class="block w-full border rounded-md py-2 px-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" autocomplete="off">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-span-12 flex justify-end items-end gap-3 md:col-start-7 md:col-span-6 lg:col-start-8 lg:col-span-5 ">
                                <div class="">
                                    <label for="deadline" class="block text-gray-700 font-bold">Deadline Day</label>
                                    <input type="text" name="deadline" id="deadline" placeholder="DeadLine in Day" class="text-right block w-full border rounded-md py-2 px-3 @error('deadline') is-invalid @enderror" autocomplete="off">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="level" class="block text-gray-700 font-bold text-left">level</label>
                                    <select class="h-10 px-5 rounded-lg" name="level">
                                    @if(!is_null($levels))
                                    @foreach($levels as $level)
                                            <option value="{{ $level['level'] }}">{{ $level['level'] }}</option>
                                        @endforeach
                                    @endif
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="description" class="text-gray-700 font-bold">Description :</label>
                            <textarea name="description" id="description" placeholder="Description" rows="5" class="w-full border rounded-md px-3 pt-1 @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 flex justify-between items-end mt-2 gap-5 lg:col-span-9">
                            {{-- <form method="post" action="/user" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-12">
                                    <div class="col-span-6 flex justify-start items-center lg:col-span-9">
                                        <input type="text" name="title" id="title" class="block w-full border rounded-md py-1 px-2 @error('title') is-invalid @enderror" placeholder="Description of file" autocomplete="off">
                                        @error('title')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 lg:col-span-3">
                                        <input type="file" name="files[]" id="files" class="w-full rounded-md py-1 px-2 @error('file') is-invalid @enderror" multiple autocomplete="off">
                                        @error('file')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </form>                    --}}
                        </div>
                        <div class="col-span-12 flex justify-between mt-2 gap-5 lg:col-span-3">
                            <button type="submit" class="bg-green-600 text-white font-bold py-2 px-8 rounded-lg hover:bg-green-800">Submit</button>
                            <a href="/user" class="bg-yellow-600 text-white font-bold py-2 px-9 rounded-lg hover:bg-yellow-800">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>                 
        </div>
    </div>
</section>
@endsection
