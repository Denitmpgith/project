@include('template.header')
@include('template.navbar')
<section style="padding-top: 55px; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: black">
  <form action="/signup" method="POST">
    @csrf
    <div class="bg-neutral-900" style="padding: 30px 10px; width: 350px; border-radius: 15px; box-shadow: 0px 0px 10px rgb(200, 200, 200)"
      onmouseover='this.style.boxShadow="0px 0px 25px rgb(100, 100, 100)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";' 
      onmouseout='this.style.boxShadow="0px 0px 10px rgb(200, 200, 200)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";'/>  
      <!-- konten div -->
      <div class="container mb-3">
        <h2 class="text-center text-white uppercase text-xl mb-2">Register</h2>
        <hr>
      </div>
      <div class="grid grid-cols-12 gap-3" style="">
        <div class="col-start-3 col-span-8">
          <input class="@error('username') is-invalid @enderror w-full" style="border-radius: 4px" type="text" name="username" placeholder="username" id="username" autofocus required>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="col-start-3 col-span-8">
          <input class="@error('password') is-invalid @enderror w-full" style="border-radius: 4px" type="password" name="password" placeholder="password" id="password" required>
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="col-start-3 col-span-8">
        <input class="@error('cpassword') is-invalid @enderror w-full" style="border-radius: 4px" type="password" name="cpassword" placeholder="confirm password" id="cpassword" required>
        @error('cpassword')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
        </div>

        <div class="col-start-3 col-span-8">
          <div class="container">
            <div class="ceckbox">
              <input class="form-check-input text-white @error('checkbox2') is-invalid @enderror" name="checkbox2" type="checkbox" id="checkbox2" aria-describedby="invalidCheck3Feedback" required >
              @error('ceckbox2')
              <div class="invalid-feedback text-white">
                {{ $message }}
              </div>
              @enderror
              <small class="form-check-label text-white" for="invalidCheck3">I saved username and password</small>
              {{-- <small class="invalid-feedback text-white">You must agree before submitting.</small> --}}
            </div>
            <div class="ceckbox">
              <input class="form-check-input @error('checkbox1') is-invalid @enderror" name="checkbox1" type="checkbox" id="checkbox1" aria-describedby="invalidCheck3Feedback" required >
              @error('checkbox1')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
              <small class="form-check-label text-white" for="invalidCheck3">Agree to <a href="">terms and conditions</a></small>
              {{-- <small class="invalid-feedback text-white">You must agree before submitting.</small> --}}
            </div>
          </div>
        </div>
        <div class="col-start-3 col-span-8 flex justify-center">
          <button name="submitBtn" type="submit" class="btn btn-primary" style="width: 100px" disabled>Submit</button>
        </div>
      </div>
  </form>
  <div class="container text-center">
    <hr class="mt-3">
      <p class="text-white">i have account and login&nbsp;<a href="/signin" class="text-yellow-500">here</a></p>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
  const username = document.getElementsByName("username")[0];
  const password = document.getElementsByName("password")[0];
  const cpassword = document.getElementsByName("cpassword")[0];
  const checkbox1 = document.getElementsByName("checkbox1")[0];
  const checkbox2 = document.getElementsByName("checkbox2")[0];
  const submitBtn = document.getElementsByName("submitBtn")[0];

  checkbox1.checked = false;
  checkbox2.checked = false;

  validateForm();

  checkbox1.addEventListener('change', function() {
    validateForm();
  });

  checkbox2.addEventListener('change', function() {
    validateForm();
  });

  username.addEventListener('input', function() {
    validateForm();
  });

  password.addEventListener('input', function() {
    validateForm();
  });

  cpassword.addEventListener('input', function() {
    validateForm();
  });

  function validateForm() {
    if (
      username.value.trim() !== '' &&
      password.value.trim() !== '' &&
      cpassword.value.trim() !== '' &&
      password.value.trim() === cpassword.value.trim() &&
      checkbox1.checked && checkbox2.checked 
    )      
    {
      submitBtn.disabled = false;
      submitBtn.style.backgroundColor = "#1643A2";
      submitBtn.style.color = "#ffffff";
    } else {
      submitBtn.disabled = true;
      submitBtn.style.backgroundColor = "#eaeaea";
      submitBtn.style.color = "#000000";
    }
  }
});
</script>
  