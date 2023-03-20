@include('template.header')
@include('template.navbar')
<section class="flex justify-center items-center w-full bg-black">
  <div class="container flex justify-center items-center min-h-screen">
    @if(session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('loginError'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('loginError') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <form action="/signin" method="post">
      @csrf
      <div class="" style="display: flex; justify-content: center; align-content: center; flex-wrap: wrap; flex-direction: column; padding: 30px 10px; width: 300px; border-radius: 15px; gap: 15px; box-shadow: 0px 0px 10px rgb(200, 200, 200)"
        onmouseover='this.style.boxShadow="0px 0px 25px rgb(100, 100, 100)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 2s, transform 1s";' 
        onmouseout='this.style.boxShadow="0px 0px 50px rgb(200, 200, 200)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 2s, transform 1s";'/> 
        <h2 class="text-center text-white">Log in</h2>
          <input class="@error('username') is-invalid @enderror" style="border-radius: 4px" type="text" name="username" placeholder="username" id="username" autofocus>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <input class="@error('password') is-invalid @enderror" style="border-radius: 4px" type="password" name="password" placeholder="password" id="password" >
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <div style="display: flex; justify-content: center; align-content: center;">
              <button class="h-7 w-28 text-white bg-neutral-800 rounded hover:bg-neutral-700">submit</button>
          </div>
      </div>
      <div class="flex justify-center align-items-center flex-row">
          <span class="text-white">register&nbsp;</span>
          <a href="/signup" class="flex justify-center align-items-center text-yellow-500">here</a>
      </div>
    </form>
  </div>
</section>
