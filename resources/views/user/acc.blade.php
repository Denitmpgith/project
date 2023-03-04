<div class="col-span-12 grid grid-cols-12 md:col-span-12 lg:col-span-3 m-3 p-3 rounded-xl shadow h-fit">
    {{-- @dd($picture); --}}
    <div class="col-span-12 flex justify-center mb-3">
        <img src="{{ asset($picture) }}" width="200"/>
    </div>
    <div class="col-span-12 p-2 rounded-lg text-base bg-slate-200 md:text-xs lg:text-sm">
        <span class="">{{ $user_detiles->first_name }}</span>
        <span class="">{{ $user_detiles->middle_name }}</span>
        <span class="">{{ $user_detiles->last_name }}</span>
        <p class="">{{ $user_detiles->address }}</p>
        <p class="">{{ $user_detiles->city }}</p>
        <p class="">{{ $user_detiles->country }}</p>
        <p class="">{{ $user_detiles->m_phone }}</p>
        <p class="">{{ $user_detiles->email }}</p>
    </div>
</div>