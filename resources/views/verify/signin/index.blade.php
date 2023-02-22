@include('template.header')
@include('template.navbar')
<section class="flex justify-center items-center w-full">
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
      onmouseover='this.style.boxShadow="0px 0px 25px rgb(100, 100, 100)"; this.style.transform="translateY(-5px) scale(1.0)"; this.style.transition="box-shadow 2s, transform 1s";' 
      onmouseout='this.style.boxShadow="0px 0px 50px rgb(200, 200, 200)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 2s, transform 1s";'/> 
      <h2 style="text-align: center">Log in</h2>
          <input class="@error('username') is-invalid @enderror" style="border-radius: 4px" type="text" name="username" placeholder="username" id="username" autofocus value="{{ old('username') }}">
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <input class="@error('password') is-invalid @enderror" style="border-radius: 4px" type="text" name="password" placeholder="password" id="password" >
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
          <div style="display: flex; justify-content: center; align-content: center;">
              <button style="border-radius: 5px; width: 100px">submit</button>
          </div>
      </div>
      <div class="" style="display: flex; justify-content: center; align-content: center; flex-direction: row;">
          <span>register&nbsp;</span>
          <a href="/signup" style="display: flex; justify-content: center; align-items: center; flex-wrap: wrap;">here</a>
      </div>
    </form>
  </div>
</section>
