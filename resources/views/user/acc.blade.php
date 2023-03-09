<div class="col-span-12 grid grid-cols-12 md:col-span-12 lg:col-span-3 gap-2 p-3 rounded-xl shadow h-fit">
    {{-- @dd($picture); --}}
    <div class="col-span-12 flex justify-center mb-3">
        <img src="{{ asset($picture) }}" width="200"/>
    </div>
    <form class="col-span-12 rounded text-base bg-slate-200 md:text-xs lg:text-sm mb-1">
        @csrf
        <input type="file" placeholder="{{ $picture }}" value="" >
    </form>
    <div class="col-span-12 p-2 rounded-lg text-base bg-slate-200 md:text-xs lg:text-sm">
        <span class="">{{ $user_detiles->first_name }}</span>
        <span class="">{{ $user_detiles->middle_name }}</span>
        <span class="">{{ $user_detiles->last_name }}</span>
        <span class="">( {{ $user_detiles->gender }} )</span>
        <p class="">{{ $user_detiles->address }}</p>
        <p class="">{{ $user_detiles->city }}</p>
        <p class="">{{ $user_detiles->country }}</p>
        <p class="">{{ $user_detiles->m_phone }}</p>
        <p class="">{{ $user_detiles->email }}</p>
    </div>
    <div class="col-span-12 p-2 rounded-lg text-base bg-slate-200 md:text-xs lg:text-sm">
        @if(auth()->check())
        <p>Detile user Apply or Join Contest :</p>
            <p>Winner : {{ auth()->user()->apply()->where('rate_status', 'Winner')->count() }}</p>
            <p>Runner Up : {{ auth()->user()->apply()->where('rate_status', 'Runner Up')->count() }}</p>
            <p>Norate : {{ auth()->user()->apply()->where('rate_status', 'Norate')->count() }}</p>
            <p>Reject : {{ auth()->user()->apply()->where('rate_status', 'Reject')->count() }}</p>
            <?php echo '<p>Total : ' . (auth()->user()->apply()->where('rate_status', 'Reject')->count() + auth()->user()->apply()->where('rate_status', 'Runner up')->count() + auth()->user()->apply()->where('rate_status', 'Norate')->count() + auth()->user()->apply()->where('rate_status', 'Winner')->count()) . '</p>'; ?>
            <?php echo '<p>Rate user : ' . (auth()->user()->apply()->where('rate_status', 'Reject')->count() - auth()->user()->apply()->where('rate_status', 'Winner')->count()) . '</p>'; ?>
        @endif
    </div>
</div>