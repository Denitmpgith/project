<hr class="col-span-2 mt-3">
        <div class="col-span-12 pb-2 flex justify-start text-xl font-bold text-cyan-600 ">
            <p>{{ $post->applies->count() }} applies ,&nbsp;</p>
            <p>from {{ $post->applies->groupBy('user_id')->count() }} user</p>
        </div>
        <hr class="col-span-12 mb-3">
        <ul class="col-span-12 grid grid-cols-12 gap-2 mb-2">
            <div class="col-span-12 grid grid-cols-12 gap-4">
                @foreach ($appliesData as $apply)
                <div class="col-span-12 bg-slate-200 p-2 rounded-lg md:col-span-6 lg:col-span-4 xl:col-span-3 h-fit">
                    @if ($apply['rateStatus'] == 'Winner')
                        <div class="text-{{ $apply['color'] }} px-2 flex justify-between rounded-tr-lg p-2">
                            <div class="-m-3 rounded">
                                <img src="{{ asset('default/winner3.png') }}">
                            </div>
                            <div class="flex justify-end">
                                <p>{{ $apply['rateStatus'] }}&nbsp;</p>
                                <p>$ {{ $apply['reward'] }}</p>
                            </div>
                        </div>
                    @elseif ($apply['rateStatus'] == 'Runner Up')
                    <div class="text-{{ $apply['color'] }} px-2 flex justify-between rounded-tr-lg p-2">
                        <div class="-m-3 rounded">
                            <img src="{{ asset('default/runnerup.png') }}">
                        </div>
                        <div class="flex justify-end">
                            <p>{{ $apply['rateStatus'] }}&nbsp;</p>
                            <p>$ {{ $apply['reward'] }}</p>
                        </div>
                    </div>
                    @elseif ($apply['rateStatus'] == 'norate')
                    <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                        <p>{{ $apply['rateStatus'] }}</p>
                    </div>
                    @elseif ($apply['rateStatus'] == 'Reject')
                    <div class="text-{{ $apply['color'] }} bg-white px-2 flex justify-between rounded-t-lg">
                        <p>{{ $apply['rateStatus'] }}</p>
                    </div>
                    @endif
                        <p class="font-semibold">{{ $apply['title'] }}</p>
                        @if ($apply['applyFileCount'] > 0 )
                            <p class="text-gray-600 text-xs">{{ $apply['applyFileCount'] }} Files has upload</p>
                        @endif
                        <p class="text-gray-600 text-xs">By {{ $apply['userFirstName'] }} {{ $apply['createdAt'] }}</p>
                </div>
                @endforeach
            </div>  
        </ul>