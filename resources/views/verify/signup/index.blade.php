@include('template.header')
@include('template.navbar')
<section style="padding-top: 55px; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: black">
  <form action="/signup" method="POST">
    @csrf
    <div class="bg-neutral-900" style="padding: 30px 10px; width: 350px; border-radius: 15px; box-shadow: 0px 0px 10px rgb(200, 200, 200)"
      onmouseover='this.style.boxShadow="0px 0px 25px rgb(100, 100, 100)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";' 
      onmouseout='this.style.boxShadow="0px 0px 10px rgb(200, 200, 200)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";'/>  
      <div class="container mb-3">
        <h2 class="text-center text-white uppercase text-xl mb-2">Register</h2>
        <hr>
      </div>
      <div class="grid grid-cols-12 gap-3" style="">
        <div class="col-start-3 col-span-8">
          <input class="@error('email') is-invalid @enderror w-full" style="border-radius: 4px" type="text" name="email" placeholder="email" id="email" autofocus required>
          @error('email')
          <div class="invalid-feedback text-red-700">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-start-3 col-span-8">
          <input class="@error('emailconfirm') is-invalid @enderror w-full" style="border-radius: 4px" type="text" name="emailconfirm" placeholder="email confirm" id="emailconfirm" required>
          @error('emailconfirm')
          <div class="invalid-feedback text-red-700">
            {{ $message }}
          </div>
          @enderror
        </div>

        <div class="col-start-3 col-span-8">
          <div class="container">
            <div class="ceckbox">
              <input class="form-check-input @error('checkbox1') is-invalid @enderror" name="checkbox1" type="checkbox" id="checkbox1" aria-describedby="invalidCheck3Feedback" required >
              @error('checkbox1')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
              <small class="form-check-label text-white" for="invalidCheck3">Agree to <a href="">terms and conditions</a></small>
            </div>
          </div>
        </div>
        
        <div class="col-start-3 col-span-8 flex justify-center">
          <button name="submitBtn" type="submit" class="hidden" style="width: 100px" disabled>Submit</button>
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
  const email = document.getElementById('email');
  const emailConfirm = document.getElementById('emailconfirm');
  const checkBox = document.getElementById('checkbox1');
  const submitBtn = document.querySelector('button[name="submitBtn"]');
  
  function validateEmail() {
    if (email.value.trim() === '') {
      return false;
    } else {
      return true;
    }
  }
  
  function validateEmailConfirm() {
    if (emailConfirm.value.trim() === '') {
      return false;
    } else if (email.value.trim() !== emailConfirm.value.trim()) {
      return false;
    } else {
      return true;
    }
  }
  
  function validateCheckBox() {
    if (checkBox.checked === false) {
      return false;
    } else {
      return true;
    }
  }
  
  function enableSubmitBtn() {
    const emailNotEmpty = validateEmail();
    const emailConfirmNotEmpty = validateEmailConfirm();
    const emailsMatch = email.value.trim() === emailConfirm.value.trim();
    const checkboxChecked = validateCheckBox();
  
    if (emailNotEmpty && emailConfirmNotEmpty && emailsMatch && checkboxChecked) {
      submitBtn.disabled = false;
      submitBtn.classList.remove('hidden');
      submitBtn.classList.add('bg-blue-500', 'hover:bg-blue-700', 'text-white', 'rounded');
    } else {
      // Jika salah satu kondisi tidak terpenuhi, maka nonaktifkan tombol submit
      submitBtn.disabled = true;
      submitBtn.classList.add('hidden');
      submitBtn.classList.remove('bg-blue-500', 'hover:bg-blue-700', 'text-white', 'rounded');
    }
  }
  
  email.addEventListener('keyup', enableSubmitBtn);
  emailConfirm.addEventListener('keyup', enableSubmitBtn);
  checkBox.addEventListener('change', enableSubmitBtn);
  
  </script>  
  

{{-- @include('template.header')
@include('template.navbar')
<section style="padding-top: 55px; display: flex; justify-content: center; align-items: center; min-height: 100vh; background-color: black">
  <form action="/signup" method="POST">
    @csrf
    <div class="bg-neutral-900" style="padding: 30px 10px; width: 350px; border-radius: 15px; box-shadow: 0px 0px 10px rgb(200, 200, 200)"
      onmouseover='this.style.boxShadow="0px 0px 25px rgb(100, 100, 100)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";' 
      onmouseout='this.style.boxShadow="0px 0px 10px rgb(200, 200, 200)"; this.style.transform="translateY(0px) scale(1.0)"; this.style.transition="box-shadow 3s, transform 1s";'/>  
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
            </div>
            <div class="ceckbox">
              <input class="form-check-input @error('checkbox1') is-invalid @enderror" name="checkbox1" type="checkbox" id="checkbox1" aria-describedby="invalidCheck3Feedback" required >
              @error('checkbox1')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
              <small class="form-check-label text-white" for="invalidCheck3">Agree to <a href="">terms and conditions</a></small>
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
   --}}