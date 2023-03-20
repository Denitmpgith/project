@extends('template.main')
@section('container')
<section class="grid grid-cols-12">
    @include('user.welcome')
    <div class="col-span-12 grid grid-cols-12">
        @include('user.acc')
        <div class="col-span-12 grid grid-cols-12 md:col-span-12 h-fit lg:col-start-4 lg:col-span-9">
            <div class="col-span-12 m-3 p-3 rounded shadow md:col-span-12 h-fit">
                <div class="flex justify-start mt-2">
                    <h1 class="text-lg mb-5 font-bold">Membuat Kontes</h1>
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
                        <div class="flex justify-between items-end flex-wrap">
                            <div class="w-[650px]">
                                <div class="flex justify-between items-end">
                                    <div>
                                        <label for="title" class="text-xs block text-gray-700">&nbsp;&nbsp;&nbsp;&nbsp;Title :</label>
                                        <input type="text" name="title" id="title" placeholder="Title" class="w-[570px] px-3 @error('title') is-invalid @enderror" value="{{ old('title') }}" autofocus autocomplete="off">
                                    </div>
                                </div>
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="flex justify-between items-end w-[200px] gap-1 ">
                                <div class="">
                                    <label for="deadline" class="text-xs block text-gray-700">deadline :</label>
                                    <input type="text" name="deadline" id="deadline" placeholder="format day" class="w-[100px] @error('deadline') is-invalid @enderror" autocomplete="off">
                                    @error('deadline')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="reward" class="text-xs block text-gray-700 ">reward :</label>
                                    <input id="isreward" type="text" pattern="[0-9]+" name="reward" placeholder="Reward $" class="w-[100px] @error('reward') is-invalid @enderror" autocomplete="off">
                                    @error('reward')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12">
                            <label for="description" class="text-gray-700 font-bold">Description :</label>
                            <textarea name="description" id="description" placeholder="Description" rows="5" class="w-full border rounded px-3 pt-1 @error('description') is-invalid @enderror" value="{{ old('description') }}"></textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-12">
                        <div class="col-span-12 flex justify-between items-end mt-2 gap-5 lg:col-span-9">
                        </div>
                        <div class="col-span-12 flex justify-end mt-2 gap-5 lg:col-span-3">
                            <button type="submit" class="bg-green-600 text-white font-bold py-1 px-8 rounded-lg hover:bg-green-800">Submit</button>
                            <a href="/user" class="bg-yellow-600 text-white font-bold py-1 px-9 rounded-lg hover:bg-yellow-800">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>                 
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>
        const rewardInput = document.getElementById('isreward');
        const levelInput = document.getElementById('islevel');

        rewardInput.addEventListener('input', () => {
            const rewardValue = rewardInput.value;
            let levelValue = '';

            if (rewardValue < 100) {
                levelValue = 'Stone';
            } else if (rewardValue < 200) {
                levelValue = 'Bronze';
            } else if (rewardValue < 300) {
                levelValue = 'Silver';
            } else if (rewardValue < 400) {
                levelValue = 'Gold';
            } else if (rewardValue < 500) {
                levelValue = 'Platinum';
            } else if (rewardValue > 501) {
                levelValue = 'Diamond';
            } else {
                levelValue = '';
            }

            levelInput.value = levelValue;
        });
    </script>
@endsection`
